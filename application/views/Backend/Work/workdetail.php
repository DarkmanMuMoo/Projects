<? $this->load->view(lang('bakheader')); ?>
<style type="text/css">
th {
	background-color: #FF9;
}
</style>


<div class="container">
    <div style="margin-top: 100px; margin-left: auto; margin-right: auto; margin-bottom: 20px;"> 
        <h2>รายละเอียดงาน</h2>
      <hr align="center" size="3" color="#C3C3C3">  </div>
    <div  style="margin: 0 auto;">  
     <form action="" method="post">
       <table width="666" border="0">
       <tr>
         <td width="660" height="44"><table width="695" border="0">
           <tr>
             <td width="122" height="30"><strong>รหัสงาน</strong></td>
             <td width="10">&nbsp;</td>
             <td width="161"><?echo $work->getWorkno();?></td>
             <td width="5">&nbsp;</td>
             <td width="171" height="44"><strong>ชื่องาน</strong></td>
             <td width="11">&nbsp;</td>
             <td width="194"><?echo $work->getWorkname();?></td>
           </tr>
           <tr>
             <td height="44"><strong>OrdNo</strong></td>
             <td>&nbsp;</td>
             <td><a href="<?echo site_url('Backend/bakorders/vieworderdetail/'.$work->getOrdno()); ?>" ><? echo $work->getOrdno() ?></a></td>
             <td width="5">&nbsp;</td>
             <td height="44"><strong>ผู้รับผิดชอบ</strong></td>
             <td>&nbsp;</td>
             <td><?echo $work->getName();?>&nbsp;<?echo $work->getLastname();?></td>
           </tr>
          
           <tr>
             <td height="44"><strong>วันเริ่มทำงาน</strong></td>
             <td>&nbsp;</td>
             <td><?echo $work->getStartdate();?></td>
             <td width="5">&nbsp;</td>
             <td height="44"><strong>วันสิ้นสุดการทำงาน</strong></td>
             <td>&nbsp;</td>
             <td><?php if ($_SESSION['emp']->getPosition() == 'Boss' ): ?>
             <?php if ($work->getEnddate() == null): ?>
                 <a class="btn" href="<? echo site_url('Backend/bakwork/completework/'.$work->getOrdno())?>" >End this work</a> 
                  <?php else: ?>
                 ยังไม่เสร็จ
                 <?php endif; ?>
             <?php else: ?>
                 
                 <? echo $work->getEnddate() ; ?>
                 <?php endif; ?>
             
             </td>
           </tr>
            <tr>
             <td height="79"><strong>รายละเอียด</strong></td>
             <td>&nbsp;</td>
             <td width="161" height="79">
                 <textarea>

<?echo $work->getWorkDescription()?>

                 </textarea>
               </td>
           </tr>

         </table>           <strong></strong></td>
       </tr>
       </table>
     </form>
     <table >
         <thead>
    <th width="72" scope="col" >สถานะงาน</th>
    <th width="127" scope="col">วันทีแก้ไข</th>
    <th width="101" scope="col">ผู้แก้ไข</th>
     </thead>
     <tbody>
  <?php foreach ($processlist as $process): ?>
  <tr>
    <td><? echo $process->getProdescription();  ?></td>
    <td><? echo $process->getDate();  ?></td>
    <td><? echo $process->getName();  ?>&nbsp;<? echo $process->getLastname();  ?></td>
  </tr>
  <?php endforeach; ?>
  </tbody>
</table>

       
        
  </div>
    
    <div>
        <form action="<?echo site_url('work/addprocess'); ?>" method="post">
    
    <table width="322" border="0">
  <tr>
    <td width="129" height="22">&nbsp;</td>
    <td width="107">&nbsp;</td>
    <td width="72"><i class="icon-edit">&nbsp;&nbsp;&nbsp;&nbsp;แก้ไข</i></td>
  </tr>
  <tr>
    <td>สถานะงาน</td>
    <td><textarea name="description" cols="" rows=""></textarea></td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td><input type="submit" name="button" id="button" value="ตกลง" class="btn" /></td>
    <td>&nbsp;</td>
  </tr>
  <input type="hidden" name="workno" value="<?echo $work->getWorkno();?>"  />
</table>

    

    </form>
    </div>

</div>

<? $this->load->view(lang('bakfooter')); ?>
