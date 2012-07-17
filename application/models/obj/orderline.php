<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of orderline
 *
 * @author Dark
 */
class Orderline  extends CI_Model{
    //put your code here
    private $ordlineno;
    private $orderno;
    private $paperno;
    private $tempno;
     private $qty;
     private $price;
    private $filepath;
    private $optionno;
    public function getOrdlineno() {
        return $this->ordlineno;
    }
    public function getOptionno() {
        return $this->optionno;
    }

    public function setOptionno($optionno) {
        $this->optionno = $optionno;
    }

        public function setOrdlineno($ordlineno) {
        $this->ordlineno = $ordlineno;
    }

    public function getOrderno() {
        return $this->orderno;
    }

    public function setOrderno($orderno) {
        $this->orderno = $orderno;
    }

    public function getPaperno() {
        return $this->paperno;
    }

    public function setPaperno($paperno) {
        $this->paperno = $paperno;
    }

    public function getTempno() {
        return $this->tempno;
    }

    public function setTempno($tempno) {
        $this->tempno = $tempno;
    }

    public function getQty() {
        return $this->qty;
    }

    public function setQty($qty) {
        $this->qty = $qty;
    }

    public function getPrice() {
        return $this->price;
    }

    public function setPrice($price) {
        $this->price = $price;
    }

    public function getFilepath() {
        return $this->filepath;
    }

    public function setFilepath($filepath) {
        $this->filepath = $filepath;
    }


}

?>
