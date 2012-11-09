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
    .description{
        text-align: left;
        text-indent: 30px;
        font-size: 16px;
        float:right;
        width: 50%;
        padding: 20px;
    }
    .description p{
        text-align: left;
        text-indent: 30px;
        font-size: 16px;


    }
    #imgcase{

        float: left;

    }
    #imgcase img{

        width: 200px;
        height: 200px;
    }




</style>

<br>
<div id="page">
    <div class="divcenter" style=" display: table;width:70%; margin-bottom: 25px;">
        <div id="imgcase">
            <img src="<? echo base_url($type->getPicurl()); ?>"   />  
        </div>
        <div class="description">  

            <h1><? echo $type->getType(); ?> </h1>
            <br/>
            <p>
                <? echo $type->getDescription(); ?>  </p>
        </div>

    </div>
    <hr/>
    <div id="calsec">
        <h1> เลือกคุณสมบัติ</h1>

        <?php
        echo form_open('product/calprice', array('target' => 'showpriceframe'));
        ?>

        <p  >
            <label>เทมเพลต: </label> <select  name="template" >
                <?php foreach ($templatelist as $template): ?>
                    <option value="<? echo $template->getTempno() ?>" >
                        <? echo $template->getName() . 'ขนาด' . $template->getSize() ?></option>
                <?php endforeach; ?>
            </select>
            <label>กระดาษ: </label> <select  name="paper" >
                <?php foreach ($paperlist as $paper): ?>
                    <option value="<? echo $paper->getPaperno() ?>" >
                        <? echo $paper->getName() . $paper->getGrame() . 'แกรม' ?></option>
                <?php endforeach; ?>
            </select>
            <label>คุณสมบัติพิเศษ: </label> <select  name="option" >

                <?php foreach ($optionlist as $option): ?>
                    <option value="<? echo $option->getOptionno() ?>" >
                        <? echo $option->getDescription() ?></option>
                <?php endforeach; ?>
            </select>
            <label  >จำนวน:</label>

            <input type="text"  name="amount" class="smartspinner" id="amount" value="50"  />
        </p>


        <input name="type" value="<? echo $type->getType(); ?>" type="hidden"/>
        <input class="btn-primary"  type="submit" value="Calculate" >
        <? echo form_close(); ?> 
    </div>

    <div   id="pricesec"    >
        <iframe src="<? echo site_url('product/getshowpriceframe') ?>"  name="showpriceframe" id="showpriceframe" width="auto"
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