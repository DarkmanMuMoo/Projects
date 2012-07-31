<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of bakwork
 *
 * @author Dark
 */
class Bakwork  extends CI_Controller{
    //put your code here
    
     public function __construct() {
        parent::__construct();
        
        $this->load->model('dao/empdao');
        
        
        }
     public function index(){
         
         
          $this->load->view(lang('bakwork'));
     }
}

?>
