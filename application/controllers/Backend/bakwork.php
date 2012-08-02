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
          $this->load->model('dao/workdao');
           $condition=array();
          $keyword='';
        if ($this->input->post('keyword')) {
            $keyword = $this->input->post('keyword');

        }
        if ($this->input->post('emp')) {
            $position = $this->input->post('emp');
           
                $condition['emp'] = $position;
          
        }
        
          $worklist=$this->workdao->findworklist($keyword,$condition);
         $emplist=$this->empdao->findall();
         $data=array();
         $data['worklist']=$worklist;
         $data['emplist']=$emplist;
          $this->load->view(lang('bakwork'),$data);
     }
     
     public function viewworkdetail($workno){
         
         
          $this->load->view(lang('workdetail'),$data);
     }
}

?>
