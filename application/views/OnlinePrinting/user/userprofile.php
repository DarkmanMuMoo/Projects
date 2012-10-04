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
        margin-left: 20%;
    }
    #address1,#address2 form{

        display: table;
        width: 100%;
		
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
    <h4>ข้อมูส่วนตัวเพื่อการสั่งพิมพ์</h4>


</p>
<hr></hr>
<div id="edit">
    <p>
        
        
         <h4 ><strong>ข้อมูลส่วนตัว</strong></h4>
    </p>
   

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
                <td> <input maxlength="10"  id="mphone" name="mphone"type="text" value="<? echo $updateuser->getMobilephone(); ?>"></td>
                <td></td>
            </tr>
            <tr>
                <td>รหัสผ่าน</td>
                <td><input name="" type="password" value="12345678" readonly="readonly" /></td>
                <td><a  href="javascript:void(0);" class="btn" onclick="changepassword();">เปลี่ยนรหัสผ่าน</a></td>
            </tr>
            <tr>
            <td></td>
                <td  > <input class="btn-info" type="submit" value="edit"/> </td>
            <td></td>
            </tr>
        </table>
    </form>

<p>
        <h4><strong>ที่อยู่ติดต่อ</strong></h4>
        </P>
   
        
        <form id="edit" action="<? echo site_url('userprofile/updateaddress') ?>" method="post" >
        <table >
        <tr> 
        <td>ที่อยู่</td>   
         
          <td> <textarea name="ad" rows="5" cols="30"><? echo $address1['address'] ?></textarea></td>
           </tr>
         <tr>
          <td>จังหวัด</td>  
          
          <td><select  name="prov" >
              <?php foreach ($provincelist as $province): ?>
                <option value="<? echo $province->getProvinceid(); ?>"    <? echo ( $address1['provinceid'] ==$province->getProvinceid())? 'selected=\'selected\'':'';  ?>><? echo $province->getProvincename(); ?></option>
                <? endforeach; ?>
        </select></td>
              
         
        <tr> 
        <td> รหัสไปรษณีย์</td> 
        
        <td> <input  maxlength="5" name="post"type="text" value="<? echo $address1['postcode'] ?>"></td></tr>
      <tr>  
      <td>โทรศัพท์  </td>
      
      <td><input id="phone1" name="phone"type="text" value="<? echo $address1['phone'] ?>"> </td>
      </tr> 
     
     <tr>
     <td></td> 
      <td >   
           <input name="index" value="1" type="hidden"/>
        <input class="btn-info" type="submit" value="edit"></td>
        <td></td>
        </tr>
         </table>
             </div>
            
        
        </form> 
        
    </div>
    <p>
            <h4><strong>ที่อยู่ออกใบเสร็จ</strong></h4>
        </p>
       
        <form id="edit" action="<? echo site_url('userprofile/updateaddress') ?>" method="post" >
            <table>
            <tr>
            <td>ที่อยู่</td>
           <td> <textarea  name="ad" rows="5" cols="50" ><? echo $address2['address'] ?></textarea>
                </td>
                </tr>
    <tr>
        <td>จังหวัด</td>
              <td> <select name="prov"> <?php foreach ($provincelist as $province): ?>
                <option value="<? echo $province->getProvinceid(); ?>"  <? echo ( $address2['provinceid'] ==$province->getProvinceid())? 'selected=\'selected\'':'';  ?>><? echo $province->getProvincename(); ?></option>
                <? endforeach; ?></select></td>
                </tr>
                <tr>
<td>                รหัสไปรษณีย์  </td>
             <td>   <input maxlength="5" name="post" type="text" value="<? echo $address2['postcode'] ?>"></td>
             </tr>
             <tr>
             <td>   โทรศัพท์</td>   
             <td> <input id="phone2" name="phone" type="text" value="<? echo $address2['phone'] ?>">
            </td>
            </tr>
            <tr>
            <td></td>
           <td colspan="2" ><input name="index" value="2" type="hidden"/>
            <input  class="btn-info"type="submit" value="edit"></td>
            <td></td>
            </tr>
             </table>
        </form>
      
        </div>

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
         $().ready(function() {
      $("#mphone").mask("999-999-9999");
     $("#phone1").mask("99-999-9999");
       $("#phone2").mask("99-999-9999");
         });
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