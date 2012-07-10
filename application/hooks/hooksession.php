<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of checkuser
 *
 * @author Dark
 */
class Hooksession  {
    //put your code here
        var $CI;

 
    public function __construct() {
         
if(!isset($_SESSION)){
  session_start();

  }
    }

    //$hasemp
  public function  empexist($varname){

 
      $_SESSION[$varname[0]]=$this->checkvarinsession('emp');
      

  }
  //$hasuser
   public function  userexist($varname){
      
      $_SESSION[$varname[0]]=$this->checkvarinsession('user');
      
       
  }
   private function checkvarinsession($varname) {
    $checker = false;

    if (isset($_SESSION[$varname])) {


        $checker = true;
    }
    
    return $checker;
}
}

?>
