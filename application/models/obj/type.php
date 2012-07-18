<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of type
 *
 * @author Dark
 */
class Type extends CI_Model {
    
  private $type;
private $description;
    private $typeno;
    private $picurl;
    //put your code here
    public function getType() {
        return $this->type;
    }

    public function setType($type) {
        $this->type = $type;
    }

    public function getDescription() {
        return $this->description;
    }

    public function setDescription($description) {
        $this->description = $description;
    }
  

    public function getTypeno() {
        return $this->typeno;
    }

    public function setTypeno($typeno) {
        $this->typeno = $typeno;
    }

    public function getPicurl() {
        return $this->picurl;
    }

    public function setPicurl($picurl) {
        $this->picurl = $picurl;
    }

}

?>
