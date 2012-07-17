<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of register
 *
 * @author Dark
 */
class Register extends CI_Controller {

    //put your code here

   

    public function __construct() {
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->model('dao/cusdao');
        $this->load->model('obj/custormer');
       $this->load->library('myencrypt');
    }

    public function index() {

        $this->form_validation->set_rules('email', 'Email', 'callback_email_check');

        if ($this->form_validation->run() == FALSE) {
            $this->load->view(lang('registerform'));
        } else {
            $cus = new Custormer();
            $cus->setEmail($this->input->post('email'));
            $cus->setName($this->input->post('name'));
            $cus->setLastname($this->input->post('lastname'));
            $cus->setPassword($this->input->post('password'));
            $cus->setPhone($this->input->post('phone'));
            $address1 = array('address' => $this->input->post('address'),
                'province' => $this->input->post('province'),
                'postcode' => $this->input->post('postcode'),
                );
             $address2 = array('address' => $this->input->post('address2'),
                'province' => $this->input->post('province2'),
                'postcode' => $this->input->post('postcode2'),
                );
             $cus->setAddress1($address1);
             $cus->setAddress2($address2);
             
             $this->cusdao->insert($cus);
        // echo var_dump( $this->cusdao->insert($cus));
            $this->sendemail($cus);
            $this->load->view(lang('registerSuccess'));
        }
    }

    public function email_check($email) {

        $check = $this->cusdao->checkemail($email);
        if (!$check) {

            $this->form_validation->set_message('email_check', 'email นี้มีคนใช้แล้ว');
            return FALSE;
        } else {

            return TRUE;
        }
    }

    private function sendemail(Custormer $cus) {
        
        $config = array();
        //for server
        /*
        $config['protocol'] = 'sendmail';
        $config['mailpath'] = '/usr/sbin/sendmail';
        $config['charset'] = 'utf-8';
        $config['wordwrap'] = TRUE;
        $config['mailtype'] = 'html';
*/
        
     //for test in localhost   
 $config['protocol']='smtp';  
$config['smtp_host']='ssl://smtp.googlemail.com';  
$config['smtp_port']='465';  
$config['smtp_timeout']='30';  
$config['smtp_user']='darkmanmumoonaja@gmail.com';  
$config['smtp_pass']='15710804';  
 $config['mailtype'] = 'html';
$config['charset']='utf-8';  
$config['newline']="\r\n";  

        $this->load->library('email', $config);
        $this->email->from('phairoj@colourharmony.co.th', 'Name');
        $this->email->to($cus->getEmail());

        $encrypted_email = $this->myencrypt->encode($cus->getEmail());
        $this->email->subject('ยืนยันการเป็นสมาชิก');
      
        $message = 'validate email link ' . '<br> <p>'.anchor("/register/validate_user/$encrypted_email", 'คลิดเพื่อกดยืนยันการเป็นสมาชิก', 'title="confirm"').'</p> \r\n';
        $this->email->message($message);

       $this->email->send();

       //echo $this->email->print_debugger();
       //echo  $message;
    }
    
   

    public function validate_user($emailencode) {
        $emaildecrpt  =  $this->myencrypt->decode($emailencode); 
         if( $this->cusdao->validateuser($emaildecrpt)){


     $this->load->view(lang('registerconfirmpage'));

          } else{
              
              
              
             echo $this->input->post('email')."<br>";
             echo  $this->myencrypt->decode($emailencode);
          }
          
   
       // echo $this->encrypt->decode($email);
    }

}

?>
