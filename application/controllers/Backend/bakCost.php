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
public function  deletetemp($tmpno){
    $this->load->model('dao/templatedao');

        $this->templatedao->delete($orderno);

        $javascript = "
   document.location.reload();
   ";
        echo $javascript;
   
    
}
    public function inserttemp() {
        $this->load->library('uploadutil');
        $this->load->model('dao/typedao');
        $this->load->model('dao/templatedao');
        $typeno = $this->input->post('typeno');
       
        $name = $this->input->post('name');
        $size = $this->input->post('size');
        $platesize = $this->input->post('platesize');
        $tpp = $this->input->post('tpp');
        $ppr = $this->input->post('ppr');
        $template = new Template();
        $template->setName($name);
        $template->setSize($size);
        $template->setTypeno($typeno);
        $template->setPlatesize($platesize);
        $template->setTrimPerPrint($tpp);
        $template->setPrintperReam($ppr);
    
        $config = array();
        $config['upload_path'] = './asset/templatefile';
        $config['allowed_types'] = 'pdf|ai';
        $config['max_size'] = '51200';
        $upload=$this->uploadutil->upload($config,'file');
         if ($upload == 'complete') {

            $data = $this->upload->data();

            $template->setUrl( $data['file_name'] );

            $result = $this->templatedao->insert($template);
            error_log(var_export($result, true) . 'insert template', 0);
            redirect('Backend/bakCost/template');
        } else {
         
            echo "<script>alert('$upload');</script>";
        }
        
        
    }

    public function index() {
        $this->load->driver('cache', array('adapter' => 'file'));
        $data['paperlist'] = $this->paperdao->findall();
        $data['ordsendlist'] = $this->ordsenddao->findall();
        $data['optionlist'] = $this->optiondao->findall();
        $data['plateL'] = $this->cache->file->get('plateL', true);
        $data['plateS'] = $this->cache->file->get('plateS', true);
        $data['print'] = $this->cache->file->get('print', true);
        $data['misc'] = $this->cache->file->get('misc', true);
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
        $this->load->driver('cache', array('adapter' => 'file'));
        $this->cache->file->save('plateL', $this->input->post('plateL'), 0);
        $this->cache->file->save('plateS', $this->input->post('plateS'), 0);
        $this->cache->file->save('print', $this->input->post('print'), 0);
        $this->cache->file->save('misc', $this->input->post('misc'), 0);
        $this->session->set_flashdata('ck', 'cal');
        redirect('Backend/bakCost');
    }

    public function addpaper() {

        $name = $this->input->post('name');
        $grame = $this->input->post('gram');
        $price = $this->input->post('price');
        $paper = new Paper();
        $paper->setName($name);
        $paper->setGrame($grame);
        $paper->setPrice($price);
        $this->paperdao->insert($paper);
        $this->session->set_flashdata('ck', 'paper');
        redirect('Backend/bakCost');
    }

    public function addoption() {

        $description = $this->input->post('description');
        $price = $this->input->post('price');
        $option = new Option();
        $option->setDescription($description);
        $option->setPrice($price);
        $this->optiondao->insert($option);
        $this->session->set_flashdata('ck', 'option');
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
