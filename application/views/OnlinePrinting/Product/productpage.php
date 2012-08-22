 <? $this->load->view(lang('header')) ?>
 
 <style>
    hr{color: orangeRed;
background-color: orange;
height: 1px;

}
table{
   
    width: 100%;
   
}

</style>
 
<div id="page">  

    <p style ="margin-bottom: 10px;">
    <h1><b>Product</b></h1>
    <h4>เลือกสินค้าตรงนี้นะ</h4>
    
    
</p>
<hr></hr>
<div style="margin: 0 auto ; width: 60%;" >  

</style>



                       
<?php foreach ($typelist as $type): ?>

                        <p>    <img src="<? echo base_url($type->getPicurl()); ?>"   />  

                            <a href="<? echo site_url("product/chooseProduct") . "/" . $type->getTypeno(); ?>"  > 
                                <h1> <? echo $type->getType();?>  </h1></a>
                            
                        <p><? echo $type->getDescription(); ?></p>
                        </p>

<?php endforeach; ?>

 </div>
</div>

<? $this->load->view(lang('footer')) ?>