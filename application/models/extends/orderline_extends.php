<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of orderline_extends
 *
 * @author Dark
 */
get_instance()->load->model('obj/orderline');


class Orderline_extends extends Orderline {
    
  private $papername;
  private $gram;
  
  private $tmpname;
  private $tmpurl;
  private $tmpsize;
  private $tmptype;
  
  private $optiondescription;
  private $optionprice;
  
  


  public function getPapername() {
      return $this->papername;
  }

  public function setPapername($papername) {
      $this->papername = $papername;
  }

  public function getGram() {
      return $this->gram;
  }

  public function setGram($gram) {
      $this->gram = $gram;
  }

  public function getTmpname() {
      return $this->tmpname;
  }

  public function setTmpname($tmpname) {
      $this->tmpname = $tmpname;
  }

  public function getTmpurl() {
      return $this->tmpurl;
  }

  public function setTmpurl($tmpurl) {
      $this->tmpurl = $tmpurl;
  }

  public function getTmpsize() {
      return $this->tmpsize;
  }

  public function setTmpsize($tmpsize) {
      $this->tmpsize = $tmpsize;
  }

  public function getTmptype() {
      return $this->tmptype;
  }

  public function setTmptype($tmptype) {
      $this->tmptype = $tmptype;
  }

  public function getOptiondescription() {
      return $this->optiondescription;
  }

  public function setOptiondescription($optiondescription) {
      $this->optiondescription = $optiondescription;
  }

  public function getOptionprice() {
      return $this->optionprice;
  }

  public function setOptionprice($optionprice) {
      $this->optionprice = $optionprice;
  }


}

?>
