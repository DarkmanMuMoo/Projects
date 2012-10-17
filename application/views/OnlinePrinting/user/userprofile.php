<? $this->load->view(lang('header')) ?>
<style type="text/css">
    table {
        margin:0 auto;
        width: 70%;;
    }

    #edit{
        margin-top: 0;
        margin-right: auto;
        margin-bottom: 10px;
        margin-left: auto;
        width: 80%;
        padding: 10px;
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
    #addresslist{


        margin: 3% auto;
        padding: 8px;
    }
    .address{
        width: 75%;
        clear: both;
        display: table;
        margin: 10px auto;
    }
    .leftadd{
        float: left;
        width: 35%;
        margin-left: 10%;
    }
    .leftadd input{
        margin-bottom: 0px;
    }
    .rightadd label{
        display: inline;
    }
    .rightadd{
        float: left;
        margin-top: 18px;
        width: 50%;

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

</div>
<h4 ><strong>รายการที่อยู่</strong></h4>
<div id="addresslist">
    <?php if (!empty($addresslist)): ?>

        <?php foreach ($addresslist as $address): ?>
            <div  id="<? echo $address->getAddressno(); ?>" class="address" >
                <div class="leftadd">
                    <p>
                        <label>ชื่อที่อยู่</label><input type="text" name="addressname" id="addressname" value="<? echo $address->getAddressname(); ?>" />
                    </p>
                    <p>
                        <label>ที่อยู่</label>  <textarea  style="height: 46px;" id="address" name="address" placeholder ="111/235 ซ.ตัวอย่าง ถ.ตัวอย่าง แขวงตัวอย่าง เขตตัวอย่าง"><? echo $address->getAddress(); ?> </textarea>
                    </p>
                </div>
                <div class="rightadd">
                    <p>
                        <label>จังหวัด</label> 
                        <select name="province" id="province">
                            <?php foreach ($provincelist as $province): ?>
                                <option <? echo($province->getProvincename() == $address->getProvince()) ? 'selected="selected"' : ''; ?> value="<? echo $province->getProvinceid(); ?>"><? echo $province->getProvincename(); ?></option>
                            <? endforeach; ?>
                        </select>
                    </p>
                    <p>
                        <label>รหัสไปรษณีย์</label> 
                        <input type="text" name="postcode" id="postcode"  value="<? echo $address->getPostcode(); ?>"/>
                    </p>
                    <p>
                        <label>เบอร์โทรศัพท์</label> 
                        <input type="text" name="phone" id="phone" class="mark" value="<? echo $address->getPhone(); ?>"/>
                    </p>
                </div>

            </div>
            <div class="divcenter"> <button class="btn  btn-large btn-success" onclick="editaddress('<? echo $address->getAddressno(); ?>');"/>Save</button>
                <a class="btn  btn-large btn-danger" href="<? echo site_url('userprofile/deleteaddress/' . $address->getAddressno()); ?>"  >ลบ</a></div>
        <?php endforeach; ?>
        <form  id="editaddressform" action="<? echo site_url('userprofile/updateaddress'); ?>"  method="post">
            <input type="hidden" name="addressno"  value=""/>
            <input type="hidden" name="addressname"  value=""/>
            <input type="hidden" name="address"  value="" />
            <input type="hidden" name="province"   value=""/>
            <input type="hidden" name="postcode"   value=""/>
            <input type="hidden" name="phone"  value="" />
        </form>
    <?php else: ?>

        <h6>ยังไม่มีที่อยู่กรุณาสร้างใหม่</h6> 

    <?php endif; ?>
</div>
<button class="btn" onclick="swapaddaddress();"> เพิ่มที่อยู่</button>
<form id="addadress"  method="post" style="  display: none;margin: 0 auto;" action="<? echo site_url('userprofile/addaddress'); ?>">
    <div  class="address" >
        <div class="leftadd">
            <p>
                <label>ชื่อที่อยู่</label><input type="text" name="addressname" id="addressname" />
            </p>
            <p>
                <label>ที่อยู่</label>  <textarea  style="height: 46px;" id="address" name="address" placeholder ="111/235 ซ.ตัวอย่าง ถ.ตัวอย่าง แขวงตัวอย่าง เขตตัวอย่าง">
                   
                </textarea>
            </p>
        </div>
        <div class="rightadd">
            <p>
                <label>จังหวัด</label> 
                <select name="province" id="province">
                    <?php foreach ($provincelist as $province): ?>
                        <option  value="<? echo $province->getProvinceid(); ?>"><? echo $province->getProvincename(); ?></option>
                    <? endforeach; ?>
                </select>
            </p>
            <p>
                <label>รหัสไปรษณีย์</label> 
                <input type="text" name="postcode" id="postcode" maxlength="5" />
            </p>
            <p>
                <label>เบอร์โทรศัพท์</label> 
                <input type="text" name="phone" id="phone" class="mark"  value=""/>
            </p>
        </div>

    </div>
    <div class="divcenter"> <input class="btn  btn-large btn-success"  type="submit" value="เพิ่ม"/></div>

</form>


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
    function editaddress(addressno){
        var target=$('#'+addressno);
        $('#editaddressform input[name=addressno]').val(addressno);
        $('#editaddressform input[name=addressname]').val(target.find('input[name=addressname]').val());
        $('#editaddressform input[name=address]').val(target.find('textarea').val());
        $('#editaddressform input[name=postcode]').val(target.find('input[name=postcode]').val());
        $('#editaddressform input[name=phone]').val(target.find('input[name=phone]').val());
        $('#editaddressform input[name=province]').val(target.find('select').val());
        $('#editaddressform').submit();
    }
    
    function swapaddaddress(){
        
        $('#addadress').fadeToggle();
        
        
    }
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
                                    
                            $.post("<? echo site_url('userprofile/ajaxchangepassword'); ?>", $("#changepasswordform").serialize(),
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
    
    $().ready(function() {
        $(".mark").mask("99-999-9999");
        $("#addadress").validate({
            rules: {
                postcode:{
                    required: true,
                    digits: true
                },
                address:"required",
                // address2:"required",
                addressname:"required",
                phone:"required"
            }
            ,messages:{
                postcode:{
                    required: "required",
                    digits:"Please enter digit only"
                },
                address:"required",
                //address2:"required",
                addressname:"required",
                phone:"required"
            }

        });
        
    });
</script>