<? $this->load->view(lang('bakheader'));?>

<div class="container" >
    <style>

    #result th{text-align: center;}
    #result td{text-align: center;}
</style>
<div id="search-bar" style="margin-top: 100px;">  
            <form id="searchform"action="<? echo site_url('orders') ?>" class="form-search" align="center"  method="post">
                Keyword:<input type="text"  name="keyword" id="email" class="input-small datepicker" />
                From :<input type="text" name="fromdate" id="fromdate" class="input-small datepicker" />
                To:<input type="text" name="todate" id="todate"  class="input-small datepicker"  /> 
                
                Status: <select name="status" id="status" >    <?php foreach ($ordstatuslist as $pos): ?>
                                
                    <option value="<?echo $pos->getStatus();?>">  <? echo $pos->getDescription();  ?></option>
                              
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
                  
                </th>
                </thead>

                <tbody>
                    <?php foreach ($orderlist as $index => $emp): ?>
                        <tr> <td  ><? echo $index + 1 ?> </td>  
                            <td  >
                                
                                    <? echo $emp->getOrderno(); ?> 
                              
                            </td> 
                            <td>
                                 <? echo $emp->getCusname(); ?> &nbsp; <? echo $emp->getLastname(); ?> 
                            </td>
                                <td>
                                 <? echo $emp->getEmail(); ?>
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
                              
                            </td>  
                        </tr>
                    <?php endforeach; ?>


                </tbody>

            </table>


        </div>
</div>










<? $this->load->view(lang('bakfooter'));?>