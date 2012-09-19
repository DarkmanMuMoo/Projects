<? $this->load->view(lang('bakheader'));?>

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
<li><input type="radio" id="paper" name="adress" value="upd"  /><label for="upd">กระดาษ</label></li>
 
 <li><input type="radio" id="send" name="adress" value="send"  /><label for="send">การจัดส่ง</label></li>
 
 <li><input type="radio" id="option" name="adress" value="option"  /><label for="option">ตัวเลือกพิเศษ</label></li>
 </ul> 


<div>
<form action="" method="post">
<table width="369" border="1" bordercolor="#CCCCCC">
  <tr>
    <td width="145">ชนิดกระดาษ</td>
    <td width="57">แกรม</td>
    <td width="145">ราคา</td>
  </tr>
  <tr>
    <td>อาร์ต</td>
    <td>160</td>
    <td><input type="text"/></td>
  </tr>
  </tr>

</table>
<br /><input type="button" value="แก้ไข"/>
</form>



<form action="" method="post">
<table  table width="269" border="1" bordercolor="#CCCCCC" >
  <tr>
    <td width="109">วิธีการส่ง</td>
    <td width="144">ราคา</td>
  </tr>
  <tr>
    <td>ไปรษณีย์</td>
    <td><input type="text"/></td>
  </tr>
  
</table>
<br /><input type="button" value="แก้ไข"/>
</form>


<form action="" method="post">
<table  table width="332" border="1" bordercolor="#CCCCCC" >
  <tr>
    <td width="132">ตัวเลือกพิเศษ</td>
    <td width="184">ราคา</td>
  </tr>
  <tr>
    <td>ไปรษณีย์</td>
    <td><input type="text"/></td>
  </tr>
  
</table>
<br /><input type="button" value="แก้ไข"/>
</form>
    </div>

</div>
</div>
<? $this->load->view(lang('bakfooter'));?>