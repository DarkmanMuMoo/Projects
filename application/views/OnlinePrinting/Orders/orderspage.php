  <? $this->load->view(lang('header')) ?>
<script>

        $(document).ready(function(){
$( ".datepicker" ).datepicker({
 buttonText: "..." ,
 showOn: "button",
 dateFormat: "yy-mm-dd"

});
 });      
      
</script>
<style>
    
    #result th{text-align: center;}
    #result td{text-align: center;}
</style>
<div id="page">
    <div id ="content">
    <div id="search-bar">  
        <form action="<? echo site_url('orders') ?>" class="form-search" align="center"  method="post">
      
        From :<input type="text" name="fromdate" id="fromdate" class="input-small datepicker" >
         To:<input type="text" name="todate" id="todate"  class="input-small datepicker"   >
  <button type="submit" class="btn">Search</button>
  </form>
    </div>
    <div id="result"  align="center">
    <table class="table table-bordered" >
        <thead>
        <th>
            Number
        </th>
         <th>
           Orderno 
        </th>
         <th>
            Date
        </th>
         <th>
            Status
        </th>
         <th>
            Total-Price
        </th>
          <th>
           Cancle Order
        </th>
        </thead>
        
        <tbody>
             <?php foreach ($orderlist as $index=>$ord): ?>
            <tr> <td  ><?echo $index+1?> </td>  
                <td  >
                    <a href="<?site_url('orders/vieworderdetail')."/".$ord->getOrderno();?>"> 
                    <?echo $ord->getOrderno(); ?> 
                    </a>
                </td> 
                <td > <?echo $ord->getOrderdate(); ?> </td>
                <td >
                    <?echo $ord->getOrdstatus(); ?>
                </td> 
                <td style="text-align: right;" ><?echo $ord->getTotalprice(); ?> </td>                      
                <td >
                    <a href="<? echo site_url('orders/cancleorder')."/".$ord->getOrderno(); ?>" >cancle</a> 
                </td>  
            </tr>
            <?php endforeach; ?>
            
            
        </tbody>
        
    </table>

    
    </div>
    
    </div >
    <div id="sidebar">
        <h2>Order Summary</h2>
        <div style="margin: o auto; padding-left: 10%; padding-top: 5%" >
            
        <ul>
            <li>all</li>
            <?php foreach ($ordstatuslist as $ordstatus): ?>
            <li ><a href="<? echo $ordstatus->getStatus() ?>"><? echo $ordstatus->getDescription() ?></a>
                    </li>
            <?php endforeach; ?>
        </ul> 
  
        </div>
    </div>
    
</div>


  <? $this->load->view(lang('footer')) ?>