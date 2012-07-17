<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of homepage
 *
 * @author Dark
 */
class Home extends CI_Controller{
    //put your code here
    public function index()
	{
        
        
        //session_start();
        
        if($_SESSION['hasemp']){
            
            $this->load->view(lang('bakhome'));
        }else{
            
              $this->load->view(lang('baklogin'));
            
        }
        }
        
      
    
}

?>
