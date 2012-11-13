<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of bakorder
 *
 * @author Dark
 */
class Bakorders extends CI_Controller {

    //put your code here

    public function __construct() {
        parent::__construct();

        $this->load->model('dao/empdao');
    }

    private function addtrackingno($orderno, $trackingno) {
        $this->load->model('dao/ordtrackingdao');
        $ordtracking = new Ordtracking();
        $ordtracking->setOrderno($orderno);
        $ordtracking->setTrackingno($trackingno);
        $result = $this->ordtrackingdao->insert($ordtracking);
        return $result;
    }

    public function ajaxchangeshipdate() {
        $this->load->model('dao/orddao');
        $newdate = $this->input->post('date');
        $orderno = $this->input->post('orderno');
        $order = $this->orddao->findbyid($orderno);
        $order->setExpectedshipdate($newdate);
        $this->orddao->update($order);

        $this->output->set_output($newdate);
    }

    public function seller_comment() {
        $this->load->model('dao/orddao');
        $orderno = $this->input->post('orderno');
        $comment = $this->input->post('comment');

        $order = $this->orddao->findbyid($orderno);
        $order->setSellerremark(trim($comment));
        $result = $this->orddao->update($order);

        redirect("Backend/bakorders/vieworderdetail/$orderno");
    }

    public function index() {
        $this->load->library('pagination');
        $this->load->model('dao/ordstatusdao');
        $this->load->model('dao/orddao');

        $condition = array();

        $keyword = '';
        if ($this->input->post('keyword')) {
            $keyword = $this->input->post('keyword');
        }
        if ($this->input->post('status')) {
            $staus = $this->input->post('status');
            if ($staus != '') {
                $condition['ord_status'] = $staus;
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
        $config['total_rows'] = $this->gettotalpage($condition, $keyword);
        $this->pagination->initialize($config);
        $this->db->limit($config['per_page'], $startrow);


        $orderlist = $this->orddao->findorderbackbyCustormer($condition, $keyword);
        // echo $this->db->last_query();
        $ordstatuslist = $this->ordstatusdao->findall();
        $data = array();
        $data['orderlist'] = $orderlist;
        $data['ordstatuslist'] = $ordstatuslist;

        $this->load->view(lang('bakorder'), $data);
    }

    private function gettotalpage($condition = array(), $keyword = '') {


        $this->db->join('custormer', 'custormer.email = ord.email');
        if ($keyword != '') {

            $where = "(`ord`.`email` LIKE '%$keyword%' OR `cus_name` LIKE '%$keyword%' OR `lastname` LIKE '%$keyword%' )";
            $this->db->where($where);
        }
        foreach ($condition as $index => $row) {

            $this->db->where($index, $row);
        }


        return $this->db->count_all_results('ord');
        ;
    }

    public function vieworderdetail($orderno) {

        $this->load->model('dao/ordstatusdao');
        $this->load->model('dao/orderlinedao');
        $this->load->model('dao/ordtrackingdao');
        $this->load->model('dao/ordsenddao');
        $this->load->model('dao/ordpaydao');
        $this->load->model('dao/orddao');
        $this->load->driver('cache', array('adapter' => 'file'));
        $ordstatuslist = $this->ordstatusdao->findall();
        $orderlinelist = $this->orderlinedao->findjoinbyorderno($orderno);
        $ordsendlist = $this->ordsenddao->findall();
        $ordpaylist = $this->ordpaydao->findall();
        $order = $this->orddao->findbyid($orderno);
        $tax = $data['tax'] = $this->cache->file->get('tax', true);
        $data = array();
        $data['taxlabel'] = "ภาษี$tax%";
        $data['taxvalue'] = (floatval($tax) / 100) + 1;
        $data['ordsendlist'] = $ordsendlist;
        $data['ordpaylist'] = $ordpaylist;
        $data['order'] = $order;
        $data['ordstatuslist'] = $ordstatuslist;
        $data['orderlinelist'] = $orderlinelist;
        if ($order->getSendmethod() == 'A') {
            $ordtracking = $this->ordtrackingdao->findbyorderno($orderno);
            if ($ordtracking != null) {

                $data['ordtracking'] = $ordtracking->getTrackingno();
            }
        }
        if ($order->getOrdstatus() >= 40) {

            $data['paymentview'] = $this->getpaymentlist($orderno);
        }
        $this->load->view(lang('BakviewOrderdetail'), $data);
    }

    public function downloadFile($orderlineno) {
        $this->load->model('dao/orderlinedao');
        $this->load->helper('download');
        $orderline = $this->orderlinedao->findbyid($orderlineno);
        $filepath = $orderline->getFilepath();
        if (empty($filepath)) {

            $javascript = "<script>alert('no File');</script>";
            echo $javascript;
        } else {

            $uploadroot = './uploads';
            $path = $uploadroot . $orderline->getFilepath();
            // var_dump($path);
            //var_dump(file_exists($path));
            if (file_exists($path)) {
                $data = file_get_contents($path); // Read the file's contents
                $name = basename($path);


                force_download($name, $data);
            } else {

                $javascript = "<script>alert('no File');</script>";
                echo $javascript;
            }
        }
    }

    public function rejectpayment() {
        $this->load->model('dao/paymentdao');
        $payno = $this->input->post('payno');
        $orderno = $this->input->post('orderno');
        $payment = $this->paymentdao->findbyid($payno);
        $payment->setActive('2');

        $result = $this->paymentdao->update($payment);

        error_log(var_export($result, true) . 'set active payment', 0);

        redirect('Backend/bakorders/vieworderdetail/' . $orderno);
    }

    public function settoactive() {
        $this->load->model('dao/paymentdao');
        $payno = $this->input->post('payno');
        $orderno = $this->input->post('orderno');
        $paymethod = $this->input->post('paymethod');
        $countactive = $this->input->post('countactive');

        $countactive+=1;

        $payment = $this->paymentdao->findbyid($payno);
        $iscomplete = false;
        if ($countactive <= 2) {
            switch ($paymethod) {
                case 10://one time
                    $payment->setPeriod('ชำระครั้งเดียว');
                    $iscomplete = true;
                    break;
                case 20://2 time
                    $payment->setPeriod("ชำระครั้งที่$countactive");
                    if ($countactive == 2) {

                        $iscomplete = true;
                    }
                    break;
            }
            $payment->setActive('1');
            $result = $this->paymentdao->update($payment);
            if (!$iscomplete) {


                $this->onproduction($orderno);
            }
            error_log(var_export($result, true) . 'set active payment', 0);
            redirect('Backend/bakorders/vieworderdetail/' . $orderno);
        } else {

            echo 'somthing wrong!!';
        }
    }

    public function getpaymentlist($orderno) {
        $this->load->model('dao/orddao');
        $this->load->model('dao/ordpaydao');
        $this->load->model('dao/paymentdao');
        $ordpaylist = $this->ordpaydao->findall();
        $paymentlist = $this->paymentdao->findbyorderno($orderno);
        $order = $this->orddao->findbyid($orderno);
        $data['paymentlist'] = $paymentlist;
        $data['order'] = $order;
        $data['ordpaylist'] = $ordpaylist;

        return $this->load->view(lang('bakpaymentlist'), $data, true);
    }

    public function onproduction($orderno) {
        $this->load->model('dao/orddao');
        $this->load->library('smsutil');
        $this->load->library('emailutil');

        $next15day = time() + ( 15 * 60 * 60 * 24 );
        $result = $this->changestatus('50', $orderno, date("Y-m-d", $next15day));
        $config = $this->emailutil->getServerconfig();
        $form = lang('adminemail');

        $ord = $this->orddao->findbyid($orderno);
        $to = $ord->getEmail();
        $subject = "Colour Harmony: ($orderno) สถานะกำลังปฏิบัติงาน";
        $message = 'งานของท่านอยู่ในระหว่างการพิมพ์ เมื่องานของท่านสำเร็จแล้วเราจะแจ้งให้ทราบภายหลังค่ะ';

        $cus = $this->cusdao->findbyEmail($ord->getEmail());
        $phone = $cus->getMobilephone();
        $phone = explode('-', $phone);
        $phone = implode('', $phone);
        $messagephone = $subject . "\n" . $message;
         if ($cus->getIssentemail() == 'T') {
            $emailresult = $this->emailutil->sendemail($config, $form, $to, $subject, $message);
            error_log("send email to $to result is" . var_export($emailresult, true), 0);
        }

        if ($cus->getIssetsms() == 'T') {
            $result = $this->smsutil->sentsms($phone, $messagephone);
            error_log("send sms to $phone result is" . var_export($result, true) . "because " . $this->smsutil->getDebumsg(), 0);
        }

        return $result;
    }

    public function waitforpay($orderno) {
        $this->load->model('dao/orddao');

        $this->load->library('smsutil');
        $this->load->library('emailutil');

        $this->changestatus('40', $orderno);


        //sent mail here;


        $config = $this->emailutil->getServerconfig();

        $form = lang('adminemail');
        $ord = $this->orddao->findbyid($orderno);
        $to = $ord->getEmail();
        $subject = 'Colour Harmony: สถานะรอชำระเงิน';
        $message = 'งานของท่านถูกต้องค่ะ กรุณาโอนเงินทังหมด หรือ เงินมัดจำ(ในกรณีที่เลือกวิธีการชำระเงินเป็นแบ่งจ่าย)เพื่อการทำงานต่อไปค่ะ';
        $messagephone = $subject . $message;



        //sent sms here
        $cus = $this->cusdao->findbyEmail($ord->getEmail());
        $phone = $cus->getMobilephone();
        $phone = explode('-', $phone);
        $phone = implode('', $phone);
        if ($cus->getIssentemail() == 'T') {
            $emailresult = $this->emailutil->sendemail($config, $form, $to, $subject, $message);
            error_log("send email to $to result is" . var_export($emailresult, true), 0);
        }

        if ($cus->getIssetsms() == 'T') {
            $result = $this->smsutil->sentsms($phone, $messagephone);
            error_log("send sms to $phone result is" . var_export($result, true) . "because " . $this->smsutil->getDebumsg(), 0);
        }

        redirect("Backend/bakorders/vieworderdetail/$orderno");
    }

    public function rejects() {
        $orderno = $this->input->post('orderno');
        $this->load->library('smsutil');
        $this->load->library('emailutil');
        $orderno = $this->input->post('orderno');
        $msg = $this->input->post('msg');
        $this->changestatus('10', $orderno);
//sent mail here;
        $config = $this->emailutil->getServerconfig();
        $form = lang('adminemail');

        // $to = $email;
        $subject = "Colour Harmony: รายการสั่งซื้อ $orderno สถานะปฏิเสธ";
        $message = 'งานของท่านไม่ถูกต้อง กรุณาอัพโหลดงานใหม่ค่ะ  ';
        $message .= '<p>';
        $message .= $msg;
        $message .= '</p>';

        $ord = $this->orddao->findbyid($orderno);
        $ord->setSellerremark($ord->getSellerremark() . $msg);
        $this->orddao->update($ord);
        $cus = $this->cusdao->findbyEmail($ord->getEmail());
        $phone = $cus->getMobilephone();
        $phone = explode('-', $phone);
        $phone = implode('', $phone);

        $messagephone = "งานของท่านไม่ถูกต้อง กรุณาอัพโหลดงานใหม่ค่ะ \n";
        $messagephone.=$msg;

        if ($cus->getIssentemail() == 'T') {
            $emailresult = $this->emailutil->sendemail($config, $form, $to, $subject, $message);
            error_log("send email to $to result is" . var_export($emailresult, true), 0);
        }

        if ($cus->getIssetsms() == 'T') {
            $result = $this->smsutil->sentsms($phone, $messagephone);
            error_log("send sms to $phone result is" . var_export($result, true) . "because " . $this->smsutil->getDebumsg(), 0);
        }
        redirect("Backend/bakorders/vieworderdetail/$orderno");
    }

    private function checkpayment($orderno) {
        $result = true;
        $this->load->model('dao/paymentdao');
        $this->load->model('dao/orddao');
        $ord = $this->orddao->findbyid($orderno);
        if ($ord->getPaymethod() == 20) {
            $payment = $this->paymentdao->findbyorderno($orderno, 1);

            $result = (count($payment) >= 2) ? true : false;
        }
        return $result;
    }

    public function ontransfer($orderno) {
        $this->load->model('dao/orddao');
        $this->load->model('dao/ordtrackingdao');
        $ord = $this->orddao->findbyid($orderno);
        $this->load->library('smsutil');
        $this->load->library('emailutil');




        $checkpayment = $this->checkpayment($orderno);
        if ($checkpayment) {
            if ($this->input->post('tracking')) {
                $this->addtrackingno($orderno, $this->input->post('tracking'));
            }
            $this->changestatus('60', $orderno);
//sent mail here;
            $config = $this->emailutil->getServerconfig();
            $form = lang('adminemail');
            $ord = $this->orddao->findbyid($orderno);
            $to = $ord->getEmail();
            //  $to = $email;
            $subject = 'Colour Harmony: จัดส่ง';
            $message = 'งานของท่านอยู่ระหว่างการจัดส่ง (สามารถตรวจสอบเลข Tracking number  ได้ในกรณีที่ ส่งทางไปรษณีย์)';


            $cus = $this->cusdao->findbyEmail($ord->getEmail());
            $phone = $cus->getMobilephone();
            $phone = explode('-', $phone);
            $phone = implode('', $phone);

            $messagephone = "Colour Harmony:($orderno) สถานะกำลังส่ง \n";
            $messagephone.= $message;

            if ($cus->getIssentemail() == 'T') {
                $emailresult = $this->emailutil->sendemail($config, $form, $to, $subject, $message);
                error_log("send email to $to result is" . var_export($emailresult, true), 0);
            }

            if ($cus->getIssetsms() == 'T') {
                $result = $this->smsutil->sentsms($phone, $messagephone);
                error_log("send sms to $phone result is" . var_export($result, true) . "because " . $this->smsutil->getDebumsg(), 0);
            }
        } else {
            $this->session->set_flashdata('warning', 'ยังชำระเงินไม่ครบไม่สามารดำเนินการต่อไปได้');
        }
        redirect("Backend/bakorders/vieworderdetail/$orderno");
    }

    public function complete($orderno) {
        $this->load->model('dao/orddao');
        $this->load->library('smsutil');
        $this->load->library('emailutil');
        $this->changestatus('70', $orderno, date("Y-m-d"));
//sent mail here;
        $config = $this->emailutil->getServerconfig();
        $form = lang('adminemail');

        $ord = $this->orddao->findbyid($orderno);
        $to = $ord->getEmail();
        $subject = 'Colour Harmony: สถานะcomplete';
        $message = 'Order ของคุนเสร็จสมบูรณ์ ขอบคุณที่ใช่บริการกับเรา ขอบคุณครับ';
        $cus = $this->cusdao->findbyEmail($ord->getEmail());
        $phone = $cus->getMobilephone();
        $phone = explode('-', $phone);
        $phone = implode('', $phone);

        $messagephone = "Colour Harmony: สถานะcomplete \n";
        $messagephone.= $message;

        if ($cus->getIssentemail() == 'T') {
            $emailresult = $this->emailutil->sendemail($config, $form, $to, $subject, $message);
            error_log("send email to $to result is" . var_export($emailresult, true), 0);
        }

        if ($cus->getIssetsms() == 'T') {
            $result = $this->smsutil->sentsms($phone, $messagephone);
            error_log("send sms to $phone result is" . var_export($result, true) . "because " . $this->smsutil->getDebumsg(), 0);
        }
        redirect("Backend/bakorders/vieworderdetail/$orderno");
    }

    private function changestatus($status, $orderno, $date = null) {
        $this->load->model('dao/orddao');
        $order = $this->orddao->findbyid($orderno);

        $order->setOrdstatus($status); //wait for validate
        if ($date != null) {

            if ($status != 70) {

                $order->setExpectedshipdate($date);
            } else {

                $order->setRecievedate($date);
            }
        }
        $result = $this->orddao->update($order);

        error_log(var_export($result, true) . 'changer status' . $status, 0);
        return $result;
        // log("changestatus  to  $status=".$result);
    }

}

?>
