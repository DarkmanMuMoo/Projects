<? $this->load->view(lang('bakheader')); ?>

<style type="text/css">

	hr{ text-align:center;
color:#09F;
border-color:#09F;
size:3;
}
h1{ font-weight:bolder;
}

</style>

<div class="container" >
    <div class="header"> 
        <h1>Template</h1>
        <hr > </hr> 
    </div>
    <div id="search-bar" >  
        <form id="searchform"action="<? echo site_url('Backend/bakCost/template') ?>" class="form-search" align="center"  method="post">
            ชื่อเทมเพลต:<input type="text"  value="<? echo $this->input->post('keyword'); ?>" name="keyword" id="email" class="input-small " />
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
                        </td>  
                    </tr>
                <?php endforeach; ?>

            </tbody>
        </table>

     <div id="showuploaddialog" style="display:none;">
    <iframe id="uploaddialog" width="500"  style="border-style:none;" scrolling="no"  ></iframe>
</div>

        <? $this->load->view(lang('bakfooter')); ?>
        <script>


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