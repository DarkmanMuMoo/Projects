<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of bakemp
 *
 * @author Dark
 */
class Bakemp extends CI_Controller{
    //put your code here
    
     public function __construct() {
        parent::__construct();
        
        $this->load->model('dao/empdao');
        
        
        }
    public function index(){
          $this->load->model('dao/positiondao');
        $condition=array();
          $keyword='';
          $data=array();
        if ($this->input->post('keyword')) {
            $keyword = $this->input->post('keyword');
          
               
            
        }
        if ($this->input->post('position')) {
            $position = $this->input->post('position');
           
                $condition['position'] = $position;
          
        }
        
        $emplist=$this->empdao->findemplist($keyword,$condition);
            $positionlist=$this->positiondao->findall();
            
            $data['emplist']=$emplist;
            $data['positionlist']=$positionlist;
            
            $this->load->view(lang('bakemp'),$data);

    }
    
    public function deleteemp(){
        $empno =$this->input->post('empno');
        
       $result= $this->empdao->delete($empno);
        error_log("delete emp  $empno =".var_export($result, true),0);
          $javascript = "
   document.location.reload();
   ";
        echo $javascript;
    }
    public function viewempdetail($empno){
        
         $this->load->model('dao/positiondao');
         $poslist=$this->positiondao->findall();
        $tmp_emp=$this->empdao->findbyid($empno);
        $data=array();
        $data['tmpemp']=$tmp_emp;
         $data['poslist']=$poslist;
        $this->load->view(lang('empdetail'),$data);
        
    }
    
    public function empprofile(){
        $this->load->model('dao/positiondao');
         $poslist=$this->positiondao->findall();
         
             $empno=$_SESSION['emp']->getEmpno();
        $tmp_emp=$this->empdao->findbyid($empno);
        $data=array();
        $data['tmpemp']=$tmp_emp;
         $data['poslist']=$poslist;
        
        
             $this->load->view(lang('empprofile'),$data);
    }
    
    public function insertemp(){
        $this->load->helper('string');

        $name=$this->input->post('name');
        $lastname=$this->input->post('lastname');
        $email=$this->input->post('email');
        $phone=$this->input->post('phone');
        $password=random_string();
        $position=$this->input->post('position');
    $emp = new Emp();
    $emp->setEmail($email);
    $emp->setName($name);
    $emp->setLastname($lastname);
    $emp->setPhone($phone);
    $emp->setPassword($password);
    $emp->setPosition($position);
    $emp->setPicurl(null);
    
    $insertresult=$this->empdao->insert($emp);
    error_log('result of insert emp'.var_export($insertresult, true),0);
    
     $this->load->library('emailutil');
    $config=$this->emailutil->getSmtpconfig();
    $form= lang('adminemail');
    $to=$email;
    $subject='ยินดีต้อนรับ พนักงาน ใหม่';
    $message='email use to login ='.$email;
     $message.='<br> password is ='.$password;
   $emailresult= $this->emailutil->sendemail($config,$form,$to,$subject,$message);
    error_log("send email to $to result is".var_export($emailresult, true),0);
    
    $this->index();
    }
    public function updateemp(){
        
        $empno=$this->input->post('empno');
  
         $position=$this->input->post('position');
         
        $emp=$this->empdao->findbyid($empno);
        $emp->setPosition($position);
        $result = $this->empdao->update($emp);
       
       
        $this->viewempdetail($empno);
    }
    
    
}

?>
