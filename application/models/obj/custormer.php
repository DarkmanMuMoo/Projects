<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of custormer
 *sf
 * @author Dark
 */
class Custormer extends CI_Model  {
  private $email;
    private $name;
      private $lastname;
          private $password;
           private $phone;
           private $address1;
           private $address2;
           private $validate;
           private $mobilephone;
           public function getValidate() {
               return $this->validate;
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
           public function getPhone() {
               return $this->phone;
           }

           public function setPhone($phone) {
               $this->phone = $phone;
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

           public function getAddress1() {
               return $this->address1;
           }

           public function setAddress1($address1) {
               $this->address1 = $address1;
           }

           public function getAddress2() {
               return $this->address2;
           }

           public function setAddress2($address2) {
               $this->address2 = $address2;
           }

    
           
}

?>
