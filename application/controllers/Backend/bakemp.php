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
class Bakemp extends CI_Controller {

    //put your code here

    public function __construct() {
        parent::__construct();

        $this->load->model('dao/empdao');
    }

    public function index() {
        $this->load->model('dao/positiondao');
        $this->load->library('pagination');
        $condition = array();
        $keyword = '';
        $data = array();
        if ($this->input->post('keyword')) {
            $keyword = $this->input->post('keyword');
        }
        if ($this->input->post('position')) {
            $position = $this->input->post('position');

            $condition['position'] = $position;
        }


        $config['per_page'] = 10;
        $startrow = ($this->input->post()) ? $this->input->post('startrow') : 0;

        if ($keyword != '') {
            $this->db->or_like('emp_name', $keyword);
            $this->db->or_like('lastname', $keyword);
            $this->db->or_like('email', $keyword);
        }
        foreach ($condition as $index => $row) {

            $this->db->where($index, $row);
        }
        $config['total_rows'] = $this->db->count_all_results('employee');

        $this->db->limit($config['per_page'], $startrow);
        $emplist = $this->empdao->findemplist($keyword, $condition);
        $this->pagination->initialize($config);
        $positionlist = $this->positiondao->findall();

        $data['emplist'] = $emplist;
        $data['positionlist'] = $positionlist;
  
        $this->load->view(lang('bakemp'), $data);
    }

   

    public function deleteemp() {
        $empno = $this->input->post('empno');

        $result = $this->empdao->delete($empno);
        error_log("delete emp  $empno =" . var_export($result, true), 0);
        $javascript = "
   document.location.reload();
   ";
        echo $javascript;
    }

    public function viewempdetail($empno) {

        $this->load->model('dao/positiondao');
        $poslist = $this->positiondao->findall();
        $tmp_emp = $this->empdao->findbyid($empno);
        $data = array();
        $data['tmpemp'] = $tmp_emp;
        $data['poslist'] = $poslist;
        $this->load->view(lang('empdetail'), $data);
    }

    public function empprofile() {
        $this->load->model('dao/positiondao');
        $poslist = $this->positiondao->findall();

        $empno = $_SESSION['emp']->getEmpno();
        $tmp_emp = $this->empdao->findbyid($empno);
        $picurl = ($tmp_emp->getPicurl() == null || $tmp_emp->getPicurl() == '') ? 'nopic.jpg' : $tmp_emp->getPicurl();
        $data = array();
        $data['tmpemp'] = $tmp_emp;
        $data['poslist'] = $poslist;
        $data['picurl'] = $picurl;

        $this->load->view(lang('empprofile'), $data);
    }

    public function uploadpic() {
        $this->load->library('uploadutil');
        $empno = $_SESSION['emp']->getEmpno();
        $tmp_emp = $this->empdao->findbyid($empno);
        $filename = $empno . '-' . $tmp_emp->getName() . '-' . $tmp_emp->getLastname();
        $config['upload_path'] = './asset/Sys_img/emp_img';
        $config['allowed_types'] = 'jpg|png';
        $config['max_size'] = '2048';
        $config['overwrite'] = true;
        $config['file_name'] = $filename;
        $upload = $this->uploadutil->upload($config, 'pic');

        if ($upload == 'complete') {

            $data = $this->upload->data();

            $tmp_emp->setPicurl($filename . $data['file_ext']);

            $result = $this->empdao->update($tmp_emp);
            error_log(var_export($result, true) . 'update in emp pic', 0);
            $this->empprofile();
        } else {

            echo "<script>alert('$upload');<script>";
        }
    }

    public function updateprofile() {
        $empno = $_SESSION['emp']->getEmpno();
        $tmp_emp = $this->empdao->findbyid($empno);
        $name = $this->input->post('name');
        $lastname = $this->input->post('lastname');
        $pasword = $this->input->post('telephone');
        $phone = $this->input->post('password');
        $tmp_emp->setName($name);
        $tmp_emp->setLastname($lastname);
        $tmp_emp->setPassword($pasword);
        $tmp_emp->setPhone($phone);
        $result = $this->empdao->update($tmp_emp);
        error_log(var_export($result, true) . 'update in emp profile', 0);
        $this->empprofile();
    }

    public function insertemp() {
        $this->load->helper('string');

        $name = $this->input->post('name');
        $lastname = $this->input->post('lastname');
        $email = $this->input->post('email');
        $phone = $this->input->post('phone');
        $password = random_string();
        $position = $this->input->post('position');
        $emp = new Emp();
        $emp->setEmail($email);
        $emp->setName($name);
        $emp->setLastname($lastname);
        $emp->setPhone($phone);
        $emp->setPassword($password);
        $emp->setPosition($position);
        $emp->setPicurl(null);

        $insertresult = $this->empdao->insert($emp);
        error_log('result of insert emp' . var_export($insertresult, true), 0);

        $this->load->library('emailutil');
        $config = $this->emailutil->getSmtpconfig();
        $form = lang('adminemail');
        $to = $email;
        $subject = 'ยินดีต้อนรับ พนักงาน ใหม่';
        $message = 'email use to login =' . $email;
        $message.='<br> password is =' . $password;
        $emailresult = $this->emailutil->sendemail($config, $form, $to, $subject, $message);
        error_log("send email to $to result is" . var_export($emailresult, true), 0);

        $this->index();
    }

    public function ajaxchangepassword() {
        $emp = $_SESSION['emp'];
        $password = $emp->getPassword();
        $oldpass = $this->input->post('pold');
        $pnew = $this->input->post('pnew');
        if ($password == $oldpass) {
            $emp->setPassword($pnew);
            $result = $this->empdao->update($emp);
            /* $_SESSION['emp']=null;
              $_SESSION['emp']=$emp; */

            error_log(var_export($result, true) . 'change emp password', 0);
            echo true;
        } else {

            echo 'password  not valid';
        }
    }

    public function updateemp() {

        $empno = $this->input->post('empno');

        $position = $this->input->post('position');

        $emp = $this->empdao->findbyid($empno);
        $emp->setPosition($position);
        $result = $this->empdao->update($emp);
        error_log(var_export($result, true) . 'update emp', 0);

        $this->viewempdetail($empno);
    }

}

?>
