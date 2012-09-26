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
        $this->load->model('dao/paperdao');
        $this->load->model('dao/ordsenddao');
        $this->load->model('dao/optiondao');
    }

    public function index() {

        $data['paperlist'] = $this->paperdao->findall();
        $data['ordsendlist'] = $this->ordsenddao->findall();
        $data['optionlist'] = $this->optiondao->findall();
        $_SESSION['paperlist'] = $data['paperlist'];
        $_SESSION['ordsendlist'] = $data['ordsendlist'];
        $_SESSION['optionlist'] = $data['optionlist'];
        $this->load->view(lang('costpage'), $data);
    }



    public function showuploadframe($templateno) {


        $data['templateno'] = $templateno;

        $this->load->view(lang('bakuploadframe'), $data);
    }


    public function updatetemplatefile() {
        $this->load->model('dao/templatedao');
        $this->load->library('uploadutil');
        $tempno = $this->input->post('templateno');
        $template = $this->templatedao->findbyid($tempno);

        $config = array();

        $filename = 'temp-' . $tempno;

        $config['upload_path'] = './asset/templatefile/';
        $config['allowed_types'] = 'pdf|ai';
        $config['max_size'] = '51200';
        $config['overwrite'] = true;
        $config['file_name'] = $filename;
        $upload = $this->uploadutil->upload($config, 'myfile');
        if ($upload == 'complete') {

            $data = $this->upload->data();

            $template->setUrl($filename . $data['file_ext']);

            $result = $this->templatedao->update($template);
            error_log(var_export($result, true) . 'update in template', 0);
        } else {

            echo "$upload";
        }
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

        $ordsendlist = $this->input->post();
        $oldordsend = $_SESSION['ordsendlist'];
        foreach ($ordsendlist as $key => $value) {


            $updateordsend = $oldordsend[$key];
            if ($value != $updateordsend->getSendprice()) {
                $updateordsend->setSendprice($value);
                $this->ordsenddao->update($updateordsend);
            }
        }
        $this->session->set_flashdata('ck', 'send');
        redirect('Backend/bakCost');
    }

    public function updatecal() {

        if($this->config->item('plate-L')==$this->input->post('plate-L')){
            
            $this->config->set_item('plate-L', $this->input->post('plate-L'));
        }
          if($this->config->item('plate-S')==$this->input->post('plate-S')){
            
             $this->config->set_item('plate-S', $this->input->post('plate-S'));
        }
          if($this->config->item('print')==$this->input->post('print')){
            
             $this->config->set_item('print', $this->input->post('print'));
        }
          if($this->config->item('misc')==$this->input->post('misc')){
            
             $this->config->set_item('misc', $this->input->post('misc'));
        }
        $this->session->set_flashdata('ck', 'cal');
        redirect('Backend/bakCost');
    }
    
    public function updateoption() {

        $updatelist = $this->input->post();
        $oldoption = $_SESSION['optionlist'];

        foreach ($updatelist as $key => $value) {


            $updateoption = $oldoption[$key];

            if ($value != $updateoption->getPrice()) {

                $updateoption->setPrice($value);
                $this->optiondao->update($updateoption);
            }
        }
        $this->session->set_flashdata('ck', 'option');
        redirect('Backend/bakCost');
    }

    public function updatepaper() {

        $updatelist = $this->input->post();
        $oldpaperlist = $_SESSION['paperlist'];
        foreach ($updatelist as $key => $value) {


            $updatepaper = $oldpaperlist[$key];
            if ($value != $updatepaper->getPriceperkilo()) {
                $updatepaper->setPriceperkilo($value);
                $this->paperdao->update($updatepaper);
            }
        }
        $this->session->set_flashdata('ck', 'paper');
        redirect('Backend/bakCost');
    }

}

?>
