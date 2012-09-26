<? $this->load->view(lang('bakheader'));?>
<style type="text/css">

	hr{ text-align:center;
color:#09F;
border-color:#09F;
size:3;
}
h1{ font-weight:bolder;
}

</style>



<div class="container" >


   <div style="margin-top: 100px; margin-left: auto; margin-right: auto; margin-bottom: 20px;"> 
        <h1>ประวัติพนักงาน</h1>
      <hr align="center" size="3" color="#C3C3C3">  </div>


    
    <div id="img" style="margin: 0 auto 5% auto; text-align: center;"  >
        <img src="<? echo ($tmpemp->getPicurl()==''||$tmpemp->getPicurl()==null)? base_url('asset/Sys_img/emp_img').'/nopic.jpg' :base_url('asset/Sys_img/emp_img').$tmpemp->getPicurl() ?>"  width="200" height="200"/>
    </div>
    <div id="info" class="divcenter"  >
        <form action="<? echo site_url('Backend/bakemp/updateemp');?>" method="post">
            <table class="elementcenter">
      
      <tr>
                <td width="84" >รหัสพนักงาน</td>
                <td width="64" ></td>
              <td width="144" ><? echo $tmpemp->getEmpno();?></td>
                
        </tr>
            
            <tr>
                <td>ชื่อ</td>
                <td></td>
              <td><? echo $tmpemp->getName();?> 
			 &nbsp;&nbsp; <? echo $tmpemp->getLastname();?></td>
                
          </tr>
            
            <tr>
                <td>อีเมลล์</td>
                <td></td>
                <td><? echo $tmpemp->getEmail();?></td>
          </tr>
             
                <tr>
                <td >โทรศัพท์</td>
                <td></td>
                <td><? echo $tmpemp->getPhone();?></td>
          </tr>
             
                <tr>
                <td >ตำแหน่ง</td>
                <td></td>
                <td><select name="position">
                        <?php foreach ($poslist as $pos): ?>

     <option value="<? echo $pos->getPosition(); ?>"  <?  echo ($tmpemp->getPosition() == $pos->getPosition())?' selected=\"selected\" ': '';?>  ><? echo $pos->getPosdescription(); ?></option>

<?php endforeach; ?>
             
             
                </select></td>
             </tr>

           <tr>
                <td></td>
                <td>&nbsp;</td>
                <td> <input type="submit" class="btn" value="ตกลง" >   <a class="btn"  href="<? echo site_url('Backend/bakemp')  ?>" > กลับ </a></td>
          </tr>
           
  </table>
            <input type="hidden" name="empno" value="<? echo $tmpemp->getEmpno();?>" />
        </form>
     </div>
</div>
    
<? $this->load->view(lang('bakfooter'));?>
