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
    private $phone;
    private $address2;
    private $province2;
    private $postcode2;
    private $phone2;
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
    public function getPhone() {
        return $this->phone;
    }

    public function setPhone($phone) {
        $this->phone = $phone;
    }

    public function getAddress2() {
        return $this->address2;
    }

    public function setAddress2($address2) {
        $this->address2 = $address2;
    }

    public function getProvince2() {
        return $this->province2;
    }

    public function setProvince2($province2) {
        $this->province2 = $province2;
    }

    public function getPostcode2() {
        return $this->postcode2;
    }

    public function setPostcode2($postcode2) {
        $this->postcode2 = $postcode2;
    }

    public function getPhone2() {
        return $this->phone2;
    }

    public function setPhone2($phone2) {
        $this->phone2 = $phone2;
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
