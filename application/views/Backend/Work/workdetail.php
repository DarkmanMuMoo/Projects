<? $this->load->view(lang('bakheader')); ?>
<style type="text/css">
    th {
        background-color: #FF9;
    }
    #processtable td{
        text-align: center;
        vertical-align: middle;
    }
</style>


<div class="container">
    <div style="margin-top: 100px; margin-left: auto; margin-right: auto; margin-bottom: 20px;"> 
        <h2>รายละเอียดงาน</h2>
        <hr align="center" size="3" color="#C3C3C3">  </div>
    <div  style="margin: 0 auto;">  

        <table width="666" border="0">
            <tr>
                <td width="660" height="44"><table width="695" border="0">
                        <tr>
                            <td width="122" height="30"><strong>รหัสงาน</strong></td>
                            <td width="10">&nbsp;</td>
                            <td width="161"><? echo $work->getWorkno(); ?></td>
                            <td width="5">&nbsp;</td>
                            <td width="171" height="44"><strong>ชื่องาน</strong></td>
                            <td width="11">&nbsp;</td>
                            <td width="194"><? echo $work->getWorkname(); ?></td>
                        </tr>
                        <tr>
                            <td height="44"><strong>OrdNo</strong></td>
                            <td>&nbsp;</td>
                            <td><a href="<? echo site_url('Backend/bakorders/vieworderdetail/' . $work->getOrdno()); ?>" ><? echo $work->getOrdno() ?></a></td>
                            <td width="5">&nbsp;</td>
                            <td height="44"><strong>ผู้รับผิดชอบ</strong></td>
                            <td>&nbsp;</td>
                            <td><? echo $work->getName(); ?>&nbsp;<? echo $work->getLastname(); ?></td>
                        </tr>

                        <tr>
                            <td height="44"><strong>วันเริ่มทำงาน</strong></td>
                            <td>&nbsp;</td>
                            <td><? echo $work->getStartdate(); ?></td>
                            <td width="5">&nbsp;</td>
                            <td height="44"><strong>วันสิ้นสุดการทำงาน</strong></td>
                            <td>&nbsp;</td>
                            <td><?php if ($_SESSION['emp']->getPosition() == 'Boss'): ?>
                                    <?php if ($work->getEnddate() == null): ?>
                                        <a class="btn" href="<? echo site_url('Backend/bakwork/completework/' . $work->getOrdno()) ?>" >End this work</a> 
                                    <?php else: ?>
                                        ยังไม่เสร็จ
                                    <?php endif; ?>
                                <?php else: ?>
                                  
                                    <? echo ($work->getEnddate()==null)?'ยังไม่เสร็จ':$work->getEnddate(); ?>
                                <?php endif; ?>

                            </td>
                        </tr>
                        <tr>
                            <td height="79"><strong>รายละเอียด</strong></td>
                            <td>&nbsp;</td>
                            <td width="161" >
                                <textarea>

                                    <? echo $work->getWorkDescription() ?>

                                </textarea>
                            </td>
                            <td>&nbsp;</td>
                            <td height="44"><strong>พนักงานที่มีส่วนร่วม</strong></td>
                            <td>&nbsp;</td>
                            <td >  <ul>
                                <? $chkemp = array(); ?>
                                <?php foreach ($coemplist as $emp): ?>

                            <li> <? echo $emp->getName(); ?>&nbsp;<? echo $emp->getLastname(); ?>   </li>
                            <? array_push($chkemp, $emp->getEmpno()); ?>
                        <?php endforeach; ?>

                        </ul>


                </td>
            </tr>
            <?php if ($_SESSION['emp']->getPosition() == 'Boss' || $_SESSION['emp']->getEmpno() == $work->getEmpno()): ?>
                <tr><td colspan="6">  </td> <td>
                        <select  id="empno">  <?php foreach ($allemp as $emp): ?> 
                                <?php if ($emp->getEmpno() != $_SESSION['emp']->getEmpno() && !in_array($emp->getEmpno(), $chkemp, true)): ?>
                                    <option value="<? echo $emp->getEmpno(); ?>" > <? echo $emp->getName(); ?>&nbsp;<? echo $emp->getLastname(); ?></option>
                                <?php endif; ?>
                            <?php endforeach; ?>
                        </select>
                        <button class="btn" onclick="addcoemp();" >เพิ่มพนักงาน</button>
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
                    <td><input type="submit" name="button" id="button" value="ตกลง" class="btn" /></td>
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