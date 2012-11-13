<? $this->load->view(lang('bakheader')); ?>

<style type="text/css">
    #insertform label{ 
        display: inline;
        margin-left: 3px;
        color: red;
    }
    hr{ 
        text-align:center;
        color:#09F;
        border-color:#09F;
        size:3;
    }
    h1{ font-weight:bolder;
    }
    #inserttemp{
        display: none;
        width: 60%;

    }
    #insertform{


        margin-top: 5%;
        margin-bottom: 5%;

    }
    
    .description{
        
        color: red;
text-align: left;
line-height: 2em;
width: 80%;
margin: 0 auto;
        
        
    }
</style>

<div class="container" >
    <div class="header"> 
        <h1>Template</h1>
        <hr > </hr> 
    </div>
    <div id="search-bar" >  
        <form id="searchform"action="<? echo site_url('Backend/bakCost/template') ?>" class="form-search" align="center"  method="post">
            ชื่อเทมเพลต:<input type="text"  value="<? echo $this->input->post('keyword'); ?>" name="keyword" id="email"  />
            ประเภท: <select name="type" id="type" >  
                <option value="0">ทั้งหมด</option>
                <?php foreach ($typelist as $type): ?>

                    <option  <? echo($this->input->post('type') == $type->getTypeno()) ? 'selected="selected"' : ''; ?> value="<? echo $type->getTypeno(); ?>">  <? echo $type->getType(); ?> </option>

                <?php endforeach; ?>
            </select>

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
                ชื่อเทมเพลต 
            </th>
            <th>
                ขนาด
            </th>
            <th>
                ประเภท
            </th>
            <th>
                เพลทไซต์
            </th>

            <th>

            </th>
            </thead>

            <tbody>
                <? $page = ($this->input->post('startrow')) ? $this->input->post('startrow') : 0; ?>
                <?php foreach ($templatelist as $index => $template): ?>
                    <tr> <td  ><? echo $index + 1 + $page ?> </td>  
                        <td  >

                            <? echo $template->getName(); ?> 

                        </td> 
                        <td>
                            <? echo $template->getSize(); ?> 
                        </td>
                        <td>
                            <?php foreach ($typelist as $type): ?>

                                <?php if ($type->getTypeno() == $template->getTypeno()): ?>
                                    <?
                                    echo $type->getType();
                                    break;
                                    ?> 
                                <?php endif; ?>

                            <?php endforeach; ?>
                        </td>
                        <td > <? echo $template->getPlatesize(); ?> </td>

                        <td >
                            <button onclick="showupload('<? echo $template->getTempno(); ?>');" class="btn btn-warning">Upload</button> 
                            <a href="<? echo site_url('orders/downloadtemplate') . '/' . $template->getTempno(); ?>" class="btn btn-primary">Download</a>
                           <!--  <a href="<? echo site_url('Backend/bakCost/deletetemp') . '/' . $template->getTempno(); ?>" class="btn btn-danger">Delete</a>-->
                        </td>  
                    </tr>
                <?php endforeach; ?>

            </tbody>
        </table>
        <? echo $this->pagination->create_onclick_links(); ?>
    </div>
    <button onclick="showinsertform();" class="btn" >เพิ่ม Template</button>
    <div  id="inserttemp" class="divcenter">

        <form id="insertform" enctype="multipart/form-data" method="post" action="<? echo site_url('Backend/bakCost/inserttemp') ?>">
            <table class="elementcenter">
                <tr>
                    <td>ชื่อ</td>
                    <td>&nbsp;</td>
                    <td><input type="text"  name="name" id="name" ></input></td>

                </tr>
                <tr>
                    <td>ขนาด</td>
                    <td>&nbsp;</td>
                    <td><input type="text"  name="size" id="size" ></input></td>
                </tr>
                <tr>
                    <td>ประเภท</td>
                    <td>&nbsp;</td>
                    <td><select name="typeno">
                            <?php foreach ($typelist as $type): ?>

                                <option   value="<? echo $type->getTypeno(); ?>">  <? echo $type->getType(); ?> </option>

                            <?php endforeach; ?>
                        </select></td>
                </tr>
                <tr>
                    <td>Plate size</td>
                    <td>&nbsp;</td>
                    <td><select name="platesize">
                            <option value="L">L</option>
                            <option value="S">S</option>
                        </select></input></td>
                </tr>
                <tr>
                    <td>Print Per Ream</td>
                    <td>&nbsp;</td>
                    <td><input type="text"  name="ppr" id="ppr" ></input></td>
                </tr>
                <tr>
                    <td>Trim Per Print</td>
                    <td>&nbsp;</td>
                    <td><input type="text"  name="tpp" id="tpp" ></input></td>
                </tr>
                <tr>
                    <td>Template file</td>
                    <td>&nbsp;</td>
                    <td><input type="file"  name="file" id="file" ></input></td>
                </tr>
                <tr>
                    <td></td>
                    <td></td>
                    <td><input class="btn-success" type="submit" value="OK"/></td>
                </tr>
            </table>

        </form>
        <p class="description"> 
            ***<strong>Platesize</strong> L=เพลทขนาด745.00x605.00 mm <br/>
            <span style="padding-left: 75px;">S=เพลทขนาด525.00x459.00 mm </span><br/> 
            ***<strong>Print Per Ream</strong> = กระดาษตัด (=1ใบรีมแบ่งได้กี่ใบพิมพ์) <br/> 
            ***<strong>Trim Per Print</strong> =1ใบพิมพ์ลงได้กี่ใบงาน (=จำนวนชิ้นงานสำเร็จรูปใน1ใบพิมพ์)
        </p>
    </div>
    <div id="showuploaddialog" style="display:none;">
        <iframe id="uploaddialog" width="500"  style="border-style:none;" scrolling="no"  ></iframe>
    </div>
    <? $this->load->view(lang('bakfooter')); ?>
    <script src="<? echo base_url("asset/javascript/jquery.validate.js"); ?>" >  </script>
    <script>
        $().ready(function() {
            $.validator.addMethod("checkextends", function(value) {	
                var result=false;
                if( value.lastIndexOf(".pdf")>=0)
                    result=true;
                if( value.lastIndexOf(".ai")>=0)
                    result=true;
                return result;	
            }, 'file must be pdf or ai');
            $("#insertform").validate({
                //errorLabelContainer: $("#con"),
                rules: {
                    name:"required",
                    size:"required",
                  
                    tpp: {
                        required: true,
                        digits: true
                    },
                    ppr: {
                        required: true,
                        digits: true
                    },file:{
                        required: true,
                        checkextends:true
                    }
               
                },messages: {
                    name:"required",
                    size:"required",
                
                    tpp: {
                        required: "required",
                        digits: "ตัวเลขเท่านั้น"
                    },
                    ppr: {
                        required: "required",
                        digits: "ตัวเลขเท่านั้น"
                    }
                    ,file:{
                        required: "required"
                    }
                }	
            }	        
        );
       
       
       
        });
        function showinsertform(){
    
            $('#inserttemp').fadeToggle();
    
    
        }
        function pag(i){
            $('#searchform input[name=startrow]').val(i);
   
            $('#searchform').submit();
        
        }
            
        function showupload(orderlineno){
    
            document.getElementById('uploaddialog').src = '<? echo site_url("Backend/bakCost/showuploadframe"); ?>/'+orderlineno; 
            $('#showuploaddialog').dialog({ 
                autoOpen: true,
                modal: true,
                width:'auto',
                title: "Upload",
                close: function(event, ui) {
                    window.location.reload();
                 
                }

            }
            
        );
                    
                   
               
    
    
    
        }
    </script>