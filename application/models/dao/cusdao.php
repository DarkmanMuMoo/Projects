<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of cusdao
 *
 * @author Dark
 */
class Cusdao extends CI_Model {

    //put your code here
    public function __construct() {
        parent::__construct();
        $this->load->model('obj/custormer');
    }
//หาข้อมมูลcusจากอีเมล(ที่activateแล้ว T default ,ไม่Activate F,ทั้งหมด default)
    public function findbyemail($email,$activate='') {

          if($activate!=''){
        $this->db->where('validate', $activate);
        
        }
        $query = $this->db->get_where('custormer', array('email' => $email));

        $cus = null;

        foreach ($query->result() as $row) {

            $cus = $this->makeObj($row);
        }
        // echo var_dump($cus);

        return $cus;
    }

    
    //หาข้อมูลลูกค้าทุกคนที่(ที่activateแล้ว T  ,ไม่Activate F,ทั้งหมด default)
    public function findall($activate='') {
        
      if($activate!=''){
        $this->db->where('validate', $activate);
        
        }
        $query = $this->db->get('custormer');

        $array = array();
        foreach ($query->result() as $row) {
            $cus = null;


            $cus = $this->makeObj($row);


            array_push($array, $cus);
        }
        // echo var_dump($array);

        return $array;
    }
//บันทึกข้อมูล
    public function insert(Custormer $cus) {
        
        
        $address1 = $cus->getAddress1();
        $address2 = $cus->getAddress2();
        $data = array(
            'email' => $cus->getEmail(),
            'name' => $cus->getName(),
            'lastname' => $cus->getLastname(),
            'phone' => $cus->getPhone(),
            'password' => $cus->getPassword(),
            'address' => $address1['address'],
            'province' => $address1['province'],
            'postcode' => $address1['postcode'],
            'address_2' => $address2['address'],
            'province_2' => $address2['province'],
            'postcode_2' => $address2['postcode'],
            'validate' => 'F'
        );

        return $this->db->insert('custormer', $data);
    }

    //checkEmailว่ามีในฐานข้อมูลมั้ย
    public function checkemail($email){
        $query = $this->db->get_where('custormer', array('email' => $email));
        $validate = true ; 
        if($query->num_rows()>0){
            
            $validate = false ; 
            
        }
        return $validate;
        
    }
    
    
    //ActivateUserว่ามีในฐานข้อมูลมั้ย
      public function validateuser($email){
       $data = array(
               'validate' => 'T'
               
            );

$this->db->where('email', $email);

return $this->db->update('custormer', $data); 
          
          
          
    }
    
    
    
    
    
    private function makeObj($row) {

        $cus = new Custormer();

        $cus->setEmail($row->email);
        $cus->setName($row->name);
        $cus->setLastname($row->lastname);
        $cus->setPassword($row->password);
        $cus->setPhone($row->phone);
        $cus->setAddress1(array('address' => $row->address, 'province' => $row->province, 'postcode' => $row->postcode));
 $cus->setValidate($row->validate);

        $cus->setAddress2(array('address' => $row->address_2, 'province' => $row->province_2, 'postcode' => $row->postcode_2));

        return $cus;
    }

}

?>
