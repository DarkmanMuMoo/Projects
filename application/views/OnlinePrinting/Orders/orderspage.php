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
                    Cancle Order
                </th>
                </thead>

                <tbody>
                    <?php foreach ($orderlist as $index => $emp): ?>
                        <tr> <td  ><? echo $index + 1 ?> </td>  
                            <td  >
                               
                                    <? echo $emp->getOrderno(); ?> 
                               
                            </td> 
                            <td > <? echo $emp->getOrderdate(); ?> </td>
                            <td >
                                 <?php foreach ($ordstatuslist as $pos): ?>
                                <?php if ($pos->getStatus() ==$emp->getOrdstatus() ): ?>
                                <? echo $pos->getDescription(); break; ?>
                               <?php endif; ?>
                                 <?php endforeach; ?>
                            </td> 
                            <td style="text-align: right;" ><? echo $emp->getTotalprice(); ?> </td>                      
                            <td >
                                 <a class="btn btn-info" href="<?echo site_url('orders/vieworderdetail') . "/" . $emp->getOrderno(); ?>"> 
                                   View
                                </a>
                                <button class="btn btn-danger" onclick="Confirmdelete('<? echo $emp->getOrderno();?>');" >cancle </button> 
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