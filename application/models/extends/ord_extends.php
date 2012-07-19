<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ord_extends
 *
 * @author Dark
 */

get_instance()->load->model('obj/ord');
class Ord_extends extends Ord {
    //put your code here
    
    
    private $cusname;
    private $lastname;
    
    public function getCusname() {
        return $this->cusname;
    }

    public function setCusname($cusname) {
        $this->cusname = $cusname;
    }

    public function getLastname() {
        return $this->lastname;
    }

    public function setLastname($lastname) {
        $this->lastname = $lastname;
    }


}

?>
