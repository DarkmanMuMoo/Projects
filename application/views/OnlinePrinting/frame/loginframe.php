<? $this->load->view(lang('includeheader')) ?>
 <script>
     
     function passworddialog(){
         
         parent.closelogin();
         parent.PasswordDialog();
         
     }
        $().ready(function() {
            // validate the comment form when it is submitted
                  
            // validate signup form on keyup and submit
         
          
            $("#loginForm").validate({
                errorLabelContainer: $("#con"),
                rules: {
                    email: {
                        required: true,
                        email: true
                    },
                  password:{
                    required: true,
                    minlength: 8,
                    maxlength:15
                }
                },messages: {
                            
                            
                    email: {
                        required: "plese enter email",
                        email:  "plese enter valid email"
                    },
                   password: {
                    required: "Please provide a password",
                  
                    minlength: " password must be at least 8 characters long",
                       maxlength:"password must max 15 characters long"
                }
                }	
            }	
        );
       
        });
              
    </script>
    <style>
        
       #con .error{
            
            color: red;
font-style: italic;
        }
    </style>
    <div style="width:350px;  margin:0 auto" >
    
     <?php
        echo form_open("user/performlogin", array('class' => 'well', 'id' => 'loginForm'));
        ?>
    <strong>Email </strong>
    <input type="text"  class="input-xlarge" style="height: 28px;" name="email" id="email"  value="<? echo (isset($email))? $email:''; ?>" placeholder ="sample@mail.com" /><br/>
         <strong  >Password </strong>
         <input value="" class="input-xlarge" style="height: 28px;" type="password" name="password" id="password" placeholder="Enter password" /><br/>
    <!--remember me<input type="checkbox" name="remember" value="remember" /> I have a bike<br />-->

         <input  class="btn btn-large btn-primary" type="submit"  value="Login"/> 
         <a  style="margin-left: 30px;"target="_top"  href="javascript:void(0);" onclick="passworddialog()" >Forget password??</a>
                
       
        <br>
        
       
        
         <? echo form_close(); ?> 
        
         <div  id="con" class="alert-error" >


            <?php echo validation_errors(); ?>

        </div>
   
    </div>

    
   
</div>