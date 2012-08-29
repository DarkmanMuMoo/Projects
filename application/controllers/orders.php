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

    public function addpayment() {

        $this->load->model('dao/paymentdao');
        $this->load->library('uploadutil');
        $ordno = $this->input->post('ordno');
        $slipno = $this->input->post('slipno');
        $date = $this->input->post('date');
        $hour = $this->input->post('hour');
        $min = $this->input->post('min');
        $sec = $this->input->post('sec');
        $amount = $this->input->post('amount');
        $time = implode(':', array($hour, $min, $sec));
        $paymentdate = $date . ' ' . $time;
        $insertpayment = new Payment();

        $insertpayment->setAmount($amount);
        $insertpayment->setPaymentdate($paymentdate);
        $insertpayment->setSeqno($slipno);
        $insertpayment->setOrderno($ordno);

        $filename = $ordno . '_' . date("Ymd-His");
        $insertpayment->setPicurl($filename);
        $config['upload_path'] = './uploads/Slips';
        $config['allowed_types'] = 'jpg|png';
        $config['max_size'] = '2048';
        $config['file_name'] = $filename;
        $upload = $this->uploadutil->upload($config, 'pic');

        $message = '';
        if ($upload == 'complete') {

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



            redirect('home');
        }
    }

    public function orderpage() {

        $this->load->model('dao/ordstatusdao');
        $user = $_SESSION['user'];
        $email = $user->getEmail();
        $condition = array();
        $condition['email'] = $email;
        $hilight='0';
        if ($this->input->post('status')) {
            $staus = $this->input->post('status');
            if ($staus != '') {
                $condition['ord_status'] = $staus;
                $hilight=$staus;
            }
        }
        if ($this->input->post('fromdate')) {

            $condition['orderdate >='] = $this->input->post('fromdate');
        }
        if ($this->input->post('todate')) {

            $condition['orderdate <='] = $this->input->post('todate');
        }


        $orderlist = $this->orddao->findbymultifield($condition);
        $ordstatuslist = $this->ordstatusdao->findall();
        $data = array();
        $data['orderlist'] = $orderlist;
        $data['ordstatuslist'] = $ordstatuslist;
        $data['hilight']=$hilight;
        $this->load->view(lang('orderpage'), $data);
    }

    public function cancleorder($orderno) {

        $this->orderlinedao->delete($orderno);
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



        $data['user'] = $_SESSION['user'];

        if (!isset($_SESSION['temp_orderlinelist'])) {
            $_SESSION['temp_orderlinelist'] = array_values($_SESSION['cart']);
        }
        $_SESSION['cart'] = array();
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


        $data['address'] = $this->input->post('add');
        $ordsendmethod = $this->input->post('ordsend');
        $ordpaymethod = $this->input->post('ordpay');

        $data['templatelist'] = $this->templatedao->findall();
        $data['paperlist'] = $this->paperdao->findall();
        $data['optionlist'] = $this->optiondao->findall();

        // echo $ordsendmethod;
        $data['ordpay'] = $this->ordpaydao->findbyid($ordpaymethod);
        $data['ordsend'] = $this->ordsenddao->findbyid($ordsendmethod);
       // var_dump($data['ordsend']);

        $this->load->view(lang('confirmorder'), $data);
    }

    //insert order data here 


    public function ordersummary() {
        $address = ($this->input->post('address') == 'add1') ? $_SESSION['user']->getAddress1() : $_SESSION['user']->getAddress2();
        $ordsend = $this->input->post('ordsend');
        $ordpay = $this->input->post('ordpay');
        $totalprice = $this->input->post('totalprice');
        $user = $_SESSION['user'];


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
        $this->load->view(lang('ordersumary'));
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
        $to = $email;
        $subject = 'Colour Harmony: สถานะตรวจสอบงาน';
        $message = 'ท่านได้อัพโหลดงานเรียบร้อยแล้ว งานของท่านอยู่ในระหว่างการตรวจสอบความถูกต้องค่ะ' ;
      

        // $emailresult= $this->emailutil->sendemail($config,$form,$to,$subject,$message);
        //error_log("send email to $to result is".var_export($emailresult, true),0);
      
      //sent sms here
        //$result = $this->smsutil->sentsms('0849731746','finaltest');

        redirect("orders/viewOrderdetail/$orderno");
    }

    private function changestatus($status, $orderno) {

        $order = $this->orddao->findbyid($orderno);
        $order->setOrdstatus($status); //wait for validate
        $result = $this->orddao->update($order);


        error_log(var_export($result, true) . 'change status', 0);
    }

}

?>
