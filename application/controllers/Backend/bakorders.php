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
class Bakorders extends CI_Controller{
    //put your code here
    
     public function __construct() {
        parent::__construct();
        
        $this->load->model('dao/empdao');
        
        
        }
     public function index(){
         
  $this->load->model('dao/ordstatusdao');
   $this->load->model('dao/orddao');
        
        $condition = array();
       
        $keyword='';
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

      $orderlist=$this->orddao->findorderbackbyCustormer($condition,$keyword);
        $ordstatuslist = $this->ordstatusdao->findall();
        $data = array();
        $data['orderlist'] = $orderlist;
        $data['ordstatuslist'] = $ordstatuslist;
      
         $this->load->view(lang('bakorder'),$data);
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
   public  function downloadtemplate($tempeno){
            $this->load->model('dao/templatedao');
            
        $template= $this->templatedao->findbyid($tempeno);
          $this->load->helper('download');
         $templatefileroot=  lang('templatefileroot');
          $data = file_get_contents($templatefileroot.$template->getUrl()); // Read the file's contents
$name = $template->getName().'.ai';


force_download($name, $data);
        
    }
    
    
      public function waitforpay($orderno){
      
       $this->changestatus('30',$orderno);
       redirect("Backend/bakorders/vieworderdetail/$orderno");
    }
      public function rejects($orderno){
    
      $this->changestatus('40',$orderno);
     
       redirect("Backend/bakorders/vieworderdetail/$orderno");
    }
    
    private function changestatus($status,$orderno){
       $this->load->model('dao/orddao');
        $order =$this->orddao->findbyid($orderno);
    
        $order->setOrdstatus($status);//wait for validate
       $result= $this->orddao->update($order);
         error_log(var_export($result, true) . 'changer status', 0);
      // log("changestatus  to  $status=".$result);
        
    }
}

?>
