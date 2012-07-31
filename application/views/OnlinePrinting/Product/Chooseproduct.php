 <? $this->load->view(lang('header')) ?>
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
        <script>
        	$(function() {
		$( "#slider" ).slider({
			value:50,
			min: 50,
			max: 500,
			step: 50,
			slide: function( event, ui ) {
				$( "#amount" ).val(ui.value );
                                $( "#showamount" ).text('amount:'+ui.value);
			}
		});
		$( "#amount" ).val( "$" + $( "#slider" ).slider( "value" ) );
	});
	</script>
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
          <p>
              <label id="showamount" for="amount"  style=" color:#f6931f; font-weight:bold;" >amount:50</label>
            
              <input type="hidden"  name="amount" id="amount" value="50"  />
</p>

<div id="slider" style="width: 300px;"></div>
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