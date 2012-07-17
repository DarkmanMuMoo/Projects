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