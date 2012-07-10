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
class homepage  extends CI_Controller{
    //put your code here
    public function index()
	{
        
        
        //session_start();
        
        if(isset($_SESSION['emp'])){
            
            $this->load->view(lang('bakhome'));
        }else{
            
              $this->load->view(lang('baklogin'));
            
        }
        }
    
}

?>
