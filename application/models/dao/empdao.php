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
class Empdao extends CI_Model {

    //put your code here


    public function __construct() {
        parent::__construct();
        $this->load->model('obj/emp');
    }

    public function findbyemail($email) {
        $this->db->where('email', $email);
        $query = $this->db->get('employee');
        $obj = null;

        foreach ($query->result() as $row) {

            $obj = $this->makeObj($row);
        }
        // echo var_dump($obj);

        return $obj;
    }

    public function findbyid($empno) {
        $this->db->where('empno', $empno);
        $query = $this->db->get('employee');
        $obj = null;

        foreach ($query->result() as $row) {

            $obj = $this->makeObj($row);
        }
        //var_dump($obj);

        return $obj;
    }

    public function findbymultifield($condition) {
        foreach ($condition as $index => $row) {

            $this->db->where($index, $row);
        }

        $query = $this->db->get('employee');
        $condition = array();

        foreach ($query->result() as $row) {
            $obj = null;
            $obj = $this->makeObj($row);
            array_push($condition, $obj);
        }
        // echo var_dump($obj);
        // var_dump($this->db->last_query());
        return $condition;
    }

    public function delete($empno) {

        return $this->db->delete('employee', array('empno' => $empno));
    }

    public function update(Emp $emp) {
        $data = array(
            'emp_name' => $emp->getName(),
            'lastname' => $emp->getLastname(),
            'email' => $emp->getEmail(),
            'phone' => $emp->getPhone(),
            'position' => $emp->getPosition(),
            'password' => $emp->getPassword(),
            'pic_url' => $emp->getPicurl()
        );

        $this->db->where('empno', $emp->getEmpno());
        return $this->db->update('employee', $data);
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
            'password' => $emp->getPassword(),
            'pic_url' => $emp->getPicurl()
        );

        return $this->db->insert('employee', $data);
    }

    public function findemplist($keyword = '', $condition = array()) {

        if ($keyword != '') {
            $this->db->or_like('emp_name', $keyword);
            $this->db->or_like('lastname', $keyword);
            $this->db->or_like('email', $keyword);
        }
        foreach ($condition as $index => $row) {

            $this->db->where($index, $row);
        }

        $query = $this->db->get('employee');
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
        $emp = new Emp();
        $emp->setEmpno($row->empno);
        $emp->setName($row->emp_name);
        $emp->setPhone($row->phone);
        $emp->setLastname($row->lastname);
        $emp->setPosition($row->position);
        $emp->setPassword($row->password);
        $emp->setEmail($row->email);
        $emp->setPicurl($row->pic_url);
        return $emp;
    }

}

?>
