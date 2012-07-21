<?php
class Positiondao extends CI_Model   {
 public function __construct() {
        parent::__construct();
        $this->load->model('obj/position');
         
    }
    
    public function findbyid($position){
         $this->db->where('position', $position);
            $query = $this->db->get('position');
         $obj = null;

        foreach ($query->result() as $row) {

            $obj = $this->makeObj($row);
        }
        // echo var_dump($obj);

        return $obj;
        
    }
     public function findall() {
        
     
        $query = $this->db->get('position');

        $array = array();
        foreach ($query->result() as $row) {
            $type = null;


            $type = $this->makeObj($row);


            array_push($array, $type);
        }
        //echo var_dump($array);

        return $array;
    }

      private function  makeObj($row){
        $pos = new Position();
$pos->setPosition($row->position);
        $pos->setPosdescription($row->pos_description);
      
        return  $pos;
    }
    
}
?>