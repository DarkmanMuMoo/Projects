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
        
        
        $this->load->view(lang('userprofile'));
        
        
    }
    
    
    public  function updateprofile(){
        
        $updateuser=  $_SESSION['user'];
        $updateaddress1=$_SESSION['user']->getAddress1();
        $updateaddress2=$_SESSION['user']->getAddress2();
        
    }
}

?>
