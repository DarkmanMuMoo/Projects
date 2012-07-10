<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ordsenddao
 *
 * @author Dark
 */
class Ordsenddao extends CI_Model {
    //put your code here
    
    public function __construct() {
        parent::__construct();
        
        $this->load->model('obj/ordsend');
    }
 public function findbyid($ordsendmethod){
     
     echo $ordsendmethod;
         $this->db->where('sendmethod', $ordsendmethod);
            $query = $this->db->get('ordsend');
         $obj = null;


        foreach ($query->result() as $row) {

            $obj = $this->makeObj($row);
        }
        // echo var_dump($obj);

        return $obj;
        
    }
     public function findall() {
        
     
        $query = $this->db->get('ordsend');

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
    public function insert(Ordsend $ordsend) {

        $data = array(
            'sendmethod' =>$ordsend->getSendmethod(),
            'description' =>$ordsend->getDescription()
          
        );

        return $this->db->insert('ordsend', $data);
    }


     public function makeObj($row) {

        $ordsend = new Ordsend();

        $ordsend->setSendmethod($row->sendmethod);
        $ordsend->setDescription($row->description);
      

        return $ordsend;
    }
}

?>
