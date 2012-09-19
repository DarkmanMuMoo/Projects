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
          $this->load->model('obj/emp');
    }

    public function index() {
        $this->load->model('dao/paperdao');
        $this->load->model('dao/ordsenddao');
        $this->load->model('dao/optiondao');


        $data['paperlist'] = $this->paperdao->findall();
        $data['ordsendlist'] = $this->ordsenddao->findall();
        $data['optionlist'] = $this->optiondao->findall();
        $_SESSION['paperlist'] = $data['paperlist'];
        $_SESSION['ordsendlist'] = $data['ordsendlist'];
        $_SESSION['optionlist'] = $data['optionlist'];
        $this->load->view(lang('costpage'), $data);
    }
public function templatedetail($templateno){
    
    
     $this->load->view(lang('costpage'), $data);
}
    public function template() {
        $this->load->model('dao/typedao');
        $this->load->model('dao/templatedao');
        $this->load->library('pagination');
        $type = $this->input->post('type');
        $condition = array();

        $keyword = '';
        if ($this->input->post('keyword')) {
            $keyword = $this->input->post('keyword');
        }
        if ($this->input->post('type')) {
            $type = $this->input->post('type');

            $condition['type_no'] = $type;
        }
        $config['per_page'] = 10;
        $startrow = ($this->input->post()) ? $this->input->post('startrow') : 0;
        $config['total_rows'] = $this->gettotalpage($keyword, $condition);
        $this->pagination->initialize($config);
        $this->db->limit($config['per_page'], $startrow);
        $data['templatelist'] = $this->templatedao->findtemplatelist($keyword, $condition);
        $data['typelist'] = $this->typedao->findall();
        $this->load->view(lang('baktemplate'), $data);
    }

    private function gettotalpage($keyword = '', $condition = array()) {

        if ($keyword != '') {
            $where = "(tmp_name LIKE '%$keyword%' )";
            $this->db->where($where);
        }
        foreach ($condition as $index => $row) {

            $this->db->where($index, $row);
        }
        return $this->db->count_all_results('template');
    }

    public function updateordsend() {
        $this->load->model('dao/ordsenddao');
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
        $this->load->model('dao/optiondao');
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
        $this->load->model('dao/paperdao');
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
