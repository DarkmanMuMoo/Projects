<? $this->load->view(lang('bakheader')); ?>

<div class="container" >
     <style> 
              #paystasut{clear: both; margin :10 auto ; padding: 5 5;}
              #result{
                  
                  margin-top: 100px;
                  margin-left: auto;
                  margin-right: auto;
                  margin-bottom: 10px;
              }
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
   
</style>
      <? $countactive=0; ?>
    <div id="result" >
    <table class="table table-bordered">
        <h2>รายละเอียดงาน</h2>
      <hr align="center" size="3" color="#C3C3C3">  </div>
        <thead>
        <th>No</th>
             <th>Payno</th>
              <th>Seqno</th> 
              <th>Period</th>
               <th>Amount</th>
               <th>Date</th>
                <th>Active</th>
                  
        </thead>
        <tbody>
            <?php if (!empty($paymentlist)): ?>
            <?php foreach ($paymentlist as $index => $payment): ?>
        <tr> <td> <? echo $index+1 ;?> </td> 
               <td><? echo $payment->getPayno();?> </td> 
            <td><? echo $payment->getSeqno();?> </td> 
         <td><? echo $payment-> getPeriod()?> </td> 
         <td><? echo $payment->getAmount();?> </td> 
          <td><? echo $payment->getPaymentdate();?></td> 
         <td><?php if ($payment->getActive() == '1'): ?>
             <span class="label label-success">Active</span>
             <?  $countactive++;    ?>
          <?php else: ?>
             <button class="btn btn-danger" onclick="settoactive('<? echo $payment->getPayno();?>');" >set to active</button>
                 <?php endif; ?>
         </td> 
      
        </tr>
        
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
            <? $showform=true;  ?>
            Period: <?php if ($ordpay->getPaymethod() == '10'): ?>
            
            <?   $showform=($countactive>0)? false:true; echo $countactive ;?>/1 Time
      <?php else: ?>
              <? $showform=($countactive>1)? false:true; echo $countactive ; ?>/2 Time
            
             <?php endif; ?>
        </div>
    
<form id="settoactive" action="<?echo site_url('Backend/bakorders/settoactive');?>"  method="post">
    <input  type="hidden" name="orderno" value="<? echo $order->getOrderno();?>"/>
     <input type="hidden"  name="payno" value=""/>
     <input  type="hidden"name="paymethod" value="<? echo $order->getPaymethod();?>" >
     <input type="hidden" name="countactive" value="<? echo $countactive;?>"
</form>
    
    </div>
<? $this->load->view(lang('bakfooter')); ?>

    <script>
    
    function settoactive(payno){
        
        var test=$('#settoactive input[name=payno]');
        test.val(payno);
      
        $('#settoactive').submit();
    }
    </script>