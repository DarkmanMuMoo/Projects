<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of price
 *
 * @author Dark
 */
class Price  extends CI_Model{
    //put your code here
    private $priceno;
    private $paperno;
    private $tempno;
    private $qty;
    private $price;
    
    public function getPriceno() {
        return $this->priceno;
    }

    public function setPriceno($priceno) {
        $this->priceno = $priceno;
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


}

?>
