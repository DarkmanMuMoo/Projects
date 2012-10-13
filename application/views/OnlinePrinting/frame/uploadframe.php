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
    beforeSubmit: function(arr, $form, options) { 
    // The array of form data takes the following form: 
    // [ { name: 'username', value: 'jresig' }, { name: 'password', value: 'secret' } ] 
      if(document.getElementById("file").value==''){
               alert('ยังไม่ได้เลือกไฟล์');
             return false ;
           }
              if(document.getElementById("file").value.lastIndexOf(".pdf")==-1||document.getElementById("file").value.lastIndexOf(".ai")==-1){
               alert('ไฟล์ที่upload ต้องเป็น pdf หรือ ai เท่านั้น');
             return false ;
           }
    // return false to cancel submit                  
},
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
            <form  id="uploadform" action="<? echo  site_url("uploader/uploadfile"); ?>" method="post" enctype="multipart/form-data">
                <input id="file" type="file" name="myfile"><br>
        <input type="hidden" name="orderlineno" value="<?echo $orderlineno;?>" >
        <input class="btn btn-warning" type="submit" value="Upload File">
    </form>
        
        <div class="progress">
        <div class="bar"></div>
        <div class="percent">0%</div>
    </div>
             <div id="status"></div>
             
             <div id="progressbar"></div>
            </div>