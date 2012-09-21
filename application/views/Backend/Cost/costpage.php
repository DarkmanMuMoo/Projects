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
</style>

<div class="container" >


    <div id='mainmenu' >
        <ul>
            <li> <a class="btn" href="<? echo site_url('Backend/bakCost/template') ?>"><span>Template</span> </a>
            </li>

        </ul>
        <ul id="listmenu">
            <li><input type="radio"  name="adress" value="paper"  /><label for="upd">กระดาษ</label></li>

            <li><input type="radio"  name="adress" value="send"  /><label for="send">การจัดส่ง</label></li>

            <li><input type="radio"  name="adress" value="option"  /><label for="option">ตัวเลือกพิเศษ</label></li>
        </ul> 

        <div id="listform">
            <div id="paper" style="display: none;">
                <form action="" method="post">
                    <table width="369" border="1" bordercolor="#CCCCCC">
                        <tr>
                            <td width="145">ชนิดกระดาษ</td>
                            <td width="57">แกรม</td>
                            <td width="145">ราคา</td>
                        </tr>
                        <?php foreach ($paperlist as $paper): ?>
                            <tr>
                                <td>อาร์ต</td>
                                <td>160</td>
                                <td><input type="text"/></td>
                            </tr>
                        <?php endforeach; ?>

                    </table>
                    <br /><input type="button" value="แก้ไข"/>
                </form>
            </div>


            <div id="send" style="display: none;" >
                <form action="" method="post">
                    <table  table width="269" border="1" bordercolor="#CCCCCC" >
                        <tr>
                            <td width="109">วิธีการส่ง</td>
                            <td width="144">ราคา</td>
                        </tr>
                        <?php foreach ($ordsendlist as $ordsend): ?>
                            <tr>
                                <td>ไปรษณีย์</td>
                                <td><input type="text"/></td>
                            </tr>
                        <?php endforeach; ?>
                    </table>
                    <br /><input type="button" value="แก้ไข"/>
                </form>
            </div >
            <div  id="option" style="display: none;"  >
                <form action="" method="post">
                    <table  table width="332" border="1" bordercolor="#CCCCCC" >
                        <tr>
                            <td width="132">ตัวเลือกพิเศษ</td>
                            <td width="184">ราคา</td>
                        </tr>
                        <?php foreach ($optionlist as $option): ?>
                            <tr>
                                <td>ไปรษณีย์</td>
                                <td><input type="text"/></td>
                            </tr>
                        <?php endforeach; ?>
                    </table>
                    <br /><input type="button" value="แก้ไข"/>
                </form>
            </div>
        </div>
    </div>
</div>
<? $this->load->view(lang('bakfooter')); ?>
<script>
    $().ready(function() {
     
        $('input[type=radio]').click(function(){
            
            var command=$(this).attr('value');
            $('#listform div').hide();
           
            $('#'+command).fadeToggle();
            
            
            
        });
     
     
     
     
    });


</script>