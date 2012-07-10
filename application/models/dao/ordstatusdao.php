<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ordstatusdao
 *
 * @author Dark
 */
class Ordstatusdao extends CI_Model{
    //put your code here
    
    
    public function __construct() {
        parent::__construct();
        
        $this->load->model('obj/ordstatus');
    }
 public function findbyid($status){
         $this->db->where('ordstatus', $status);
            $query = $this->db->get('ordstatus');
         $obj = null;

        foreach ($query->result() as $row) {

            $obj = $this->makeObj($row);
        }
        // echo var_dump($obj);

        return $obj;
        
    }
     public function findall() {
        
     
        $query = $this->db->get('ordstatus');

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
    public function insert(Ordstatus $ordstatus) {

        $data = array(
            'status' =>$ordstatus->getStatus(),
            'description' =>$ordstatus->getDescription()
          
        );

        return $this->db->insert('ordstatus', $data);
    }


     public function makeObj($row) {

        $ordstatus = new Ordstatus();

        $ordstatus->setStatus($row->status);
        $ordstatus->setDescription($row->description);
      

        return $ordstatus;
    }

}

?>
