<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of thailandutil
 *
 * @author Dark
 */
class Thailandutil {
 
   
  public function getAllprovinceList($tablename='province'){
         $CI =&get_instance(); 
       $query = $CI->db->get($tablename);

        $array = array();
        foreach ($query->result() as $row) {
            $option = null;


            $option = $this->makeObj($row);


            array_push($array, $option);
        }
        // echo var_dump($array);

        return $array;
      
  }
    public function findbyid($provinceid,$tablename='province'){
           $CI =&get_instance(); 
         $CI->db->where('PROVINCE_ID', $provinceid);
            $query = $CI->db->get($tablename);
        $obj = null;

        foreach ($query->result() as $row) {

            $obj = $this->makeObj($row);
        }
        // echo var_dump($obj);

        return $obj;
        
    }
    private function makeObj($row){
        
             $province = new Province();

        $province->setProvincecode($row->PROVINCE_ID);
        $province->setProvinceid($row->PROVINCE_CODE);
        $province->setProvincename($row->PROVINCE_NAME);
       
        return $province;
        
    }
}
class Province
{
    private $provinceid;
    private $provincecode;
    private $provincename;
    public function getProvinceid() {
        return $this->provinceid;
    }

    public function setProvinceid($provinceid) {
        $this->provinceid = $provinceid;
    }

    public function getProvincecode() {
        return $this->provincecode;
    }

    public function setProvincecode($provincecode) {
        $this->provincecode = $provincecode;
    }

    public function getProvincename() {
        return $this->provincename;
    }

    public function setProvincename($provincename) {
        $this->provincename = $provincename;
    }


}

?>
