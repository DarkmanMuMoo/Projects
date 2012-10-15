<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ordtracking
 *
 * @author Dark
 */
class Ordtracking  extends CI_Model{
    //put your code here
    
    private $orderno;
    private $trackingno;
    
    public function getOrderno() {
        return $this->orderno;
    }

    public function setOrderno($orderno) {
        $this->orderno = $orderno;
    }

    public function getTrackingno() {
        return $this->trackingno;
    }

    public function setTrackingno($trackingno) {
        $this->trackingno = $trackingno;
    }


}

?>
