<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of user
 *
 * @author Dark
 */
class User extends CI_Controller {
    //put your code here
     public function __construct() {
        parent::__construct();
        
        $this->load->model('dao/empdao');
        //$this->load->model('obj/custormer');  loaded in autoload
         $this->load->library('form_validation');
    }
 
     public function performlogin(){
              $password=$this->input->post('password'); 
  
   
       $this->form_validation->set_rules('name', 'Name', "callback_user_check[$password]");
         if ($this->form_validation->run() == FALSE) {
              
             //redirect('false');
         $this->load->view(lang('baklogin'));
             //$this->load->view('dsf');
        }else{
       
            $_SESSION['emp']=$this->empdao->findbyempname($this->input->post('name') );
            
             $this->load->view(lang('bakhome'));
        }
     }
     
     
     
     public function performlogout(){
         
         unset($_SESSION['emp']);
           $this->load->view(lang('baklogin'));
     }
           public function user_check($name,$password) {
               
               
               
               $emp=null;

         $emp = $this->empdao->findbyempname($name);

        if ( $emp==null) {

            $this->form_validation->set_message('user_check', 'ไม่มีพนักงาน นี้ในระบบ');
            return FALSE;
             
        } else if($emp->getPassword()!= $password ){
        
             $this->form_validation->set_message('user_check', 'password ไม่ถุกต้อง');
            return FALSE;
          
            }else{
   
                return TRUE; 
               
            }
           }
     
}

?>
