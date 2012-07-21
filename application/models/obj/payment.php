<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of payment
 *
 * @author Dark
 */
class Payment extends CI_Model {
    //put your code here
    
    private $payno;
    private $period;
    private $amount;
    private $paymentdate;
    private $orderno;
    
    public function getPayno() {
        return $this->payno;
    }

    public function setPayno($payno) {
        $this->payno = $payno;
    }

    public function getPeriod() {
        return $this->period;
    }

    public function setPeriod($period) {
        $this->period = $period;
    }

    public function getAmount() {
        return $this->amount;
    }

    public function setAmount($amount) {
        $this->amount = $amount;
    }

    public function getPaymentdate() {
        return $this->paymentdate;
    }

    public function setPaymentdate($paymentdate) {
        $this->paymentdate = $paymentdate;
    }

    public function getOrderno() {
        return $this->orderno;
    }

    public function setOrderno($orderno) {
        $this->orderno = $orderno;
    }


    
}

?>
