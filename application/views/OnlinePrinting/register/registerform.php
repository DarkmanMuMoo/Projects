<? $this->load->view(lang('header')) ?>
<style type="text/css">
.req {
	color: #F00;
}
</style>

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
        $("#needop").click(function(){
   
          if($('#needop').attr('checked')!=undefined){
                $('#optional').hide();
          
          }else{
               $('#optional').show();
          }
        });
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
               /* postcode2:{
                    required: true,
                    digits: true
                },*/
                postcode:{
                    required: true,
                    digits: true
                },
                address:"required",
               // address2:"required",
                mphone:"required",
                phone1:"required",
                // phone2:"required",
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
               /* postcode2:{
                    required: "required",
                    digits:"Please enter digit only"
                },*/
                postcode:{
                    required: "required",
                    digits:"Please enter digit only"
                },
                address:"required",
                //address2:"required",
                   mphone:"required",
                phone1:"required",
                 //phone2:"required",
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
            <td>อีเมลล์<span class="req">*</span></td>
            <td></td>
            <td><input type="text" name="email" id="email" value="<?echo $this->input->post('email')?>"  />
                <input class="btn" type="button" onclick="check_email();"  value="ตรวจสอบอีเมลล์"/></td>
        </tr>

        <tr>
            <td>ชื่อ<span class="req">*</span></td>
            <td></td>
            <td><input type="text" name="name" id="name" value="<?echo $this->input->post('name')?>" /></td>
        </tr>
        
        <tr>
        <td>นามสกุล<span class="req">*</span></td>
        <td></td>
        <td><input type="text" name="lastname" id="lastname"  value="<?echo $this->input->post('lastname')?>"/></td>
        </tr>
        
        <tr>
        <td>โทรศัพท์มือถือ<span class="req">*</span></td>
        <td></td>
        <td><input type="text" name="mphone"  value="<?echo $this->input->post('mphone')?>" id="mphone"/></td>
        </tr>
        
        <tr>
        <td>รหัสผ่าน<span class="req">*</span></td>
        <td></td>
        <td><input size="15" maxlength="15"  value="" type="password" name="password" id="password" /></td>
        </tr>
        
        <tr>
        <td>ยืนยันรหัสผ่าน<span class="req">*</span></td> 
        <td></td>
        <td><input size="15" maxlength="15" type="password" name="confirm_password" id="confirm_password" /></td>
        </tr>
        
        <tr>
           <td style ="vertical-align: text-top;"><strong>ที่อยู่ติดต่อ</strong></td>
           <td></td>
           <td>&nbsp;</td>
        </tr>
        <tr>
        <td>ที่อยู่<span class="req">*</span></td>
        <td></td>
        <td><textarea  id="address" name="address" cols="" rows="" placeholder ="111/235 ซ.ตัวอย่าง ถ.ตัวอย่าง แขวงตัวอย่าง เขตตัวอย่าง"></textarea></td>
      </tr>
      
        <tr>
            <td>จังหวัด<span class="req">*</span></td>
            <td></td>
            <td><select name="province" id="province">
                     <?php foreach ($provincelist as $province): ?>
                <option <? echo ($province->getProvinceid()==$this->input->post('province'))? 'selected="selected"':'' ?> value="<? echo $province->getProvinceid(); ?>"><? echo $province->getProvincename(); ?></option>
                <? endforeach; ?>
            </select></td>
        </tr>
        
        <tr>
            <td>รหัสไปรษณย์<span class="req">*</span></td>
            <td></td>
            <td><input type="text" name="postcode" maxlength="5"  value="<?echo $this->input->post('postcode')?>"id="postcode"/></td>
        </tr>
        
        <tr>
        <td>โทรศัพท์<span class="req">*</span></td>
        <td></td>
        <td><input type="text" name="phone1" value="<?echo $this->input->post('phone1')?>"  id="phone1"/></td>
        </tr>
        <tr>
        <td ><b>ที่อยู่(ออกใบเสร็จ)</b></td>
       <td></td>
            <td><input  type="checkbox" name="needop" id="needop" value="ck" /><span>เหมือนที่อยู่ติดต่อ</span></td>
          
        </tr>
        </tbody>
</table>
<table id="optional">
    <tbody>
    
            <tr>
        <td style="width: 144px;" >ที่อยู่</td>
       
        <td><textarea  id="address2" name="address2" cols="" rows="" placeholder ="111/235 ซ.ตัวอย่าง ถ.ตัวอย่าง แขวงตัวอย่าง เขตตัวอย่าง"></textarea></td>
        </tr>
        <tr>
    <tr>
            <td>จังหวัด</td> 
            
            <td><select name="province2" id="province2">
                     <?php foreach ($provincelist as $province): ?>
                <option <? echo ($province->getProvinceid()==$this->input->post('province2'))? 'selected="selected"':'' ?>
                    value="<? echo $province->getProvinceid(); ?>"><? echo $province->getProvincename(); ?></option>
                <? endforeach; ?>
            </select></td>
    </tr>
            
            <tr>
            <td>รหัสไปรษณีย์</td>
         
            <td><input type="text" name="postcode2" maxlength="5" id="postcode2" value="<?echo $this->input->post('postcode2')?>" /></td>
            </tr>
            
            <tr>
        <td>โทรศัพท์</td>
        
        <td><input type="text" name="phone2"  id="phone2" value="<?echo $this->input->post('phone2')?>"/></td>
        </tr>
        </tbody>
         </table>
<table>
    <tbody>
         <tr><td style="
    width: 144px;
"></td>
             
             <td> <img id="captcha" src="<? echo site_url('register/getcaptcha') ?>" width="150" heigth="40" /><a href="javascript:void(0)"  onclick="changecaptcha();"class="btn">เปลี่ยนรูป</a><br><br></td>
                  
    </tr>
              <tr>
        <td>กรอกตัวอักษรในภาพ<span class="req">*</span></td>
       
        <td><input type="text" name="captcha"  id="captcha"/> </td>
        </tr>
            
            <tr>
                <td></td>
                
                <td><input class="btn-info" type="submit"  value="ตกลง"/></td>
            </tr>
              </tbody>
              </table>
        <? echo form_close(); ?>
   

</div>






<? $this->load->view(lang('footer')) ?>