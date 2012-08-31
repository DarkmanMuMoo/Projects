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

    public function removeCoemp($empno, $workno) {
        $this->db->where('empno', $empno);
        $this->db->where('workno', $workno);
        $result = $this->db->delete('work_emp');
         error_log('removecowork ' . var_export($result, true));
        $this->viewworkdetail($workno);
    }

    public function empworkpage() {
        $this->load->model('dao/workdao');


        $keyword = '';
        if ($this->input->post('keyword')) {
            $keyword = $this->input->post('keyword');
        }
        $allworklist = array();
        ;
        $empno = $_SESSION['emp']->getEmpno();

        switch ($this->input->post('status')) {
            case 0: {
                    $allworklist = $this->workdao->findsharedwork($keyword, $empno, 0);

                    break;
                }
            case 1: {

                    $allworklist = $this->workdao->findsharedwork($keyword, $empno, 1);
                    break;
                }
            case 2: {

                    $allworklist = $this->workdao->findsharedwork($keyword, $empno, 2);
                    break;
                }
        }

        $data['worklist'] = $allworklist;

        $this->load->view(lang('bakempwork'), $data);
    }

    public function addprocess() {

        $this->load->model('dao/processdao');
        $workno = $this->input->post('workno');
        $description = $this->input->post('description');
        $process = new Process();
        $process->setEmpno($_SESSION['emp']->getEmpno());
        $process->setDate(date("Y-m-d"));
        $process->setProdescription($description);
        $process->setWorkno($workno);

        $result = $this->processdao->insert($process);
        error_log('isert process ' . var_export($result, true));

        $this->viewworkdetail($workno);
    }

    public function deletework($workno) {

        $this->load->model('dao/workdao');
        $this->load->model('dao/processdao');
        $processresult = $this->processdao->delete($workno);
        $workresult = $this->workdao->delete($workno);
        error_log('delete process of workno' . var_export($processresult, true));
        error_log('delete work of workno' . var_export($workresult, true));
        $message = '';
        if ($processresult && $workresult) {
            $message = 'alert(\'delete complete\'); document.location.reload();';
        } else {


            $message = 'alert(\'somthing wrong *-* contact admin\');';
        }
        echo $message;
    }

    public function addcoemp() {
        $this->load->model('dao/workdao');
        $workno = $this->input->post('workno');
        $empno = $this->input->post('empno');

        $result = $this->workdao->addcoemp($workno, $empno);
        error_log(var_export($result, true) . 'insert in work_emp', 0);

        $this->viewworkdetail($workno);
    }

    public function viewworkdetail($workno) {
        $this->load->model('dao/workdao');
        $this->load->model('dao/processdao');
        $data = array();
        $work = $this->workdao->findworkdetail($workno);
        $allemp = $this->empdao->findbymultifield(array('position' => 'des'));
        $processlist = $this->processdao->findprocesslist($workno);
        $coemplist = $this->empdao->findcoemp($workno);
        $data['coemplist'] = $coemplist;
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
