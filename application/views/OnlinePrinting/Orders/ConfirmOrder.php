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
    #addressbar{
        width:100%;
        clear: both;
        display: table;
    }
    #sendaddress{
        width: 50%;
        float: left;
    }
    #receiptadd{
        width: 50%;
        float: right;

    }
</style>
<div id="page">  
    <? echo form_open('orders/ordersummary') ?>
     
    <img src="<? echo base_url('asset/Sys_img/pic_step/02comfirmOrder.png') ?>"/>
    
    <p style ="margin-bottom: 10px;">
    <h1><b>Confirm Order</b></h1>
    <h4>ยืนยันการสั่งสินค้า</h4>
</p>
<hr></hr>


<div id="addressbar"> 
    <div id="sendaddress" >
        <h5>ที่อยู่จัดส่ง</h5> <br/>

        <div id="showsendadd" >

            <address id="line1" ><? echo $_SESSION['sendadd']->getAddress(); ?></address>
            <address id="line2" ><? echo $_SESSION['sendadd']->getProvince(); ?>
                <? echo $_SESSION['sendadd']->getPostcode(); ?></address>
            <address id="line3" >โทรศัพท์ : <? echo $_SESSION['sendadd']->getPhone(); ?></address>


        </div>
    </div>
    <div id="receiptadd">
        <h5>ที่อยู่ออกใบเสร็จ</h5> <br/>
        <div id="showreceiptadd" >
            <address id="line1" ><? echo $_SESSION['receiptadd']->getAddress(); ?></address>
            <address id="line2" ><? echo $_SESSION['receiptadd']->getProvince(); ?>
                <? echo $_SESSION['receiptadd']->getPostcode(); ?></address>
            <address id="line3" >โทรศัพท์ : <? echo $_SESSION['receiptadd']->getPhone(); ?></address>
        </div>
    </div>
</div>

</p>
<!-- <? echo var_dump($_SESSION); ?>-->
<? $totalprice = 0; ?>
<table class="table table-bordered" id="Ccolum" style="width:auto">
    <thead> <tr> 


            <td>เทมเพลต</td>
            <td>กระดาษ</td>
            <td>ตัวเลือกพิเศษ</td>
            <td>จำนวน</td>
            <td>ราคา(บาท)</td>
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
                    <?
                    echo number_format($cart->getPrice(), 2, '.', ',');
                    $totalprice = $totalprice + $cart->getPrice();
                    ?>&nbsp; 
                </td>
              <!--  <td>
                    <a href="<? echo site_url('orders/removeCartItem') . '/' . $index; ?> ">remove </a>
                </td>-->


            </tr>
<? endforeach; ?>

    </tbody>


</table>
<div style="float: right; margin-right: 30%;" >
    <table> 
        <tr>
            <td><strong>ราคาสินค้า</strong></td> 
            <td> <strong>&nbsp;:&nbsp;</strong></td>
            <td align="right"><strong><? echo number_format($totalprice, 2, '.', ','); ?></strong></td>
            <td><strong> &nbsp;&nbsp;บาท</strong></td>
        </tr>
        <tr>
            <td><strong>ค่าจัดส่ง</strong></td>
            <td><strong>&nbsp;:&nbsp;</strong></td>
            <td align="right"><strong><? echo number_format($ordsend->getSendprice(), 2, '.', ','); ?></strong></td>
            <td><strong> &nbsp;&nbsp;บาท</strong></td>
        </tr>
        <tr>
            <td><strong><? echo $taxlabel ;?></strong></td>
            <td><strong>&nbsp;:&nbsp;</strong></td>
            <td align="right"><strong><? echo number_format($totalprice * ($taxvalue-1), 2, '.', ','); ?></strong></td>
            <td><strong> &nbsp;&nbsp;บาท</strong></td>
        </tr>
        <tr>
            <td><strong>ราคารวม</strong></td>
            <td><strong>&nbsp;:&nbsp;</strong></td>
            <td align="right"><strong><? echo number_format(($totalprice * ($taxvalue)) + $ordsend->getSendprice(), 2, '.', ','); ?></strong> </td>
            <td><strong> &nbsp;&nbsp;บาท</strong></td>
        </tr>
    </table><br>
    <input type="hidden" name="totalprice" value="<? echo ($totalprice * ($taxvalue)) + $ordsend->getSendprice(); ?>">
</div>


<table>
    <tr>
        <td>จัดส่ง</td>
        <td>&nbsp;:&nbsp;</td> 
        <td><strong><? echo $ordsend->getDescription(); ?>   </strong>
            <input name="ordsend"  type="hidden" value="<? echo $ordsend->getSendmethod(); ?>"  /></td>
    </tr>
    <tr>
        <td>  การจ่ายเงิน</td>
        <td>&nbsp;:&nbsp;</td> 
        <td><strong><? echo $ordpay->getDescription(); ?>   </strong>
            <input name="ordpay"  type="hidden" value="<? echo $ordpay->getPaymethod(); ?>"  /></td>
    </tr>

    <tr>
        <td>ข้อความถึงโรงพิมพ์</td>
        <td>&nbsp;:&nbsp;</td>
        <td><p><strong><? echo $cusremark ?></strong>&nbsp;</p>
            <input name="cusremark"  type="hidden" value="<? echo $cusremark ?>" ></td></tr> </table>

<div style="text-align: center; margin-top:20px;" >
    <a href="javascript:void(0);" onclick="history.back()" class="btn btn-primary">Back</a> 
    <button type="submit" class="btn btn-primary">Confirm</button>
</div>
<? echo form_close(); ?>
</div>
<? $this->load->view(lang('footer')) ?>