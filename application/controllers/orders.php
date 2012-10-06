<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of order
 *
 * @author Dark
 */
class Orders extends CI_Controller {

    //put your code here

    public function __construct() {
        parent::__construct();


        $this->load->model('dao/orderlinedao');
        $this->load->model('obj/orderline');
        $this->load->model('dao/orddao');
    }

    public function cus_comment() {
        $orderno = $this->input->post('orderno');
        $comment = $this->input->post('comment');

        $order = $this->orddao->findbyid($orderno);
        $order->setCusremark($comment);
        $result = $this->orddao->update($order);

        redirect("orders/viewOrderdetail/$orderno");
    }

    public function paymentimg($payno) {

        $this->load->helper('html');
        $this->load->model('dao/paymentdao');
        $payment = $this->paymentdao->findbyid($payno);

        echo img('uploads/Slips/' . $payment->getPicurl());
        // redirect("orders/getpaymentlist/$ordno");
    }

    public function addpayment() {

        $this->load->model('dao/paymentdao');
        $this->load->library('uploadutil');
        $ordno = $this->input->post('ordno');
        $slipno = $this->input->post('slipno');
        $date = $this->input->post('date');
        $hour = $this->input->post('hour');
        $min = $this->input->post('min');
        $sec = '00';
        $amount = $this->input->post('amount');
        $time = implode(':', array($hour, $min, $sec));
        $paymentdate = $date . ' ' . $time;
        $insertpayment = new Payment();

        $insertpayment->setAmount($amount);
        $insertpayment->setPaymentdate($paymentdate);
        $insertpayment->setSeqno($slipno);
        $insertpayment->setOrderno($ordno);

        $filename = $ordno . '_' . date("Ymd-His");

        $config['upload_path'] = './uploads/Slips';
        $config['allowed_types'] = 'jpg|png';
        $config['max_size'] = '2048';
        $config['file_name'] = $filename;
        $upload = $this->uploadutil->upload($config, 'pic');

        $message = '';
        if ($upload == 'complete') {
            $data = $this->upload->data();
            $insertpayment->setPicurl($filename . $data['file_ext']);
            $result = $this->paymentdao->insert($insertpayment);
            error_log(var_export('addpayment' . $result, true));

            $message = "<script>alert('แจ้งการชำระเงินเรียบร้อย กรุณารอตรวจสอบ ขอบคุณครับ');</script>";
        } else {

            $message = $upload;
        }

        $this->session->set_flashdata('message', $message);
        redirect("orders/getpaymentlist/$ordno");
    }

    public function getpaymentlist($orderno) {
        $this->load->model('dao/ordpaydao');
        $this->load->model('dao/paymentdao');
        $ordpaylist = $this->ordpaydao->findall();
        $paymentlist = $this->paymentdao->findbyorderno($orderno, '1');
        $order = $this->orddao->findbyid($orderno);
        $data['paymentlist'] = $paymentlist;
        $data['order'] = $order;
        $data['ordpaylist'] = $ordpaylist;

        $hour = array();
        for ($i = 0; $i <= 23; $i++) {
            array_push($hour, str_pad($i, 2, "0", STR_PAD_LEFT));
        }
        $min = array();
        for ($i = 0; $i <= 59; $i++) {
            array_push($min, str_pad($i, 2, "0", STR_PAD_LEFT));
        }

        $data['hour'] = $hour;
        $data['min'] = $min;
        $this->load->view(lang('paymentlist'), $data);
    }

    public function index() {
        if ($_SESSION['hasuser']) {

            $this->orderpage();
        } else {



            redirect('product');
        }
    }

    public function reorder($orderno) {

        $this->load->model('dao/templatedao');
        $this->load->model('dao/paperdao');
        $this->load->model('dao/optiondao');
        $this->load->model('dao/ordpaydao');
        $this->load->model('dao/ordsenddao');



        $data['user'] = $_SESSION['user'];

        $_SESSION['temp_orderlinelist'] = $this->orderlinedao->findbyorderno($orderno);

        $data['templatelist'] = $this->templatedao->findall();
        $data['paperlist'] = $this->paperdao->findall();
        $data['optionlist'] = $this->optiondao->findall();


        $data['ordpaylist'] = $this->ordpaydao->findall();
        $data['ordsendlist'] = $this->ordsenddao->findall();



        $this->load->view(lang('createorder'), $data);
    }

    public function orderpage() {
        $this->load->library('pagination');
        $this->load->model('dao/ordstatusdao');
        $user = $_SESSION['user'];
        $email = $user->getEmail();
        $condition = array();
        $condition['email'] = $email;
        $hilight = '0';
        if ($this->input->post('status')) {
            $staus = $this->input->post('status');
            if ($staus != '') {
                $condition['ord_status'] = $staus;
                $hilight = $staus;
            }
        }
        if ($this->input->post('fromdate')) {

            $condition['orderdate >='] = $this->input->post('fromdate');
        }
        if ($this->input->post('todate')) {

            $condition['orderdate <='] = $this->input->post('todate');
        }

        $config['per_page'] = 10;
        $startrow = ($this->input->post()) ? $this->input->post('startrow') : 0;
        $config['total_rows'] = $this->gettotalpage($condition);
        $this->pagination->initialize($config);
        $this->db->limit($config['per_page'], $startrow);
        $orderlist = $this->orddao->findbymultifield($condition);
        $ordstatuslist = $this->ordstatusdao->findall();
        $data = array();
        $data['orderlist'] = $orderlist;
        $data['ordstatuslist'] = $ordstatuslist;
        $data['hilight'] = $hilight;
        $this->load->view(lang('orderpage'), $data);
    }

    private function gettotalpage($condition = array()) {

        foreach ($condition as $index => $row) {

            $this->db->where($index, $row);
        }

        return $this->db->count_all_results('ord');
    }

    public function cancleorder($orderno) {


        $this->orddao->delete($orderno);

        $javascript = "
   document.location.reload();
   ";
        echo $javascript;
    }

    public function Checkout() {
        $this->load->model('dao/templatedao');
        $this->load->model('dao/paperdao');
        $this->load->model('dao/optiondao');
        $this->load->model('dao/ordpaydao');
        $this->load->model('dao/ordsenddao');
        $this->load->library('thailandutil');


        $data['user'] = $_SESSION['user'];

        if (!empty($_SESSION['cart'])) {
            $_SESSION['temp_orderlinelist'] = array_values($_SESSION['cart']);
        }

        $_SESSION['cart'] = array();
        $provincelist = $this->thailandutil->getAllprovinceList();

        $data['provincelist'] = $provincelist;
        $data['templatelist'] = $this->templatedao->findall();
        $data['paperlist'] = $this->paperdao->findall();
        $data['optionlist'] = $this->optiondao->findall();


        $data['ordpaylist'] = $this->ordpaydao->findall();
        $data['ordsendlist'] = $this->ordsenddao->findall();



        $this->load->view(lang('createorder'), $data);
    }

    public function confirmorder() {
        $this->load->model('dao/ordpaydao');
        $this->load->model('dao/templatedao');
        $this->load->model('dao/paperdao');
        $this->load->model('dao/optiondao');
        $this->load->model('dao/ordpaydao');
        $this->load->model('dao/ordsenddao');
        $this->load->library('thailandutil');

        if ($this->input->post('add') == 'tabadd3') {
            $_SESSION['newadd'] = array();
            $_SESSION['newadd']['address'] = $this->input->post('address');

            $_SESSION['newadd']['province'] = $this->thailandutil->findbyid($this->input->post('province'))->getProvincename();
            $_SESSION['newadd']['postcode'] = $this->input->post('postcode');

            $_SESSION['newadd']['phone'] = $this->input->post('phone');
        }
        $data['address'] = $this->input->post('add');
        ;



        $ordsendmethod = $this->input->post('ordsend');
        $ordpaymethod = $this->input->post('ordpay');
        $cusremark = $this->input->post('cusremark');
        $data['templatelist'] = $this->templatedao->findall();
        $data['paperlist'] = $this->paperdao->findall();
        $data['optionlist'] = $this->optiondao->findall();

        // echo $ordsendmethod;
        $data['cusremark'] = $cusremark;
        $data['ordpay'] = $this->ordpaydao->findbyid($ordpaymethod);
        $data['ordsend'] = $this->ordsenddao->findbyid($ordsendmethod);
        // var_dump($data['ordsend']);

        $this->load->view(lang('confirmorder'), $data);
    }

    //insert order data here 


    public function ordersummary() {
        if ($this->input->post('address') == 'tabadd3') {
            $address = $_SESSION['newadd'];
        } else {
            $address = ($this->input->post('address') == 'tabadd1') ? $_SESSION['user']->getAddress1() : $_SESSION['user']->getAddress2();
        }
        $ordsend = $this->input->post('ordsend');
        $ordpay = $this->input->post('ordpay');
        $totalprice = $this->input->post('totalprice');
        $user = $_SESSION['user'];
        $cusremark = $this->input->post('cusremark');

        $ord = new Ord();
        $ord->setAddress($address['address']);
        $ord->setProvince($address['province']);
        $ord->setPostcode($address['postcode']);
        $ord->setEmail($user->getEmail());
        $ord->setPaymethod($ordpay);
        $ord->setSendmethod($ordsend);
        $ord->setOrdstatus('20');
        $ord->setTotalprice($totalprice);
        $ord->setOrderdate(date("Y-m-d"));
        $ord->setCusremark($cusremark);
        $result = $this->orddao->insert($ord);
        error_log(var_export($result, true) . 'insert in ord', 0);  //debug insert
        $orderid = $this->db->insert_id();
        foreach ($_SESSION['temp_orderlinelist'] as $orderline) {
            //$orderline
            $orderline->setOrderno($orderid);
            $result = $this->orderlinedao->insert($orderline);
            error_log(var_export($result, true) . 'insert in orderline', 0);
        }


        unset($_SESSION['temp_orderlinelist']);

        //  $this->load->view(lang('ordersumary'));
        $this->session->set_flashdata('alert', $orderid);
        redirect('orders');
    }

    public function viewOrderdetail($orderno) {
        $this->load->model('dao/ordstatusdao');
        $this->load->model('dao/ordpaydao');
        $this->load->model('dao/ordsenddao');


        $ordstatuslist = $this->ordstatusdao->findall();
        $orderlinelist = $this->orderlinedao->findjoinbyorderno($orderno);
        $ordsendlist = $this->ordsenddao->findall();
        $ordpaylist = $this->ordpaydao->findall();
        $order = $this->orddao->findbyid($orderno);
        $data = array();
        $data['ordsendlist'] = $ordsendlist;
        $data['ordpaylist'] = $ordpaylist;
        $data['order'] = $order;
        $data['ordstatuslist'] = $ordstatuslist;
        $data['orderlinelist'] = $orderlinelist;
        $this->load->view(lang('viewOrderdetail'), $data);
    }

    public function ajaxordersendprice() {
        $this->load->model('dao/ordsenddao');
        $id = $this->input->post('id');
        $price = $this->ordsenddao->findbyid($id);
        echo number_format($price->getSendprice(), 2, '.', ',');
    }

    public function ajaxcheckuploadfile() {
        $orderno = $this->input->post('order');
        $this->load->model('dao/orddao');
        $notupload = $this->orddao->countfilenotupload($orderno);
        if ($notupload == 0) {
            echo 'true';
        } else {

            echo $notupload;
        }
    }

    public function downloadtemplate($tempeno) {
        $this->load->model('dao/templatedao');
        $template = $this->templatedao->findbyid($tempeno);
        $this->load->helper('download');
        $templatefileroot = lang('templatefileroot');
        $data = file_get_contents($templatefileroot . $template->getUrl()); // Read the file's contents
        $name = $template->getName() . '.ai';


        force_download($name, $data);
    }

    public function showuploadframe($orderlineno) {
        $data = array();
        $data['orderlineno'] = $orderlineno;
        $this->load->view(lang('uploadframe'), $data);
    }

    public function waitforvalidate() {
        $this->load->library('smsutil');
        $this->load->library('emailutil');
        $orderno = $this->input->post('orderno');
        $this->changestatus('30', $orderno);


//sent mail here;
        $config = $this->emailutil->getSmtpconfig();
        $form = lang('adminemail');
        $to = $_SESSION['user']->getEmail();
        $subject = "Colour Harmony:รายการสั่งซื้อ $orderno  สถานะตรวจสอบงาน";
        $message = 'ท่านได้อัพโหลดงานเรียบร้อยแล้ว งานของท่านอยู่ในระหว่างการตรวจสอบความถูกต้องค่ะ';

       // $emailresult = $this->emailutil->sendemail($config, $form, $to, $subject, $message);
       // error_log("send email to $to result is" . var_export($emailresult, true), 0);
        //sent sms here
        $phone = $_SESSION['user']->getMobilephone();
        $phone = explode('-', $phone);
        $phone = implode('', $phone);
      //  $result = $this->smsutil->sentsms($phone, "Colour Harmony:รายการสั่งซื้อ $orderno  สถานะตรวจสอบงาน");
       // error_log("send sms to $phone result is" . var_export($result, true) . "because " . $this->smsutil->getDebumsg(), 0);
        // redirect("orders/viewOrderdetail/$orderno");
        redirect("orders");
    }

    private function changestatus($status, $orderno) {

        $order = $this->orddao->findbyid($orderno);
        $order->setOrdstatus($status); //wait for validate
        $result = $this->orddao->update($order);


        error_log(var_export($result, true) . 'change status', 0);
    }

}

?>
