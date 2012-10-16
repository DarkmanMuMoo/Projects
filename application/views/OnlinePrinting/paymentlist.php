<? $this->load->view(lang('header')) ?>
<style> 
    #paystasut{clear: both; margin :10 auto ; padding: 5 5;}

    #result th{text-align: center;}
    #result td{text-align: center;}
    #payconfirm{ margin-top: 15px;}
    #payconfirm form{
        margin-left: 20px;
        margin-top: 15px;
    }
    #payconfirm table{

        width: 50%;

    }
    #con{

        width: 20%;
        margin-left: 10%;
    }
    hr{color: orangeRed;
       background-color: orange;
       height: 1px;

    }
.req {
	color: #F00;
}

</style>
<div id="page">


    <p style ="margin-bottom: 10px;">
    <h1><b>Payment</b></h1>
    <h4>แจ้งการชำระสินค้า</h4>
</p>
<hr></hr>
<? $countactive = 0;
$paidamount = 0; ?>
<div id="result" align="center">
    <table class="table table-bordered">
        <thead>

        <th>#</th> 
        <th>รอบการจ่ายเงิน</th>
        <th>ราคารวม(บาท)</th>

        <th>วันที่</th>
        <th>ภาพใบเสร็จ</th>
        </thead>
        <tbody>
            <?php if (!empty($paymentlist)): ?>
    <?php foreach ($paymentlist as $index => $payment): ?>

                <td><? echo $payment->getSeqno(); ?> </td> 
                <td><? echo $payment->getPeriod() ?> </td> 
                <td><? echo number_format($payment->getAmount(), 2, '.', ','); ?> &nbsp;</td> 

                <td><? echo $payment->getPaymentdate(); ?> </td> 
                <td>  <a target="_blank" href="<? echo site_url('orders/paymentimg/' . $payment->getPayno()) ?>" class="btn" >
                        <i class="icon-picture"></i>ใบเสร็จ</a>   </td>
                </tr>
                <?php if ($payment->getActive() == 1): ?>
                    <? $countactive++;
                    $paidamount+=$payment->getAmount(); ?>
                <?php endif; ?>
    <? endforeach; ?>
<?php else: ?>
            <tr><td colspan="7" >  <h6>ยังไม่มีรายการชำระเงิน</h6>  </td></tr>


<?php endif; ?>
        </tbody>
    </table>

</div>
<div id="paystatus"  >
    <table >
        <tr>
            <td><strong>วันที่</strong></td>
            <td><? echo $order->getOrderdate(); ?></td>
        <tr>
            <td><strong>การชำระเงิน</strong></td> 
            <td><?php foreach ($ordpaylist as $ordpay): ?>
                    <?php if ($ordpay->getPaymethod() == $order->getPaymethod()): ?>
                        <? echo $ordpay->getDescription();
                        break;
                        ?>
    <?php endif; ?>
<?php endforeach; ?><br>
<? $showform = true; ?></td>
        </tr>

        <tr>
            <td><strong>รอบการจ่ายเงิน&nbsp;&nbsp;</strong></td>
            <td><?php if ($ordpay->getPaymethod() == '10'): ?>

                    <? $showform = ($countactive > 0) ? false : true;
                    echo $countactive;
                    ?>/1 ครั้ง
                <?php else: ?>
    <? $showform = ($countactive > 1) ? false : true;
    echo $countactive;
    ?>/2 ครั้ง

                <?php endif; ?></td>
        </tr>
        <tr><td><strong>ชำระครั้งต่อไป&nbsp;&nbsp;</strong></td><td> <?php if ($showform): ?>

    <? echo ($ordpay->getPaymethod() == '10') ? number_format($order->getTotalprice(), 2, '.', ',') : number_format($order->getTotalprice()/2, 2, '.', ',') ?>&nbsp;บาท

                <?php else: ?>
                    0.00&nbsp;บาท
                <?php endif; ?></td> </tr>
        <tr><td><strong>ค้างชำระ&nbsp;&nbsp;</strong></td><td> <?php if ($showform): ?>

    <? echo number_format( $order->getTotalprice() - $paidamount, 2, '.', ',') ?>&nbsp;บาท
<?php else: ?>
                    0.00&nbsp;บาท
<?php endif; ?></td> </tr>
        <tr><td><strong>ยอดทั้งหมด&nbsp;&nbsp;</strong></td><td><? echo number_format( $order->getTotalprice(), 2, '.', ',') ?>&nbsp;บาท </td> </tr>

    </table>
</div>
<?php if ($showform): ?>
    <div id ="payconfirm">
        <h4>Payment confirmation</h4>
        <form id="payform"  method="post" action="<? echo site_url('orders/addpayment'); ?>" enctype="multipart/form-data" id="payconfirmform" >
            <table border="0">
                <tr>
                    <td scope="row">เลขที่สลิป:</td>
                    <td ><input class="input-medium" id="slipno" name="slipno" type="text" /></td>
                </tr>
                <tr>
                    <td scope="row">วันทีี่ชำระเงิน<span class="req">*</span>:</td>
                    <td><input class="input-medium datepicker"  id="date"  name="date" type="text" /></td>
                </tr>
                <tr>
                    <td scope="row">เวลา<span class="req">*</span>:</td>
                    <td>ชั่วโมง<select style="width:20%;" name="hour"> 
                            <?php foreach ($hour as $index => $h): ?>

                                <option value="<? echo $index ?>"  >    <? echo $h ?>      </option>
                            <?php endforeach; ?>
                        </select> นาที<select style="width:20%;" name="min"> 
                        <?php foreach ($min as $index => $m): ?>

                                <option value="<? echo $index ?>"  >    <? echo $m ?>      </option>
                        <?php endforeach; ?>
                        </select>
                   <!-- วินาที<select style="width:20%;" name="sec"> 
    <?php foreach ($min as $index => $m): ?>
                                    <option value="<? echo $index ?>"  >    <? echo $m ?>      </option>
    <?php endforeach; ?>
                        </select>-->
                    </td>
                </tr>
                <tr>
                    <td scope="row">จำนวนเงิน<span class="req">*</span>:</td>
                    <td><input  class="input-medium" name="amount"  id="amount" type="text" value="0.00"/>
                        บาท</td>
                </tr>
                <tr>
                    <td scope="row">รูปภาพใบเสร็จ<span class="req">*</span>:</td>
                    <td><input  class="input-medium" name="pic"  id="pic" type="file" />
                    </td>
                </tr>
                <tr>
                    <th scope="row">&nbsp;</th>
                    <td><input type="submit" value="แจ้งชำระเงิน"  /></td>
                </tr>
            </table>
            <input type="hidden" name="ordno" value="<? echo $order->getOrderno(); ?>">
            <input type="hidden" name="nextpay" id="nextpay" value="<? echo ($ordpay->getPaymethod() == '10') ? $order->getTotalprice() : $order->getTotalprice() / 2 ?>">
        </form>
        <div  id="con" class="alert-error" ></div>
    </div>
<?php endif; ?>
</div>


<? $this->load->view(lang('footer')) ?>
<script>
    $().ready(function() {
        var nextpaid=parseInt($('#nextpay').val()).toFixed(2);
        $( ".datepicker" ).datepicker({
            buttonText: "..." ,
            showOn: "button",
            dateFormat: "yy-mm-dd"

        });
        
        $.validator.addMethod("checkextends", function(value) {	
            var result=false;
            if( value.lastIndexOf(".jpg")>=0)
                result=true;
            if( value.lastIndexOf(".png")>=0)
                result=true;
            return result;	
        }, 'Picture must be jpg or png');
        $.validator.addMethod("minus", function(value) {	
            var result=true;
            if( value.lastIndexOf("-")>=0)
                result=false;
          
            return result;	
        }, 'ไม่สามารถกรอกจำนวนลบได้');

        $("#payform").validate({
            errorLabelContainer: $("#con"),
             
            rules: {
                date:"required",
                amount:{
                    required: true,
                    number: true,
                    minus:true,
                    equalTo: "#nextpay"
                },
                pic:"checkextends"

            },messages: {
                date: "Please enter your date",
               
                amount:{
                    required: "Please enter amount",
                    number:"number",
                    equalTo: "ยอดชำระครั้งต่อไปต้องเท่ากับ "+nextpaid+"บาท"
                }
            }
            
            
            
        });
       
       
       
       
    });


</script>
<?
echo $this->session->flashdata('message');
error_log($this->session->flashdata('message') . 'sdfds');
?>