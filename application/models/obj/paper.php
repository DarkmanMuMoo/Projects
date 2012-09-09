<?php


class Paper  extends CI_Model {
    //put your code here
    
    private $paperno;
    private $name;
    private $grame;
    private $priceperkilo;
    public function getPaperno() {
        return $this->paperno;  
    }
    public function getPriceperkilo() {
        return $this->priceperkilo;
    }

    public function setPriceperkilo($priceperkilo) {
        $this->priceperkilo = $priceperkilo;
    }

        public function setPapaerno($papaerno) {
        $this->paperno = $papaerno;
    }

    public function getName() {
        return $this->name;
    }

    public function setName($name) {
        $this->name = $name;
    }

    public function getGrame() {
        return $this->grame;
    }

    public function setGrame($grame) {
        $this->grame = $grame;
    }


}

?>
