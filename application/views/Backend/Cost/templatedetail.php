<? $this->load->view(lang('bakheader'));?>

<div class="container" >
 
    <form action="" method="get"><table width="457" border="1" bordercolor="#CCCCCC">
  <tr>
    <td width="124">เทมเพลต</td>
    <td width="80">ขนาด</td>
    <td width="239">url</td>
  </tr>
  <tr>
    <td></td>
    <td>&nbsp;</td>
    <td><input type="file" /></td>
  </tr>

</table>
<br /><input type="button" value="แก้ไข"/>
</form>

<form action="" method="get">
<table width="230" border="0" >
  <tr>
    <td width="174">X</td>
    <td width="46"><select name="">
    <option></option></select></td>
  </tr>
  <tr>
    <td>Y</td>
    <td><select name="">
    <option></option></select></td>
  </tr>
  <tr>
    <td>Z</td>
    <td><select name="">
    <option></option></select></td>
  </tr>
  <tr>
    <td>platesize</td>
    <td><select name="">
    <option>L</option>
    <option>S</option></select></td>
  </tr>

</table>
<br /><input type="button" value="แก้ไข"/>
</form>


</div>


<? $this->load->view(lang('bakfooter'));?>