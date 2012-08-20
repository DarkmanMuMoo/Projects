<? $this->load->view(lang('bakheader')); ?>

<div class="container" >
    <style>
.table th, .table td {
padding: 5px;
line-height: 18px;
vertical-align: middle;
border-top: 1px solid #DDD;
}
        #result th{text-align: center;}
        #result td{text-align: center;}
    </style>
   <div style="margin-top: 100px; margin-left: auto; margin-right: auto; margin-bottom: 20px;"> 
        <h2>รายการสั่งซื้อ</h2>
      <hr align="center" size="3" color="#C3C3C3">  </div>    

    <div id="search-bar" >  
        <form id="searchform"action="<? echo site_url('Backend/bakorders') ?>" class="form-search" align="center"  method="post">
            Keyword:<input type="text"  name="keyword" id="email" class="input-small" />
            From :<input type="text" name="fromdate" id="fromdate" class="input-small datepicker" />
            To:<input type="text" name="todate" id="todate"  class="input-small datepicker"  /> 

            Status: <select name="status" id="status" >   
                <option value="" >all</option>
                <?php foreach ($ordstatuslist as $ord): ?>

                    <option value="<? echo $ord->getStatus(); ?>">  <? echo $ord->getDescription(); ?></option>

                <?php endforeach; ?></select>

            <button type="submit" class="btn">Search</button>
        </form>
    </div>
    <div id="result"  align="center">
        <table class="table table-bordered" >
            <thead>
            <th>
                ลำดับ
            </th>
            <th>
                รหัสสั่งซื้อ 
            </th>
            <th>
                ชื่อลูกค้า
            </th>
            <th>
                อีเมลล์
            </th>
            <th>
                วันที่
            </th>
            <th>
                สถานะ
            </th>
            <th>
                ราคารวม
            </th>
            <th>

            </th>
            </thead>

            <tbody>
                <?php foreach ($orderlist as $index => $ord): ?>
                    <tr> <td  ><? echo $index + 1 ?> </td>  
                        <td  >

                            <? echo $ord->getOrderno(); ?> 

                        </td> 
                        <td>
                            <? echo $ord->getCusname(); ?> &nbsp; <? echo $ord->getLastname(); ?> 
                        </td>
                        <td>
                            <? echo $ord->getEmail(); ?>
                        </td>
                        <td > <? echo $ord->getOrderdate(); ?> </td>
                        <td >
                            <?php foreach ($ordstatuslist as $ordstatus): ?>
                                <?php if ($ordstatus->getStatus() == $ord->getOrdstatus()): ?>
                                    <? echo $ordstatus->getDescription();
                                    break;
                                    ?>
                                <?php endif; ?>
    <?php endforeach; ?>
                        </td> 
                        <td style="text-align: right;" ><? echo $ord->getTotalprice(); ?> </td>                      
                        <td >
                            <a class="btn btn-info" href="<? echo site_url('Backend/bakorders/vieworderdetail') . "/" . $ord->getOrderno(); ?>"> 
                                View
                            </a>
                            <?php if ($ord->getOrdstatus() >= 40): ?>
                                <a href="<? echo site_url('Backend/bakorders/getpaymentlist') . "/" . $ord->getOrderno(); ?>" class="btn btn-warning" >Payment</a> 
                            <?php endif; ?>
                        </td>  
                    </tr>
<?php endforeach; ?>


            </tbody>

        </table>


    </div>
</div>










<? $this->load->view(lang('bakfooter')); ?>
<script>




    $(document).ready(function(){
        $( ".datepicker" ).datepicker({
            buttonText: "..." ,
            showOn: "button",
            dateFormat: "yy-mm-dd"

        });
    });   

</script>