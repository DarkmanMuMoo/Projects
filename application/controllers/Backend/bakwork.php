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
class Bakwork extends CI_Controller {

    //put your code here

    public function __construct() {
        parent::__construct();

        $this->load->model('dao/empdao');
    }

    public function index() {
        $this->load->model('dao/workdao');
        $condition = array();
        $keyword = '';
        if ($this->input->post('keyword')) {
            $keyword = $this->input->post('keyword');
        }
        if ($this->input->post('emp')) {
            $position = $this->input->post('emp');

            $condition['emp'] = $position;
        }

        $worklist = $this->workdao->findworklist($keyword, $condition);
        $emplist = $this->empdao->findall();
        $data = array();
        $data['worklist'] = $worklist;
        $data['emplist'] = $emplist;
       
        $this->load->view(lang('bakwork'), $data);
    }

    public function viewworkdetail($workno) {
   $this->load->model('dao/workdao');
   $this->load->model('dao/processdao');
   $data=array();
   $work=$this->workdao->findbyid($workno);
   $allemp=$this->empdao->findall();
   $processlist=$this->processdao->finbyworkno($workno);
   $data['work']=$work;
  $data['allemp']=$allemp;
  $data['processlist']=$allemp;
        $this->load->view(lang('workdetail'), $data);
        
        
    }
    public function assignemptowork(){
        
        
        
        
    }
    
    public function listprocess($workno){
        
        
        
    }
    public function creatework() {
        $this->load->model('dao/workdao');

        $insertwork;
        if ($this->input->post('ordno')) {
            $ordno = $this->input->post('ordno');
            $workname = $this->input->post('workname');
            $startdate = date("Y-m-d");
            $empno = $this->input->post('empno');
            $workDescription = $this->input->post('workdes');
            
            $insertwork = new Work();
            $insertwork->setOrdno($ordno);
            $insertwork->setWorkname($workname);
            $insertwork->setWorkDescription($workDescription);
            $insertwork->setEmpno($empno);
            $insertwork->setStartdate($startdate);
            
        } else {



            //งานภายนอกทำดีมั้ยนะT^T
        }
        
        $result =$this->workdao->insert($insertwork);
         error_log(var_export($result, true) . 'insert in work', 0);
         
         $this->index();
    }
    
    public  function completework($workno){
        
          $this->load->model('dao/workdao');
        $endwork=$this->workdao->findbyid($workno);
        $endwork->setEnddate(date("Y-m-d"));
        $result =$this->workdao->update($endwork);
        
        error_log(var_export($result, true) . 'update in work', 0);
    }
    
  

}

?>
