<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of empdao
 *
 * @author Dark
 */
class Empdao extends CI_Model{
    //put your code here
    
    
      public function __construct() {
        parent::__construct();
        $this->load->model('obj/emp');
         
    }
      public function findbyid($empno){
         $this->db->where('employee', $empno);
            $query = $this->db->get('employee');
         $obj = null;

        foreach ($query->result() as $row) {

            $obj = $this->makeObj($row);
        }
        // echo var_dump($obj);

        return $obj;
        
    }
     public function findall() {
        
     
        $query = $this->db->get('employee');

        $array = array();
        foreach ($query->result() as $row) {
            $type = null;


            $type = $this->makeObj($row);


            array_push($array, $type);
        }
        //echo var_dump($array);

        return $array;
    }
//บันทึกข้อมูล
    public function insert(Emp $emp) {

        $data = array(
            'empno' => $emp->getEmpno(),
            'emp_name' => $emp->getName(),
             'lastname' => $emp->getLastname(),
                 'email' => $emp->getEmail(),
            'phone' => $emp->getPhone(),
             'position' => $emp->getPosition(),
            'password'=>$emp->getPassword()
           
        );

        return $this->db->insert('employee', $data);
    }
    
  private function  makeObj($row){
        $emp = new Emp();
        $emp->setEmpno($row->empno);
        $emp->setName($row->emp_name);
        $emp->setPhone($row->phone);
        $emp->setLastname($row->lastname);
        $emp->setPosition($row->position);
        $emp->setPassword($row->password);
        return  $emp;
    }
}

?>
