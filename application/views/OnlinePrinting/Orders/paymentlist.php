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
   
</style>
<div id="page">
    <? $countactive=0; ?>
    <div id="result" align="center">
    <table class="table table-bordered">
        <thead>
        <th>No</th>
             <th>Payno</th>
              <th>Seqno</th> 
              <th>Period</th>
               <th>Amount</th>
                <th>Active</th>
                  <th>Date</th>
        </thead>
        <tbody>
            <?php if (!empty($paymentlist)): ?>
            <?php foreach ($paymentlist as $index => $payment): ?>
        <tr> <td> <? echo $index+1 ;?> </td> 
               <td><? echo $payment->Seqno();?> </td> 
            <td><? echo $payment->getPayno();?> </td> 
         <td><? echo $payment-> getPeriod()?> </td> 
         <td><? echo $payment->getAmount();?> </td> 
          <td><? echo $payment->getActive();?> </td> 
         <td><? echo $payment->getPaymentdate();?> </td> 
      
        </tr>
        <?  $countactive++;    ?>
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
  <?php if ($showform): ?>
    <div id ="payconfirm">
        <h4>Payment confirmation</h4>
        <form id="payform"  method="post" action="<?  echo site_url('orders/addpayment') ;?>" enctype="multipart/form-data" id="payconfirmform" >
            <table border="0">
  <tr>
    <td scope="row">เลขที่สลิป:</td>
    <td ><input class="input-medium" id="slipno" name="slipno" type="text" /></td>
    </tr>
  <tr>
    <td scope="row">วันทีี่ชำระเงิน:</td>
    <td><input class="input-medium datepicker"  id="date"  name="date" type="text" /></td>
    </tr>
  <tr>
    <td scope="row">เวลา:</td>
    <td>ชั่วโมง<select style="width:20%;" name="hour"> 
            <?php foreach ($hour as $index => $h): ?>
            
            <option value="<?echo $index?>"  >    <? echo $h ?>      </option>
             <?php endforeach; ?>
        </select> นาที<select style="width:20%;" name="min"> 
            <?php foreach ($min as $index => $m): ?>
            
            <option value="<?echo $index?>"  >    <? echo $m ?>      </option>
             <?php endforeach; ?>
        </select>
    วินาที<select style="width:20%;" name="sec"> 
            <?php foreach ($min as $index => $m): ?>
            <option value="<?echo $index?>"  >    <? echo $m ?>      </option>
             <?php endforeach; ?>
        </select>
    </td>
       </tr>
  <tr>
    <td scope="row">จำนวนเงิน:</td>
    <td><input  class="input-medium" name="amount"  id="amount" type="text" value="0.00"/>
      บาท</td>
    </tr>
     <tr>
    <td scope="row">รูปภาพใบเสร็จ:</td>
    <td><input  class="input-medium" name="pic"  id="pic" type="file" />
      </td>
    </tr>
  <tr>
    <th scope="row">&nbsp;</th>
    <td><input type="submit" value="แจ้งชำระเงิน"  /></td>
    </tr>
</table>
            <input type="hidden" name="ordno" value="<? echo $order->getOrderno(); ?>">
            
        </form>
        <div  id="con" class="alert-error" ></div>
    </div>
      <?php endif; ?>
</div>


  <? $this->load->view(lang('footer')) ?>
<script>
   $().ready(function() {
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
                slipno:{
                    required: true,
                    digits: true
                },
                amount:{
                    required: true,
                    digits: true
                },
                pic:"checkextends"
              
                      
                        
            },messages: {
                date: "Please enter your date",
                slipno: {
                    required: "Please enter slipno",
                   digits:"number"
                },
                 amount:{
                    required: "Please enter amount",
                   digits:"number"
                }
            }
            
            
            
        });
       
       
       
       
   });


</script>
<?  echo  $this->session->flashdata('message');
  error_log($this->session->flashdata('message').'sdfds');
?>