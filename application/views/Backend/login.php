<!--
To change this template, choose Tools | Templates
and open the template in the editor.
-->
<!DOCTYPE html>
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
       
        
        </style>
        <script type="text/javascript">
        
     $().ready(function() {

     $("#loginForm").validate({
                errorLabelContainer: $("#con"),
                rules: {
                    name: "required",
                    password: "required"
                },messages: {
                    name:"plese enter name",
                    password:"password required"
                }	
            }	        
     );
     });
</script>
    </head>
    <body>
        <div class="container" align="center">
            <div id="login"  >
                  <?php
        echo form_open("user/performlogin", array('class' => 'well', 'id' => 'loginForm'));
        ?>
                      <fieldset>
                          <h4>Login</h4>
    <br>

    &nbsp; &nbsp; &nbsp;Name:     <input type="text" id="name" name="name"/><br>
      Password: <input type="text" id="password" name="password" /><br>
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
