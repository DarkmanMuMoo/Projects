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

    <div align="center" style="margin-top:100px">  

        <div class="divcenter" > 
            <img src="<? echo base_url('asset/Sys_img/emp_img/' . $picurl) ?>"  />
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
                                <? echo $pos->getPosdescription();
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
                    <td width="194"> <button onclick="changepassword();">เปลี่ยนรหัสผ่าน</button></td>
                </tr>
                <tr>
                    <td width="95"></td>
                    <td width="165"><input class="btn-info" type="submit"  value="แก้ไข"/></td>
                    <td width="194"> </td>
                </tr>
            </table>
        </form>

    </div>

    <? $this->load->view(lang('bakfooter')); ?>
    <script>
    
    function showuploadpic(){
        
        $('#uploadpic').fadeToggle("slow", "linear");
        
    }
    
    
    </script>