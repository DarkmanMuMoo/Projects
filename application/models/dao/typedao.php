<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of typedao
 *
 * @author Dark
 */
class Typedao extends  CI_Model {
    //put your code here
  
      public function __construct() {
     
          
       
       
     
          $this->load->model('obj/type');
    }
    
        public function getoption(Type $type){
         $this->load->model('dao/optiondao');
         
         $sql ='SELECT * FROM option_type ot inner join project.option o  on ot.optionno = o.optionno where type = ? ';
         
         
        $query = $this->db->query($sql, array($type->getType()));
           $array = array();
             foreach ($query->result() as $row) {
$obj = null;
            $obj = $this->optiondao->makeObj($row);
            array_push($array, $obj);
        }
        
        return $array;
    }
    
    public function gettemplate(Type $type){
          $this->load->model('dao/templatedao');
     return   $this->templatedao->findbytype($type->getType());
        
    }
   
    
    
    
    
    
    public function findbyid($type){
         $this->db->where('type', $type);
            $query = $this->db->get('type');
         $obj = null;

        foreach ($query->result() as $row) {

            $obj = $this->makeObj($row);
        }
        // echo var_dump($obj);

        return $obj;
        
    }
     public function findall() {
        
     
        $query = $this->db->get('type');

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
    public function insert(Type $type) {

        $data = array(
            'type' => $type->getType(),
            'type_description' => $type->getDescription(),
           'pic_url'=>$type->getPicurl()
        );

        return $this->db->insert('type', $data);
    }


     public function makeObj($row) {

        $type = new Type;

        $type->setType($row->type);
        $type->setDescription($row->type_description);
       $type->setPicurl($row->pic_url);

        return $type;
    }
    
}

?>
