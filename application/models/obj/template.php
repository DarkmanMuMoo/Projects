<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of template
 *
 * @author Dark
 */
class Template extends CI_Model{
    
    public function getName() {
        return $this->name;
    }

    public function setName($name) {
        $this->name = $name;
    }

      private $tempno;
  private $type;
  private $size;
  private $url;
    private $name;
    
  public function getTempno() {
      return $this->tempno;
  }

  public function setTempno($tempno) {
      $this->tempno = $tempno;
  }

  public function getType() {
      return $this->type;
  }

  public function setType($type) {
      $this->type = $type;
  }

  public function getSize() {
      return $this->size;
  }

  public function setSize($size) {
      $this->size = $size;
  }

  public function getUrl() {
      return $this->url;
  }

  public function setUrl($url) {
      $this->url = $url;
  }


//put your code here
}

?>