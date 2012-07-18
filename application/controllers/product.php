<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of product
 *
 * @author Dark
 */
class Product  extends CI_Controller{
    //put your code here
    
    public function __construct() {
        parent::__construct();
        $this->load->model('dao/templatedao');
            $this->load->model('dao/paperdao');
               $this->load->model('dao/optiondao');
               $this->load->model('dao/typedao');
                $this->load->model('obj/orderline');
    }
 public function index() {
     
      $data['typelist'] =$this->typedao->findall();
       $this->load->view(lang('productpage'),$data);
     
 }
   public function chooseProduct($typeno){
       
        $data['type']=$this->typedao->findbyid($typeno);
      $data['templatelist'] =  $this->templatedao->findbytypeno($typeno);
      
     // var_dump($data['type']);
         $data['paperlist'] =  $this->paperdao->findbytypeno($typeno);
            $data['optionlist'] =  $this->optiondao->findbytypeno($typeno);
 
         $this->load->view(lang('chooseproduct'),$data);
    }
    public function calprice(){
       // session_start();
        $_SESSION['tmp_ordline']= new Orderline();
        $tempno=$this->input->post('template');
        $paperno=$this->input->post('paper');
        $optionno=$this->input->post('option');
        $qty=$this->input->post('amount');
          $_SESSION['tmp_ordline']->setTempno($tempno);
           $_SESSION['tmp_ordline']->setPaperno($paperno);
          $_SESSION['tmp_ordline']->setOptionno($optionno);
              $_SESSION['tmp_ordline']->setQty($qty);
              
              
       //   need to fix later
           $sql =  lang('sqlcalprice');

        $query = $this->db->query($sql, array(intval($paperno),intval($tempno),  intval($qty)));
      $data=array();
             foreach ($query->result() as $row) {
$data['paper']=$row->papername.' '.$row->gram .'g';
$data['template']=$row->tmpname.' '.$row->size;
$data['qty']=$row->qty;
$data['typeno']=$row->typeno;
$data['price']=$row->price;
   $_SESSION['tmp_ordline']-> setFilepath($row->filepath);
    $_SESSION['tmp_ordline']->setPrice($row->price);
        }
        $option =$this->optiondao->findbyid($optionno);
$data['option'] =  $option->getDescription();
//need to fix later
              $this->load->view(lang('showpriceframe'),$data);
    }
    
    
    public function getshowpriceframe(){
      // echo var_dump(($this));
            $this->load->view(lang('showpriceframe'));
        
        
    }
    
}

?>
