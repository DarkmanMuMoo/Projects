<? $this->load->view(lang('bakheader')); ?>
<style type="text/css">
    table {
        margin:0 auto;

    }
    .divcenter img{
        margin: 20px;
        width: auto;
        height: auto;
        clear: both;
        max-width: 40%;

    }
    .divcenter button{
        margin-bottom: 10px;
    }
    #updateprofileform input{


        height: 28px;
    }
    #uploadpic{

        display: none;
        width: 40%;
        margin-top: 20px;
        margin-right: auto;
        margin-bottom:  20px;
        margin-left: auto;

    }
    td{
        padding: 5px;

    }

</style>




<div class="container"  >
    <div class="header"> 
        <h2>ประวัติส่วนตัว</h2>
        <hr align="center" size="3" color="#C3C3C3">  </div>

    <div align="center" >  



        <div class="divcenter" > 
            <img src="<? echo base_url('asset/Sys_img/emp_img/' . $picurl) ?>" width="200" height="200" />
            <br><button  class="btn"   onclick="showuploadpic();"><i class="icon-camera"></i>เปลี่ยนรูปประจำตัว</button>
            <form  class="well" action="<? echo site_url('Backend/bakemp/uploadpic'); ?>" method="post" enctype="multipart/form-data" id="uploadpic" >
                <input type="file" name="pic" />
                <input type="submit" value="upload">
            </form>
        </div>


        <form  action="<? echo site_url('Backend/bakemp/updateprofile'); ?>"  id="updateprofileform"method="post" >

            <table border="0" >

                <tr>
                    <td width="95">ชื่อพนักงาน</td>
                    <td width="165"><input class="input-medium" name="name" type="text" value="<? echo $tmpemp->getName(); ?>" /></td>
                    <td width="194"><input class="input-medium"  name="lastname" type="text" value="<? echo $tmpemp->getLastname(); ?>" /></td>

                </tr>
                <tr>
                    <td width="95">ตำแหน่ง</td>
                    <td width="165">   <?php foreach ($poslist as $pos): ?>
                            <?php if ($tmpemp->getPosition() == $pos->getPosition()): ?>
                                <?
                                echo $pos->getPosdescription();
                                break;
                                ?>
                            <?php endif; ?>


                        <?php endforeach; ?></td>
                    <td width="194">&nbsp;</td>
                </tr>

                <tr>
                    <td width="95">อีเมลล์</td>
                    <td width="165"><input name="email" class="input-medium"  type="text" value="<? echo $tmpemp->getEmail(); ?>" /></td>
                    <td width="194">&nbsp;</td>

                <tr>
                    <td width="95">โทรศัพท์</td>
                    <td width="165"><input name="telephone" class="input-medium"  type="text" value="<? echo $tmpemp->getPhone(); ?>" /></td>
                    <td width="194">&nbsp;</td>
                </tr>

                <tr>
                    <td width="95">รหัสผ่าน</td>
                    <td width="165"><input class="input-medium"  name="password" type="password"  readonly="true" value="nunan" /></td>
                    <td width="194"> <a  href="javascript:void(0);" class="btn" onclick="changepassword();">เปลี่ยนรหัสผ่าน</a></td>
                </tr>
                <tr>
                    <td width="95"></td>
                    <td width="165"><input class="btn-info" type="submit"  value="Edit"/></td>
                    <td width="194"> </td>
                </tr>
            </table>
        </form>

    </div>

    <? $this->load->view(lang('bakfooter')); ?>
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
                                    
                                $.post("<? echo site_url('Backend/bakemp/ajaxchangepassword'); ?>", $("#changepasswordform").serialize(),
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
        function showuploadpic(){
        
            $('#uploadpic').fadeToggle("slow", "linear");
        
        }
    
    
    </script>