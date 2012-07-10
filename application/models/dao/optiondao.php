<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of optiondao
 *
 * @author Dark
 */
class Optiondao  extends CI_Model{
    //put your code here
    
    
    public function __construct() {
        parent::__construct();
           
        
           
        $this->load->model('obj/option');
        
    }
    public function gettypeOf(Option $option){
         $this->load->model('dao/typedao');
         
         $sql ='SELECT * FROM option_type ot inner join type t  on ot.type = t.type where optionno = ? ';
         
         
        $query = $this->db->query($sql, array($option->getOptionno()));
           $array = array();
             foreach ($query->result() as $row) {
$obj = null;
            $obj = $this->typedao->makeObj($row);
            array_push($array, $obj);
        }
        
        return $array;
    }
    
      public function findbytype($type){
             
           $sql =' SELECT * FROM option_type ot inner join `option` o on ot.optionno=o.optionno WHERE ot.`type` = ?';
           
           $query = $this->db->query($sql, array($type));
        
           $array = array();
             foreach ($query->result() as $row) {
                $obj = null;
            $obj = $this->makeObj($row);
            array_push($array, $obj);
           
        }
        
        return $array;    

           
      }
    
     public function findbyid($optionno){
         $this->db->where('optionno', $optionno);
            $query = $this->db->get('ordoption');
         $obj = null;

        foreach ($query->result() as $row) {

            $obj = $this->makeObj($row);
        }
        // echo var_dump($obj);

        return $obj;
        
    }
     public function findall() {
        
     
        $query = $this->db->get('ordoption');

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
    public function insert(Option $option) {

     
        $data = array(
         
            'description' => $option->getDescription(),
             'price' => $option->getPrice()
           
        );

        return $this->db->insert('ordoption', $data);
    }

    
    
     public function makeObj($row) {

        $option = new Option();

        $option->setOptionno($row->optionno);
        
        $option->setDescription($row->description);
       $option->setPrice($row->price);
    

        return $option;
    }

}

?>
