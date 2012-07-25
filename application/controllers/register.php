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
public function  getcaptcha(){
    $this->load->library('captchautil');

        $array=$this->captchautil->captcha();
        $_SESSION['word']=$array['word'];
        $image=$array['img'];
        header("Content-type:image/png");	//กำหนดชนิดของภาพตอนแสดงผลผ่าน browser
imagepng($image); //แสดงผลภาพที่สร้าง
imagedestroy($image);
    
    
    
}
    public function index() {

        $this->form_validation->set_rules('email', 'Email', 'callback_email_check');
         $this->form_validation->set_rules('captcha', 'Captcha', 'callback_captcha_check');
$this->load->library('thailandutil');
        if ($this->form_validation->run() == FALSE) {
            
                $provincelist= $this->thailandutil->getAllprovinceList();
                $data=array();
            $data['provincelist']=$provincelist;
            $this->load->view(lang('registerform'),$data);
        } else {
            $cus = new Custormer();
            $cus->setEmail($this->input->post('email'));
            $cus->setName($this->input->post('name'));
            $cus->setLastname($this->input->post('lastname'));
            $cus->setPassword($this->input->post('password'));
         $province= $this->thailandutilfindbyid($this->input->post('province'));
          $province2= $this->thailandutilfindbyid($this->input->post('province2'));
            $cus->setMobilephone($this->input->post('mphone'));
            $address1 = array('address' => $this->input->post('address'),
                'province' => $province,
                'postcode' => $this->input->post('postcode'),
                'phone1' => $this->input->post('phone1')
                );
             $address2 = array('address' => $this->input->post('address2'),
                'province' => $province2,
                'postcode' => $this->input->post('postcode2'),
                   'phone2' => $this->input->post('phone2')
                );
             $cus->setAddress1($address1);
             $cus->setAddress2($address2);
             
             $this->cusdao->insert($cus);
        // echo var_dump( $this->cusdao->insert($cus));
            $this->sendemail($cus);
            $this->load->view(lang('registerSuccess'));
        }
    }

    public function captcha_check($captcha){
        
        if(!isset($_SESSION['word'])){
            
              $this->form_validation->set_message('captcha_check', 'กรอกอักษรตรวจสอบผิด');
            return FALSE;
        }else if ($captcha!= $_SESSION['word']) {
             
              $this->form_validation->set_message('captcha_check', 'กรอกอักษรตรวจสอบผิด');
            return FALSE;
             
             
         }else{
             
              return true;
             
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
      $url = site_url("register/validate_user/$encrypted_email");
      $alink="<a href=\"$url\" >กดเพื่อยืนยันการเป็นสมาชิก</a>";
        $message = 'validate email link ' . '<br> <p>'.$alink.'</p> \r\n';
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
