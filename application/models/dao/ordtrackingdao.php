<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ordtrackingdao
 *
 * @author Dark
 */
class Ordtrackingdao extends CI_Model {

    //put your code here

    public function __construct() {


        $this->load->model('obj/ordtracking');
    }
public function findbyorderno($orderno){
    $this->db->where('orderno', $orderno);
        $query = $this->db->get('ordtracking');
        $obj = null;

        foreach ($query->result() as $row) {

            $obj = $this->makeObj($row);
        }
        //var_dump($obj);

        return $obj;
}
      public function insert(Ordtracking $ordtracking) {

        $data = array(
            'orderno' => $ordtracking->getOrderno(),
            'trackingno' => $ordtracking->getTrackingno()
        );

        return $this->db->insert('ordtracking', $data);
    }
public function update(Ordtracking $ordtracking) {
        $data = array(
            'trackingno' => $$ordtracking->getTrackingno()
          
        );

        $this->db->where('orderno', $ordtracking->getOrderno());
        return $this->db->update('ordtracking', $data);
    }

    
    public function makeObj($row) {

        $ordtracking = new Ordtracking();
        $ordtracking->setOrderno($row->orderno);
        $ordtracking->setTrackingno($row->trackingno);

        return $ordtracking;
    }

}

?>
