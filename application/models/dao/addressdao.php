<?php

class Addressdao extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->load->model('obj/address');
    }

    public function findbyemail($email) {
        $this->db->where('email', $email);
        $query = $this->db->get('address');
        $obj = null;

        foreach ($query->result() as $row) {

            $obj = $this->makeObj($row);
        }
        // echo var_dump($obj);

        return $obj;
    }

    public function findbyid($addressno) {
        $this->db->where('addressno', $addressno);
        $query = $this->db->get('address');
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

        $query = $this->db->get('address');
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

    public function delete($addressno) {

        return $this->db->delete('address', array('addressno' => $addressno));
    }

    public function update(Address $address) {
        $data = array(
            'email' => $address->getEmail(),
            'address' => $address->getAddress(),
            'province' => $address->getProvince(),
            'postcode' => $address->getPostcode(),
            'addressname' => $address->getAddressname(),
            'phone' => $address->getPhone()
        );

        $this->db->where('addressno', $address->getAddressno());
        return $this->db->update('address', $data);
    }

    public function findall() {


        $query = $this->db->get('address');

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
    public function insert(Address $address) {

        $data = array(
            'addressno' => $address->getAddressno(),
            'addressname' => $address->getAddressname(),
            'email' => $address->getEmail(),
            'address' => $address->getAddress(),
            'province' => $address->getProvince(),
            'postcode' => $address->getPostcode(),
            'phone' => $address->getPhone()
        );
     
        return $this->db->insert('address', $data);
    }

    private function makeObj($row) {
        $address = new Address();
        $address->setAddressname($row->addressname);
        $address->setAddressno($row->addressno);
        $address->setEmail($row->email);
        $address->setAddress($row->address);
        $address->setProvince($row->province);
        $address->setPostcode($row->postcode);
        $address->setPhone($row->phone);
        return $address;
    }

}
?>