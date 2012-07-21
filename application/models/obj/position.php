<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of possition
 *
 * @author Dark
 */
class Position  extends CI_Model{
    //put your code here
    private $position;
    private $posdescription;
    
    public function getPosition() {
        return $this->position;
    }

    public function setPosition($position) {
        $this->position = $position;
    }

    public function getPosdescription() {
        return $this->posdescription;
    }

    public function setPosdescription($posdescription) {
        $this->posdescription = $posdescription;
    }


}

?>
