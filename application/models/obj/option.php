<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of option
 *
 * @author Dark
 */
class Option extends CI_Model {
    //put your code here
    
    private $optionno;
    private $description;
    
private $price;
public function getOptionno() {
    return $this->optionno;
}

public function setOptionno($optionno) {
    $this->optionno = $optionno;
}

public function getDescription() {
    return $this->description;
}

public function setDescription($description) {
    $this->description = $description;
}

public function getPrice() {
    return $this->price;
}

public function setPrice($price) {
    $this->price = $price;
}


    
}

?>
