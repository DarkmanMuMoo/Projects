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

            $condition['empno'] = $position;
        }

        $worklist = $this->workdao->findworklist($keyword, $condition);
        $emplist = $this->empdao->findbymultifield(array('position' => 'des'));
        $data = array();
        $data['worklist'] = $worklist;
        $data['emplist'] = $emplist;

        $this->load->view(lang('bakwork'), $data);
    }
    
    public function empworkpage(){
    $this->load->model('dao/workdao');
    
        $condition = array();
        $keyword = '';
        if ($this->input->post('keyword')) {
            $keyword = $this->input->post('keyword');
        }
    $allworklist;
 
    
    switch($this->input->post('status')){
    case 0:{
         $ownworklist = $this->workdao->findworklist($keyword, $condition);
         $coworklist=$this->workdao->findsharedwork($keyword, $condition);
        break;
    }
    case 1:{
         $ownworklist = $this->workdao->findworklist($keyword, $condition);
        break;
    }
    case 2:{
         $ownworklist = $this->workdao->findworklist($keyword, $condition);
        break;
    }
    
    }
     $ownworklist = $this->workdao->findworklist($keyword, $condition);
     
      
     $this->load->view(lang('bakempwork'), $data);
}
public function addprocess(){
    
    $this->load->model('dao/processdao');
    $workno=$this->input->post('workno');
    $description=$this->input->post('description');
    $process=new Process();
    $process->setEmpno($_SESSION['emp']->getEmpno());
    $process->setProdescription($description);
    $process->setWorkno($workno);
    
    $result=$this->processdao->insert($process);
    error_log('isert process '.  var_export($result, true));
    
    $this->index();
}
    public function deletework($workno){
        
         $this->load->model('dao/workdao');
         $this->load->model('dao/processdao');
         $processresult=$this->processdao->delete($workno);
         $workresult=$this->workdao->delete($workno);
         error_log('delete process of workno'.  var_export($processresult, true));
         error_log('delete work of workno'.  var_export($workresult, true));
         $message='';
         if($processresult&&$workresult){
             $message='alert(\'delete complete\'); document.location.reload();';
             
         }else{
             
             
              $message='alert(\'somthing wrong *-* contact admin\');';
         }
         echo $message;
         
    }
    public function viewworkdetail($workno) {
        $this->load->model('dao/workdao');
        $this->load->model('dao/processdao');
        $data = array();
        $work = $this->workdao->findworkdetail($workno);
        $allemp = $this->empdao->findbymultifield(array('position' => 'des'));
        $processlist = $this->processdao->findprocesslist($workno);
        $data['work'] = $work;
        $data['allemp'] = $allemp;
        $data['processlist'] = $processlist;
  
        $this->load->view(lang('workdetail'), $data);
    }

    public function creatework() {
        $this->load->model('dao/workdao');

        $insertwork;
        if ($this->input->post('ordno')) {
            $ordno = $this->input->post('ordno');
            $workname = $this->input->post('workname');
            $startdate = date("Y-m-d");
            $empno = $this->input->post('empno');
            $workDescription = $this->input->post('description');

            $insertwork = new Work();
            $insertwork->setOrdno($ordno);
            $insertwork->setWorkname($workname);
            $insertwork->setWorkDescription($workDescription);
            $insertwork->setEmpno($empno);
            $insertwork->setStartdate($startdate);
        } else {



            //งานภายนอกทำดีมั้ยนะT^T
        }

        $result = $this->workdao->insert($insertwork);
        error_log(var_export($result, true) . 'insert in work', 0);

        $this->index();
    }

    public function completework($workno) {

        $this->load->model('dao/workdao');
        $endwork = $this->workdao->findbyid($workno);
        $endwork->setEnddate(date("Y-m-d"));
        $result = $this->workdao->update($endwork);

        error_log(var_export($result, true) . 'update in work', 0);
        
        $this->viewworkdetail($workno);
    }

}

?>
