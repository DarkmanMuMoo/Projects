<? $this->load->view(lang('bakheader'));?>

<div class="container" >
    <style>
#insertemp{display: none; width: 60%;}
#insertform{
    
    
  margin-top: 5%;
  margin-bottom: 5%;
 
}
    #result th{text-align: center;}
    #result td{text-align: center;}
	
hr{ text-align:center;
color:#09F;
border-color:#09F;
size:3;
}
h1{ font-weight:bolder;
}

.bottom{border:dashed;
border-width:thin;
}


</style>

<div class="header"> 
        <h1>รายชื่อพนักงาน</h1>
      <hr />  </div>


<div id="search-bar" >  
            <form id="searchform"action="<? echo site_url('Backend/bakemp') ?>" class="form-search" align="center"  method="post">
                ค้นหา:<input type="text"  name="keyword" id="email" class="input-small " />
                ตำแหน่ง: <select name="position" id="position" >  
                    <option value="">ทั้งหมด</option>
  <?php foreach ($positionlist as $ord): ?>
                                
                    <option  <? echo ($this->input->post('position')==$ord->getPosition())? 'selected="selected"': '';?> value="<?echo $ord->getPosition();?>">  <? echo $ord->getPosdescription();  ?></option>
                              
                                 <?php endforeach; ?></select>
                <input type="hidden" name="startrow" value="0"/>
                <button type="submit" class="btn">ค้นหา</button>
            </form>
 </div>
<div id="result"  align="center">
            <table class="table table-bordered" >
                <thead>
                <th>
                    #
                </th>
                <th>
                    รหัสพนักงาน 
                </th>
                <th>
                    ชื่อ
                </th>
                <th>
                    นามสกุล
                </th>
                <th>
                    อีเมลล์
                </th>
                <th>
                    โทรศัพท์
                </th>
                <th>
                    ตำแหน่ง
                </th>
                <th>
                  
                </th>
                </thead>
   <? $page=($this->input->post('startrow'))?$this->input->post('startrow'):0; ?>
                <tbody>
                    <?php foreach ($emplist as $index => $ord): ?>
                        <tr> <td  ><? echo $index + 1+$page ?> </td>  
                            <td  >
                                
                                    <? echo $ord->getEmpno(); ?> 
                              
                            </td> 
                            <td>
                                 <? echo $ord->getName(); ?> 
                            </td>
                                <td>
                                 <? echo $ord->getLastname(); ?> 
                            </td>
                            <td > <? echo $ord->getEmail(); ?> </td>
                             <td ><? echo $ord->getPhone(); ?> </td>      
                            <td >
                                 <?php foreach ($positionlist as $pos): ?>
                                <?php if ($ord->getPosition() == $pos->getPosition() ): ?>
                                <? echo $pos->getPosdescription(); break; ?>
                               <?php endif; ?>
                                 <?php endforeach; ?>
                            </td> 
                     
                            <td >
                                <a class="btn btn-info" href="<?echo site_url('Backend/bakemp/viewempdetail') . "/" .$ord->getEmpno();   ?>"> 
                                   View
                                </a>
                                <button class="btn btn-danger"  onclick="Confirmdelete('<? echo $ord->getEmpno(); ?>');"> 
                                  Delete
                                </button>
                            </td>  
                        </tr>
                    <?php endforeach; ?>


                </tbody>

            </table>
     
        <? echo $this->pagination->create_onclick_links(); ?>
    <hr class="bottom"></hr>
        </div>


<button onclick="showinsertform();" class="btn" > insert new emp</button>
<div  id="insertemp" class="divcenter"  >
    <form  id="insertform" action="<? echo site_url('Backend/bakemp/insertemp')  ?>" method="post">

        <table class="elementcenter">
            <tr>
                <td>ชื่อ</td>
                <td>&nbsp;</td>
              <td><input type="text"  name="name" id="name" ></input></td>
                
          </tr>
          <tr>
                <td>นามสกุล</td>
                <td>&nbsp;</td>
              <td><input type="text"  name="lastname" id="lastname"  ></input></td>
                
          </tr>
            <tr>
                <td>อีเมลล์</td>
                <td>&nbsp;</td>
                <td><input type="text"name="email" id="email"></input></td>
          </tr>
 <tr>
                <td >โทรศัพท์</td>
                <td>&nbsp;</td>
                <td><input type="text" name="phone" id="phone"></input></td>
          </tr>
             
                <tr>
                <td >ตำแหน่ง</td>
                <td></td>
                <td><select name="position">
                        <?php foreach ($positionlist as $ord): ?>

     <option value="<? echo $ord->getPosition(); ?>" ><? echo $ord->getPosdescription(); ?></option>

<?php endforeach; ?>
             
             
                </select></td>
             </tr>

           <tr>
                <td></td>
                <td></td>
                <td><input class="btn-success" type="submit" value="ตกลง"/></td>
          </tr>
           
  </table>
            
            
        </form>
        
         </div>
 
    
    

</div>

<? $this->load->view(lang('bakfooter'));?>
 <script src="<? echo base_url("asset/javascript/jquery.maskedinput-1.2.1.js"); ?>" >  </script>
<script src="<? echo base_url("asset/javascript/jquery.validate.js"); ?>" >  </script>
      <script src="<? echo base_url("asset/javascript/jquery.metadata.js"); ?>" >  </script>
<script>   
    
    
    function pag(i){
        $('#searchform input[name=startrow]').val(i);
   
        $('#searchform').submit();
        
    }
     function Confirmdelete(empno)

    {
var vempno=empno;
        if(confirm('Do you want to delete this emp')==true)

        {

              $.post('<? echo site_url('Backend/bakemp/deleteemp')?>',{empno:vempno}, function(data){
                  //alert(data);
                  eval(data);

              });

        }

      

    }
function showinsertform (){
    
    
     $("#insertemp").fadeToggle("slow", "linear");
}
 $().ready(function() {
 $("#phone").mask("999-999-9999");
     $("#insertform").validate({
                //errorLabelContainer: $("#con"),
                rules: {
                     name:"required",
                lastname:"required",
                    email: {
                        required: true,
                        email: true
                    },
                      phone:"required"
                },messages: {
                     name:"required",
                lastname:"required",
                    email: {
                        required: "plese enter email",
                        email:  "plese enter valid email"
                    },
                     phone:"required"
                }	
            }	        
     );
     });

</script>
