<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of userprofile
 *
 * @author Dark
 */
class Userprofile extends CI_Controller {

    //put your code here




    public function index() {

        $this->load->model('dao/addressdao');

        $this->load->library('thailandutil');
        $updateuser = $_SESSION['user'];
        $con = array();

        $con['email'] = $updateuser->getEmail();
        $data = array();
        $data['updateuser'] = $updateuser;
        $data['addresslist'] = $this->addressdao->findbymultifield($con);
        $data['provincelist'] = $this->thailandutil->getAllprovinceList();

        $this->load->view(lang('userprofile'), $data);
    }

    public function updateaddress() {
        
        $this->load->library('thailandutil');
        $this->load->model('dao/addressdao');
        //var_dump($this->input->post());
        $addressno = $this->input->post('addressno');
        $updateaddress = $this->addressdao->findbyid($addressno);
        $address = $this->input->post('address');
        $province = $this->thailandutil->findbyid($this->input->post('province'))->getProvincename();
        $postcode = $this->input->post('postcode');
        $phone = $this->input->post('phone');
        $addressname = $this->input->post('addressname');
        $updateaddress->setAddressname($addressname);
      
        $updateaddress->setAddress($address);
        $updateaddress->setProvince($province);
        $updateaddress->setPostcode($postcode);
        $updateaddress->setPhone($phone);


        $result = $this->addressdao->update($updateaddress);

        error_log(var_export($result, true) . 'change address', 0);


       redirect('userprofile');
    }

    public function updateinfo() {


        $name = $this->input->post('name');
        $lastname = $this->input->post('lastname');
        $mphone = $this->input->post('mphone');
        $update = false;
        if ($name != $_SESSION['user']->getLastname()) {

            $update = true;
        }
        if ($lastname != $_SESSION['user']->getName()) {

            $update = true;
        }

        if ($mphone != $_SESSION['user']->getMobilephone()) {

            $update = true;
        }
        if ($update) {
            //do update
            $_SESSION['user']->setName($name);
            $_SESSION['user']->setLastname($lastname);
            $_SESSION['user']->setMobilephone($mphone);

            $result = $this->cusdao->update($_SESSION['user']);
            error_log(var_export($result, true) . 'change emp password', 0);
            if (!$result) {
                $_SESSION['user'] = $this->cusdao->findbyemail($_SESSION['user']->getEmail());
            }
        }
        redirect('userprofile');
    }

    public function ajaxchangepassword() {
        $updateuser = $_SESSION['user'];
        $password = $updateuser->getPassword();
        $oldpass = $this->input->post('pold');
        $pnew = $this->input->post('pnew');
        if ($password == md5($oldpass)) {
            $updateuser->setPassword(md5($pnew));
            $result = $this->cusdao->update($updateuser);
            /* $_SESSION['emp']=null;
              $_SESSION['emp']=$emp; */

            error_log(var_export($result, true) . 'change emp password', 0);
            echo true;
        } else {

            echo 'password  not valid';
        }
    }

    
    public function addaddress() {

        $this->load->library('thailandutil');
        $this->load->model('dao/addressdao');
        $addressname = $this->input->post('addressname');
        $address = $this->input->post('address');
        $province = $this->thailandutil->findbyid($this->input->post('province'));
        $phone = $this->input->post('phone');
        $postcode = $this->input->post('postcode');
        $email = $_SESSION['user']->getEmail();

        $newaddress = new Address();
        $newaddress->setAddress(trim($address));
        $newaddress->setAddressname($addressname);
        $newaddress->setEmail($email);
        $newaddress->setPhone($phone);
        $newaddress->setPostcode($postcode);
        $newaddress->setProvince($province->getProvincename());

  
        $result = $this->addressdao->insert($newaddress);
     
        
        redirect('userprofile');
    }

    public function deleteaddress($addressno) {
        $this->load->model('dao/addressdao');

        $result = $this->addressdao->delete($addressno);
        redirect('userprofile');
    }

}

?>