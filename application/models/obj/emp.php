<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of emp
 *
 * @author Dark
 */
class Emp extends CI_Model {
    //put your code here

    private $name;
    private $lastname;
    private $email;
    private $phone;
    private $position;
    private $password;
  
    public function getPhone() {
        return $this->phone;
    }
    public function getPassword() {
        return $this->password;
    }

    public function setPassword($password) {
        $this->password = $password;
    }

        public function setPhone($phone) {
        $this->phone = $phone;
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

    public function getEmail() {
        return $this->email;
    }

    public function setEmail($email) {
        $this->email = $email;
    }

    public function getPosition() {
        return $this->position;
    }

    public function setPosition($position) {
        $this->position = $position;
    }


}

?>
