
<html>
    
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>Backendlogin</title>
         
        <? $this->load->view(lang('Bakincludeheader')) ?>
            <style type="text/css">
        body{ 
          background-color: #bce8f1;
        }
        #login{
          margin-top: 150px;
   
            width: 50%;
            
        }
        #login input[type=text],input[type=password]{
            
            
            height: auto;
        }
       
        
        </style> 
    </head>
    <body>
        <div class="container" align="center">
            <div id="login"  >
                  <?php
        echo form_open("Backend/user/performlogin", array('class' => 'well', 'id' => 'loginForm'));
        ?>
                      <fieldset>
                          <h4>Login</h4>
    <br>

    &nbsp; &nbsp; &nbsp;Email:     <input class="input-xlarge"  value=""type="text" id="email" name="email"/><br>
    Password: <input  class="input-xlarge" type="password" value="" id="password" name="password" /><br>
      <br>
      <p><button type="submit" class="btn btn-primary">login</button></p>
                      </fieldset>
                        <? echo form_close(); ?>
                <p>
                 <div  id="con" class="alert-error" >


            <?php echo validation_errors(); ?>

        </div>
            </p>
                
                </div>
        </div>
    </body>
</html>

<script src="<? echo base_url("asset/javascript/jquery.validate.js"); ?>" >  </script>
      <script src="<? echo base_url("asset/javascript/jquery.metadata.js"); ?>" >  </script>
        <script type="text/javascript">
        
     $().ready(function() {

     $("#loginForm").validate({
                errorLabelContainer: $("#con"),
                rules: {
                    email: {
                        required: true,
                        email: true
                    },
                    password: "required"
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
  