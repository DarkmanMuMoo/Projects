<?php

  if(!$_SESSION['hasemp']){
             
      
      redirect('Backend/home');
    
        }
            
             
            
       
?>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>Backendlogin</title>
           <? $this->load->view(lang('Bakincludeheader')) ?>
  </head>
    <body>
        <div class="navbar-fixed-top" style="clear: both;"> 
        <div id="head"  > <span class="label label-info"><? echo $_SESSION['emp']->getName();?></span>  <a class="btn btn-danger" href="<? echo site_url('Backend/user/performlogout') ?>">
               <i class="icon-off icon-white"></i>Logout</a>    
        </div>
            </div>