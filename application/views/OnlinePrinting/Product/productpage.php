
<? $this->load->view(lang('header')) ?>

<style>
    hr{color: orangeRed;
       background-color: orange;
       height: 1px;

    }
    table{

        width: 100%;

    }
    .product{
        width: 300px;
        float: left;
        margin-left: 3px;
        margin-bottom: 5px;
    }
    .caseproduct{
        margin: 0 auto; width: 100%;display: table;  

    }
    .thumbnail h3 {
        font-size: 24px;
        line-height: 40px;
        margin: 10px 0;
        font-family: inherit;
        font-weight: bold;

        color: inherit;
        text-rendering: optimizelegibility;
    }
</style>

<div id="page">  

    <p style ="margin-bottom: 10px;">
    <h1><b>Product</b></h1>
    <h4>เลือกสินค้าตรงนี้นะ</h4>
</p>
<hr></hr>
<div class="caseproduct" >  


    <?php foreach ($typelist as $index => $type): ?>
        <div class="thumbnail product well" >
            <img width="300" height="300" src="<? echo base_url($type->getPicurl()); ?>"   />  
            <div class="caption">
                <h3> <? echo $type->getType(); ?>  </h3>
                <p><? echo $type->getDescription(); ?></p>
                <p>
                    <a class=" btn btn-primary" href="<? echo site_url("product/chooseProduct") . "/" . $type->getTypeno(); ?>"  > 
                        สั่งซื้อสินค้า </a>
                </p>


            </div>
        </div>
    <?php endforeach; ?>

</div>
</div>

<? $this->load->view(lang('footer')) ?>