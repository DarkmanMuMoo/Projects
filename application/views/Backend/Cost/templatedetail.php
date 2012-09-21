<? $this->load->view(lang('bakheader')); ?>

<div class="container" >
    <div style="margin-top: 100px; margin-left: auto; margin-right: auto; margin-bottom: 20px;"> 
        <h1>Template</h1>
        <hr > </hr> 
    </div>
    <table width="457" border="1" bordercolor="#CCCCCC">
            <?// $template = new Template(); ?>
            <tr>
                <td width="124">เทมเพลต</td>
                <td width="80">ขนาด</td>
                <td width="239">url(<? echo ($template->getUrl() == '' || $template->getUrl() == null) ? 'ยังไม่มี' : $template->getUrl()
            ?>)</td>
            </tr>
            <tr>
                <td> <? echo $template->getName(); ?></td>
                <td><? echo $template->getSize(); ?></td>
                <td> <button onclick="showupload('<? echo $template->getTempno(); ?>');" class="btn btn-warning">Upload</button> 
                
                 <a href="<? echo site_url('orders/downloadtemplate').'/'.$template->getTempno(); ?>" class="btn btn-primary">Download</a>
                </td>
            </tr>

        </table>

    </form>

    <form action="<? echo site_url(); ?>" method="post">
        <table width="230" border="0" >
            <tr>
                <td width="174">X</td>
                <td width="46"><input type="text" name="x" value="<? echo $template->getX(); ?>"/></td>
            </tr>
            <tr>
                <td>Y</td>
                <td><input type="text" name="y" value="<? echo $template->getY(); ?>"/></td>
            </tr>
            <tr>
                <td>Z</td>
                <td><input type="text" name="z" value="<? echo $template->getZ(); ?>"/></td>
            </tr>
            <tr>
                <td>platesize</td>
                <td><select name="platesize">
                        <option<? echo ($template->getPlatesize() == 'L') ? 'selected="selected"' : ''; ?>L</option>
                         <option <? echo ($template->getPlatesize() == 'S') ? 'selected="selected"' : ''; ?>  >S</option></select></td>
            </tr>

        </table>
        <input type="hidden"  name="tempno" value="<? echo $template->getTempno(); ?>"/>
        <br /><input type="submit" value="แก้ไข"/>
    </form>
<div id="showuploaddialog" style="display:none;">
    <iframe id="uploaddialog" width="500"  style="border-style:none;" scrolling="no"  ></iframe>
</div>

</div>
<? $this->load->view(lang('bakfooter')); ?>

<script>

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