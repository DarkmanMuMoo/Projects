  




<? 
//check var  that hook gen

//echo var_dump($_SESSION);
if (!$_SESSION['hasuser']) { ?>



    <script>
        $().ready(function() {
            // validate the comment form when it is submitted
                  
            // validate signup form on keyup and submit
                    
            $('#forgetpassword').click(function(){
                $('#PasswordDialog').dialog(
                {
                    autoOpen: true,
                    buttons: [
                        {
                            text: "sendEmail",
                             click: function(){ 
                             var email = $('#PasswordDialog #email').val();
                    var url= '<?php echo site_url("user/ajaxRetrivePassword");  ?>';
                               
                 
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
                    
            });
                   
                    
          
            $("#loginForm").validate({
                errorLabelContainer: $("#con"),
                rules: {
                    email: {
                        required: true,
                        email: true
                    },
                    password:"required"
                },messages: {
                            
                            
                    email: {
                        required: "plese enter email",
                        email:  "plese enter valid email"
                    },
                    password:"password required"
                }	
            }	
        );
        });
    </script>
    <div>
        <?php
        echo form_open("user/performlogin/homepage", array('class' => 'well', 'id' => 'loginForm'));
        ?>
        email <input type="text"  class="input-xlarge" style="height: 28px;" name="email" id="email"  /><br/>
        password<input class="input-xlarge" style="height: 28px;" type="password" name="password" id="password" /><br/>
    <!--remember me<input type="checkbox" name="remember" value="remember" /> I have a bike<br />-->

        <input  class="btn btn-primary" type="submit"  value="submit"/>

        <? echo anchor('register', 'Signup', 'title="SignUp"'); ?>

        <a href="javascript:void(0);" id="forgetpassword" >forgetpassword</a>
        <div  id="con" class="alert-error" >


            <?php echo validation_errors(); ?>

        </div>
        
         <? echo form_close(); ?> 
        
        
        <div id="PasswordDialog"  style="display: none;">
            <p> กรอกEmailของคุณ </p>

            <p>
                <input type="text"  class="input-xlarge" style="height: 28px;" name="email" id="email"  />
            </p>
        </div>
    </div>
    <?
} else {

    $cus = $_SESSION['user'];
    ?>

    <div>


        Hello <? echo $cus->getName(); ?>



        <? echo form_open("user/performlogout/homepage", array('id' => 'logoutform')); ?>

        <input  type="submit"  value="logout"/>

        <? echo form_close(); ?>
    </div>
    
    
<? }  ?>
