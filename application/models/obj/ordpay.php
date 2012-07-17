<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ordpaymethod
 *
 * @author Dark
 */
class Ordpay  extends CI_Model{
    //put your code here
    
    private $paymethod;
    private $description;
    
    
    public function getPaymethod() {
        return $this->paymethod;
    }

    public function setPaymethod($paymethod) {
        $this->paymethod = $paymethod;
    }

    public function getDescription() {
        return $this->description;
    }

    public function setDescription($description) {
        $this->description = $description;
    }


}

?>
