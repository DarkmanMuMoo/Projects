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

    public function index() {

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

        $orderlist = $this->orddao->findorderbackbyCustormer($condition, $keyword);
        $ordstatuslist = $this->ordstatusdao->findall();
        $data = array();
        $data['orderlist'] = $orderlist;
        $data['ordstatuslist'] = $ordstatuslist;

        $this->load->view(lang('bakorder'), $data);
    }

    public function vieworderdetail($orderno) {

        $this->load->model('dao/ordstatusdao');
        $this->load->model('dao/orderlinedao');
        $this->load->model('dao/ordsenddao');
        $this->load->model('dao/ordpaydao');
        $this->load->model('dao/orddao');

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
            error_log(var_export($result, true) . 'set active payment', 0);
if($countactive!=2){
             $this->onproduction($orderno);
}
            if ($iscomplete && $result) {

                $this->paymentdao->deleteinactive($orderno);
            }
            redirect('Backend/bakorders/getpaymentlist/' . $orderno);
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

        $this->load->view(lang('bakpaymentlist'), $data);
    }

    public function onproduction($orderno) {
        $this->load->library('smsutil');
        $this->load->library('emailutil');
        $result = $this->changestatus('50', $orderno);
        $config = $this->emailutil->getSmtpconfig();
        $form = lang('adminemail');

       // $to = $email;
        //$subject = 'Colour Harmony: สถานะกำลังปฏิบัติงาน';
       // $message = 'งานของท่านอยู่ในระหว่างการพิมพ์ เมื่องานของท่านสำเร็จแล้วเราจะแจ้งให้ทราบภายหลังค่ะ' . $email;
        


        // $emailresult= $this->emailutil->sendemail($config,$form,$to,$subject,$message);
        //error_log("send email to $to result is".var_export($emailresult, true),0);
        //sent sms here
        //$result = $this->smsutil->sentsms('0849731746','finaltest');

        return $result;
    }

    public function waitforpay($orderno) {
        $this->load->library('smsutil');
        $this->load->library('emailutil');
        $this->changestatus('40', $orderno);

        //sent mail here;
        $config = $this->emailutil->getSmtpconfig();
        $form = lang('adminemail');

      //  $to = $email;
        $subject = 'Colour Harmony: สถานะรอชำระเงิน';
        $message = 'งานของท่านถูกต้องค่ะ กรุณาโอนเงินเพื่อการทำงานต่อไปค่ะ' ;
       


        // $emailresult= $this->emailutil->sendemail($config,$form,$to,$subject,$message);
        //error_log("send email to $to result is".var_export($emailresult, true),0);
        //sent sms here
        //$result = $this->smsutil->sentsms('0849731746','finaltest');
        redirect("Backend/bakorders/vieworderdetail/$orderno");
    }

    public function rejects($orderno) {
        $this->load->library('smsutil');
        $this->load->library('emailutil');
        $this->changestatus('10', $orderno);
//sent mail here;
        $config = $this->emailutil->getSmtpconfig();
        $form = lang('adminemail');

       // $to = $email;
        $subject = 'Colour Harmony: สถานะปฏิเสธ';
        $message = 'งานของท่านไม่ถูกต้อง กรุณาอัพโหลดงานใหม่ค่ะ' ;
        


        // $emailresult= $this->emailutil->sendemail($config,$form,$to,$subject,$message);
        //error_log("send email to $to result is".var_export($emailresult, true),0);
        //sent sms here
        //$result = $this->smsutil->sentsms('0849731746','finaltest');
        redirect("Backend/bakorders/vieworderdetail/$orderno");
    }

    public function ontransfer($orderno) {
        $this->load->library('smsutil');
        $this->load->library('emailutil');
        $this->changestatus('60', $orderno);
//sent mail here;
        $config = $this->emailutil->getSmtpconfig();
        $form = lang('adminemail');

      //  $to = $email;
        $subject = 'Colour Harmony: สถานะสำเร็จ';
        $message = 'งานของท่านเสร็จเรียบร้อยแล้วค่ะ' ;
       


        // $emailresult= $this->emailutil->sendemail($config,$form,$to,$subject,$message);
        //error_log("send email to $to result is".var_export($emailresult, true),0);
        //sent sms here
        //$result = $this->smsutil->sentsms('0849731746','finaltest');
        redirect("Backend/bakorders/vieworderdetail/$orderno");
    }

    public function complete($orderno) {
        $this->load->library('smsutil');
        $this->load->library('emailutil');
        $this->changestatus('70', $orderno);
//sent mail here;
        $config = $this->emailutil->getSmtpconfig();
        $form = lang('adminemail');

       // $to = $email;
        $subject = 'Colour Harmony: สถานะcomplete';
        $message = 'Order Complete' ;
       

        // $emailresult= $this->emailutil->sendemail($config,$form,$to,$subject,$message);
        //error_log("send email to $to result is".var_export($emailresult, true),0);
        //sent sms here
        //$result = $this->smsutil->sentsms('0849731746','finaltest');
        redirect("Backend/bakorders/vieworderdetail/$orderno");
    }

    private function changestatus($status, $orderno) {
        $this->load->model('dao/orddao');
        $order = $this->orddao->findbyid($orderno);

        $order->setOrdstatus($status); //wait for validate
        $result = $this->orddao->update($order);

        error_log(var_export($result, true) . 'changer status' . $status, 0);
        return $result;
        // log("changestatus  to  $status=".$result);
    }

}

?>
