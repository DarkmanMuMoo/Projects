<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of pricedao
 *
 * @author Dark
 */
class Pricedao extends CI_Model {
    //put your code here
    
    public function __construct() {
        parent::__construct();
        $this->load->model('obj/price');
    
         
    }
      public function findbyid($priceno){
         $this->db->where('price_no', $priceno);
            $query = $this->db->get('price');
         $obj = null;

        foreach ($query->result() as $row) {

            $obj = $this->makeObj($row);
        }
         //echo var_dump($obj);

        return $obj;
        
    }
    
   public  function findPriceExtendsby($paperno,$tempno,$qty){
       $this->load->model('extends/price_extends');
        
       $sql ='select * from price pr join paper pa  on pr.paperno=pa.paperno
 join template tmp  on pr.tempno=tmp.tempno 
 join project.`type` ty on ty.type_no=tmp.type_no
 where pr.paperno =? and pr.tempno=? and pr.qty=?';
         $query = $this->db->query($sql, array(intval($paperno),intval($tempno),  intval($qty)));
       
          $obj = null;

        foreach ($query->result() as $row) {

            $obj = $this->makeObjextends($row);
        }
         //echo var_dump($obj);

        return $obj;
         
         
         
   }
    public function findall() {
        
     
        $query = $this->db->get('price');

        $array = array();
        foreach ($query->result() as $row) {
            $type = null;


            $type = $this->makeObj($row);


            array_push($array, $type);
        }
       //  echo var_dump($array);

        return $array;
    }
      public function insert(Price $price) {

        $data = array(
        
            'price_no' => $price->getPriceno(),
             'paperno' => $price->getPaperno(),
            'tempno' => $price->getTempno(),
             'qty' => $price->getQty(),
                  'price' => $price->getPrice()

        );

        return $this->db->insert('template', $data);
    }
    
    
     private function makeObj($row) {

        $price = new Price();

        $price->setPriceno($row->price_no);
        
        $price->setPaperno($row->paperno);
     
       $price->setTempno($row->tempno);
       $price->setQty($row->qty);
       $price->setPrice($row->price);

        return $price;
    }
       private function makeObjextends($row) {

        $price = new Price_extends();

        $price->setPriceno($row->price_no);
        
        $price->setPaperno($row->paperno);
     
       $price->setTempno($row->tempno);
       $price->setQty($row->qty);
       $price->setPrice($row->price);
       
       $price->setPapername($row->paper_name);
       $price->setGrame($row->gram);
       
       $price->setTmpname($row->tmp_name);
       $price->setSize($row->size);
       $price->setUrl($row->url);
       
       $price->setTypeno($row->type_no);
       $price->setType($row->type);
       $price->setTypedescription($row->type_description);
       $price->setPicurl($row->pic_url);

        return $price;
    }
}

?>
