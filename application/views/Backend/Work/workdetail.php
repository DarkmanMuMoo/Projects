<? $this->load->view(lang('bakheader')); ?>
<style type="text/css">
    th {
        background-color: #FF9;
    }
    #processtable td{
        text-align: center;
        vertical-align: middle;
    }

    hr{ text-align:center;
        color:#09F;
        border-color:#09F;
        size:3;
    }
    h1{ font-weight:bolder;
    }
    i{
        margin-top: 2px;
    }
</style>


<div class="container">
    <div class="header"> 
        <h1>รายละเอียดงาน</h1>
        <hr align="center" size="3" color="#C3C3C3">  </div>
    <div  style="margin: 0 auto;">  

        <table width="666" border="0" align="center">
            <tr>
                <td width="660" height="44"><table width="695" border="0">
                        <tr>
                            <td width="118" height="30"><strong>รหัสงาน </strong></td>
                            <td width="26">:</td>
                            <td width="161"><? echo $work->getWorkno(); ?></td>
                            <td width="12">&nbsp;</td>
                            <td width="180" height="44"><strong>ผู้รับผิดชอบ</strong></td>
                            <td width="24">:</td>
                            <td width="300"><? echo $work->getName(); ?>&nbsp;<? echo $work->getLastname(); ?> 
                                 <?php foreach ($positionlist as $pos): ?> 
                                 <?php if ( $work->getPosition()==$pos->getPosition()): ?>
                            &nbsp;(<? echo $pos->getPosdescription();  ?>)&nbsp;<?break;?>
                             <?php endif; ?>
                               <?php endforeach; ?>
                            <? echo ($work->getActive()) ? '<span class="badge badge-success">active</span>' : '<span class="badge badge-important">unactive</span>'; ?></td>
                        </tr>
                        <tr>
                            <td height="44"><strong>ชื่องาน </strong></td>
                            <td>:</td>
                            <td><? echo $work->getWorkname(); ?></td>
                            <td width="12">&nbsp;</td>
                            <td height="44"><strong>พนักงานที่มีส่วนร่วม</strong></td>
                            <td>:</td>
                            <td><select  id="empno">  <?php foreach ($allemp as $emp): ?> 
                                            <?php if ($emp->getEmpno() != $_SESSION['emp']->getEmpno() && !in_array($emp->getEmpno(), $chkemp, true)): ?>
                                        <option value="<? echo $emp->getEmpno(); ?>" > <a><? echo $emp->getName(); ?>&nbsp;<? echo $emp->getLastname(); ?></a></option>
                                            <?php endif; ?>
                                        <?php endforeach; ?>
                                    </select></td>
                        </tr>

                        <tr>
                            <td height="44"><strong>รหัสสั่งซื้อ</strong></td>
                            <td>:</td>
                            <td><a href="<? echo site_url('Backend/bakorders/vieworderdetail/' . $work->getOrdno()); ?>" ><? echo $work->getOrdno() ?></a></td>
                            <td width="12">&nbsp;</td>
                            <td height="44"></td>
                            <td>&nbsp;</td>
                            <td>
                                    <button class="btn" onclick="addcoemp();" >Add</button></td>
                        </tr>
                        <tr>
                            <td height="79"><strong>วันเริ่มงาน</strong></td>
                            <td>:</td>
                            <td width="161" >
                                <? echo $work->getStartdate(); ?>
                            </td>
                            <td>&nbsp;</td>
                            <td height="44"></td>
                            <td>&nbsp;</td>
                            <td ><? $chkemp = array(); ?>
                              <?php foreach ($coemplist as $emp): ?>
                              <p>                                      <? echo $emp->getName(); ?>&nbsp;<? echo $emp->getLastname(); ?>
                                  
                                   <? echo ($emp->getActive()) ? '<span class="badge badge-success">active</span>' : '<span class="badge badge-important">unactive</span>'; ?>
                              <a href="<?echo site_url('Backend/bakwork/removeCoemp/'.$emp->getEmpno().'/'.$work->getWorkno()); ?>"> 
                               
                                  
                                  <i class="icon-remove"></i></a></p>
                              <p>
                                <? array_push($chkemp, $emp->getEmpno()); ?>
                                <?php endforeach; ?>
                            </p></td>
                        </tr>
                        
                        <tr>
                        <td><strong>วันสิ้นสุดงาน</strong></td>
                        <td>:

                            </td>
                        <td><?php if ($_SESSION['emp']->getPosition() == 'Boss'): ?>
                                    <?php if ($work->getEnddate() == null): ?>
                                        <a class="btn" href="<? echo site_url('Backend/bakwork/completework/' . $work->getWorkno()) ?>" >End this work</a> 
                                    <?php else: ?>
                                       เสร็จ
                                    <?php endif; ?>
                                <?php else: ?>

                                    <? echo ($work->getEnddate() == null) ? 'ยังไม่เสร็จ' : $work->getEnddate(); ?>
                                <?php endif; ?></td>
                        <td></td>
                        <td><strong>รายละเอียดงาน</strong></td>
                        <td>:</td>
                        <td><textarea>

                                    <? echo $work->getWorkDescription() ?>

                                </textarea></td>
                        </tr>
                        
                        
                        
                        <?php if ($_SESSION['emp']->getPosition() == 'Boss' || $_SESSION['emp']->getEmpno() == $work->getEmpno()): ?>
                            <tr><td height="58" colspan="6">  </td> <td>
                                    
                                </td>  </tr>
                        <?php endif; ?>
                    </table>         
          </tr>
         
        </table>


    </div>

    <div id="processtable" style="margin-top: 20px;width: 80%; ">
      <table  class="table" style="margin-bottom: 30px;" >
            <thead>
            <th  style="width: 40% ;text-align: center;" style=""scope="col" >สถานะงาน</th>
            <th  style="width: 10%">วันทีแก้ไข</th>
            <th  style="width: 20%; text-align: center;">ผู้แก้ไข</th>
            </thead>
            <tbody>
                <?php foreach ($processlist as $process): ?>
                    <tr>
                        <td><? echo $process->getProdescription(); ?></td>
                        <td><? echo $process->getDate(); ?></td>
                        <td><? echo $process->getName(); ?>&nbsp;<? echo $process->getLastname(); ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

        <form action="<? echo site_url('Backend/bakwork/addprocess'); ?>" method="post">

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
                    <td><input type="submit" name="button" id="button" value="OK" class="btn" /></td>
                    <td>&nbsp;</td>
                </tr>
                <input type="hidden" name="workno" value="<? echo $work->getWorkno(); ?>"  />
            </table>



        </form>

    </div>

</div>
<form id="addcoempform"action="<? echo site_url('Backend/bakwork/addcoemp') ?>" method="post"> <input type="hidden" name="empno" value=""/> 
    <input type="hidden" name="workno" value="<? echo $work->getWorkno(); ?>"> </form>
<? $this->load->view(lang('bakfooter')); ?>
<script>

    function addcoemp(){
        $('#addcoempform input[name=empno]').val($('#empno').val());
    
        $('#addcoempform').submit();
    }


</script>