<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ordstatus
 *
 * @author Dark
 */
class Ordstatus  extends CI_Model{
    //put your code here
    private $status;
    private $description;
    
    
    
    public function getStatus() {
        return $this->status;
    }

    public function setStatus($status) {
        $this->status = $status;
    }

    public function getDescription() {
        return $this->description;
    }

    public function setDescription($description) {
        $this->description = $description;
    }


}

?>
