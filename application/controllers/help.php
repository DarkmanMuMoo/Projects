<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of help
 *
 * @author Dark
 */
class Help  extends CI_Controller{
    //put your code here
    
    public function __construct() {
        parent::__construct();
    }
public function index($page='step'){
    $data['page']=$page;
    $this->load->view(lang('help'),$data);
}
public function pay(){
    
      $this->load->view(lang('helppay'));
}
public function regis(){
    
      $this->load->view(lang('helpregis'));
}
public function step(){
    
      $this->load->view(lang('helpstep'));
}
}

?>
