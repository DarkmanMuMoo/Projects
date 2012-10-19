<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of address
 *
 * @author Dark
 */
class Address  extends CI_Model {
    //put your code here
    public $addressno;
    public $addressname;
    public $email;
    public $address;
    public $province;
    public $postcode;
    public $phone;
    public function getAddressname() {
        return $this->addressname;
    }

    public function setAddressname($addressname) {
        $this->addressname = $addressname;
    }

        public function getAddressno() {
        return $this->addressno;
    }

    public function setAddressno($addressno) {
        $this->addressno = $addressno;
    }

    public function getEmail() {
        return $this->email;
    }

    public function setEmail($email) {
        $this->email = $email;
    }

    public function getAddress() {
        return $this->address;
    }

    public function setAddress($address) {
        $this->address = $address;
    }

    public function getProvince() {
        return $this->province;
    }

    public function setProvince($province) {
        $this->province = $province;
    }

    public function getPostcode() {
        return $this->postcode;
    }

    public function setPostcode($postcode) {
        $this->postcode = $postcode;
    }

    public function getPhone() {
        return $this->phone;
    }

    public function setPhone($phone) {
        $this->phone = $phone;
    }


}
?>
