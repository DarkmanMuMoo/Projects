<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of custormer
 * sf
 * @author Dark
 */
class Custormer extends CI_Model {

    private $email;
    private $name;
    private $lastname;
    private $password;
    private $validate;
    private $mobilephone;
    private $issentemail;
    private $issetsms;
    
    public function getValidate() {
        return $this->validate;
    }
    public function getIssentemail() {
        return $this->issentemail;
    }

    public function setIssentemail($issentemail) {
        $this->issentemail = $issentemail;
    }

    public function getIssetsms() {
        return $this->issetsms;
    }

    public function setIssetsms($issetsms) {
        $this->issetsms = $issetsms;
    }

        public function getMobilephone() {
        return $this->mobilephone;
    }

    public function setMobilephone($mobilephone) {
        $this->mobilephone = $mobilephone;
    }

    public function setValidate($validate) {
        $this->validate = $validate;
    }

    public function getEmail() {
        return $this->email;
    }

    public function setEmail($email) {
        $this->email = $email;
    }

    public function getName() {
        return $this->name;
    }

    public function setName($name) {
        $this->name = $name;
    }

    public function getLastname() {
        return $this->lastname;
    }

    public function setLastname($lastname) {
        $this->lastname = $lastname;
    }

    public function getPassword() {
        return $this->password;
    }

    public function setPassword($password) {
        $this->password = $password;
    }

   

}

?>
