<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of work
 *
 * @author Dark
 */
class Work  extends CI_Model{
    //put your code here
    private $workno;
    private $workname;
    private $startdate;
    private $enddate;
    private  $empno;
    private   $ordno;
    private   $workDescription;
    
    
    public function getWorkno() {
        return $this->workno;
    }

    public function setWorkno($workno) {
        $this->workno = $workno;
    }

    public function getWorkname() {
        return $this->workname;
    }

    public function setWorkname($workname) {
        $this->workname = $workname;
    }

    public function getStartdate() {
        return $this->startdate;
    }

    public function setStartdate($startdate) {
        $this->startdate = $startdate;
    }

    public function getEnddate() {
        return $this->enddate;
    }

    public function setEnddate($enddate) {
        $this->enddate = $enddate;
    }

    public function getEmpno() {
        return $this->empno;
    }

    public function setEmpno($empno) {
        $this->empno = $empno;
    }

    public function getOrdno() {
        return $this->ordno;
    }

    public function setOrdno($ordno) {
        $this->ordno = $ordno;
    }

    public function getWorkDescription() {
        return $this->workDescription;
    }

    public function setWorkDescription($workDescription) {
        $this->workDescription = $workDescription;
    }


}

?>
