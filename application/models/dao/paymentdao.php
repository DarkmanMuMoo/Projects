<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of paymentdao
 *
 * @author Dark
 */
class Paymentdao extends CI_Model {
    //put your code here
     public function __construct() {
        parent::__construct();
        $this->load->model('obj/payment');
         
    }
      public function findbyid($payno){
         $this->db->where('payno', $payno);
            $query = $this->db->get('payment');
         $obj = null;

        foreach ($query->result() as $row) {

            $obj = $this->makeObj($row);
        }
        // echo var_dump($obj);

        return $obj;
        
    }
     public function findall() {
        
     
        $query = $this->db->get('payment');

        $array = array();
        foreach ($query->result() as $row) {
            $type = null;


            $type = $this->makeObj($row);


            array_push($array, $type);
        }
        // echo var_dump($array);

        return $array;
    }
//บันทึกข้อมูล
    public function insert(Payment $payment) {

        $data = array(
  
            'period' => $payment->getPeriod(),
             'amount' => $payment->getAmount(),
                'paymentdate' => $payment->getPaymentdate(),
            'orderno' => $payment->getOrderno()
           
        );

        return $this->db->insert('payment', $data);
    }

     private function makeObj($row) {

        $payment = new Payment();

        $payment->setPayno($row->payno);
        
        $payment->setAmount($row->amount);
     
       $payment->setPaymentdate($row->paymentdate);
$payment->setPeriod($row->period);
     
       $payment->setOrderno($row->orderno);
        return $payment;
    }
    
    public function findbyorderno($orderno){
        $this->db->where('orderno', $orderno);
               $query = $this->db->get('payment');

        $array = array();
        foreach ($query->result() as $row) {
            $type = null;


            $type = $this->makeObj($row);


            array_push($array, $type);
        }
        // echo var_dump($array);

        return $array;
        
        
        
        
        
    }
    
    
    
}

?>
