  <? $this->load->view(lang('header')) ?>
          <style> 
              #paystasut{clear: both; margin :10 auto ; padding: 5 5;}
            
              #result th{text-align: center;}
    #result td{text-align: center;}
</style>
<div id="page">
    <? $countactive=0; ?>
    <div id="result" align="center">
    <table class="table table-bordered">
        <thead>
        <th>No</th>
             <th>Payno</th>
              <th>Orderno</th> 
              <th>Period</th>
               <th>Amount</th>
                <th>Active</th>
                  <th>Date</th>
        </thead>
        <tbody>
            <?php if (!empty($paymentlist)): ?>
            <?php foreach ($paymentlist as $index => $payment): ?>
        <tr> <td> <? echo $index+1 ;?> </td> 
               <td><? echo $payment->getOrderno();?> </td> 
            <td><? echo $payment->getPayno();?> </td> 
         <td><? echo $payment-> getPeriod()?> </td> 
         <td><? echo $payment->getAmount();?> </td> 
          <td><? echo $payment->getActive();?> </td> 
         <td><? echo $payment->getPaymentdate();?> </td> 
      
        </tr>
        <? if($payment->getActive()=='1'){ $countactive++;  }  ?>
            <? endforeach; ?>
        <?php else: ?>
        <tr><td colspan="7" >  <h6>ยังไม่มีรายการชำระเงิน</h6>  </td></tr>
        
        
        <?php endif; ?>
        </tbody>
    </table>
       
    </div>
    <div id="paystatus"  >

              Orderdate : <? echo $order->getOrderdate(); ?><br>
            Paymethod : <?php foreach ($ordpaylist as $ordpay): ?>
                <?php if ($ordpay->getPaymethod() == $order->getPaymethod()): ?>
                    <? echo $ordpay->getDescription();  break;?>
                <?php endif; ?>
            <?php endforeach; ?><br>
            Period: <?php if ($ordpay->getPaymethod() == '10'): ?>
            <? echo $countactive ;?>/1 Time
      <?php else: ?>
              <? echo $countactive ; ?>/2 Time
            
             <?php endif; ?>
        </div>
    
    <div id ="payconfirm">
        <h4>Payment confirmation</h4>
        <form id="payconfirmform" >
            <table width="365" border="0">
  <tr>
    <td width="97" scope="row">เลขที่สลิป:</td>
    <td width="258"><input name="slipno" type="text" /></td>
    </tr>
  <tr>
    <td scope="row">วันทีี่ชำระเงิน:</td>
    <td><input name="date" type="text" /></td>
    </tr>
  <tr>
    <td scope="row">เวลา:</td>
    <td><input type="text" />
       </tr>
  <tr>
    <td scope="row">จำนวนเงิน:</td>
    <td><input name=" " type="text" value="0.00"/>
      บาท</td>
    </tr>
  <tr>
    <th scope="row">&nbsp;</th>
    <td>&nbsp;</td>
    </tr>
</table>

            
            
        </form>
 
    </div>
</div>


  <? $this->load->view(lang('footer')) ?>