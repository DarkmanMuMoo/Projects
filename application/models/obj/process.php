<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of process
 *
 * @author Dark
 */
class Process  extends CI_Model{
    //put your code here
    private $processno;
    private $prodescription;
    private $date;
    private $empno;
    private $workno;
    
    public function getProcessno() {
        return $this->processno;
    }

    public function setProcessno($processno) {
        $this->processno = $processno;
    }

    public function getProdescription() {
        return $this->prodescription;
    }

    public function setProdescription($prodescription) {
        $this->prodescription = $prodescription;
    }

    public function getDate() {
        return $this->date;
    }

    public function setDate($date) {
        $this->date = $date;
    }

    public function getEmpno() {
        return $this->empno;
    }

    public function setEmpno($empno) {
        $this->empno = $empno;
    }

    public function getWorkno() {
        return $this->workno;
    }

    public function setWorkno($workno) {
        $this->workno = $workno;
    }


}

?>
