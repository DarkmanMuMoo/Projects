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
    }

    public function getcaptcha() {
        $this->load->library('captchautil');

        $array = $this->captchautil->captcha();
        $_SESSION['word'] = $array['word'];
        $image = $array['img'];
        header("Content-type:image/png"); //กำหนดชนิดของภาพตอนแสดงผลผ่าน browser
        imagepng($image); //แสดงผลภาพที่สร้าง
        imagedestroy($image);
    }

    public function index() {
        $this->load->library('thailandutil');
        $this->load->library('form_validation');
        $this->form_validation->set_rules('email', 'Email', 'callback_email_check');
        $this->form_validation->set_rules('captcha', 'Captcha', 'callback_captcha_check');

        if ($this->form_validation->run() == FALSE) {

            $provincelist = $this->thailandutil->getAllprovinceList();
            $data = array();
            $data['provincelist'] = $provincelist;
            $this->load->view(lang('registerform'), $data);
        } else {
            $issentemail=($this->input->post('issentemail'))?'T':'F';
            $issentsms=($this->input->post('issentsms'))?'T':'F';
            $cus = new Custormer();
            $cus->setIssentemail($issentemail);
            $cus->setIssetsms($issentsms);
            $cus->setEmail($this->input->post('email'));
            $cus->setName($this->input->post('name'));
            $cus->setLastname($this->input->post('lastname'));
            $cus->setPassword(md5($this->input->post('password')));
            $cus->setMobilephone($this->input->post('mphone'));
            $this->cusdao->insert($cus);
            // echo var_dump( $this->cusdao->insert($cus));
            $result = $this->sendemail($cus);
            error_log(var_export($result, true) . 'send email register to' . $this->input->post('email'), 0);
            $this->load->view(lang('registerSuccess'));
        }
    }

    public function captcha_check($captcha) {

        $this->load->library('form_validation');

        if (!isset($_SESSION['word'])) {

            $this->form_validation->set_message('captcha_check', 'กรอกอักษรตรวจสอบผิด');
            return FALSE;
        } else if ($captcha != $_SESSION['word']) {

            $this->form_validation->set_message('captcha_check', 'กรอกอักษรตรวจสอบผิด');
            return FALSE;
        } else {

            return true;
        }
    }

    public function email_check($email) {
        $this->load->library('form_validation');

        $check = $this->cusdao->checkemail($email);
        if (!$check) {

            $this->form_validation->set_message('email_check', 'email นี้มีคนใช้แล้ว');
            return FALSE;
        } else {

            return TRUE;
        }
    }

    private function sendemail(Custormer $cus) {
        $this->load->library('myencrypt');
        $config = array();
        //for server

        $config['protocol'] = 'sendmail';
        $config['mailpath'] = '/usr/sbin/sendmail';
        $config['charset'] = 'utf-8';
        $config['wordwrap'] = TRUE;
        $config['mailtype'] = 'text';
        $config['newline'] = "\r\n";


        //for test in localhost   
        /* $config['protocol'] = 'smtp';
          $config['smtp_host'] = 'ssl://smtp.googlemail.com';
          $config['smtp_port'] = '465';
          $config['smtp_timeout'] = '30';
          $config['smtp_user'] = 'darkmanmumoonaja@gmail.com';
          $config['smtp_pass'] = '15710804';
          $config['mailtype'] = 'html';
          $config['charset'] = 'utf-8';
          $config['newline'] = "\r\n"; */

        $this->load->library('email', $config);
        $this->email->from('phairoj@colourharmony.co.th', 'Colour Harmony');
        $this->email->to($cus->getEmail());

        $encrypted_email = $this->myencrypt->encode($cus->getEmail());
        $this->email->subject('ยืนยันการเป็นสมาชิก');
        $url = site_url("register/validate_user/$encrypted_email");
        
        $message = ' อีเมลล์ที่ใช้เข้าสู่ระบบของคุณคือ' . $cus->getEmail() .'กดที่ลิ้งนี้เพื่อยืนยันการเป็นสมาชิก'.$url;
        $this->email->message($message);

        return $this->email->send();

        //echo $this->email->print_debugger();
        //echo  $message;
    }

    public function validate_user($emailencode) {
        $this->load->library('myencrypt');
        $emaildecrpt = $this->myencrypt->decode($emailencode);
        if ($this->cusdao->validateuser($emaildecrpt)) {


            $this->load->view(lang('registerconfirmpage'));
        } else {



            echo $this->input->post('email') . "<br>";
            echo $this->myencrypt->decode($emailencode);
        }


        // echo $this->encrypt->decode($email);
    }

}

?>
