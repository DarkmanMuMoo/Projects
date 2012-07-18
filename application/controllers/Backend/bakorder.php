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
class Bakorder extends CI_Controller{
    //put your code here
    
     public function __construct() {
        parent::__construct();
        
        $this->load->model('dao/empdao');
        
        
        }
     public function index(){
         
  $this->load->model('dao/ordstatusdao');
   $this->load->model('dao/orddao');
        
        $condition = array();
       
        
        if ($this->input->post('email')) {
            $email = $this->input->post('email');
          
                $condition['email'] = $email;
            
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
     $orderlist = null;
if(empty($condition)){
    
         $orderlist = $this->orddao->findall();
    
}else{
    
         $orderlist = $this->orddao->findbymultifield($condition);
    
}
        
        $ordstatuslist = $this->ordstatusdao->findall();
        $data = array();
        $data['orderlist'] = $orderlist;
        $data['ordstatuslist'] = $ordstatuslist;
         
         $this->load->view(lang(bakorder));
     }
}

?>
