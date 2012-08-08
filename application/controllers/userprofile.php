<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of userprofile
 *
 * @author Dark
 */
class Userprofile  extends CI_Controller{
    //put your code here
    
    
    public function index(){
        
         $updateuser=  $_SESSION['user'];
         $address1=$_SESSION['user']->getAddress1();
         $address2=$_SESSION['user']->getAddress2();
         $data=array();
         $data['updateuser']= $updateuser;
          $data['address1']= $address1;
           $data['address2']= $address2;
        $this->load->view(lang('userprofile'),$data);

    }
    
    
    public  function updateprofile(){
        
        $updateuser=  $_SESSION['user'];
        $updateaddress1=$_SESSION['user']->getAddress1();
        $updateaddress2=$_SESSION['user']->getAddress2();
        
    }
}

?>
