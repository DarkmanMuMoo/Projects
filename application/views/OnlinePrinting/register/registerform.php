<? $this->load->view(lang('header')) ?>
<br>
<script>
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
        $("#phone1").mask("99-999-9999");
           $("#phone2").mask("99-999-9999");
        // validate signup form on keyup and submit
        $("#signupForm").validate({
            rules: {
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
                postcode2:{
                    required: true,
                    digits: true
                },
                postcode:{
                    required: true,
                    digits: true
                },
                address:"required",
                address2:"required",
                mphone:"required",
                phone1:"required",
                 phone2:"required",
                 captcha:"required"
                      
                        
            },messages: {
                name: "Please enter your firstname",
                lastname: "Please enter your lastname",
		
                password: {
                    required: "Please provide a password",
                  
                    minlength: "Your password must be at least 5 characters long",
                       maxlength:"Your password must max 15 characters long"
                },
                confirm_password: {
                    required: "Please provide a confirmpassword",
                    minlength: "Your password must be at least 5 characters long",
                      maxlength:"Your password must max 15 characters long",
                    equalTo: "Please enter the same password as above"
                },
                email: "Please enter a valid email address Example: someone@example.com",
                postcode2:{
                    required: "required",
                    digits:"digit"
                },
                postcode:{
                    required: "required",
                    digits:"digit"
                },
                address:"required",
                address2:"required",
                   mphone:"required",
                phone1:"required",
                 phone2:"required",
                  captcha:"required"
            }
            
            
            
        });


	
    });
     
 
</script>
<style>
    hr{color: orangered;
background-color: orange;
height: 1px;}
    input.error { border: 1px dotted red; }
    label.error {
color: red;
font-style: italic;
}
table{
   
    width: 100%;
   
}

</style>
<div style="margin: 0 auto ; width: 80%;" > 
    <p style ="margin-bottom: 10px;">
    <h1><b>ลงทะเบียน</b></h1>
    <h4>สมัครฟรี ไม่เสียค่าใช้จ่าย</h4>
    
    
</p>
<hr></hr>
    <?php
    echo form_open('register', array('class' => 'email', 'id' => 'signupForm'));
    ?>
    
    
<table>
    <tbody>
        <tr>
            <td>อีเมลล์ </td>
            <td></td>
            <td><input type="text" name="email" id="email"  />
                <input class="btn" type="button" onclick="check_email();"  value="ตรวจสอบอีเมลล์"/></td>
        </tr>

        <tr>
            <td>ชื่อ</td>
            <td></td>
            <td><input type="text" name="name" id="name" /></td>
        </tr>
        
        <tr>
        <td>นามสกุล</td>
        <td></td>
        <td><input type="text" name="lastname" id="lastname" /></td>
        </tr>
        
        <tr>
        <td>โทรศัพท์มือถือ</td>
        <td></td>
        <td><input type="text" name="mphone"  id="mphone"/></td>
        </tr>
        
        <tr>
        <td>รหัสผ่าน</td>
        <td></td>
        <td><input size="15" type="password" name="password" id="password" /></td>
        </tr>
        
        <tr>
        <td>ยืนยันรหัสผ่าน</td> 
        <td></td>
        <td><input size="15" type="password" name="confirm_password" id="confirm_password" /></td>
        </tr>
        
        <tr>
           <td style ="vertical-align: text-top;">ที่อยู่</td>
           <td></td>
           <td><textarea rows="10" cols="30" name="address" id="address">The cat was playing in the garden.
            </textarea></td>
        </tr>
        
        <tr>
            <td>จังหวัด</td>
            <td></td>
            <td><select name="province" id="province">
                     <?php foreach ($provincelist as $province): ?>
                <option value="<? echo $province->getProvinceid(); ?>"><? echo $province->getProvincename(); ?></option>
                <? endforeach; ?>
            </select></td>
        </tr>
        
        <tr>
            <td>รหัสไปรษณย์</td>
            <td></td>
        <td><input type="text" name="postcode"  id="postcode"/></td>
        </tr>
        
        <tr>
        <td>โทรศัพท์</td>
        <td></td>
        <td><input type="text" name="phone1"  id="phone1"/></td>
        </tr>
        
        <tr>
            <td><b>ที่อยู่สำรอง</b></td>
            <td></td>
        <td></td>
        </tr>        
        
        
        
        <tr>
            <td style ="vertical-align: text-top;">ที่อยู่</td> 
            <td></td>
            <td><textarea rows="10" cols="30" name="address2" id="address2"  >
The cat was playing in the garden.
            </textarea></td>
        </tr>
            
            <tr>
            <td>จังหวัด</td> 
            <td></td>
            <td><select name="province2" id="province2">
                     <?php foreach ($provincelist as $province): ?>
                <option value="<? echo $province->getProvinceid(); ?>"><? echo $province->getProvincename(); ?></option>
                <? endforeach; ?>
            </select></td>
            </tr>
            
            <tr>
            <td>รหัสไปรษณีย์</td>
            <td></td>
            <td><input type="text" name="postcode2" id="postcode2" /></td>
            </tr>
            
            <tr>
        <td>โทรศัพท์</td>
        <td></td>
        <td><input type="text" name="phone2"  id="phone2"/></td>
        </tr>
         <tr><td></td>
             <td></td>
                <td> <img  src="<? echo site_url('register/getcaptcha') ?>" width="150" heigth="40" /><br><br></td>
                  
            </tr>
              <tr>
        <td>กรอกตัวอักษรในภาพ</td>
        <td></td>
        <td><input type="text" name="captcha"  id="captcha"/></td>
        </tr>
            
            <tr>
                <td></td>
                <td></td>
                <td><input class="btn-info" type="submit"  value="ตกลง"/></td>
            </tr>
              </tbody>
        <? echo form_close(); ?>
    </table>
    <p>

        <?php echo validation_errors(); ?>

    </p>
</div>






<? $this->load->view(lang('footer')) ?>