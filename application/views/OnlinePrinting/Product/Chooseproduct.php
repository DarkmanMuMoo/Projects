 <? $this->load->view(lang('header')) ?>
 <link href="<? echo base_url("asset/css/smartspinner.css"); ?>" rel="stylesheet">
<style>
    .divcenter img{
        
        margin-bottom: 15px;
        
    }
    #calsec{
        float: left;
margin-left: 15%;
width: 40%;
padding-top: 6.5px;
       
        
    }
    #calsec h1{
font-size: 30px;
line-height: 36px;
margin: 0;
font-family: inherit;
font-weight: bold;
color: inherit;
text-rendering: optimizelegibility;
        
        
    }
    #calsec form{
        
        margin-top: 10px;
        padding:8px;
    }
    #pricesec{

         float:left; width: 40%;
       
	    }
	

         
    

    
</style>
      
        <br>
        <div id="page">
            <div class="divcenter" style=" margin-bottom: 25px;">
                 
                     <img src="<? echo base_url($type->getPicurl()); ?>"   />  

        <h1> <? echo $type->getDescription(); ?>  </h1>
   

            </div>
            <hr/>
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