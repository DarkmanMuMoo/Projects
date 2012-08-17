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
       <table width="469" border="0">
       <tr>
         <td height="44"><table width="604" border="0">
           <tr>
             <td width="139" height="30"><strong>รหัสงาน</strong></td>
             <td width="24">&nbsp;</td>
             <td width="122"><?echo $work->getWorkno();?></td>
             <td width="140" height="44"><strong>ชื่องาน</strong></td>
             <td width="18">&nbsp;</td>
             <td width="90"><?echo $work->getWorkname();?></td>
           </tr>
           <tr>
             <td height="44"><strong>OrdNo</strong></td>
             <td>&nbsp;</td>
             <td><a href="<?echo site_url('Backend/bakorders/vieworderdetail/'.$work->getOrdno()); ?>" ><? echo $work->getOrdno() ?></a></td>
             <td height="44"><strong>ผู้รับผิดชอบ</strong></td>
             <td>&nbsp;</td>
             <td><?echo $work->getName();?>&nbsp;<?echo $work->getLastname();?></td>
           </tr>
          
           <tr>
             <td height="44"><strong>วันเริ่มทำงาน</strong></td>
             <td>&nbsp;</td>
             <td><?echo $work->getStartdate();?></td>
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
             <td height="44"><strong>รายละเอียดงาน</strong></td>
             <td>&nbsp;</td>
             <td width="50" height="100">
                 <textarea>

<?echo $work->getWorkDescription()?>

                 </textarea>
               </td>
           </tr>

         </table>           <strong></strong></td>
       </tr>
       </table>
     </form>
     
     <form action="" method="post">
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

     
     </form>
        
        
  </div>
    

</div>

<? $this->load->view(lang('bakfooter')); ?>
