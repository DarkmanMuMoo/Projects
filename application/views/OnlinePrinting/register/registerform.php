<? $this->load->view(lang('header')) ?>
<style type="text/css">
.req {
	color: #F00;
}
</style>

<br>
<script>
    function changecaptcha(){
        
        if(jQuery.browser.mozilla){
            document.getElementById('captcha').src='';
            document.getElementById('captcha').src='<? echo site_url('register/getcaptcha') ?>';
            
        }else{
            
              $('#captcha').attr('src', '<? echo site_url('register/getcaptcha') ?>');
        }
    

       
    }
     function check_email (){

       var vemail= $.trim($("#signupForm #email").val());
         if(vemail==''){
           alert('กรุณากรอกemail');  
         }else{
             
             var url = '<? echo site_url('user/ajaxcheckemail'); ?>'
                $.post(url, {email:vemail}, function(data){
                  
                    if(data=='true'){
                           alert('คุณสามารถใช้Emailนี้ได้');  
                        
                    }else{
                        
                           alert('มีEmailนี้ในระบบแล้ว');  
                        
                    }
                    
                });
         }
     }
    $().ready(function() {
    

    
        // validate the comment form when it is submitted
        $("#mphone").mask("999-999-9999");
        // validate signup form on keyup and submit
        $("#signupForm").validate({
            errorPlacement: function(error, element) {
                     if (element.attr("name") == "email" ){
                         
                          error.insertAfter($('#chkemail'));
                     }else{
                          error.insertAfter(element);
                     }
            },
            rules: {
                mphone:"required",
                name:"required",
                lastname:"required",
	
                password:{
                    required: true,
                    minlength: 8,
                    maxlength:15
                },
                confirm_password:{
                    required: true,
                    minlength: 8,
                    maxlength:15,
                    equalTo: "#password"
                },
                email: {
                    required: true,
                    email: true
                },
              
                // phone2:"required",
                 captcha:"required"
                      
                        
            },messages: {
                mphone:"ใส่เบอร์มือถือ",
                name: "Please enter your firstname",
                lastname: "Please enter your lastname",
		
                password: {
                    required: "Please provide a password",
                  
                    minlength: "Your password must be at least 8 characters long",
                       maxlength:"Your password must max 15 characters long"
                },
                confirm_password: {
                    required: "Please provide a confirmpassword",
                    minlength: "Your password must be at least 8 characters long",
                      maxlength:"Your password must max 15 characters long",
                    equalTo: "Please enter the same password as above"
                },
                email: "Please enter a valid email address",
               /* postcode2:{
                    required: "required",
                    digits:"Please enter digit only"
                },*/
                
                 //phone2:"required",
                  captcha:"required"
            }
            
            
            
        });


	
    });
     
 
</script>
<style>
    
    td:first-child{
        
        width: 152px;
    }
    hr{color: orangered;
background-color: orange;
height: 1px;}
    input.error { border: 1px dotted red; }

table{
   margin-top: 10px;
    width: 100%;
   
}
#alert p{
    
    font-size: 18px;
}
label.error {
    
    margin-left: 10px;
    display:inline;
}
</style>
<div style="margin: 0 auto ; width: 80%;" > 
    <p style ="margin-bottom: 10px;">
    <h1><b>ลงทะเบียน</b></h1>
    <h4>สมัครฟรี ไม่เสียค่าใช้จ่าย</h4>
</p>
<hr></hr>

<div  id="alert" <? echo (validation_errors()==null)?'': 'class="alert alert-error alert-block"'; ?> style=" margin-bottom: 30px; width: 50%" > 
<? echo (validation_errors()==null)?'': '<h4>ข้อผิดพลาด!</h4>'; ?>
    
    
        <?php echo validation_errors(); ?>


</div>
    <?php
    echo form_open('register', array('class' => 'email', 'id' => 'signupForm'));
    ?>
    
    
<table>
    <tbody>
        <tr>
            <td>อีเมลล์<span class="req">*             </span>  :</td>
            <td></td>
            <td><input type="text" name="email" id="email" value="<?echo $this->input->post('email')?>"  />
                <input id="chkemail" style="margin-bottom: 9px;" class="btn" type="button" onclick="check_email();"  value="ตรวจสอบอีเมลล์"/></td>
        </tr>

        <tr>
            <td>ชื่อ<span class="req">*</span> :</td>
            <td></td>
            <td><input type="text" name="name" id="name" value="<?echo $this->input->post('name')?>" /></td>
        </tr>
        
        <tr>
        <td>นามสกุล<span class="req">*</span> :</td>
        <td></td>
        <td><input type="text" name="lastname" id="lastname"  value="<?echo $this->input->post('lastname')?>"/></td>
        </tr>
        
        <tr>
        <td>โทรศัพท์มือถือ<span class="req">*</span> :</td>
        <td></td>
        <td><input type="text" name="mphone"  value="<?echo $this->input->post('mphone')?>" id="mphone"/></td>
        </tr>
        
        <tr>
        <td>รหัสผ่าน<span class="req">*</span> :</td>
        <td></td>
        <td><input size="15" maxlength="15"  value="" type="password" name="password" id="password" /></td>
        </tr>
        
        <tr>
        <td>ยืนยันรหัสผ่าน<span class="req">*</span> :</td> 
        <td></td>
        <td><input size="15" maxlength="15" type="password" name="confirm_password" id="confirm_password" /></td>
        </tr>
        <tr>
        <td>การแจ้งเตือน<span class="req">*</span> :</td> 
        <td></td>
        <td><input type="checkbox" name="issentemail" checked="checked" value="T"> Email
<input type="checkbox" name="issentsms" value="T" checked="checked" > SMS</td>
        </tr>
</table>

<table >
    <tbody>
         <tr><td 
  
></td>
             
             <td> <img  id="captcha" src="<? echo site_url('register/getcaptcha') ?>" width="150" heigth="40" /><a href="javascript:void(0)"  onclick="changecaptcha();"class="btn">เปลี่ยนรูป</a><br><br></td>
                  
    </tr>
              <tr>
        <td>กรอกตัวอักษรในภาพ<span class="req">*</span> :</td>
       
        <td><input type="text" name="captcha"  id="captcha"/> </td>
        </tr>
            
            <tr>
                <td></td>
                
                <td>&nbsp;&nbsp;&nbsp;<input class="btn-info" type="submit"  value="ตกลง"/></td>
            </tr>
              </tbody>
              </table>
        <? echo form_close(); ?>
   

</div>






<? $this->load->view(lang('footer')) ?>