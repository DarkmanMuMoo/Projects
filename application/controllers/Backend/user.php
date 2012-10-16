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
  
   
       $this->form_validation->set_rules('email', 'Email', "callback_user_check[$password]");
         if ($this->form_validation->run() == FALSE) {
              
             //redirect('false');
         $this->load->view(lang('baklogin'));
             //$this->load->view('dsf');
        }else{
       
            $_SESSION['emp']=$this->empdao->findbyemail($this->input->post('email') );
            
             $this->load->view(lang('bakhome'));
        }
     }
     
     
     
     public function performlogout(){
         
        session_destroy();
           $this->load->view(lang('baklogin'));
     }
           public function user_check($email,$password) {
               
               
               
               $emp=null;

         $emp = $this->empdao->findbyemail($email);

        if ( $emp==null) {

            $this->form_validation->set_message('user_check', 'email หรือ password ไม่ถูกต้อง');
            return FALSE;
             
        } else if($emp->getPassword()!= $password ){
        
             $this->form_validation->set_message('user_check', 'email หรือ password ไม่ถูกต้อง');
            return FALSE;
          
            }else if ($emp->getActive()== 0 ){
   
                $this->form_validation->set_message('user_check', 'email หรือ password ไม่ถูกต้อง');
            return FALSE;
               
            }else{
                
                return true;
                
            }
           }
     
}

?>
