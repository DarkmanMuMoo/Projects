<? $this->load->view(lang('bakheader')); ?>
<style type="text/css">
#font1 {
	font-family: can_jaew;
}
#insertwork{
    
    display: none;
}
</style>


<div class="container" >
    <div id="search-bar" style="margin-top: 100px;">  
        <form id="searchform"action="<? echo site_url('Backend/bakwork') ?>" class="form-search" align="center"  method="post">
            Keyword:<input type="text"  name="keyword" id="email" class="input-small " />
            Employee: <select name="emp" id="emp" >  
                <option value="">All</option>
                <?php foreach ($emplist as $emp): ?>

                    <option value="<? echo $emp->getEmpno(); ?>">  <? echo $emp->getName(); ?>&nbsp; <? echo $emp->getLastname(); ?> </option>

                <?php endforeach; ?></select>

            <button type="submit" class="btn">Search</button>
        </form>
    </div>
    <div id="result"  align="center">
        <table class="table table-bordered" >
            <thead>
            <th>
                Number
            </th>
            <th>
                Workname
            </th>
            <th>
                Workno 
            </th>
            <th>
                Employee
            </th>
            <th>
                StartDate
            </th>
            <th>
                Enddate
            </th>

            <th>
                management
            </th>
            </thead>

            <tbody>
                <?php foreach ($worklist as $index => $work): ?>
                    <tr> <td  ><? echo $index + 1 ?> </td>  
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
                        break; ?> 
                                <?php endif; ?>

    <?php endforeach; ?>
                        </td>
                        <td > <? echo $work->getStartdate(); ?> </td>
                        <td ><? echo ($work->getEnddate()==null)?'-':$work->getEnddate(); ?> </td>      
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

    </div>
 <button onclick="showinsertform();" class="btn" > insert new Work</button>
 <div  id="insertwork" class="divcenter" >

        <form id="creatworkform" action="<? echo site_url('Backend/bakwork/creatework') ?>" method="post">
<table width="532" border="0" align="center">
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
    <td height="50">OrdNo</td>
    <td><input name="ordno" type="text" /></td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>คำอธิบาย</td>
    <td><textarea name="description"></textarea></td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td height="50"><input name="assign" type="submit" class="btn" value="มอบหมาย" /></td>
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

              $.post('<? echo site_url('Backend/bakwork/deletework')?>/'+workno, function(data){
                  //alert(data);
                  eval(data);

              });

        }

      

    }

    
</script>