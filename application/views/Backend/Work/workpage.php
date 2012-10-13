<? $this->load->view(lang('bakheader')); ?>
<style type="text/css">

    #insertwork{

        display: none;
    }
    hr{ text-align:center;
        color:#09F;
        border-color:#09F;
        size:3;
    }
    h1{ font-weight:bolder;
    }
    
    .hidestatus{
        
        display: none;
    }
     .showstatus{
        
        display: inline;
    }
    #search-bar select{

        width: 150px;
    }
</style>



<div class="container" >

    <div class="header"> 
        <h1>งานทั้งหมด</h1>
        <hr > </hr> 
    </div>





    <div id="search-bar" >  
        <form id="searchform"action="<? echo site_url('Backend/bakwork') ?>" class="form-search" align="center"  method="post">
            ชื่องาน:<input type="text"  value="<? echo $this->input->post('keyword');?>" name="keyword" id="email" class="input-small " />
            สถานะ 
            <select name="finish" >
                <option <?  echo($this->input->post('finish')==0)?'selected="selected"':''; ?> value="0"> ทั้งหมด </option>
            <option <?  echo($this->input->post('finish')==1)?'selected="selected"':''; ?> value="1"> เสร็จ </option>
            <option <?  echo($this->input->post('finish')==2)?'selected="selected"':''; ?> value="2"> ไม่เสร็จ </option>
            </select> 
        
            ผู้รับผิดชอบ: <select name="emp" id="emp" >  
                <option value="0">ทั้งหมด</option>
                <?php foreach ($emplist as $emp): ?>

                    <option  <? echo($this->input->post('emp')==$emp->getEmpno())?'selected="selected"':''; ?> value="<? echo $emp->getEmpno(); ?>">  <? echo $emp->getName(); ?>&nbsp; <? echo $emp->getLastname(); ?> </option>

                <?php endforeach; ?></select>
            <div id="status"  class="hidestatus">status: <select name="status" id="emp" >  
                <option <?  echo($this->input->post('status')==0)?'selected="selected"':''; ?> value="0">All</option>
                <option  <?  echo($this->input->post('status')==1)?'selected="selected"':''; ?>   value="1">งานที่รับผิดชอบ</option>
                <option  <?  echo($this->input->post('status')==2)?'selected="selected"':''; ?> value="2">งานทที่มีส่วนร่วม
                </option>
            </select></div>
            <input type="hidden" name="startrow" value="0"/>
            <button type="submit" class="btn">Search</button>
        </form>
    </div>
    <div id="result"  align="center">
        <table class="table table-bordered" >
            <thead>
            <th>
                #
            </th>
            <th>
                รหัสงาน 
            </th>
            <th>
                ชื่องาน
            </th>
            <th>
                ผู้รับผิดชอบ
            </th>
            <th>
                สถานะ
            </th>
            <th>
                วันเริ่มงาน
            </th>
            <th>
                วันสิ้นสุดงาน
            </th>

            <th>
                
            </th>
            </thead>

            <tbody>
                   <? $page=($this->input->post('startrow'))?$this->input->post('startrow'):0; ?>
                <?php foreach ($worklist as $index => $work): ?>
                    <tr> <td  ><? echo $index+1+$page ?> </td>  
                        <td  >

                            <? echo $work->getWorkno(); ?> 

                        </td> 
                        <td>
                            <? echo $work->getWorkname(); ?> 
                        </td>
                        <td>
                            <?php foreach ($emplist as $emp): ?>

                                <?php if ($emp->getEmpno() == $work->getEmpno()): ?>
                                    <? echo $emp->getName(); ?>&nbsp; <? echo $emp->getLastname();
                        break;
                                    ?> 
                                <?php endif; ?>

    <?php endforeach; ?>
                        </td>
                        <td>  <? echo ($work->getEnddate() == null) ? 'ยังไม่เสร็จ':'เสร็จ'; ?></td>
                        <td > <? echo $work->getStartdate(); ?> </td>
                        <td ><? echo ($work->getEnddate() == null) ? '-' : $work->getEnddate(); ?> </td>      
                        <td >
                            <a class="btn btn-info" href="<? echo site_url('Backend/bakwork/viewworkdetail') . "/" . $work->getWorkno(); ?>"> 
                                View
                            </a>
                            <button class="btn btn-danger"  onclick="Confirmdelete('<? echo $work->getWorkno(); ?>');"> 
                                Delete
                            </button>
                        </td>  
                    </tr>
<?php endforeach; ?>



            </tbody>
        </table>
 <? echo $this->pagination->create_onclick_links(); ?>
    </div>
    <button onclick="showinsertform();" class="btn" > insert new Task</button>
    <div  id="insertwork" class="divcenter" >

        <form id="creatworkform" action="<? echo site_url('Backend/bakwork/creatework') ?>" method="post">
            <table width="532" border="0" align="center">
                   <tr>
                    <td height="50">เลขใบสั่งซื้อ</td>
                    <td><input name="ordno" type="text" readonly="true" value="<?echo $this->session->flashdata('orderno'); ?>"/></td>
                    <td>&nbsp;</td>
                </tr>
                <tr>
                    <td width="181" height="50">ชื่องาน</td>
                    <td width="170"><input id="workname" name="workname" type="text" /></td>
                    <td width="167">&nbsp;</td>
                </tr>
                <tr>
                    <td height="50">ชื่อพนักงาน</td>
                    <td><select name="empno" >
<?php foreach ($emplist as $emp): ?>

                                <option value="<? echo $emp->getEmpno(); ?>">  <? echo $emp->getName(); ?>&nbsp; <? echo $emp->getLastname(); ?> </option>

<?php endforeach; ?>
                        </select></td>
                    <td>&nbsp;</td>
                </tr>
             
                <tr>
                    <td>คำอธิบาย</td>
                    <td><textarea name="description"></textarea></td>
                    <td>&nbsp;</td>
                </tr>
                <tr>
                    <td>&nbsp;</td>
                    <td height="50"><input name="assign" type="submit" class="btn" value="OK" /></td>
                    <td>&nbsp;</td>
                </tr>

            </table>




        </form>










    </div>
</div>

<? $this->load->view(lang('bakfooter')); ?>

<script src="<? echo base_url("asset/javascript/jquery.validate.js"); ?>" >  </script>
<script src="<? echo base_url("asset/javascript/jquery.metadata.js"); ?>" >  </script>
<script>  
    
     $().ready(function() {
         
         
         if($('#searchform select[name=emp]').val()!= 0){

              $('#status').addClass( 'showstatus' );
         }
        $('#searchform select[name=emp]').change(function(){
            
       if( $(this).val()!='0'){
           
           
           $('#status').addClass( 'showstatus' );
          
       }else{
           
            $('#status').addClass( 'hidestatus' );
            $('#status').removeClass( 'showstatus' );
       }
            
        }) ;
         
     });
     function pag(i){
        $('#searchform input[name=startrow]').val(i);
   
        $('#searchform').submit();
        
    }

   
    function showinsertform(){
        var validate=  $("#creatworkform").validate({
            rules: {
                workname:"required" 
                  
            },messages:{
                workname:"required" 
            }
        
        });
            
        $('#insertwork').fadeToggle("slow", "linear");
            
            
            
    }
    
    
    function Confirmdelete(workno)

    {

        if(confirm('Do you want to  delete this work ')==true)

        {

            $.post('<? echo site_url('Backend/bakwork/deletework') ?>/'+workno, function(data){
                //alert(data);
                eval(data);

            });

        }

      

    }

    
</script>
<?php if ($this->session->flashdata('orderno')): ?>
<script>

showinsertform();

</script>
<?php endif; ?>