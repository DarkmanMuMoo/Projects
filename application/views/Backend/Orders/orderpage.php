<? $this->load->view(lang('bakheader'));?>

<div class="container" >
    <style>

    #result th{text-align: center;}
    #result td{text-align: center;}
</style>
<div id="search-bar" style="margin-top: 100px;">  
            <form id="searchform"action="<? echo site_url('Backend/bakorder') ?>" class="form-search" align="center"  method="post">
                Keyword:<input type="text"  name="keyword" id="email" class="input-small" />
                From :<input type="text" name="fromdate" id="fromdate" class="input-small datepicker" />
                To:<input type="text" name="todate" id="todate"  class="input-small datepicker"  /> 
                
                Status: <select name="status" id="status" >    <?php foreach ($ordstatuslist as $emp): ?>
                                
                    <option value="<?echo $emp->getStatus();?>">  <? echo $emp->getDescription();  ?></option>
                              
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
                    <?php foreach ($orderlist as $index => $work): ?>
                        <tr> <td  ><? echo $index + 1 ?> </td>  
                            <td  >
                                
                                    <? echo $work->getOrderno(); ?> 
                              
                            </td> 
                            <td>
                                 <? echo $work->getCusname(); ?> &nbsp; <? echo $work->getLastname(); ?> 
                            </td>
                                <td>
                                 <? echo $work->getEmail(); ?>
                            </td>
                            <td > <? echo $work->getOrderdate(); ?> </td>
                            <td >
                                 <?php foreach ($ordstatuslist as $emp): ?>
                                <?php if ($emp->getStatus() ==$work->getOrdstatus() ): ?>
                                <? echo $emp->getDescription(); break; ?>
                               <?php endif; ?>
                                 <?php endforeach; ?>
                            </td> 
                            <td style="text-align: right;" ><? echo $work->getTotalprice(); ?> </td>                      
                            <td >
                                <a class="btn btn-info" href="<?echo site_url('Backend/bakorders/vieworderdetail') . "/" . $work->getOrderno(); ?>"> 
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
<script>




    $(document).ready(function(){
        $( ".datepicker" ).datepicker({
            buttonText: "..." ,
            showOn: "button",
            dateFormat: "yy-mm-dd"

        });
    });   

</script>