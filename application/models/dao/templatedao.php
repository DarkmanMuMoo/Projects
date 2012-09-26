<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of templatedao
 *
 * @author Dark
 */
class Templatedao extends CI_Model {

    //put your code here
    public function __construct() {
        parent::__construct();
        $this->load->model('obj/template');
    }

    public function findbyid($tempno) {
        $this->db->where('tempno', $tempno);
        $query = $this->db->get('template');
        $obj = null;

        foreach ($query->result() as $row) {

            $obj = $this->makeObj($row);
        }
        //echo var_dump($obj);

        return $obj;
    }

    public function findtemplatelist($keyword = '', $condition = array()) {

        $this->db->select('*');
        $this->db->from('template');

        if ($keyword != '') {
            $where = "(temp_name LIKE '%$keyword%' )";
            $this->db->where($where);
        }
        foreach ($condition as $index => $row) {

            $this->db->where($index, $row);
        }
        $query = $this->db->get();
        $result = array();

        foreach ($query->result() as $row) {
            $obj = null;
            $obj = $this->makeObj($row);
            array_push($result, $obj);
        }
        // echo var_dump($obj);
        //var_dump($this->db->last_query());
        return $result;
    }

    public function getType(Template $template) {
        $this->load->model('dao/typedao');
        return $this->typedao->findbyid($template->getTypeno());
    }

    public function findbytypeno($typeno) {
        $this->db->where('type_no', $typeno);

        $query = $this->db->get('template');

        $array = array();
        foreach ($query->result() as $row) {
            $type = null;


            $type = $this->makeObj($row);


            array_push($array, $type);
        }
        //echo var_dump($array);

        return $array;
    }

    public function findall() {


        $query = $this->db->get('template');

        $array = array();
        foreach ($query->result() as $row) {
            $type = null;


            $type = $this->makeObj($row);


            array_push($array, $type);
        }
        //  echo var_dump($array);

        return $array;
    }

    public function insert(Template $template) {

        $data = array(
            'type_no' => $template->getTypeno(),
            'size' => $template->getSize(),
            'url' => $template->getUrl(),
            'tmp_name' => $template->getName(),
            'X' => $template->getTrimPerPrint(),
            'Z' => $template->getPrintperReam(),
            'platesize' => $template->getPlatesize()
        );

        return $this->db->insert('template', $data);
    }

    public function update(Template $template) {
        $data = array(
            'size' => $template->getSize(),
            'url' => $template->getUrl(),
            'tmp_name' => $template->getName(),
            'trimperprint' => $template->getTrimPerPrint(),
            'printperream' => $template->getPrintperReam(),
            'platesize' => $template->getPlatesize()
        );

        $this->db->where('tempno', $template->getTempno());
        return $this->db->update('template', $data);
    }

    private function makeObj($row) {

        $template = new Template();

        $template->setTempno($row->tempno);

        $template->setTypeno($row->type_no);
        $template->setSize($row->size);
        $template->setUrl($row->url);
        $template->setName($row->tmp_name);
        $template->setTrimPerPrint($row->trimperprint);
        $template->setPrintperReam($row->printperream);

        $template->setPlatesize($row->platesize);
        return $template;
    }

}

?>
