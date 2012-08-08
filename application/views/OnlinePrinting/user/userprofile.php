<? $this->load->view(lang('header')) ?>
<style type="text/css">
    table {
        margin:0 auto;
width: 60%;
    }

    #edit{
        margin-top: 0;
  margin-right: auto;
  margin-bottom: 10px;
  margin-left: auto;
    }
    td{
        padding: 5px;

    }
    tr td:last-of-type {
        width: 30%; 
        text-align: center;

    }
    
      tr td:first-of-type {
        width: 30%; 
    }
    
    tr td:not(:first-of-type):not(:last-of-type) {
        
         width: 30%; 
    }
 hr{color: orangered;
background-color: orange;
height: 1px;}
</style>
<div id="page">
      <p style ="margin-bottom: 10px;">
    <h1><b>ประวัติ</b></h1>
    <h4>แก้ไขได้</h4>
    
    
</p>
<hr></hr>
<div id="edit">
<form   id="editform" action="<?echo site_url('userprofile') ?>" method="post">
<table  border="0" >
 <tr>
    <td>อีเมลล์</td>
    <td><? echo $updateuser->getEmail();?></td>
    <td>&nbsp;</td>
  </tr>
  <tr>
     <td >ชื่อ-นามสกุล</td>
    <td ><? echo $updateuser->getName();?>&nbsp;&nbsp;<? echo $updateuser->getLastname();?></td>
    <td ><a href="">แก้ไข</a></td>
  </tr>
  <tr>
    <td>โทรศัพท์มือถือ</td>
    <td><? echo $updateuser->getMobilephone();?></td>
    <td></td>
  </tr>
  <tr>
    <td>รหัสผ่าน</td>
    <td><input name="" type="password" value="12345678" readonly="readonly" /></td>
    <td><button onclick="changepassword();" >changepassword</button></td>
  </tr>
 
    <tr>
    <td><strong>ที่อยู่</strong></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td></td>
    <td> <? echo $address1['address']?></td>
    <td><a href="">แก้ไข</a></td>
  </tr>
  <tr>
    <td>จังหวัด</td>
    <td><? echo $address1['province']?></td>
    <td><a href="">แก้ไข</a></td>
  </tr>
  <tr>
    <td>รหัสไปรษณีย์</td>
    <td><? echo $address1['postcode']?></td>
    <td><a href="">แก้ไข</a></td>
  </tr>
  <tr>
    <td>โทรศัพท์</td>
    <td><? echo $address1['phone1']?></td>
    <td><a href="">แก้ไข</a></td>
  </tr>
   <tr>
    <td><strong>ที่อยู่สำรอง</strong></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td></td>
    <td> <? echo $address2['address']?></td>
    <td><a href="">แก้ไข</a></td>
  </tr>
  <tr>
    <td>จังหวัด</td>
    <td><? echo $address2['province'] ?></td>
    <td><a href="">แก้ไข</a></td>
  </tr>
  <tr>
    <td>รหัสไปรษณีย์</td>
    <td><? echo $address2['postcode'] ?></td>
    <td><a href="">แก้ไข</a></td>
  </tr>
  <tr>
    <td>โทรศัพท์</td>
    <td><? echo $address2['phone'] ?></td>
    <td><a href="">แก้ไข</a></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
</table>





</form>

</div>
    
    
    
    
</div>


<? $this->load->view(lang('footer')) ?>