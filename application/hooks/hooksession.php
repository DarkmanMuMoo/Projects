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
class Hooksession {
//put your code here
var $CI;


public function __construct() {

if(!isset($_SESSION)){
session_start();

}
}

//$hasemp
public function empexist($varname){


$_SESSION[$varname[0]] = $this->checkvarinsession('emp');


}
//$hasuser
public function userexist($varname){
$check = $this->checkvarinsession('user');
$_SESSION[$varname[0]] = $check;
$controllername = get_class(get_instance());


if(!$check){
  
if($controllername=='Userprofile'||$controllername=='Orders'){
redirect('home');
}
}else{
    if($controllername=='Register'){
        redirect('home');
    }
}


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
