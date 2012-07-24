<!--
To change this template, choose Tools | Templates
and open the template in the editor.
-->
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title></title>

        <? $this->load->view(lang('includeheader')) ?>
        <script src="<? echo base_url("asset/javascript/bootstrap-dropdown.js"); ?>" >  </script>
        <link href="<? echo base_url("asset/css/main.css"); ?>" rel="stylesheet">
    </head>
    <body>
        <script>
                
            function showcart(){

 
 
                $('#showcartdialog').dialog({ 
                    autoOpen: true,
                    modal: true,
                    width:900,
                    title: "Your Cart"

                }
            
            );
                    
                   
                document.getElementById('cartdialog').src = '<? echo site_url("orders/showcart"); ?>'; 
                    
         
          
            }
            function showloginframe(){
                $('#showloginframe').dialog({ 
                    autoOpen: true,
                    modal: true,
                    width:450,
                    height:400,
                    title: "login"

                }
            
            );
                    
                   
                document.getElementById('loginframe').src = '<? echo site_url("home/loginframe"); ?>';   
                    
                    
            }
            function PasswordDialog(){
                    
                $('#PasswordDialog').dialog(
                {
                    autoOpen: true,
                    buttons: [
                        {
                            text: "sendEmail",
                            click: function(){ 
                                var email = $('#PasswordDialog #email').val();
                                var url= '<?php echo site_url("user/ajaxRetrivePassword"); ?>';
                               
                 
                                $.post(url, { emailval: email}, function(data) { 
                                
                                    if(data=='ส่งemailเรียบร้อย'){
                                        alert(data);

                                    }else{
                                        alert(data);

                                    }
                                });
                        
                                $(this).dialog("close");    
                            
                            }
                           
                            
                        }
           
                    ],
                    modal: true,
                    title: "Forget password dialog"
                
            
                } );     
                    
                    
                    
                    
                    
                    
                    
            }
                
            function logout(){
                
                var url= '<?php echo site_url("user/performlogout"); ?>';
                               
                 
                $.post(url, function(data) { 
                              
                    eval(data);
                });
                
                
                
            }
           $(document).ready(function(){
   // Your code here
  // alert('<?echo get_class(get_instance())?>');
        $('#menu #<?echo get_class(get_instance())?>').addClass('current_page_item');
        
       if( $('#slider').length!=0){
           
            $("#slider").easySlider({
		auto: false,
		continuous: true,
		numeric: true
	});
           
       }

 });      
                
                
        </script>
        <div id="wrapper">
            <div id="header">
                <div id="logo">
                    <h1><a href="#">OnlinePrinting </a></h1>
                    <p>  by colour harmony </p>
                </div>
            </div>
            <div id="menu">
                <ul class="menu" >
                    <li id="Home"><a href="<?php echo site_url("home"); ?>">Home</a></li>
                    <li id="Product"><a href="<?php echo site_url("product"); ?>">Product</a></li>
                    <li id="Orders"><a href="<?php echo site_url("orders"); ?>">Orders</a></li>
                    <li id="Register" ><a href="<?php echo site_url("register"); ?>">Register</a></li>
                    <li><a href="#">Links</a></li>

                </ul>


                <div id="login" style="float: right; padding-right: 20px;" >
                    <?
//check var  that hook gen
//echo var_dump($_SESSION);
                    if (!$_SESSION['hasuser']) {
                        ?>
                        <div class="btn-group pull-right" style="font-weight:bold; margin-top: 5px;" >

                            <button class="btn btn-info" style="font-weight:bold;"   onclick="showloginframe()" ><i class="icon-user"></i>  Login  </button>
                            <button class="btn btn-info dropdown-toggle" data-toggle="dropdown" >
                                <span class="caret"></span>
                            </button>
                            <ul class="dropdown-menu">
                                <li> <? echo anchor('register', 'Signup', 'title="SignUp"'); ?></li>
                                <li class="divider"></li>
                                <li> <a href="javascript:void(0);" id="forgetpassword"  onclick="PasswordDialog();" >forget password</a></li>

                            </ul>
                        </div>



                    <?
                    } else {
                        $cus = $_SESSION['user'];
                        ?>

                        <div class="btn-group pull-right" style="font-weight:bold; margin-top: 5px;" >
                            <a class="btn dropdown-toggle" data-toggle="dropdown" href="#">
                                <i class="icon-user"></i>  <? echo $cus->getName(); ?>
                                <span class="caret"></span>
                            </a>
                            <ul class="dropdown-menu">
                                <li><a onclick="showcart();" id="showcart"  href="javascript:void(0);"><i class="icon-shopping-cart icon-white"></i> yourcart(<? echo (isset($_SESSION['cart'])) ? count($_SESSION['cart']) : '0' ?>)</a> </li>
                                <li class="divider"></li>
                                <li><a href="javascript:void(0);" onclick="logout();">Log Out</a></li>
                            </ul>
                        </div>

<? } ?>
                </div>
            </div>

            <!--frame-->
            <div id="showloginframe"  style="display: none; width:auto;" >
                <iframe src="" name="loginframe" id="loginframe" width="400px" height="350px"
                        style="border-style:none;" scrolling="no" >
                </iframe>

            </div>
            <div id="showcartdialog"  style="display: none;">
                <iframe src="" name="cartdialog" id="cartdialog" width="700px"
                        height="500px" style="border-style:none;" scrolling="no" >


                </iframe>

            </div>

            <div id="PasswordDialog"  style="display: none;">
                <p> กรอกEmailของคุณ </p>

                <p>
                    <input type="text"  class="input-xlarge" style="height: 28px;" name="email" id="email"  />
                </p>
            </div>
            <br>