<? $this->load->view(lang('bakheader'));?>
<style>

    #result th{text-align: center;}
    #result td{text-align: center;}
</style>
<div class="container">
<div id="search-bar">  
            <form id="searchform"action="<? echo site_url('orders') ?>" class="form-search" align="center"  method="post">
                Keyword:<input type="text"  name="keyword" id="email" class="input-small datepicker" />
                From :<input type="text" name="fromdate" id="fromdate" class="input-small datepicker" />
                To:<input type="text" name="todate" id="todate"  class="input-small datepicker"  /> >
                
                Status: <select name="status" id="status" >    <?php foreach ($ordstatuslist as $ordstatus): ?>
                                
                    <option value="<?echo $ordstatus->getStatus();?>" >   <? echo $ordstatus->getDescription();  ?></option>
                              
                                 <?php endforeach; ?></select>
                
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
                    Custormer
                </th>
                <th>
                    Email
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
                    <?php foreach ($orderlist as $index => $ord): ?>
                        <tr> <td  ><? echo $index + 1 ?> </td>  
                            <td  >
                                
                                    <? echo $ord->getOrderno(); ?> 
                              
                            </td> 
                            <td>
                                
                            </td>
                            <td > <? echo $ord->getOrderdate(); ?> </td>
                            <td >
                                 <?php foreach ($ordstatuslist as $ordstatus): ?>
                                <?php if ($ordstatus->getStatus() ==$ord->getOrdstatus() ): ?>
                                <? echo $ordstatus->getDescription(); break; ?>
                               <?php endif; ?>
                                 <?php endforeach; ?>
                            </td> 
                            <td style="text-align: right;" ><? echo $ord->getTotalprice(); ?> </td>                      
                            <td >
                                <a class="btn btn-info" href="<?echo site_url('orders/vieworderdetail') . "/" . $ord->getOrderno(); ?>"> 
                                   View
                                </a>
                                <button class="btn btn-danger" onclick="Confirmdelete('<? echo $ord->getOrderno();?>');" >cancle </button> 
                            </td>  
                        </tr>
                    <?php endforeach; ?>


                </tbody>

            </table>


        </div>
</div>










<? $this->load->view(lang('bakfooter'));?>