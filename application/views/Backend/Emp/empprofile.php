<? $this->load->view(lang('bakheader'));?>
<style type="text/css">
table {
			margin:o auto;
}
</style>




<div class="container"  >
    
<div align="center" style="margin-top:100px">  

<form action="" method="post">
<table width="200" height="200" border="3" >
  <tr>
    <td><img /></td>
  </tr>
</table>
</form>



<form action="" method="post">
    <table border="0" >
  <tr>
    <td width="95">ชื่อพนักงาน</td>
    <td width="165"><input name="name" type="text" value="ธัชสินี" /></td>
    <td width="194"><input name="lastname" type="text" value="กิจอุดมรัตน์" /></td>
    
    
  </tr>
  <tr>
    <td width="95">ตำแหน่ง</td>
    <td width="165"><input name="position" type="text" value="ชงกาแฟ" readonly="true" /></td>
    <td width="194">&nbsp;</td>
  </tr>
  
    <tr>
    <td width="95">อีเมลล์</td>
    <td width="165"><input name="email" type="text" value="nunan@gmail.com" /></td>
    <td width="194">&nbsp;</td>
    
     <tr>
    <td width="95">โทรศัพท์</td>
    <td width="165"><input name="telephone" type="text" value="0978647389" /></td>
    <td width="194">&nbsp;</td>
  </tr>

 <tr>
    <td width="95">รหัสผ่าน</td>
    <td width="165"><input name="password" type="password"  readonly="true" value="nunan" /></td>
    <td width="194"> <button>เปลี่ยนรหัสผ่าน</button></td>
  </tr>
  
   <tr>
    <td width="95">&nbsp;</td>
    <td width="165"></td>
    <td width="194"> </td>
  </tr>
  
  <tr>
    <td width="95"></td>
    <td width="165"><button>แก้ไข</button></td>
    <td width="194"> </td>
  </tr>
</table>
</form>
    
</div>
    
<? $this->load->view(lang('bakfooter'));?>
