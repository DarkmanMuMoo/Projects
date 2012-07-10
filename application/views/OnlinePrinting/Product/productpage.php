 <? $this->load->view(lang('header')) ?>
<div id="page">  
<div style="margin: 0 auto ; width: 60%;" >  

                       
<?php foreach ($typelist as $type): ?>

                        <p>    <img src="<? echo base_url($type->getPicurl()); ?>"   />  

                            <a href="<? echo site_url("product/chooseProduct") . "/" . $type->getType(); ?>"  > 
                                <h1> <? echo $type->getDescription(); ?>  </h1></a>
                        </p>

<?php endforeach; ?>

 </div>
</div>

<? $this->load->view(lang('footer')) ?>