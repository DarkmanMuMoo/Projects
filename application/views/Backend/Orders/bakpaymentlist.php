<h2>การชำระเงิน&nbsp;<button id="swap" class="btn"onclick="swappaydetail();">รายละเอียด<i class="icon-chevron-up"></i></button></h2>
<hr align="center" size="3" color="#C3C3C3">  
<? $countactive = 0;
$paidamount = 0;
?>
<div id="paydetail" >
    <div id="result" >
        <table class="table table-bordered">

            <thead>

            <th>Seqno</th> 
            <th>Period</th>
            <th>Amount</th>
            <th>Date</th>
            <th>Active</th>
            <th>Picture</th>
            </thead>
            <tbody>
                <?php if (!empty($paymentlist)): ?>
    <?php foreach ($paymentlist as $index => $payment): ?>


                    <td><? echo $payment->getSeqno(); ?> </td> 
                    <td><? echo $payment->getPeriod() ?> </td> 
                    <td><? echo number_format($payment->getAmount(), 2, '.', ','); ?>  &nbsp; บาท</td> 
                    <td><? echo $payment->getPaymentdate(); ?></td> 
                    <td>  <a target="_blank" href="<? echo site_url('orders/paymentimg/' . $payment->getPayno()) ?>" class="btn" >ใบเสร็จ</a>   </td>
                    <td><?php if ($payment->getActive() == '1'): ?>
                            <span class="label label-success">Active</span>
                            <? $countactive++; ?>
        <?php elseif ($payment->getActive() == '2'): ?>

                            <span class="label label-important">Reject</span>

        <?php else: ?>

                            <button class="btn btn-success" onclick="settoactive('<? echo $payment->getPayno(); ?>');" >set to active</button>
                             <button class="btn btn-danger" onclick="Reject('<? echo $payment->getPayno(); ?>');" >Rejects</button>
        <?php endif; ?>
                    </td> 

                    </tr>
                    <?php if ($payment->getActive() == 1): ?>
                        <? $paidamount+=$payment->getAmount(); ?>
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
          <!--  <tr>
                <td><strong>วันที่</strong></td>
                <td><? echo $order->getOrderdate(); ?></td>
            <tr>-->
                <td width="121"><strong>การชำระเงิน</strong></td> 
                <td width="154"><?php foreach ($ordpaylist as $ordpay): ?>
                        <?php if ($ordpay->getPaymethod() == $order->getPaymethod()): ?>
                            <?
                            echo $ordpay->getDescription();
                            break;
                            ?>
                        <?php endif; ?>
                    <?php endforeach; ?><br>
<? $showform = true; ?></td>
<td width="143"><strong>ยอดเงินที่ต้องชำระ&nbsp;&nbsp;</strong></td>
<td width="213"><strong><u><?php if ($showform): ?>

                        <? echo ($ordpay->getPaymethod() == '10') ? number_format($order->getTotalprice(), 2, '.', ',') : number_format($order->getTotalprice() / 2, 2, '.', ',') ?>&nbsp;บาท

                    <?php else: ?>
                        0.00&nbsp;บาท
<?php endif; ?></strong></u></td>
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
<td class="red"><?php if ($showform): ?>

                        <? echo number_format($order->getTotalprice() - $paidamount, 2, '.', ',') ?>&nbsp;บาท
                    <?php else: ?>
                        0.00&nbsp;บาท
<?php endif; ?></td>
            </tr>
            <tr><td>&nbsp;</td><td>&nbsp;</td> 
<td><strong>ยอดทั้งหมด&nbsp;&nbsp;</strong></td>
<td><? echo number_format($order->getTotalprice(), 2, '.', ',') ?>&nbsp;บาท </td>
</tr>
            

        </table>
  </div>

    <form id="settoactive" action="<? echo site_url('Backend/bakorders/settoactive'); ?>"  method="post">
        <input  type="hidden" name="orderno" value="<? echo $order->getOrderno(); ?>"/>
        <input type="hidden"  name="payno" value=""/>
        <input  type="hidden"name="paymethod" value="<? echo $order->getPaymethod(); ?>" /> 
        <input type="hidden" name="countactive" value="<? echo $countactive; ?>"/>
    </form>
    <form id="Reject" action="<? echo site_url('Backend/bakorders/rejectpayment'); ?>"  method="post">
        <input  type="hidden" name="orderno" value="<? echo $order->getOrderno(); ?>"/>
        <input type="hidden"  name="payno" value=""/>
     
    </form>
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
    
    }
    function settoactive(payno){
        
        var test=$('#settoactive input[name=payno]');
        test.val(payno);
      
        $('#settoactive').submit();
    }
     function Reject(payno){
        
        var test=$('#Reject input[name=payno]');
        test.val(payno);
      
        $('#Reject').submit();
    }
</script>