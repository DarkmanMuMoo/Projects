<style>
.red{
        color:#F00;
    }
</style>


<p style ="margin-bottom: 10px;">

<h4>การชำระเงิน&nbsp;<button id="swap" class="btn"onclick="swappaydetail();">แสดงรายละเอียด <i class="icon-chevron-up"></i></button></h4>
</p>

<? $countactive = 0;
$paidamount = 0;
?>
<div id="paydetail" >
    <hr></hr>
  <div id="result" align="center">
        <table class="table table-bordered">
            <thead>

            <th>เลขที่สลิป</th> 
            <th>รอบการจ่ายเงิน</th>
            <th>ราคารวม(บาท)</th>
            <th>สถานะ</th>
            <th>วันที่</th>
            <th>ภาพใบเสร็จ</th>
            </thead>
            <tbody>
                <?php if (!empty($paymentlist)): ?>
    <?php foreach ($paymentlist as $index => $payment): ?>

          <td><? echo $payment->getSeqno(); ?> </td> 
                    <td><? echo $payment->getPeriod() ?> </td> 
                    <td><? echo number_format($payment->getAmount(), 2, '.', ','); ?> &nbsp;</td> 
                    <td> <?php if ($payment->getActive() == '1'): ?>

                            <span class="label label-success">Success</span>

        <?php elseif ($payment->getActive() == '2'): ?>

                            <span class="label label-important">Rejects</span>

        <?php endif; ?></td>
                    <td><? echo $payment->getPaymentdate(); ?> </td> 
                    <td>  <a target="_blank" href="<? echo site_url('orders/paymentimg/' . $payment->getPayno()) ?>" class="btn" >
                            <i class="icon-picture"></i>ใบเสร็จ</a>   </td>
                    </tr>
                    <?php if ($payment->getActive() == 1): ?>
                        <? $countactive++;
                        $paidamount+=$payment->getAmount();
                        ?>
                    <?php endif; ?>
    <? endforeach; ?>
<?php else: ?>
                <tr><td colspan="7" >  <h6>ยังไม่มีรายการชำระเงิน</h6>  </td></tr>


<?php endif; ?>
            </tbody>
        </table>

    </div>
    
    
        <table width="692" >
          <!--  <tr>
                <td><strong>วันที่</strong></td>
                <td><? echo $order->getOrderdate(); ?></td>
            <tr>-->
                <td width="121"><strong>การชำระเงิน</strong></td> 
                <td width="215"><?php foreach ($ordpaylist as $ordpay): ?>
                        <?php if ($ordpay->getPaymethod() == $order->getPaymethod()): ?>
                            <?
                            echo $ordpay->getDescription();
                            break;
                            ?>
    <?php endif; ?>
<?php endforeach; ?><br>
<? $showform = true; ?></td>
       <td width="144"><strong>ยอดเงินที่ต้องชำระ&nbsp;&nbsp;</strong></td>
       <td width="192" ><strong><u><?php if ($showform): ?>

    <? echo ($ordpay->getPaymethod() == '10') ? number_format($order->getTotalprice(), 2, '.', ',') : number_format($order->getTotalprice() / 2, 2, '.', ',') ?>&nbsp;</u>บาท

                    <?php else: ?>
                        0.00&nbsp;บาท
                    <?php endif; ?></strong></td>     
            
            </tr>

            <tr>
                <td><strong>รอบการจ่ายเงิน&nbsp;&nbsp;</strong></td>
                <td><?php if ($ordpay->getPaymethod() == '10'): ?>

                        <?
                        $showform = ($countactive > 0) ? false : true;
                        echo $countactive;
                        ?>/1 ครั้ง
                    <?php else: ?>
                        <?
                        $showform = ($countactive > 1) ? false : true;
                        echo $countactive;
                        ?>/2 ครั้ง

                    <?php endif; ?></td>
             <td><strong>ค้างชำระ&nbsp;&nbsp;</strong></td>
             <td class="red"> 0.00 บาท </td>       
            </tr>
            <tr>
            <td></td>
            <td></td>
              <td><strong>ยอดทั้งหมด&nbsp;&nbsp;</strong></td>
              <td><? echo number_format($order->getTotalprice(), 2, '.', ',') ?>&nbsp;บาท&nbsp;</td>
          </tr>
            <tr>
            <td></td>
            <td></td> 
            </tr>
            <tr><td></td>
            <td></td> 
            </tr>

        </table>
</div>
<?php if ($showform && ($order->getOrdstatus() == 40 || $order->getOrdstatus() == 55)): ?>
        <div id ="payconfirm">
            <h4>แจ้งชำระเงิน</h4>
            <form id="payform"  method="post" action="<? echo site_url('orders/addpayment'); ?>" enctype="multipart/form-data" id="payconfirmform" >
                <table border="0">
                    <tr>
                        <td scope="row">เลขที่สลิป:</td>
                        <td ><input class="input-medium" id="slipno" name="slipno" type="text" /></td>
                    </tr>
                    <tr>
                        <td scope="row">วันทีี่ชำระเงิน<span class="red">*</span>:</td>
                        <td><input class="input-medium datepicker"  id="date"  name="date" type="text" /></td>
                    </tr>
                    <tr>
                        <td scope="row">เวลา<span class="red">*</span>:</td>
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
                        <td scope="row">จำนวนเงิน<span class="red">*</span>:</td>
                        <td><input  class="input-medium"  name="amount"  id="amount" type="text" />
                            บาท</td>
                    </tr>
                    <tr>
                        <td scope="row">รูปภาพใบเสร็จ<span class="red">*</span>:</td>
                        <td><input  class="input-medium" name="pic"  id="pic" type="file" />
                        </td>
                    </tr>
                    <tr>
                        <th scope="row">&nbsp;</th>
                        <td><input class="btn" type="submit" value="แจ้งชำระเงิน"  /></td>
                    </tr>
                </table>
                <input type="hidden" name="ordno" value="<? echo $order->getOrderno(); ?>">
                 <input type="hidden"  name="nextpayformat" id="nextpayformat" value="">
                <input type="hidden"  name="nextpay" id="nextpay" value="<? echo ($ordpay->getPaymethod() == '10') ? $order->getTotalprice() : $order->getTotalprice() / 2 ?>">
            </form>
            <div  id="con" class="alert-error" ></div>
        </div>
<?php endif; ?>
</div>
<script>
    function swappaydetail(){
        $('#swap i').toggleClass(function() {
  if ($(this).hasClass('icon-chevron-up')) {
    return 'icon-chevron-down';
  } else {
    return 'icon-chevron-up';
  }
});
        
        $('#paydetail').fadeToggle();
       // window.scrollTo(0,document.height);
    }
    $().ready(function() {
      
        $('#amount').priceFormat({
            prefix: '',
            suffix: '',
            clearPrefix: true,
            clearSufix: true
        });
           $('#nextpayformat').val(parseFloat($('#nextpay').val()).toFixed(2));
           $('#nextpayformat').priceFormat({
            prefix: '',
            suffix: '',
            clearPrefix: true,
            clearSufix: true
        });
      var nextpaid=$('#nextpayformat').val();
        
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
  

        $("#payform").validate({
            errorLabelContainer: $("#con"),
             
            rules: {
                date:"required",
                amount:{
                    required: true,
                    number: true,
                    equalTo: "#nextpayformat"
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