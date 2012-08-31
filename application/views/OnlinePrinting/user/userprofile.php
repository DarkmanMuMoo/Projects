<? $this->load->view(lang('header')) ?>
<style type="text/css">
    table {
        margin:0 auto;
        width: 60%;
    }

    #edit{
        margin-top: 0;
        margin-right: auto;
        margin-bottom: 10px;
        margin-left: auto;
    }
    td{
        padding: 5px;

    }
    tr td:last-of-type {
        width: 30%; 
        text-align: center;

    }

    tr td:first-of-type {
        width: 30%; 
    }

    tr td:not(:first-of-type):not(:last-of-type) {

        width: 40%; 
    }
   
    hr{color: orangered;
       background-color: orange;
       height: 1px;}
    #address1,#address2{

        padding: 5px;
        margin-bottom: 10px;
    }
    #address1,#address2 form{

        display: table;
        width: 100%;
		text-align:center;
    }
    .leftadd{

        float:left ; 
        width: 50%; 
        text-align: center;
    }
    .leftadd textarea{
        
        width: 75%;
        height: auto;
    }
    .rightadd{
        
        float:right ; width: 50%;
    }
  
</style>
<div id="page">
    <p style ="margin-bottom: 10px;">
    <h1><b>ประวัติ</b></h1>
    <h4>แก้ไขได้</h4>


</p>
<hr></hr>
<div id="edit">
    <p>
    <h5><strong>INFO</strong></h5>
    </P>
    <form   id="editform" action="<? echo site_url('userprofile/updateinfo') ?>" method="post">
        <table  border="0" >
            <tr>
                <td>อีเมลล์</td>
                <td><? echo $updateuser->getEmail(); ?></td>
                <td>&nbsp;</td>
            </tr>
            <tr>
                <td >ชื่อ</td>
                <td colspan="2" style="text-align: left"><input  class="input-medium"name="name" type="text" value="<? echo $updateuser->getName(); ?>">&nbsp;&nbsp;
                    </td>
                    
             
            </tr>
            <tr>
            <td>นามสกุล</td>
            <td colspan="2" style="text-align: left"><input class="input-medium" name="lastname" type="text" value="<? echo $updateuser->getLastname(); ?>"></td>
            
            </tr>
            <tr>
                <td>โทรศัพท์มือถือ</td>
                <td> <input maxlength="10" name="mphone"type="text" value="<? echo $updateuser->getMobilephone(); ?>"></td>
                <td></td>
            </tr>
            <tr>
                <td>รหัสผ่าน</td>
                <td><input name="" type="password" value="12345678" readonly="readonly" /></td>
                <td><a  href="javascript:void(0);" class="btn" onclick="changepassword();">เปลี่ยนรหัสผ่าน</a></td>
            </tr>
            <tr>
                <td colspan="3" > <input class="btn-info" type="submit" value="แก้ไข"/> </td>
            </tr>
        </table>
    </form>

<p>
        <h5><strong>ที่อยู่</strong></h5>
        </P>
    <div id="address1" >
        
        <form id="edit" action="<? echo site_url('userprofile/updateaddress') ?>" method="post" >
             
            <textarea name="ad" rows="5" cols="30"><? echo $address1['address'] ?></textarea>
             </div>
          <div id="address1" >    
          จังหวัด  &nbsp;&nbsp; &nbsp;&nbsp;&nbsp;<select  name="prov" >
              <?php foreach ($provincelist as $province): ?>
                <option value="<? echo $province->getProvinceid(); ?>"    <? echo ( $address1['provinceid'] ==$province->getProvinceid())? 'selected=\'selected\'':'';  ?>><? echo $province->getProvincename(); ?></option>
                <? endforeach; ?>
        
              
          </select><br/>
          รหัสไปรษณีย์  <input  maxlength="10" name="post"type="text" value="<? echo $address1['postcode'] ?>"><br/>
           โทรศัพท์  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input  name="phone"type="text" value="<? echo $address1['phone'] ?>">
           <br />
           <input name="index" value="1" type="hidden"/>
        <input class="btn-info" type="submit" value="edit">
             </div>
            
        
        </form> 
        
    </div>
    <div id="address2" >
        <p>
            &nbsp;  &nbsp;  &nbsp; <h5><strong>ที่อยู่</strong></h5>
        </p>
        <form id="edit" action="<? echo site_url('userprofile/updateaddress') ?>" method="post" >
            

                <textarea  name="ad" rows="5" cols="50" ><? echo $address2['address'] ?></textarea>
                <br />
      จังหวัด &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
               <select name="prov"> <?php foreach ($provincelist as $province): ?>
                <option value="<? echo $province->getProvinceid(); ?>"  <? echo ( $address2['provinceid'] ==$province->getProvinceid())? 'selected=\'selected\'':'';  ?>><? echo $province->getProvincename(); ?></option>
                <? endforeach; ?></select><br/>
                รหัสไปรษณีย์  
                <input maxlength="15" name="post" type="text" value="<? echo $address2['postcode'] ?>"><br/>
                โทรศัพท์   &nbsp;&nbsp; &nbsp;&nbsp;&nbsp; <input name="phone" type="text" value="<? echo $address2['phone'] ?>">
            <br />
            <input name="index" value="2" type="hidden"/>
            <input  class="btn-info"type="submit" value="edit">
        </form>
        </div>
</table>
    </div>



</div>




</div>


<? $this->load->view(lang('footer')) ?>
<div id="changepassword" style="display: none">
        <form id="changepasswordform">
            <p>
                <label>passwordเก่า</label><input type="password" name="pold" id="pold" />
            </p>
            <p>
                <label>passwordใหม่</label><input type="password" name="pnew" id="pnew" />
            </p>
            <p>
                <label>passwordconfirm</label><input type="password"  name="pconnew" id="connew" />
            </p>
            <div id="showerror" style="text-align: center; color: red; "></div>
        </form>


    </div>
    <script src="<? echo base_url("asset/javascript/jquery.validate.js"); ?>" >  </script>
    <script src="<? echo base_url("asset/javascript/jquery.metadata.js"); ?>" >  </script>
    <script>
        
        function changepassword(){
           var validate= $("#changepasswordform").validate({
                rules: {
                    pold:"required", 
                    pnew:"required",
                    pconnew:{required: true,
                        equalTo: "#pnew"
                    }
                },messages:{
                    pold:"required", 
                    pnew:"required",
                    pconnew:{required: "required",
                        equalTo: "pl fill same as above"
                    }
                
                
                }
        
            });
                    
                    
            $('#changepassword').dialog(
            {
                autoOpen: true,
                buttons: [
                    {
                        text: "change",
                        click: function(){ 
                            if(validate.form()){
                               // var param = {pold:$('#pold').val()
                                    //,pnew:$('#pold').val()
                                    //,pconnew:$('#pconnew').val()}
                                    
                                   $.post("<? echo site_url('userprofile/ajaxchangepassword');?>", $("#changepasswordform").serialize(),
                                   function(data){
     
                                   if(data==true){
                              
                                      $('#changepassword').dialog('close');
                                   validate.resetForm();
                                   document.getElementById('changepasswordform').reset();
                                   }else{
                                       $('#changepassword #showerror').html(data);
                                       
                                   }
                                   });
                                    
                            }
                            
                        }
       
                    }
           
                ],
                modal: true,
                close: function() {
            
				  validate.resetForm();
                                  document.getElementById('changepasswordform').reset();
			},
                title: "change password"
                
            
            } );    
                
        }
                </script>