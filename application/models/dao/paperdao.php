<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of paperdao
 *
 * @author Dark
 */
class Paperdao extends CI_Model   {
    //put your code here
      public function __construct() {
        parent::__construct();
        $this->load->model('obj/paper');
         
    }
      public function findbyid($paperno){
         $this->db->where('paperno', $paperno);
            $query = $this->db->get('paper');
         $obj = null;

        foreach ($query->result() as $row) {

            $obj = $this->makeObj($row);
        }
        // echo var_dump($obj);

        return $obj;
        
    }
     public function findall() {
        
     
        $query = $this->db->get('paper');

        $array = array();
        foreach ($query->result() as $row) {
            $obj = null;


            $obj = $this->makeObj($row);


            array_push($array, $obj);
        }
        // echo var_dump($array);

        return $array;
    }
//บันทึกข้อมูล
    public function insert(Paper $paper) {

        $data = array(
            'paperno' => $paper->getPaperno(),
            'paper_name' => $paper->getName(),
             'gram' => $paper->getGrame(),
           'priceperkilo'=>$paper->getPriceperkilo()
        );

        return $this->db->insert('paper', $data);
    }
     public function update(Paper $paper) {
        $data = array(
              'paper_name' => $paper->getName(),
             'gram' => $paper->getGrame(),
           'priceperkilo'=>$paper->getPriceperkilo()
        );

        $this->db->where('paperno', $paper->getPaperno());
        return $this->db->update('paper', $data);
    }
     public function findbytypeno($typeno){
         
     $sql ='select * from paper_type pt join  paper p on pt.paperno=p.paperno   where pt.type_no = ?';
         
         
        $query = $this->db->query($sql, array($typeno));
           $array = array();
             foreach ($query->result() as $row) {
$obj = null;
            $obj = $this->makeObj($row);
            array_push($array, $obj);
        }
        
        return $array;
        
    }

    
    
    
     private function makeObj($row) {

        $paper = new Paper();

        $paper->setPapaerno($row->paperno);
        
        $paper->setName($row->paper_name);
     
       $paper->setGrame($row->gram);
       
       $paper->setPriceperkilo($row->priceperkilo);

        return $paper;
    }
}

?>