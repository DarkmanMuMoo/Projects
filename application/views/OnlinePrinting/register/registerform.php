<? $this->load->view(lang('header')) ?>
<br>
<script>
     
    $().ready(function() {
        // validate the comment form when it is submitted
        $("#phone").mask("999-999-9999");
        // validate signup form on keyup and submit
        $("#signupForm").validate({
            rules: {
                name:"required",
                lastname:"required",
	
                password:{
                    required: true,
                    minlength: 5
                },
                confirm_password:{
                    required: true,
                    minlength: 5,
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
                phone:"required"
                      
                        
            },messages: {
                name: "Please enter your firstname",
                lastname: "Please enter your lastname",
		
                password: {
                    required: "Please provide a password",
                    minlength: "Your password must be at least 5 characters long"
                },
                confirm_password: {
                    required: "Please provide a confirmpassword",
                    minlength: "Your password must be at least 5 characters long",
                    equalTo: "Please enter the same password as above"
                },
                email: "Please enter a valid email address",
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
                phone:"required"
		
            }
            
            
            
        });


	
    });
     
 
</script>
   
<div style="margin: 0 auto ; width: 60%;" > 
    <p style ="margin-bottom: 10px;">
    <h1><b>ลงทะเบียน</b></h1>
    <h4>สมัครฟรี ไม่เสียค่าใช้จ่าย</h4>
    
    
</p>
<hr style="color: orangered;
background-color: orange;
height: 1px;""></hr>
    <?php
    echo form_open('register', array('class' => 'email', 'id' => 'signupForm'));
    ?>
    
    
    <table>

        <tr>
            <td>อีเมลล์</td>
            <td></td>
            <td><input type="text" name="email" id="email" /></td>
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
        <td>โทรศัพท์</td>
        <td></td>
        <td><input type="text" name="phone"  id="phone"/></td>
        </tr>
        
        <tr>
        <td>รหัสผ่าน</td>
        <td></td>
        <td><input type="password" name="password" id="password" /></td>
        </tr>
        
        <tr>
        <td>ยืนยันรหัสผ่าน</td> 
        <td></td>
        <td><input type="password" name="confirm_password" id="confirm_password" /></td>
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
                <option value="A">A</option>
                <option value="B">B</option>
                <option value="C" selected="selected">C</option>
            </select><br/></td>
        </tr>
        
        <tr>
            <td>รหัสไปรษณย์</td>
            <td></td>
        <td><input type="text" name="postcode"  id="postcode"/></td>
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
                <option value="A">A</option>
                <option value="B">B</option>
                <option value="C" selected="selected">C</option>
            </select><br/></td>
            </tr>
            
            <tr>
            <td>รหัสไปรษณีย์</td>
            <td></td>
            <td><input type="text" name="postcode2" id="postcode2" /></td>
            </tr>
            
            <tr>
                <td></td>
                <td></td>
            <td><input  type="submit"  value="ตกลง"/></td>
            </tr>
            
        <? echo form_close(); ?>
    </table>
    <p>

        <?php echo validation_errors(); ?>

    </p>
</div>






<? $this->load->view(lang('footer')) ?>