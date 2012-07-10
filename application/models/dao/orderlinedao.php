<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of orderlinedao
 *
 * @author Dark
 */
class Orderlinedao  extends CI_Model{
    //put your code here
        public function __construct() {
        parent::__construct();
        $this->load->model('obj/orderline');
         
    }
      public function findbyid($ordlineno){
         $this->db->where('ordlineno', $ordlineno);
            $query = $this->db->get('orderline');
         $obj = null;

        foreach ($query->result() as $row) {

            $obj = $this->makeObj($row);
        }
        // echo var_dump($obj);

        return $obj;
        
    }
    public function findbyorderno($orderno){
         $this->db->where('orderno', $orderno);
            $query = $this->db->get('orderline');
     $array = array();

        foreach ($query->result() as $row) {
   $obj = null;
            $obj = $this->makeObj($row);
            array_push($array, $obj);
        }
        // echo var_dump($obj);

    return  $array;
        
    }
    
    
     public function findall() {
        
     
        $query = $this->db->get('orderline');

        $array = array();
        foreach ($query->result() as $row) {
            $option = null;


            $option = $this->makeObj($row);


            array_push($array, $option);
        }
        // echo var_dump($array);

        return $array;
    }
//บันทึกข้อมูล
    public function insert(Orderline $orderline) {

     
        $data = array(
         
            'orderno' => $orderline->getOrderno(),
             'paperno' => $orderline->getPaperno(),
                'tempno' => $orderline->getTempno(),
             'optionno' => $orderline->getOptionno(),
            'qty' => $orderline->getQty(),
             'price' => $orderline->getPrice(),
            'filepath' => $orderline->getFilepath()
           
            
           
        );

        return $this->db->insert('orderline', $data);
    }
       private function makeObj($row) {

        $ordline = new Orderline();

        $ordline->setOrderno($row->orderno);
        $ordline->setFilepath($row->filepath);
        $ordline->setOrdlineno($row->ordlineno);
        $ordline->setPaperno($row->paperno);
        $ordline->setTempno($row->tempno);
        $ordline->setQty($row->qty);
        $ordline->setPrice($row->price);
     $ordline->setOptionno($row->optionno);
        return $ordline;
    }
}

?>
