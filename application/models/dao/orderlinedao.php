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
      public function delete($orderno){
         $this->db->delete('orderline', array('orderno' => $orderno));
        
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
    //paper template option
     public function findjoinbyorderno($orderno){
     $sql = 'select *  from orderline  as ol  join paper as p on ol.paperno=p.paperno 
join template as t on t.tempno=ol.tempno
join ordoption as op on ol.optionno=op.optionno
where ol.orderno=?';
     $query = $this->db->query($sql, array(intval($orderno)));
     $array = array();

        foreach ($query->result() as $row) {
   $obj = null;
            $obj = $this->makeObjextends($row);
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
    
     private function makeObjextends($row) {
$this->load->model('extends/orderline_extends');
        $ordline = new Orderline_extends();

       $ordline->setOrderno($row->orderno);
        $ordline->setFilepath($row->filepath);
        $ordline->setOrdlineno($row->ordlineno);
        $ordline->setPaperno($row->paperno);
        $ordline->setTempno($row->tempno);
        $ordline->setQty($row->qty);
        $ordline->setPrice($row->price);
     $ordline->setOptionno($row->optionno);
         $ordline->setPapername($row->paper_name);
         $ordline->setGram($row->gram);
         $ordline->setTmpname($row->tmp_name);
         $ordline->setTmpsize($row->size);
           $ordline->setTmptype($row->type);
         $ordline->setTmpurl($row->url);
         
         $ordline->setOptiondescription($row->option_description);
         $ordline->setOptionprice($row->option_price);
        return $ordline;
    }
}

?>
