<? $this->load->view(lang('bakheader')); ?>

<style>
    #table{
        border-color:#CCC;
        border:thin;
    }
    #listmenu li{

        float: left;
    }
    #listmenu{


        margin: 0 auto;
    }
    #tabs{
         margin: 10% auto;
        width:50%;
    }
       #tabs table{
        
       margin: 0 auto;
    }
</style>

<div class="container" >


    <div id='mainmenu' >
        <ul>
            <li> <a class="btn" href="<? echo site_url('Backend/bakCost/template') ?>"><span>Template</span> </a>
            </li>

        </ul>
    </div>
        <div id="tabs" >
            <ul id="listmenu">
                <li><a href="#paper">กระดาษ</a></li>

                <li><a href="#send">การจัดส่ง</a></li>

                <li><a href="#option">ตัวเลือกพิเศษ</a></li>
                  <li><a href="#cal">การคำนวณราคา</a></li>
            </ul> 

           
                <div id="paper" >
                    <form action="<? echo site_url('Backend/bakCost/updatepaper'); ?>" method="post">
                        <table width="369" border="1" bordercolor="#CCCCCC">
                            <tr>
                                <td width="145">ชนิดกระดาษ</td>
                                <td width="57">แกรม</td>
                                <td width="145">ราคา</td>
                            </tr>
                            <?php foreach ($paperlist as $index => $paper): ?>
                                <tr>

                                    <td> <? echo $paper->getName(); ?></td>
                                    <td> <? echo $paper->getGrame(); ?></td>
                                    <td><input type="text" name="<? echo $index ?>" value="<? echo $paper->getPriceperkilo(); ?>"/></td>
                                </tr>
                            <?php endforeach; ?>

                        </table>
                        <br /><input type="submit" value="Edit"/>
                    </form>
                </div>


                <div id="send" >
                    <form action="<? echo site_url('Backend/bakCost/updateordsend'); ?>" method="post">
                        <table  table width="269" border="1" bordercolor="#CCCCCC" >
                            <tr>
                                <td width="109">วิธีการส่ง</td>
                                <td width="144">ราคา</td>
                            </tr>
                            <?php foreach ($ordsendlist as $index => $ordsend): ?>
                                <tr>

                                    <td>  <? echo $ordsend->getSendmethod() ?></td>
                                    <td><input type="text" name="<? echo $index ?>" value="<? echo $ordsend->getSendprice() ?>"/></td>
                                </tr>
                            <?php endforeach; ?>
                        </table>
                        <br /><input type="submit" value="Edit"/>
                    </form>
                </div >
                <div  id="option"   >
                    <form action="<? echo site_url('Backend/bakCost/updateoption'); ?>" method="post">
                        <table  table width="332" border="1" bordercolor="#CCCCCC" >
                            <tr>
                                <td width="132">ตัวเลือกพิเศษ</td>
                                <td width="184">ราคา</td>
                            </tr>
                            <?php foreach ($optionlist as $index=>$option): ?>
                                <tr>

                                    <td>  <? echo $option->getDescription(); ?></td>
                                    <td><input type="text" name="<? echo $index ?>" value=" <? echo $option->getPrice(); ?>"/></td>
                                </tr>
                            <?php endforeach; ?>
                        </table>
                        <br /><input type="submit" value="Edit"/>
                    </form>
                </div>
                <div id="cal">
                    <form action="<? echo site_url('Backend/bakCost/updatecal'); ?>" method="post">
                     <table  table width="332" border="1" bordercolor="#CCCCCC" >
                            <tr>
                                <td width="132">ตัวแปร</td>
                                <td width="184">ราคา</td>
                            </tr>
                            <tr>
                                <td width="132">ต้นทุนการพิมพ์</td>
                                <td width="184"><input type="text"  name="print" value="<? echo $print?>"/></td>
                            </tr>
                             <tr>
                                <td width="132">ต้นทุนเพลทใหญ่</td>
                                <td width="184"><input type="text"  name="plateL" value="<? echo $plateL?>"/></td>
                            </tr>
                             <tr>
                                <td width="132">ต้นทุนเพลทเล็ก</td>
                                <td width="184"><input type="text"  name="plateS" value="<? echo $plateS ?>"/>
                                    </td>
                            </tr>
                            <tr>
                                <td width="132">เบ็ดเตล็ด</td>
                                <td width="184"><input type="text"  name="misc" value="<? echo $misc ?>"/></td>
                            </tr>
                    
                    </table>
                        <br /><input type="submit" value="Edit"/>
                    </form>
                    
                </div>
           
        </div>
    </div>

<? $this->load->view(lang('bakfooter')); ?>
<script>
    $().ready(function() {
     
  $( "#tabs" ).tabs();
     
 <?php if ($this->session->flashdata('ck')): ?>


 $( "#tabs" ).tabs( "select" , '<? echo $this->session->flashdata('ck')?>' )

<?php endif; ?>
     
     
    });


</script>




