<? $this->load->view(lang('header')) ?>
<script>
        var totalprice;
    $(function() {
        $( "#selectadd" ).buttonset();
        $('#ordsend').change(function(){
            
var sid =document.getElementById('ordsend').options[document.getElementById('ordsend').selectedIndex].value;
            $.post('<?echo site_url('orders/ajaxordersendprice') ;?>', {id:sid}, function(data){
                
                $('#adprice').html(data);
                
                $('#sumprice').html((parseFloat(data)+totalprice).toFixed(2))
            });
            
        });
        $('#selectadd input').click(function(){
               
                    
                    
            var id = this.id;
        
            if(id=='add1'){
            
                $("#mainaddress").css({"display":"inline"});
                $('#subaddress').css({"display":"none"});
        
            
            }else{
                $("#mainaddress").css({"display":"none"});
                $('#subaddress').css({"display":"inline"});
            
            
            }
        });
        
        
    });

</script>
<style>
    #mainaddress address {
        font-weight: lighter;
        line-height: 20px;
    }
    form{
        padding: 20px;
        width: 80%;
        margin: 0 auto;
    }
    hr{color: orangeRed;
       background-color: orange;
       height: 1px;

    }
</style>
<div id="page">
    <p style ="margin-bottom: 10px;">
    <h1><b>Create Order</b></h1>
    <h4>สร้างออร์เดอร์</h4>
</p>
<hr></hr>

<? echo form_open('orders/confirmorder') ?>

<h5>จัดส่ง</h5> <br/>
<div id="selectadd" >

    <input type="radio" id="add1" name="add" value="add1" checked="checked" /><label for="add1">ที่อยหลัก</label>
    <input type="radio" id="add2" name="add" value="add2"  /><label for="add2">ที่อยู่รอง</label>
    <input type="radio" id="add3" name="add" value="add2"  /><label for="add3">ที่อยู่อื่น</label>
</div>
<br/><h5>จัดส่ง</h5> <br/>
<div id="mainaddress" >
    <? $addr1 = $_SESSION['user']->getAddress1(); ?>
    <address>
        <? echo $addr1['address']; ?><br/>
        <? echo $addr1['province']; ?>
        <? echo $addr1['postcode']; ?><br/>
        <? echo $addr1['phone']; ?><br/>
    </address>



</div>

<div id="subaddress" style="display: none;">
    <? $addr2 = $_SESSION['user']->getAddress2(); ?>
    <address>

        <? echo $addr2['address']; ?><br/>
        <? echo $addr2['province']; ?>
        <? echo $addr2['postcode']; ?><br/>
        <? echo $addr2['phone']; ?><br/>
    </address>

</div>

</p>
<!-- <? echo var_dump($_SESSION); ?>-->
<? $totalprice = 0; ?>
<table class="table table-bordered" id="Ccolum" style="width:auto">
    <thead> <tr> 


            <td>template</td>
            <td>กระดาษ</td>
            <td>option</td>
            <td>จำนวน</td>
            <td>ราคา</td>
          <!--  <td>ลบ</td>-->

        </tr> </thead>
    <tbody>
        <?php foreach ($_SESSION['temp_orderlinelist'] as $index => $cart): ?>
            <tr>

                <td>   <?php foreach ($templatelist as $orderline): ?>


                        <?php if ($orderline->getTempno() == $cart->getTempno()): ?>
                            <strong> <? echo $orderline->getName(); ?> &nbsp; <? echo $orderline->getTypeno(); ?>&nbsp;
                                <? echo $orderline->getSize();
                                break;
                                ?>
                            </strong>
                        <?php endif; ?>
    <? endforeach; ?>
                </td>

                <td>   <?php foreach ($paperlist as $paper): ?>
                            <?php if ($paper->getPaperno() == $cart->getPaperno()): ?>
                            <strong> <? echo $paper->getName(); ?> &nbsp; <? echo $paper->getGrame();
                    break;
                                ?></strong>
                        <?php endif; ?>

    <? endforeach; ?>
                </td>
                <td>   <?php foreach ($optionlist as $option): ?>

                            <?php if ($option->getOptionno() == $cart->getOptionno()): ?>
                            <strong> <? echo $option->getDescription();
                    break;
                                ?> </strong>
                        <?php endif; ?>
                    <? endforeach; ?>
                </td>
                <td>
                    <? echo $cart->getQty(); ?>
                </td>
                <td>
    <? echo number_format($cart->getPrice(), 2, '.', ',');
    $totalprice = $totalprice + $cart->getPrice();
    ?>&nbsp; บาท
                </td>
              <!--  <td>
                    <a href="<? echo site_url('orders/removeCartItem') . '/' . $index; ?> ">remove </a>
                </td>-->


            </tr>
<? endforeach; ?>

    </tbody>
</table>
<div style="float: right; margin-right: 30%" >
    <strong>ราคาสินค้า :<? echo number_format( $totalprice ,2,'.',',');?> บาท</strong><br>
    <strong>ค่าจัดส่ง :<span  id="adprice">-</span> บาท</strong><br>
    <strong>ราคารวม :<span  id="sumprice"><? echo number_format( $totalprice ,2,'.',','); ?></span> บาท</strong>
</div>

<p>
    <label>จัดส่ง: </label> <select id="ordsend" name="ordsend" >
<?php foreach ($ordsendlist as $ordsend): ?>
            <option value="<? echo $ordsend->getSendmethod() ?>" >
            <? echo $ordsend->getDescription() ?></option>
        <?php endforeach; ?>
    </select>

    <label>การจ่ายเงิน: </label> <select  name="ordpay" >
<?php foreach ($ordpaylist as $ordpay): ?>
            <option value="<? echo $ordpay->getPaymethod() ?>" >
    <? echo $ordpay->getDescription() ?></option>
<?php endforeach; ?>
    </select>

</p>

<label> ความคิดเห็นลูกค้า: </label>
<textarea name="cusremark">


</textarea>
<div style="text-align: center;"> <button type="submit" class="btn btn-primary">Create Order</button> </div>
<? echo form_close(); ?>

</div>


<? $this->load->view(lang('footer')) ?>
<script>  totalprice=<? echo $totalprice;?>;  </script>