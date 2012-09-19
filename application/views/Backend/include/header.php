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
             <div id="navi"> 
             <?php if ($_SESSION['emp']->getPosition() == 'Boss'): ?>   
           
                <ul id="menu"class="nav nav-pills">
                    <li id="Home"  ><a href="<? echo site_url('Backend/home');  ?>">Mainmenu</a></li>
                    <li id="BakOrders" >
    <a href="<? echo site_url('Backend/bakorders');  ?>">Order</a>
  </li>
  <li  id="Bakwork"  ><a href="<? echo site_url('Backend/bakwork');  ?>">Work</a></li>
  <li id="Bakemp"  ><a href="<? echo site_url('Backend/bakemp');  ?>">Employee</a></li>
  <li id="BakCost"  ><a href="<? echo site_url('Backend/bakCost');  ?>">Cost</a></li>
           </ul>
                  <?php else: ?>
                
                  <ul id="menu"class="nav nav-pills">
                    <li id="Home"  ><a href="<? echo site_url('Backend/home');  ?>">mainmenu</a></li>
           <li id="Bakemp"  ><a href="<? echo site_url('Backend/bakemp/empprofile');  ?>">Employee</a></li>         
  <li  id="Bakwork"  ><a href="<? echo site_url('Backend/bakwork/empworkpage');  ?>">Work</a></li>

           </ul>
                
                 <?php endif; ?>
            </div>
                
     
            </div>