<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of price_extends
 *
 * @author Dark
 */
get_instance()->load->model('obj/price');

class Price_extends extends Price {

    //put your code here

    private $typeno;
    private $size;
    private $url;
    private $tmpname;
    private $papername;
    private $grame;
    private $type;
    private $typedescription;
    private $picurl;

    public function getTypeno() {
        return $this->typeno;
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

    public function getTmpname() {
        return $this->tmpname;
    }

    public function setTmpname($tmpname) {
        $this->tmpname = $tmpname;
    }

    public function getPapername() {
        return $this->papername;
    }

    public function setPapername($papername) {
        $this->papername = $papername;
    }

    public function getGrame() {
        return $this->grame;
    }

    public function setGrame($grame) {
        $this->grame = $grame;
    }

    public function getType() {
        return $this->type;
    }

    public function setType($type) {
        $this->type = $type;
    }

    public function getTypedescription() {
        return $this->typedescription;
    }

    public function setTypedescription($typedescription) {
        $this->typedescription = $typedescription;
    }

    
    public function getPicurl() {
        return $this->picurl;
    }

    public function setPicurl($picurl) {
        $this->picurl = $picurl;
    }

}

?>
