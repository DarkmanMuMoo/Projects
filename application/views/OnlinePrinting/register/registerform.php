<? $this->load->view(lang('header')) ?>
<br>
<script>
    function changecaptcha(){
        
        $('#captcha').attr('src', '<? echo site_url('register/getcaptcha') ?>');
        
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
                  
                    minlength: "Your password must be at least 8 characters long",
                       maxlength:"Your password must max 15 characters long"
                },
                confirm_password: {
                    required: "Please provide a confirmpassword",
                    minlength: "Your password must be at least 8 characters long",
                      maxlength:"Your password must max 15 characters long",
                    equalTo: "Please enter the same password as above"
                },
                email: "Please enter a valid email address Example: someone@example.com",
                postcode2:{
                    required: "required",
                    digits:"Please enter digit only"
                },
                postcode:{
                    required: "required",
                    digits:"Please enter digit only"
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
#alert p{
    
    font-size: 18px;
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
            <td><input type="text" name="email" id="email" value="<?echo $this->input->post('email')?>"  />
                <input class="btn" type="button" onclick="check_email();"  value="ตรวจสอบอีเมลล์"/></td>
        </tr>

        <tr>
            <td>ชื่อ</td>
            <td></td>
            <td><input type="text" name="name" id="name" value="<?echo $this->input->post('name')?>" /></td>
        </tr>
        
        <tr>
        <td>นามสกุล</td>
        <td></td>
        <td><input type="text" name="lastname" id="lastname"  value="<?echo $this->input->post('lastname')?>"/></td>
        </tr>
        
        <tr>
        <td>โทรศัพท์มือถือ</td>
        <td></td>
        <td><input type="text" name="mphone"  value="<?echo $this->input->post('mphone')?>" id="mphone"/></td>
        </tr>
        
        <tr>
        <td>รหัสผ่าน</td>
        <td></td>
        <td><input size="15" maxlength="15"  value="" type="password" name="password" id="password" /></td>
        </tr>
        
        <tr>
        <td>ยืนยันรหัสผ่าน</td> 
        <td></td>
        <td><input size="15" maxlength="15" type="password" name="confirm_password" id="confirm_password" /></td>
        </tr>
        
        <tr>
           <td style ="vertical-align: text-top;">ที่อยู่</td>
           <td></td>
           <td><textarea rows="10" cols="30" name="address" id="address">

<?echo $this->input->post('address')?>
            </textarea></td>
        </tr>
        
        <tr>
            <td>จังหวัด</td>
            <td></td>
            <td><select name="province" id="province">
                     <?php foreach ($provincelist as $province): ?>
                <option <? echo ($province->getProvinceid()==$this->input->post('province'))? 'selected="selected"':'' ?> value="<? echo $province->getProvinceid(); ?>"><? echo $province->getProvincename(); ?></option>
                <? endforeach; ?>
            </select></td>
        </tr>
        
        <tr>
            <td>รหัสไปรษณย์</td>
            <td></td>
            <td><input type="text" name="postcode" maxlength="5"  value="<?echo $this->input->post('postcode')?>"id="postcode"/></td>
        </tr>
        
        <tr>
        <td>โทรศัพท์</td>
        <td></td>
        <td><input type="text" name="phone1" value="<?echo $this->input->post('phone1')?>"  id="phone1"/></td>
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
<?echo $this->input->post('address2')?>
            </textarea></td>
        </tr>
            
            <tr>
            <td>จังหวัด</td> 
            <td></td>
            <td><select name="province2" id="province2">
                     <?php foreach ($provincelist as $province): ?>
                <option <? echo ($province->getProvinceid()==$this->input->post('province2'))? 'selected="selected"':'' ?>
                    value="<? echo $province->getProvinceid(); ?>"><? echo $province->getProvincename(); ?></option>
                <? endforeach; ?>
            </select></td>
            </tr>
            
            <tr>
            <td>รหัสไปรษณีย์</td>
            <td></td>
            <td><input type="text" name="postcode2" maxlength="5" id="postcode2" value="<?echo $this->input->post('postcode2')?>" /></td>
            </tr>
            
            <tr>
        <td>โทรศัพท์</td>
        <td></td>
        <td><input type="text" name="phone2"  id="phone2" value="<?echo $this->input->post('phone2')?>"/></td>
        </tr>
         <tr><td></td>
             <td></td>
             <td> <img id="captcha" src="<? echo site_url('register/getcaptcha') ?>" width="150" heigth="40" /><a href="javascript:void(0)"  onclick="changecaptcha();"class="btn">เปลี่ยนรูป</a><br><br></td>
                  
            </tr>
              <tr>
        <td>กรอกตัวอักษรในภาพ</td>
        <td></td>
        <td><input type="text" name="captcha"  id="captcha"/> </td>
        </tr>
            
            <tr>
                <td></td>
                <td></td>
                <td><input class="btn-info" type="submit"  value="ตกลง"/></td>
            </tr>
              </tbody>
        <? echo form_close(); ?>
    </table>
<div  id="alert"class="alert alert-error alert-block" style=" margin: 0 auto; width: 50%" > 

    <h4>ข้อผิดพลาด!</h4>
    
        <?php echo validation_errors(); ?>


</div>
</div>






<? $this->load->view(lang('footer')) ?>