 <? $this->load->view(lang('header')) ?>
 <link href="<? echo base_url("asset/css/smartspinner.css"); ?>" rel="stylesheet">
<style>
    .divcenter img{
        
        margin-bottom: 15px;
        
    }
    #calsec{
        
        float: left ; width :50%;
        
    }
    #pricesec{
         float:right; width: 50%;
        text-align: center;
	    }
	
    
</style>
 <style>
    hr{color: orangeRed;
background-color: orange;
height: 1px;

}
table{
   
    width: 100%;
   
}

</style>
    
        <br>
        <div id="page">
            <div class="divcenter" style=" margin-bottom: 25px;">
     
          <div style="text-align:left">
    <p style ="margin-bottom: 10px;">
    <h1><b>การ์ดเชิญ</b></h1>
    <h4></h4>
    
    
</p>
</div>
<hr></hr> 
                 
                 
                     <img src="<? echo base_url($type->getPicurl()); ?>"   />  

        <h1> <? echo $type->getDescription(); ?>  </h1>
   

            </div>
            
            <hr style="border-style:dashed"/>

            <div id="calsec">
                <h1> เลือกคุณสมบัติ</h1>

        <?php
        echo form_open('product/calprice',array('target'=>'showpriceframe'));
        ?>
    
         <p  >
        <label>template: </label> <select  name="template" >
            <?php foreach ($templatelist as $template): ?>
                <option value="<? echo $template->getTempno() ?>" >
                    <? echo $template->getName().'ขนาด'.$template->getSize() ?></option>
            <?php endforeach; ?>
        </select>
          <label>paper: </label> <select  name="paper" >
            <?php foreach ($paperlist as $paper): ?>
                <option value="<? echo $paper->getPaperno() ?>" >
                    <? echo $paper->getName().$paper ->getGrame().'แกรม'?></option>
            <?php endforeach; ?>
        </select>
          <label>option: </label> <select  name="option" >
              
            <?php foreach ($optionlist as $option): ?>
                <option value="<? echo $option->getOptionno() ?>" >
                    <? echo $option->getDescription() ?></option>
            <?php endforeach; ?>
        </select>
              <label  >amount:</label>
            
              <input type="text"  name="amount" class="smartspinner" id="amount" value="50"  />
</p>


          
            <input class="btn-primary" type="submit" value="calprice" >
        <? echo form_close(); ?>
  </div>
            
            <div   id="pricesec"    >
                    <iframe src="<?echo site_url('product/getshowpriceframe') ?>"  name="showpriceframe" id="showpriceframe" width="auto"
                            height="400px" style="border-style:none;" scrolling="no" >
                    
                    </iframe>
                </div>
             
        </div>
     
<? $this->load->view(lang('footer')) ?>
 <script src="<? echo base_url("asset/javascript/smartspinner.js"); ?>" >  </script>
  <script>
        	  $(document).ready(function(){
                    
                   
                    $('#amount').spinit({
                        min:50,max:500,stepInc:50,pageInc:50, height: 22 }); 
                    
                
		
	});
	</script>