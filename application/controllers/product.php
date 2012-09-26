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
class Product extends CI_Controller {

    //put your code here

    public function __construct() {
        parent::__construct();

        $this->load->model('obj/orderline');
    }

    public function index() {
        $this->load->model('dao/typedao');
        $data['typelist'] = $this->typedao->findall();
        $this->load->view(lang('productpage'), $data);
    }

    public function chooseProduct($typeno) {
        $this->load->model('dao/typedao');
        $this->load->model('dao/templatedao');
        $this->load->model('dao/paperdao');
        $this->load->model('dao/optiondao');
        $data['type'] = $this->typedao->findbyid($typeno);
        $data['templatelist'] = $this->templatedao->findbytypeno($typeno);

        // var_dump($data['type']);
        $data['paperlist'] = $this->paperdao->findbytypeno($typeno);
        $data['optionlist'] = $this->optiondao->findbytypeno($typeno);

        $this->load->view(lang('chooseproduct'), $data);
    }

    private function __calprice(Template
    $temp, Paper $paper, $amount) {
        
        $printprice = (900 * $paper->getGrame() * $paper->getPriceperkilo()) / (3100 * 500);
 
        $printprice = ceil($printprice);
           error_log("printprice".$printprice);
        $papern = (($amount /$temp->getTrimPerPrint()) + (200)) / $temp->getPrintperReam();
        $papern = ceil($papern);
           error_log("papern".$papern);
        $price=$papern*$printprice;
        
         if($temp->getTypeno()==8){
            $price+=300;    //ห่วงกระดูกงู ขาปติทิน
        }
        if($temp->getTypeno()==10){
            $price+=1500;    //ไดคัท ทำเล่ม
        }

        if($temp->getPlatesize()=='L'){
      
            $price +=( $this->config->item('plate-L')+$this->config->item('print'));//ค่าเพลท  พิม ใหญ่
      
        }else{
            $price +=( $this->config->item('plate-S')+$this->config->item('print'));  //ค่าเพลท พิม  เล็ก
            
        }
        
        $price+=$this->config->item('misc');
        
         
        
      
        
        return $price;
    }

    public function calprice() {
        //  $this->load->model('dao/pricedao');
        $this->load->model('dao/optiondao');
        $this->load->model('dao/templatedao');
        $this->load->model('dao/paperdao');

        // session_start();
        $_SESSION['tmp_ordline'] = new Orderline();
        $tempno = $this->input->post('template');
        $paperno = $this->input->post('paper');
        $optionno = $this->input->post('option');
        $type = $this->input->post('type');
        $qty = $this->input->post('amount');
        $_SESSION['tmp_ordline']->setTempno($tempno);
        $_SESSION['tmp_ordline']->setPaperno($paperno);
        $_SESSION['tmp_ordline']->setOptionno($optionno);
        $_SESSION['tmp_ordline']->setQty($qty);

        $template =$this->templatedao->findbyid($tempno);
        $paper=$this->paperdao->findbyid($paperno);
        
      
        $price=$this->__calprice($template, $paper, $qty);
           $option = $this->optiondao->findbyid($optionno);
           
           if($option->getOptionno()>0){
               
               $price+=($qty*$option->getPrice());
           }
        $price=  round($price*1.2);//กำไร
        //
        //   old version
        //  $priceextends = $this->pricedao->findPriceExtendsby(intval($paperno), intval($tempno), intval($qty));

      //  if ($priceextends != null) {
            $data['paper'] = $paper->getName() . ' ' . $paper->getGrame() . 'g';
            $data['template'] = $template->getName() . ' ' . $template->getSize();
            $data['qty'] = $qty;
            $data['type'] = $type;
            $data['price'] = $price;
            $_SESSION['tmp_ordline']->setPrice($price);
     //   }
      
        $data['option'] = $option->getDescription();
//need to fix later
        $this->load->view(lang('showpriceframe'), $data);
    }

    public function getshowpriceframe() {
        // echo var_dump(($this));
        $this->load->view(lang('showpriceframe'));
    }

}

?>
