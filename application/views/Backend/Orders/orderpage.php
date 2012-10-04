<? $this->load->view(lang('bakheader')); ?>

<div class="container" >
    <style>
        .table th, .table td {
            padding: 5px;
            line-height: 18px;
            vertical-align: middle;
            border-top: 1px solid #DDD;

        }
        #result th{text-align: center;
                   font-size: 12px;}
        #result td{text-align: center;font-size: 15px;}

        hr{ text-align:center;
            color:#09F;
            border-color:#09F;
            size:3;
        }
        h1{ font-weight:bolder;
        }
        .dropdown-menu a{
            
            text-align: left;
        }
        .red{
        color:#F00;
    }

    .blue{
        color:#09C;	
    }
    </style>
    <div class="header"> 
        <h1>รายการสั่งซื้อ</h1>
        <hr />  </div>    

    <div id="search-bar" >  
        <form id="searchform"action="<? echo site_url('Backend/bakorders') ?>" class="form-search" align="center"  method="post">
            ค้นหา:<input type="text"  name="keyword" id="email" class="input-small"  value="<? echo $this->input->post('keyword'); ?>"/>
            จากวันที่ :<input type="text" name="fromdate" id="fromdate" class="input-small datepicker"  value="<? echo $this->input->post('fromdate'); ?>"/>
            ถึง:<input type="text" name="todate" id="todate"  class="input-small datepicker"  value="<? echo $this->input->post('todate'); ?>" /> 

            สถานะ: 
            <select name="status" id="status" >   
                <option value="" >ทั้งหมด</option>
                <?php foreach ($ordstatuslist as $ord): ?>

                    <option  <? echo ($this->input->post('status') == $ord->getStatus()) ? 'selected="selected"' : ''; ?> value="<? echo $ord->getStatus(); ?>">  <? echo $ord->getDescription(); ?></option>

                <?php endforeach; ?></select>
            <input type="hidden" name="startrow" value="0"/>
            <button type="submit" class="btn">Search</button>
        </form>
    </div>
    <div id="result"  align="center">
        <table class="table table-bordered" >
            <thead>
            <th>
                #
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
                ราคารวม(บาท)
            </th>
            <th>

            </th>
            </thead>

            <tbody>
                <? $page = ($this->input->post('startrow')) ? $this->input->post('startrow') : 0; ?>
                <?php foreach ($orderlist as $index => $ord): ?>
                    <tr> <td  ><? echo $index + 1 + $page ?> </td>  
                        <td style="width:52px;" >

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
                             <span   <?echo ($ordstatus->getStatus()==10)?'class="red"':'class="blue"'; ?> >
                                    <?
                                    echo $ordstatus->getDescription();
                                    break;
                                    ?>
                             </span>
                                <?php endif; ?>
                            <?php endforeach; ?>
                        </td> 
                        <td style="text-align: right;" ><? echo number_format($ord->getTotalprice(), 2, '.', ','); ?></td>                      
                        <td >

                            <div class="btn-group">
                                <a class="btn btn-info" href="<? echo site_url('Backend/bakorders/vieworderdetail') . "/" . $ord->getOrderno(); ?>"> 
                                    View
                                </a>
                                <a class="btn btn-info dropdown-toggle" data-toggle="dropdown" style="height: 18px;">
                                    <span class="caret"></span>
                                </a>
                                <ul class="dropdown-menu">
                                    <li><a  href="<? echo site_url('Backend/bakorders/vieworderdetail') . "/" . $ord->getOrderno(); ?>"> 
                                            View
                                        </a></li>
                                    <?php if ($ord->getOrdstatus() >= 40): ?>
                                        <li>  <a href="<? echo site_url('Backend/bakorders/getpaymentlist') . "/" . $ord->getOrderno(); ?>"  >Payment</a> </li>
                                    <?php endif; ?>
                                         <li><a  href="<? echo site_url('Backend/bakwork/chooseorder') . "/" . $ord->getOrderno(); ?>"> 
                                          create work from this order
                                        </a></li>   
                                        
                                </ul>
                            </div>

                        </td>  
                    </tr>
                <?php endforeach; ?>


            </tbody>

        </table>
        <? echo $this->pagination->create_onclick_links(); ?>

    </div>
</div>





<? $this->load->view(lang('bakfooter')); ?>
   <script src="<? echo base_url("asset/javascript/bootstrap-dropdown.js"); ?>" >  </script>
<script>
    function pag(i){
        $('#searchform input[name=startrow]').val(i);
   
        $('#searchform').submit();
        
    }

    $(document).ready(function(){
        $( ".datepicker" ).datepicker({
            buttonText: "..." ,
            showOn: "button",
            dateFormat: "yy-mm-dd"

        });
    });   

</script>