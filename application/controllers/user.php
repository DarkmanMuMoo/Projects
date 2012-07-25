<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of usermanagement
 *
 * @author Dark
 */
class User extends CI_Controller{
    //ใช้เช็คตอนlogin
    private $viewpath = 'OnlinePrinting/';
     public function __construct() {
        parent::__construct();
        
        $this->load->model('dao/typedao');
        //$this->load->model('obj/custormer');  loaded in autoload
         $this->load->library('form_validation');
    }
 
    
    public function ajaxRetrivePassword(){
         $emailtosend=$this->input->post('emailval'); 
       $user= $this->cusdao->findbyemail($emailtosend,'T');
        $message='';
        if($user!=null){
            $message= 'ส่งemailเรียบร้อย';
      
      $this->sendemail($user);
            
        }else{
            
           $message   ='Emailนี้ไม่มีในระบบ';
            
        }
       
        echo $message;
        
    }
    public function performlogin(){
     
        $password=$this->input->post('password'); 
     // $data['typelist'] =$this->typedao->findall();
   
       $this->form_validation->set_rules('email', 'Email', "callback_user_check[$password]");
         if ($this->form_validation->run() == FALSE) {
              $data['email']=$this->input->post('email'); 
             //redirect('false');
          $this->load->view(lang('loginframe'),$data);
             //$this->load->view('dsf');
        } else {
            
             // session_start();
            
                $_SESSION['user']= $this->cusdao->findbyemail($this->input->post('email') );  
                //echo var_dump($_SESSION['user']);
                //override hasuser
                $_SESSION['hasuser']=true;
                  //log_message('error', 'userlogin');
              //  $this->load->view($this->viewpath.$fowardpath,$data);
                
                $javascript =" <script>
    parent.document.location.reload();

    </script>";
          echo  $javascript;
            //redirect($fowardpath);
        }

        
    }
      public function performlogout(){
         //session_start();
         unset($_SESSION['user']);
         unset($_SESSION['cart']);
         
      $_SESSION['hasuser']=false;
      
           $javascript =" 
  document.location.reload();
";
           
          echo  $javascript;
    }
      public function user_check($email,$password) {
$user=null;

         $user = $this->cusdao->findbyemail($email);

        if ( $user==null) {

            $this->form_validation->set_message('user_check', 'email หรือ password ไม่ถุกต้อง');
            return FALSE;
             
        } else  if( $user->getValidate() == 'F'){

             $this->form_validation->set_message('user_check', 'email นี้ยังไม่ได้รับการvalidate');
            return FALSE;
             
        }else if($user->getPassword()!= $password ){
        
             $this->form_validation->set_message('user_check', 'email หรือ password ไม่ถุกต้อง');
            return FALSE;
          
            }else{
   
                return TRUE; 
               
            }
        
    }
    public function ajaxcheckemail(){
        $email= $this->input->post('email'); 
         $user = $this->cusdao->findbyemail($email);
        if($user==null){
            
            echo 'true';
        }else{
            
             echo 'false';
            
        }
    }
    
   
    private function sendemail(Custormer $cus) {
        $config = array();
        $config['protocol'] = 'sendmail';
        $config['mailpath'] = '/usr/sbin/sendmail';
        $config['charset'] = 'utf-8';
        $config['wordwrap'] = TRUE;
        $config['mailtype'] = 'text';

        $this->load->library('email', $config);
        $this->email->from('phairoj@colourharmony.co.th', 'Name');
        $this->email->to($cus->getEmail());

        
        $this->email->subject('password');
      
        $message = 'Passwordคุณคือ='.$cus->getPassword();
        $this->email->message($message);

       $this->email->send();

      // echo $this->email->print_debugger();
       //echo  $message;
    }
    
    public function ajaxcheckuser(){
        
        
        if($_SESSION['hasuser']){
            
            echo 'true';
            
        }else{
            
             echo 'false';
            
        }
        
    }
}

?>
