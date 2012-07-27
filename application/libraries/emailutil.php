<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of emailutil
 *
 * @author Dark
 */
class Emailutil {
    //put your code here
   private $smtpconfig;
   private $serverconfig;
   private $CI;
   public function getSmtpconfig() {
       return $this->smtpconfig;
   }

   public function getServerconfig() {
       return $this->serverconfig;
   }
   public function __construct() {
        $this->serverconfig['protocol'] = 'sendmail';
        $this->serverconfig['mailpath'] = '/usr/sbin/sendmail';
        $this->serverconfig['charset'] = 'utf-8';
        $this->serverconfig['wordwrap'] = TRUE;
        $this->serverconfig['mailtype'] = 'html';
        
$this->smtpconfig['protocol']='smtp';  
$this->smtpconfig['smtp_host']='ssl://smtp.googlemail.com';  
$this->smtpconfig['smtp_port']='465';  
$this->smtpconfig['smtp_timeout']='30';  
$this->smtpconfig['smtp_user']='darkmanmumoonaja@gmail.com';  
$this->smtpconfig['smtp_pass']='15710804';  
 $this->smtpconfig['mailtype'] = 'html';
$this->smtpconfig['charset']='utf-8';  
$this->smtpconfig['newline']="\r\n";  

  $this->CI =&get_instance(); 
  
   }

   public function sendemail($config,$form,$to,$subject,$message){
       
      $CI=$this->CI;
       
        $CI->load->library('email', $config);
        $CI->email->from($form);
        $CI->email->to($to);
        $CI->email->subject($subject);
     
        $CI->email->message($message);

    return   $CI->email->send();

   }
   public function getDebugmessage(){
       $CI=$this->CI;
      return $CI->email->print_debugger();

   }
}

?>
