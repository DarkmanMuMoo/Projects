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
    #tabs input[type=text]{


        height:25px;
        margin-bottom: 0px;
    }
    #tabs table{

        margin: 0 auto;
    }
    #paper,#option,#send,#cal{


        text-align: center;
    }
    
   .right input{ text-align: right}
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
            <form  class="right"action="<? echo site_url('Backend/bakCost/updatepaper'); ?>" method="post">
                <table width="369" border="1" bordercolor="#CCCCCC">
                    <tr>
                        <td width="145">ชนิดกระดาษ</td>
                        <td width="57">แกรม</td>
                        <td width="145">ราคา(บาทต่อกิโล)</td>
                    </tr>
                    <?php foreach ($paperlist as $index => $paper): ?>
                        <tr>

                            <td> <? echo $paper->getName(); ?></td>
                            <td> <? echo $paper->getGrame(); ?></td>
                            <td><input  type="text" name="<? echo $index ?>" value="<? echo $paper->getPriceperkilo(); ?>"/></td>
                        </tr>
                    <?php endforeach; ?>

                </table>
                <br /><input  class="btn btn-primary" type="submit" value="Save"/>
            </form>
            <form  action="<? echo site_url('Backend/bakCost/addpaper'); ?>" method="post">
                <table  table width="332" border="1" bordercolor="#CCCCCC" >
                    <tr>
                        <td width="132">ชื่อกระดาษ</td>
                        <td width="184"><input type="text" name="name"/></td>
                    </tr>
                    <tr>
                        <td width="132">แกรม</td>
                        <td width="184"><input type="text" name="gram"/></td>
                    </tr>
                    <tr>
                        <td width="132">ราคา(บาทต่อกิโล)</td>
                        <td width="184"><input type="text" name="price"/></td>
                    </tr>
                </table>
                <br /><input  class="btn btn-inverse" type="submit" value="Add"/>
            </form>
        </div>


        <div id="send" >
            <form class="right" action="<? echo site_url('Backend/bakCost/updateordsend'); ?>" method="post">
                <table  table width="auto" border="1" bordercolor="#CCCCCC" >
                    <tr>
                        <td width="109">วิธีการส่ง</td>
                        <td width="50">ราคา(บาท)</td>
                    </tr>
                    <?php foreach ($ordsendlist as $index => $ordsend): ?>
                        <tr>

                            <td>  <? echo $ordsend->getDescription() ?></td>
                            <td><input type="text" name="<? echo $index ?>" value="<? echo $ordsend->getSendprice() ?>"/></td>
                        </tr>
                    <?php endforeach; ?>
                </table>
                <br /><input  class="btn btn-primary" type="submit" value="Save"/>
            </form>
        </div >
        <div   id="option"   >
            <form  class="right" action="<? echo site_url('Backend/bakCost/updateoption'); ?>" method="post">
                <table  table width="332" border="1" bordercolor="#CCCCCC" >
                    <tr>
                        <td width="132">ตัวเลือกพิเศษ</td>
                        <td width="184">ราคา(บาท)</td>
                    </tr>
                    <?php foreach ($optionlist as $index => $option): ?>
                        <tr>

                            <td>  <? echo $option->getDescription(); ?></td>
                            <td><input type="text" name="<? echo $index ?>" value=" <? echo $option->getPrice(); ?>"/></td>
                        </tr>
                    <?php endforeach; ?>
                </table>
                <br /><input  class="btn btn-primary" type="submit" value="Save"/>
            </form>
            <form action="<? echo site_url('Backend/bakCost/addoption'); ?>" method="post">
                <table  table width="332" border="1" bordercolor="#CCCCCC" >
                    <tr>
                        <td width="132">ชื่อตัวเลือก</td>
                        <td width="184"><input type="text" name="description"/></td>
                    </tr>
                    <tr>
                        <td width="132">ราคา(บาท)</td>
                        <td width="184"><input type="text" name="price"/></td>
                    </tr>
                </table>
                <br /><input  class="btn btn-inverse" type="submit" value="Add"/>
            </form>
        </div>
        <div id="cal">
            <form  class="right"action="<? echo site_url('Backend/bakCost/updatecal'); ?>" method="post">
                <table  table width="332" border="1" bordercolor="#CCCCCC" >
                    <tr>
                        <td width="132">ตัวแปร</td>
                        <td width="184">ราคา(บาท)</td>
                    </tr>
                    <tr>
                        <td width="132">ต้นทุนการพิมพ์</td>
                        <td width="184"><input type="text"  name="print" value="<? echo $print ?>"/></td>
                    </tr>
                    <tr>
                        <td width="132">ต้นทุนเพลทใหญ่</td>
                        <td width="184"><input type="text"  name="plateL" value="<? echo $plateL ?>"/></td>
                    </tr>
                    <tr>
                        <td width="132">ต้นทุนเพลทเล็ก</td>
                        <td width="184"><input type="text"  name="plateS" value="<? echo $plateS ?>"/>
                        </td>
                    </tr>
                    <tr>
                        <td width="132">เบ็ดเตล็ด</td>
                        <td width="184"><input type="text"  name="misc" value="<? echo $misc; ?>"/></td>
                    </tr>
                    <tr>
                        <td width="132">ภาษี</td>
                        <td width="184">

                            <div class="input-append" style="
                                 margin-bottom: 0px;
                                 ">
                                <input  type="text" name="tax" value="<? echo $tax; ?>" style="
                                      width: 180px; height: 28px;
                                       ">
                                <span class="add-on" style="
                                      margin-left: -8;
                                      border-left-width: 0px;
                                      ">%</span>
                            </div>
                        </td>
                    </tr>

                </table>
                <br /><input  class="btn btn-primary" type="submit" value="Save"/>
            </form>

        </div>

    </div>
</div>

<? $this->load->view(lang('bakfooter')); ?>
<script>
    $().ready(function() {
     
     
     
     
     
        $( "#tabs" ).tabs();
     
<?php if ($this->session->flashdata('ck')): ?>


            $( "#tabs" ).tabs( "select" , '<? echo $this->session->flashdata('ck') ?>' )

<?php endif; ?>
     
     
     
     
     
    });


</script>




