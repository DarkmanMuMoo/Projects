<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ord
 *
 * @author Dark
 */
class Ord extends CI_Model {

    //put your code here

    private $orderno;
    private $ordstatus;
    private $email;
    private $paymethod;
    private $sendmethod;
    private $totalprice;
    private $address;
    private $province;
    private $postcode;
    private $orderdate;
    private $expectedshipdate;
    private $recievedate;
    private $cusremark;
    private $sellerremark;
    
    public function getExpectedshipdate() {
        return $this->expectedshipdate;
    }

    public function setExpectedshipdate($expectedshipdate) {
        $this->expectedshipdate = $expectedshipdate;
    }

    public function getRecievedate() {
        return $this->recievedate;
    }

    public function setRecievedate($recievedate) {
        $this->recievedate = $recievedate;
    }

    public function getCusremark() {
        return $this->cusremark;
    }

    public function setCusremark($cusremark) {
        $this->cusremark = $cusremark;
    }

    public function getSellerremark() {
        return $this->sellerremark;
    }

    public function setSellerremark($sellerremark) {
        $this->sellerremark = $sellerremark;
    }

    public function getOrderdate() {
    return $this->orderdate;
}

public function setOrderdate($orderdate) {
    $this->orderdate = $orderdate;
}

    public function getOrderno() {
        return $this->orderno;
    }

    public function setOrderno($orderno) {
        $this->orderno = $orderno;
    }

    public function getOrdstatus() {
        return $this->ordstatus;
    }

    public function setOrdstatus($ordstatus) {
        $this->ordstatus = $ordstatus;
    }

    
    public function getEmail() {
        return $this->email;
    }

    public function setEmail($email) {
        $this->email = $email;
    }

    public function getPaymethod() {
        return $this->paymethod;
    }

    public function setPaymethod($paymethod) {
        $this->paymethod = $paymethod;
    }

    public function getSendmethod() {
        return $this->sendmethod;
    }

    public function setSendmethod($sendmethod) {
        $this->sendmethod = $sendmethod;
    }

    public function getTotalprice() {
        return $this->totalprice;
    }

    public function setTotalprice($totalprice) {
        $this->totalprice = $totalprice;
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

}

?>
