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
           $('#<? echo $hilight; ?>').addClass('hilight');
        
    });      
      
</script>
<style>
    .hilight{
        
        background-color: #faa732;
    }
    #result th{text-align: center;}
    #result td{text-align: center;}
    #statuslist> li > a:hover{
text-decoration: none;
background-color: #faa732;
        
    }
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
                    Management
                </th>
                </thead>

                <tbody>
                    <?php foreach ($orderlist as $index => $ord): ?>
                        <tr> <td  ><? echo $index + 1 ?> </td>  
                            <td  >
                               
                                    <? echo $ord->getOrderno(); ?> 
                               
                            </td> 
                            <td > <? echo $ord->getOrderdate(); ?> </td>
                            <td >
                                 <?php foreach ($ordstatuslist as $status): ?>
                                <?php if ($status->getStatus() ==$ord->getOrdstatus() ): ?>
                                <? echo $status->getDescription(); break; ?>
                               <?php endif; ?>
                                 <?php endforeach; ?>
                            </td> 
                            <td style="text-align: right;" ><? echo $ord->getTotalprice(); ?> </td>                      
                            <td >
                                 <a class="btn btn-info" href="<?echo site_url('orders/vieworderdetail') . "/" . $ord->getOrderno(); ?>"> 
                                   View
                                </a>
                                <?php if ($ord->getOrdstatus()<=20): ?>
                                <button class="btn btn-danger" onclick="Confirmdelete('<? echo $ord->getOrderno();?>');" >cancel </button> 
                                 <?php endif; ?>
                                 <?php if ($ord->getOrdstatus()>30): ?>
                                <a href="<? echo site_url('orders/getpaymentlist'). "/" . $ord->getOrderno();    ?>" class="btn btn-warning" >Payment</a> 
                                 <?php endif; ?>
                                
                            </td>  
                        </tr>
                    <?php endforeach; ?>


                </tbody>

            </table>


        </div>

    </div >
    <div id="sidebar">
        <h2>My Order</h2>
     

        <ul id="statuslist"class="nav nav-tabs nav-stacked">
      
            <li><a id="0" href="JavaScript:void(0);" onclick="Searchstatus('');">all</a></li>
                <?php foreach ($ordstatuslist as $ord): ?>
                <li ><a id="<? echo $ord->getStatus(); ?>" href="JavaScript:void(0);" onclick="Searchstatus('<? echo $ord->getStatus(); ?>');"><? echo $ord->getDescription() ?></a>
                    </li>
                <?php endforeach; ?>
            </ul> 

       
    </div>

</div>


<? $this->load->view(lang('footer')) ?>