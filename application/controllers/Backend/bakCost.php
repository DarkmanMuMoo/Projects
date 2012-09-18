<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of bakCost
 *
 * @author Dark
 */
class BakCost extends CI_Controller {

    //put your code here

    public function __construct() {
        parent::__construct();
    }

    public function index() {
        $this->load->model('paperdao');
        $this->load->model('ordsenddao');
        $this->load->model('optiondao');


        $data['paperlist'] = $this->paperdao->findall();
        $data['ordsendlist'] = $this->ordsenddao->findall();
        $data['optionlist'] = $this->optiondao->findall();
        $_SESSION['paperlist'] = $data['paperlist'];
        $_SESSION['ordsendlist'] = $data['ordsend'];
        $_SESSION['optionlist'] = $data['optionlist'];
        $this->load->view(lang('costpage'));
    }

    public function updateordsend() {
        $this->load->model('ordsenddao');
        $ordsendlist = $this->input->post();
        $oldoption = $_SESSION['ordsendlist'];
        foreach ($ordsendlist as $key => $value) {


            $updateordsend = $oldoption[$key];
            if ($value != $updateordsend->getSendprice()) {
                $updatepaper->setSendprice($value);
                $this->ordsenddao->update($updatepaper);
            }
        }
        redirect('Backend/bakCost');
    }
     public function updateoption() {
        $this->load->model('optiondao');
        $updatelist = $this->input->post();
        $oldoption = $_SESSION['optionlist'];
        foreach ($updatelist as $key => $value) {


            $updateoption = $oldoption[$key];
            if ($value != $updateoption->getPrice()) {
                $updatepaper->setPrice($value);
                $this->optiondao->update($updatepaper);
            }
        }
        redirect('Backend/bakCost');
    }

    public function updatepaper() {
        $this->load->model('paperdao');
        $updatelist = $this->input->post();
        $oldpaperlist = $_SESSION['paperlist'];
        foreach ($updatelist as $key => $value) {


            $updatepaper = $oldpaperlist[$key];
            if ($value != $updatepaper->getPriceperkilo()) {
                $updatepaper->setPriceperkilo($value);
                $this->paperdao->update($updatepaper);
            }
        }
        redirect('Backend/bakCost');
    }

}

?>
