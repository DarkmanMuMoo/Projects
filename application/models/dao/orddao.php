<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of orddao
 *
 * @author Dark
 */
class Orddao extends CI_Model {

    //put your code here

    public function __construct() {
        parent::__construct();
        $this->load->model('obj/ord');
    }

    public function update(Ord $ord) {
        $data = array(
            'email' => $ord->getEmail(),
            'orderdate' => $ord->getOrderdate(),
            'paymethod' => $ord->getPaymethod(),
            'sendmethod' => $ord->getSendmethod(),
            'ord_status' => $ord->getOrdstatus(),
            'total_price' => $ord->getTotalprice(),
            'address' => $ord->getAddress(),
            'province' => $ord->getProvince(),
            'postcode' => $ord->getPostcode(),
            'phone' => $ord->getPhone(),
            'phone2' => $ord->getPhone2(),
            'address2' => $ord->getAddress2(),
            'province2' => $ord->getProvince2(),
            'postcode2' => $ord->getPostcode2(),
            'expected_ship_date' => $ord->getExpectedshipdate(),
            'received_date' => $ord->getRecievedate(),
            'cus_remark' => $ord->getCusremark(),
            'seller_remark' => $ord->getSellerremark(),
        );

        $this->db->where('orderno', $ord->getOrderno());
        return $this->db->update('ord', $data);
    }

    public function delete($orderno) {

        $this->db->delete('ord', array('orderno' => $orderno));
    }

    public function findbyid($orderno) {
        $this->db->where('orderno', $orderno);
        $query = $this->db->get('ord');
        $obj = null;

        foreach ($query->result() as $row) {

            $obj = $this->makeObj($row);
        }
        // echo var_dump($obj);

        return $obj;
    }

    public function findbyemail($email) {
        $this->db->where('email', $email);
        $query = $this->db->get('ord');
        $array = array();

        foreach ($query->result() as $row) {
            $obj = null;
            $obj = $this->makeObj($row);
            array_push($array, $obj);
        }
        // echo var_dump($obj);

        return $array;
    }

    public function getcountbystatus($status = '') {

        $sql = "select count(*)as nstatus  from ord ";

        if ($status != '') {
            $sql.="where ord_status='" . $status . "'";
        }

        $query = $this->db->query($sql);

        if ($query->num_rows() > 0) {
            $row = $query->row();

            return intval($row->nstatus);
        } else {


            return 0;
        }
    }

    public function countfilenotupload($orderno) {

        $sql = "select count(*) as nfile from orderline where  orderno =? and  (orderline.filepath is null  or orderline.filepath ='')";
        $query = $this->db->query($sql, array($orderno));
        if ($query->num_rows() > 0) {
            $row = $query->row();

            return intval($row->nfile);
        } else {


            return null;
        }
    }

    public function findorderbackbyCustormer($condition = array(), $keyword = '') {
        $this->db->select('*');
        $this->db->from('ord');
        $this->db->join('custormer', 'custormer.email = ord.email');
        if ($keyword != '') {
            $where = "(`ord`.`email` LIKE '%$keyword%' OR `cus_name` LIKE '%$keyword%' OR `lastname` LIKE '%$keyword%' )";
            $this->db->where($where);
        }
        foreach ($condition as $index => $row) {

            $this->db->where($index, $row);
        }
        $this->db->order_by('orderdate', 'desc');
        $query = $this->db->get();
        $result = array();

        foreach ($query->result() as $row) {
            $obj = null;
            $obj = $this->makeObjextends($row);
            array_push($result, $obj);
        }
        // echo var_dump($obj);
        //var_dump($this->db->last_query());
        return $result;
    }

    public function findbymultifield($condition) {
        foreach ($condition as $index => $row) {

            $this->db->where($index, $row);
        }
        $this->db->order_by('orderno', 'desc');
        
        $query = $this->db->get('ord');
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

    public function findall() {


        $query = $this->db->get('ord');

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
    public function insert(Ord $ord) {


        $data = array(
            'email' => $ord->getEmail(),
            'orderdate' => $ord->getOrderdate(),
            'paymethod' => $ord->getPaymethod(),
            'sendmethod' => $ord->getSendmethod(),
            'ord_status' => $ord->getOrdstatus(),
            'total_price' => $ord->getTotalprice(),
            'address' => $ord->getAddress(),
            'province' => $ord->getProvince(),
            'postcode' => $ord->getPostcode(),
            'phone' => $ord->getPhone(),
            'phone2' => $ord->getPhone2(),
            'address2' => $ord->getAddress2(),
            'province2' => $ord->getProvince2(),
            'postcode2' => $ord->getPostcode2(),
            'expected_ship_date' => $ord->getExpectedshipdate(),
            'received_date' => $ord->getRecievedate(),
            'cus_remark' => $ord->getCusremark(),
            'seller_remark' => $ord->getSellerremark(),
        );

        return $this->db->insert('ord', $data);
    }

    private function makeObj($row) {

        $ord = new Ord();

        $ord->setOrderno($row->orderno);
        $ord->setEmail($row->email);
        $ord->setOrdstatus($row->ord_status);
        $ord->setPaymethod($row->paymethod);
        $ord->setSendmethod($row->sendmethod);
        $ord->setTotalprice($row->total_price);
        $ord->setAddress($row->address);
        $ord->setProvince($row->province);
        $ord->setPostcode($row->postcode);
        $ord->setPhone($row->phone);
        $ord->setAddress2($row->address2);
        $ord->setProvince2($row->province2);
        $ord->setPostcode2($row->postcode2);
        $ord->setPhone2($row->phone2);
        $ord->setOrderdate($row->orderdate);
        $ord->setExpectedshipdate($row->expected_ship_date);
        $ord->setRecievedate($row->received_date);
        $ord->setCusremark($row->cus_remark);
        $ord->setSellerremark($row->seller_remark);
        return $ord;
    }

    private function makeObjextends($row) {
        $this->load->model('extends/ord_extends');
        $ord = new Ord_extends();

        $ord->setOrderno($row->orderno);
        $ord->setEmail($row->email);
        $ord->setOrdstatus($row->ord_status);
        $ord->setPaymethod($row->paymethod);
        $ord->setSendmethod($row->sendmethod);
        $ord->setTotalprice($row->total_price);
        $ord->setAddress($row->address);
        $ord->setProvince($row->province);
        $ord->setPostcode($row->postcode);
        $ord->setOrderdate($row->orderdate);

        $ord->setCusname($row->cus_name);
        $ord->setLastname($row->lastname);
        return $ord;
    }

}

?>
