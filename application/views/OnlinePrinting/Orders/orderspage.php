<? $this->load->view(lang('header')) ?>
<script>
    function Searchstatus (ordstatus){
    
        $('#status').attr('value',ordstatus);
        $('#fromdate').attr('value','');
        $('#todate').attr('value','');
        $('#searchform').submit();
    }
    function Confirmdelete(orderno)

    {

        if(confirm('Do you want to visit delete this order information')==true)

        {

              $.post('<? echo site_url('orders/cancleorder')?>/'+orderno, function(data){
                  //alert(data);
                  eval(data);

              });

        }

      

    }
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
            <form id="searchform"action="<? echo site_url('orders') ?>" class="form-search" align="center"  method="post">

                From :<input type="text" name="fromdate" id="fromdate" class="input-small datepicker" >
                To:<input type="text" name="todate" id="todate"  class="input-small datepicker"   >
                <input type="hidden" name="status" id="status"    >
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
                    Cancel Order
                </th>
                </thead>

                <tbody>
                    <?php foreach ($orderlist as $index => $order): ?>
                        <tr> <td  ><? echo $index + 1 ?> </td>  
                            <td  >
                               
                                    <? echo $order->getOrderno(); ?> 
                               
                            </td> 
                            <td > <? echo $order->getOrderdate(); ?> </td>
                            <td >
                                 <?php foreach ($ordstatuslist as $pos): ?>
                                <?php if ($pos->getStatus() ==$order->getOrdstatus() ): ?>
                                <? echo $pos->getDescription(); break; ?>
                               <?php endif; ?>
                                 <?php endforeach; ?>
                            </td> 
                            <td style="text-align: right;" ><? echo $order->getTotalprice(); ?> </td>                      
                            <td >
                                 <a class="btn btn-info" href="<?echo site_url('orders/vieworderdetail') . "/" . $order->getOrderno(); ?>"> 
                                   View
                                </a>
                                <?php if ($order->getOrdstatus()=='10'||$order->getOrdstatus()=='40'): ?>
                                <button class="btn btn-danger" onclick="Confirmdelete('<? echo $order->getOrderno();?>');" >cancel </button> 
                                 <?php endif; ?>
                                 <?php if ($order->getOrdstatus()=='30'): ?>
                                <a href="<? echo site_url('orders/getpaymentlist'). "/" . $order->getOrderno();    ?>" class="btn btn-warning" >Payment</a> 
                                 <?php endif; ?>
                                
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
                <li><a href="JavaScript:void(0);" onclick="Searchstatus('');">all</a></li>
                <?php foreach ($ordstatuslist as $pos): ?>
                    <li ><a href="JavaScript:void(0);" onclick="Searchstatus('<? echo $pos->getStatus(); ?>');"><? echo $pos->getDescription() ?></a>
                    </li>
                <?php endforeach; ?>
            </ul> 

        </div>
    </div>

</div>


<? $this->load->view(lang('footer')) ?>