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
private $platesize;
      private $tempno;
  private $typeno;
  private $size;
  private $url;
    private $name;
    private $Y;
    private $Z;
    private $X;

    public function getX() {
        return $this->X;
    }

    public function setX($X) {
        $this->X = $X;
    }

      public function getTempno() {
      return $this->tempno;
  }

  public function setTempno($tempno) {
      $this->tempno = $tempno;
  }
  public function getTypeno() {
      return $this->typeno;
  }
  public function getPlatesize() {
      return $this->platesize;
  }

  public function setPlatesize($platesize) {
      $this->platesize = $platesize;
  }

    public function setType() {
      return $this->typeno;
  }
  public function getY() {
      return $this->Y;
  }

  public function setY($Y) {
      $this->Y = $Y;
  }

  public function getZ() {
      return $this->Z;
  }

  public function setZ($Z) {
      $this->Z = $Z;
  }

    public function setTypeno($typeno) {
      $this->typeno = $typeno;
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
