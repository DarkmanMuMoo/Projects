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
        $this->load->library('thailandutil');
        $updateuser = $_SESSION['user'];
        $address1 = $_SESSION['user']->getAddress1();
        $address2 = $_SESSION['user']->getAddress2();
        $data = array();
        $data['updateuser'] = $updateuser;
        $id1 = $this->thailandutil->findbyname($address1['province']);
        $address1['provinceid'] = ($id1 == null) ? '' : $id1->getProvinceid();
        $id2 = $this->thailandutil->findbyname($address2['province']);
        $address2['provinceid'] = ($id2 == null) ? '' : $id2->getProvinceid();
        $data['address1'] = $address1;
        $data['address2'] = $address2;

        $data['provincelist'] = $this->thailandutil->getAllprovinceList();
   
        $this->load->view(lang('userprofile'), $data);
    }

    public function updateaddress() {
  $this->load->library('thailandutil');

  //var_dump($this->input->post());
        $ad = $this->input->post('ad');
        $prov = $this->thailandutil->findbyid($this->input->post('prov'))->getProvincename();
        $post = $this->input->post('post');
        $phone = $this->input->post('phone');
        $address = ($this->input->post('index') == '1') ? $_SESSION['user']->getAddress1() : $_SESSION['user']->getAddress2();
       
        $update = ($ad != $address['address']) || ($prov != $address['province']) || ($ad != $address['postcode']) || ($ad != $address['phone']);
        if ($update) {
            $address['address'] = $ad;
            $address['province'] = $prov;
            $address['postcode'] = $post;
            $address['phone'] = $phone;
              ($this->input->post('index') == '1') ?$_SESSION['user']->setAddress1($address):$_SESSION['user']->setAddress2($address);
             $result = $this->cusdao->update($_SESSION['user']);
            
            error_log(var_export($result, true) . 'change address', 0);
            if (!$result) {
                $_SESSION['user'] = $this->cusdao->findbyemail($_SESSION['user']->getEmail());
            }
        }
          $this->index();
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
        $this->index();
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

}

?>
