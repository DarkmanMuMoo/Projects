<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ordsend
 *
 * @author Dark
 */
class Ordsend extends CI_Model {

    //put your code here

    private $sendmethod;
    private $description;
    private $sendprice;

    public function getSendmethod() {
        return $this->sendmethod;
    }

    public function getSendprice() {
        return $this->sendprice;
    }

    public function setSendprice($sendprice) {
        $this->sendprice = $sendprice;
    }

    public function setSendmethod($sendmethod) {
        $this->sendmethod = $sendmethod;
    }

    public function getDescription() {
        return $this->description;
    }

    public function setDescription($description) {
        $this->description = $description;
    }

}

?>
