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
    public function viewempdetail($empno){
        
         $this->load->model('dao/positiondao');
         $poslist=$this->positiondao->findall();
        $tmp_emp=$this->empdao->findbyid($empno);
        $data=array();
        $data['tmpemp']=$tmp_emp;
         $data['poslist']=$poslist;
        $this->load->view(lang('empdetail'),$data);
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
