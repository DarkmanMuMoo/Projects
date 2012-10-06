<? $this->load->view(lang('includeheader')) ?>
        <style>

.progress { position:relative; width:400px; border: 1px solid #ddd; padding: 1px; border-radius: 3px; }
.bar { background-color: #B4F5B4; width:0%; height:20px; border-radius: 3px; }
.percent { position:absolute; display:inline-block; top:3px; left:48%; }

        </style>
         <script src="<? echo base_url("asset/javascript/jquery.form.js"); ?>" >  </script>
         <script>
         
$().ready(function() {
//$( "#progressbar" ).progressbar({ value: 0 });
$('#uploadform').ajaxForm({
    beforeSend: function() {
           
       $('#status').empty();
        var percentVal = '0%';
        
        $('.bar').width(percentVal)
        $('.percent').html(percentVal);
     
    },
    uploadProgress: function(event, position, total, percentComplete) {
      
        var percentVal = percentComplete + '%';
        //$( "#progressbar" ).progressbar({ value: percentComplete });
       $('.bar').width(percentVal);
       $('.percent').html(percentVal);
     
 
    },
	complete: function(xhr) {
               //  $( "#progressbar" ).hide();
         $('.bar').width('100%');
       $('.percent').html('complete');
	$('#status').html(xhr.responseText);
        
        //parent.closedialog();
	}
}); 

});      

     </script>
 
     <div class="well">
<form  id="uploadform" action="<? echo  site_url("Backend/BakCost/updatetemplatefile"); ?>" method="post" enctype="multipart/form-data">
        <input type="file" name="myfile"><br>
        <input type="hidden" name="templateno" value="<?echo $templateno;?>" >
        <input class="btn btn-warning" type="submit" value="Upload File to Server">
    </form>
        
        <div class="progress">
        <div class="bar"></div>
        <div class="percent">0%</div>
    </div>
             <div id="status"></div>
             
             <div id="progressbar"></div>
        </div>
