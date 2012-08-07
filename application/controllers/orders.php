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

    public function getpaymentlist($orderno) {
        $this->load->model('dao/ordpaydao');
        $this->load->model('dao/paymentdao');
        $ordpaylist = $this->ordpaydao->findall();
        $paymentlist = $this->paymentdao->findbyorderno($orderno);
        $order = $this->orddao->findbyid($orderno);
        $data['paymentlist'] = $paymentlist;
        $data['order'] = $order;
        $data['ordpaylist'] = $ordpaylist;

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


        $orderlist = $this->orddao->findbymultifield($condition);
        $ordstatuslist = $this->ordstatusdao->findall();
        $data = array();
        $data['orderlist'] = $orderlist;
        $data['ordstatuslist'] = $ordstatuslist;

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

    public function showcart() {
        $this->load->model('dao/templatedao');
        $this->load->model('dao/paperdao');
        $this->load->model('dao/optiondao');


        $data = array();
        if (!isset($_SESSION['cart'])) {
            $_SESSION['cart'] = array();
        } else {

            $data['templatelist'] = $this->templatedao->findall();
            $data['paperlist'] = $this->paperdao->findall();
            $data['optionlist'] = $this->optiondao->findall();
        }

        $this->load->view(lang('showcartframe'), $data);
    }

    public function addtocart() {

        // session_start();
        //log_message('error', 'Some variable Some construct');

        $ordline = $_SESSION['tmp_ordline'];
        // echo var_dump($ordline);
        if (!isset($_SESSION['cart'])) {
            $_SESSION['cart'] = array();
        }
        array_push($_SESSION['cart'], $ordline);
        unset($_SESSION['tmp_ordline']);

        // redirect('home', 'refresh');
        redirect('home/opencartdialog');
    }

    public function removeCartItem($index) {


        unset($_SESSION['cart'][$index]);
        $this->showcart();
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
        $ord->setOrdstatus('10');
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
        $orderno = $this->input->post('orderno');
        $this->changestatus('20', $orderno);
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
