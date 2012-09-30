<? $this->load->view(lang('header')) ?>
<style>
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
<? echo form_open('orders/ordersummary') ?>

 <p style ="margin-bottom: 10px;">
  <h1><b>Confirm Order</b></h1>
    <h4>คอนเฟิมออร์เดอร์</h4>
</p>
<hr></hr>

<h5>จัดส่ง</h5><br/>
<div id="sendaddress" >
    <?
    if ($address == 'tabadd1') {
        $addr1 = $_SESSION['user']->getAddress1();
        ?>
        <address>
            <? echo $addr1['address']; ?><br/>
            <? echo $addr1['province']; ?>
            <? echo $addr1['postcode']; ?><br/>
            <? echo $addr1['phone']; ?><br/>
        </address>
    <? } else   if ($address == 'tabadd2') {
        $addr2 = $_SESSION['user']->getAddress2(); ?>
        <address>
            <? echo $addr2['address']; ?><br/>
            <? echo $addr2['province']; ?>
            <? echo $addr2['postcode']; ?><br/>
    <? echo $addr2['phone']; ?><br/>
        </address>

<? } else{ $addr3 = $_SESSION['newadd']; ?>

        <address>
            <? echo $addr3['address']; ?><br/>
            <? echo $addr3['province']; ?>
            <? echo $addr3['postcode']; ?><br/>
    <? echo $addr3['phone']; ?><br/>
        </address>
    
    
<?}?>
    <input type="hidden" name="address" value="<? echo $address ?>"/>
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
                            break; ?>
                            </strong>
        <?php endif; ?>
    <? endforeach; ?>
                </td>

                <td>   <?php foreach ($paperlist as $paper): ?>
                        <?php if ($paper->getPaperno() == $cart->getPaperno()): ?>
                            <strong> <? echo $paper->getName(); ?> &nbsp; <? echo $paper->getGrame();
                break; ?></strong>
        <?php endif; ?>

                    <? endforeach; ?>
                </td>
                <td>   <?php foreach ($optionlist as $option): ?>

                        <?php if ($option->getOptionno() == $cart->getOptionno()): ?>
                            <strong> <? echo $option->getDescription();
                break; ?> </strong>
                        <?php endif; ?>
    <? endforeach; ?>
                </td>
                <td>
                    <? echo $cart->getQty(); ?>
                </td>
                <td>
    <? echo  number_format( $cart->getPrice(), 2, '.', ',');
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
<div style="float: right; margin-right: 30%;" >
    <strong>ราคาสินค้า :<? echo number_format($totalprice, 2, '.', ',') ;?> บาท</strong><br>
    <strong>ค่าจัดส่ง :<? echo  number_format($ordsend->getSendprice(), 2, '.', ','); ?> บาท</strong><br>
    <strong>ราคารวม :<? echo number_format($totalprice + $ordsend->getSendprice() , 2, '.', ','); ?> บาท</strong><br>
    <input type="hidden" name="totalprice" value="<? echo $totalprice + $ordsend->getSendprice(); ?>">
</div>

<p>
    <label>จัดส่ง: </label> 

    <strong><? echo $ordsend->getDescription(); ?>   </strong>
    <input name="ordsend"  type="hidden" value="<? echo $ordsend->getSendmethod(); ?>"

</p>

<p>
    <label>การจ่ายเงิน: </label> 


    <strong><? echo $ordpay->getDescription(); ?>   </strong>
    <input name="ordpay"  type="hidden" value="<? echo $ordpay->getPaymethod(); ?>"


</p>
<label> ข้อความถึงโรงพิมพ์: </label>
<p>  

</p>
<input name="cusremark"  type="hidden" value="<? echo $cusremark ?>" >
<div style="text-align: center;">
    <a href="javascript:void(0);" onclick="history.back()" class="btn btn-primary">Back</a> 
    <button type="submit" class="btn btn-primary">Confirm</button>
</div>
<? echo form_close(); ?>
 </div>
<? $this->load->view(lang('footer')) ?>