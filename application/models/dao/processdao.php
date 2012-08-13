<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of processdao
 *
 * @author Dark
 */
class Processdao  extends CI_Model{
    //put your code here
    
    
      public function __construct() {
     
        
          $this->load->model('obj/process');
    }
    
 public function findbyworkno($workno){
       $this->db->where('workno', $workno);
   $query = $this->db->get('process');

        $array = array();
        foreach ($query->result() as $row) {
            $type = null;


            $type = $this->makeObj($row);


            array_push($array, $type);
        }
        // echo var_dump($array);

        return $array;
    
}
    
    public function findbyid($processno){
         $this->db->where('processno', $processno);
            $query = $this->db->get('process');
         $obj = null;

        foreach ($query->result() as $row) {

            $obj = $this->makeObj($row);
        }
        // echo var_dump($obj);

        return $obj;
        
    }
     public function findall() {
        
     
        $query = $this->db->get('process');

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
    public function insert(Process $process) {

        $data = array(
            'pro_description' => $process->getProdescription(),
            'workno' => $process->getWorkno(),
            'empno' => $process->getEmpno(),
           'date'=>$process->getDate()
        );

        return $this->db->insert('process', $data);
    }


     public function makeObj($row) {

        $process = new Process();
$process->setProcessno($row->processno);
        $process->setDate($row->date);
        $process->setProdescription($row->pro_description);
       $process->setEmpno($row->empno);
 $process->setWorkno($row->workno);
        return $process;
    }
}

?>
