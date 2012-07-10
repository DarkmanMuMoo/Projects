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
        <?php
  echo form_open('register', array('class' => 'email', 'id' => 'signupForm'));
        ?>
        email <input type="text" name="email" id="email"  /><br/>
        name <input type="text" name="name" id="name" /><br/>
        lastname<input type="text" name="lastname" id="lastname" /><br/>
        phone <input type="text" name="phone"  id="phone"/><br/>
       password<input type="password" name="password" id="password" /><br/>
       confirm-password <input type="password" name="confirm_password" id="confirm_password" /><br/>
       <p>
           address <br/><textarea rows="10" cols="30" name="address" id="address">
The cat was playing in the garden.
</textarea><br/>
province <select name="province" id="province">
<option value="A">A</option>
<option value="B">B</option>
<option value="C" selected="selected">C</option>
</select><br/>
postcode<input type="text" name="postcode"  id="postcode"/><br/>
       </p>
       
     <p>  Address2</p>
           <p>
               address<br/> <textarea rows="10" cols="30" name="address2" id="address2"  >
The cat was playing in the garden.
</textarea>
               province <select name="province2" id="province2">
<option value="A">A</option>
<option value="B">B</option>
<option value="C" selected="selected">C</option>
</select><br/>
postcode<input type="text" name="postcode2" id="postcode2" /><br/>
       </p>
       <input  type="submit"  value="submit"/>
        <?echo form_close();?>
        
        <p>
            
            <?php echo validation_errors(); ?>
    
        </p>
  </div>
     
     
     
     
     
     
 <? $this->load->view(lang('footer')) ?>