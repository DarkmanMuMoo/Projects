<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ordpaydao
 *
 * @author Dark
 */
class Ordpaydao extends CI_Model{
    //put your code here
    
     public function __construct() {
        parent::__construct();
        
        $this->load->model('obj/ordpay');
    }
 public function findbyid($ordpaymethod){
         $this->db->where('paymethod', $ordpaymethod);
            $query = $this->db->get('ordpay');
         $obj = null;

        foreach ($query->result() as $row) {

            $obj = $this->makeObj($row);
        }
        // echo var_dump($obj);

        return $obj;
        
    }
     public function findall() {
        
     
        $query = $this->db->get('ordpay');

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
    public function insert(Ordpay $ordpay) {

        $data = array(
            'paymethod' =>$ordpay->getPaymethod(),
            'pay_description' =>$ordpay->getDescription()
          
        );

        return $this->db->insert('ordpay', $data);
    }


     public function makeObj($row) {

        $ordpay = new Ordpay();

        $ordpay->setPaymethod($row->paymethod);
        $ordpay->setDescription($row->pay_description);
      

        return $ordpay;
    }
}

?>
