  <? $this->load->view(lang('header')) ?>
          <style> 
            
              #result th{text-align: center;}
    #result td{text-align: center;}
</style>
<div id="page">
    <div id="result" align="center">
    <table>
        <thead>
        <th>No</th>
             <th>Payno</th>
              <th>Orderno</th> 
              <th>Period</th>
              
               <th>Amount</th>
                  <th>Date</th>
        </thead>
        <tbody>
            <?php foreach ($paymentlist as $index => $payment): ?>
        <tr> <td> <? echo $index+1 ;?> </td> 
               <td><? echo $payment->getOrderno();?> </td> 
            <td><? echo $payment->getPayno();?> </td> 
         <td><? echo $payment-> getPeriod()?> </td> 
         <td><? echo $payment->getAmount();?> </td> 
         <td><? echo $payment->getPaymentdate();?> </td> 
      
        </tr>
            <? endforeach; ?>
        </tbody>
    </table>
        <div id="paystatus" >
        
        
        
        </div>
    </div>
</div>


  <? $this->load->view(lang('footer')) ?>