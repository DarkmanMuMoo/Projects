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
            //ใส่อะไรดีช่วยกัน  think  หน่อย;
            
            
        </form>
 
    </div>
</div>


  <? $this->load->view(lang('footer')) ?>