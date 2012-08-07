<? $this->load->view(lang('bakheader'));?>

<div class="container" >
    
    <div id="img" style="margin: 100 auto 5% auto; text-align: center;"  >
        <img src="<? echo ($tmpemp->getPicurl()==''||$tmpemp->getPicurl()==null)? base_url('asset/Sys_img/emp_img').'nopic.png' :base_url('asset/Sys_img/emp_img').$tmpemp->getPicurl() ?>" width="182" height="205"/>
    </div>
    <div id="info" class="divcenter"  >
        <form action="<? echo site_url('Backend/bakemp/updateemp');?>" method="post">
            <table class="elementcenter">
      
      <tr>
                <td >Employee No</td>
                <td ></td>
              <td ><? echo $tmpemp->getEmpno();?></td>
                
        </tr>
            
            <tr>
                <td>Employee Name</td>
                <td></td>
              <td><? echo $tmpemp->getName();?></td>
                
          </tr>
            
            <tr>
                <td>E-mail</td>
                <td></td>
                <td><? echo $tmpemp->getEmail();?></td>
          </tr>
             
                <tr>
                <td >Phone</td>
                <td></td>
                <td><? echo $tmpemp->getPhone();?></td>
          </tr>
             
                <tr>
                <td >Position</td>
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
                <td> <input type="submit" class="btn" value="edit" >   <a class="btn"  href="<? echo site_url('Backend/bakemp')  ?>" > Back </a></td>
          </tr>
           
  </table>
            <input type="hidden" name="empno" value="<? echo $tmpemp->getEmpno();?>" />
        </form>
     </div>
</div>
    
<? $this->load->view(lang('bakfooter'));?>
