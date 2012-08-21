<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of workdao
 *
 * @author Dark
 */
class Workdao extends CI_Model {

    //put your code here

    public function __construct() {
        parent::__construct();
        $this->load->model('obj/work');
    }

    public function insert(Work $work) {

        $data = array(
            'work_name' => $work->getWorkname(),
            'work_description' => $work->getWorkDescription(),
            'startdate' => $work->getStartdate(),
            'enddate' => $work->getEnddate(),
            'empno' => $work->getEmpno(),
            'ordno' => $work->getOrdno()
        );



        return $this->db->insert('work', $data);
    }

    public function delete($workno) {

        return $this->db->delete('work', array('workno' => $workno));
    }

    public function update(Work $work) {
        $data = array(
            'work_name' => $work->getWorkname(),
            'work_description' => $work->getWorkDescription(),
            'startdate' => $work->getStartdate(),
            'enddate' => $work->getEnddate(),
            'empno' => $work->getEmpno(),
            'ordno' => $work->getOrdno()
        );

        $this->db->where('workno', $work->getWorkno());
        return $this->db->update('work', $data);
    }

    public function findsharedwork($keyword,$condition){
        
        
        
    }
    public function findworkdetail($workno) {
        $sql = "select * from work w join employee emp  on w.empno=emp.empno where w.workno=?";
        $query = $this->db->query($sql, array($workno));
        $obj=null;
        foreach ($query->result() as $row) {
          
          $obj=$this->makeObjextends($row);
           
        }
        
        return $obj;
    }

    public function findbyid($workno) {
        $this->db->where('workno', $workno);
        $query = $this->db->get('work');
        $obj = null;

        foreach ($query->result() as $row) {

            $obj = $this->makeObj($row);
            
        }
        // echo var_dump($obj);

        return $obj;
    }

    public function findall() {


        $query = $this->db->get('work');

        $array = array();
        foreach ($query->result() as $row) {
            $type = null;


            $type = $this->makeObj($row);


            array_push($array, $type);
        }
        //echo var_dump($array);

        return $array;
    }

    public function findworklist($keyword = '', $condition = array()) {

        if ($keyword != '') {
            $this->db->or_like('work_name', $keyword);
        }
        foreach ($condition as $index => $row) {

            $this->db->where($index, $row);
        }

        $query = $this->db->get('work');
        $result = array();

        foreach ($query->result() as $row) {
            $obj = null;
            $obj = $this->makeObj($row);
            array_push($result, $obj);
        }
        // echo var_dump($obj);
        //var_dump($this->db->last_query());
        return $result;
    }

    private function makeObj($row) {
        $work = new Work();
        $work->setWorkno($row->workno);
        $work->setWorkname($row->work_name);
        $work->setWorkDescription($row->work_description);
        $work->setStartdate($row->startdate);
        $work->setEnddate($row->enddate);
        $work->setOrdno($row->ordno);
        $work->setEmpno($row->empno);
        return $work;
    }

    private function makeObjextends($row) {
        $this->load->model('extends/work_extends');
        $work = new Work_extends();

        $work->setWorkno($row->workno);
        $work->setWorkname($row->work_name);
        $work->setWorkDescription($row->work_description);
        $work->setStartdate($row->startdate);
        $work->setEnddate($row->enddate);
        $work->setOrdno($row->ordno);
        $work->setEmpno($row->empno);

        $work->setName($row->emp_name);
        $work->setPhone($row->phone);
        $work->setLastname($row->lastname);
        $work->setPosition($row->position);
        $work->setPassword($row->password);
        $work->setEmail($row->email);
        $work->setPicurl($row->pic_url);
        return $work;
    }

}

?>
