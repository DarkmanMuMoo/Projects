<? $this->load->view(lang('header')) ?>

<script>
    function pag(i){
        $('#searchform input[name=startrow]').val(i);
   
        $('#searchform').submit();
        
    }
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

            $.post('<? echo site_url('orders/cancleorder') ?>/'+orderno, function(data){
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
        
<?php if ($this->session->flashdata('alert')): ?>
            
                      alert('รายการสั่งซื้อของคุณถูกสร้างขึ้นแล้ว หมายเลขสั่งซื้อ'+'<? echo $this->session->flashdata('alert'); ?>');
<?php endif; ?>
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
<div id="page">
    <div id ="content">
        <div id="search-bar">  
            <form id="searchform"action="<? echo site_url('orders') ?>" class="form-search" align="center"  method="post">

                จากวันที่ :<input type="text" name="fromdate" value="<? echo $this->input->post('fromdate'); ?>" id="fromdate" class="input-small datepicker" />
                ถึง:
                <input type="text" name="todate" value="<? echo $this->input->post('todate'); ?>" id="todate"  class="input-small datepicker"   />
                <input type="hidden" name="status" id="status"  />  
                <input type="hidden" name="startrow" value="0"/>
                <button type="submit" class="btn">Search</button>
            </form>
        </div>
        <div id="result"  align="center">
            <table class="table table-bordered" >
                <thead>
                <th >
                    #
                </th>
                <th>
                    หมายเลขสั่งซื้อ 
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
                        <tr> <td style="width: 45px;" ><? echo $index + 1 + $page ?> </td>  
                            <td style="width: 100px;" >

                                <? echo $ord->getOrderno(); ?> 

                            </td> 
                            <td > <? echo $ord->getOrderdate(); ?> </td>
                            <td style="width: 80px;" >
                                <?php foreach ($ordstatuslist as $status): ?>
                                    <?php if ($status->getStatus() == $ord->getOrdstatus()): ?>
                                <span   <?echo ($status->getStatus()==10)?'class="red"':'class="blue"'; ?> >
                                        <?
                                        echo $status->getDescription();
                                        break;
                                        ?></span>
                                    <?php endif; ?>
                                <?php endforeach; ?>
                            </td> 
                            <td style="text-align: right;" ><? echo number_format($ord->getTotalprice(), 2, '.', ','); ?>  &nbsp; </td>                      
                            <td style="width: 100px;" >
                                <div class="btn-group">
                                    <a class="btn btn-info" href="<? echo site_url('orders/viewOrderdetail') . "/" . $ord->getOrderno(); ?>"> 
                                        View
                                    </a>
                                    <a class="btn btn-info dropdown-toggle" data-toggle="dropdown" style="height: 18px;">
                                        <span class="caret"></span>
                                    </a>
                                    <ul class="dropdown-menu">
                                        <li><a  href="<? echo site_url('orders/viewOrderdetail') . "/" . $ord->getOrderno(); ?>"> 
                                                View
                                            </a></li>
                                        <?php if ($ord->getOrdstatus() <= 20): ?>
                                            <li>   <a  href="JavaScript:void(0);"  onclick="Confirmdelete('<? echo $ord->getOrderno(); ?>');" >cancel </a>  </li>
                                        <?php endif; ?>
                                        <?php if ($ord->getOrdstatus() > 30): ?>
                                            <li> <a href="<? echo site_url('orders/getpaymentlist') . "/" . $ord->getOrderno(); ?>" >Payment</a> </li>   
                                        <?php endif; ?>

                                    </ul>
                                </div>


                            </td>  
                        </tr>
                    <?php endforeach; ?>


                </tbody>

        </table>

            <? echo $this->pagination->create_onclick_links(); ?>
        </div>

    </div >
    <div id="sidebar">
        <h2>รายการสั่งซื้อ</h2>


        <ul id="statuslist"class="nav nav-tabs nav-stacked">

            <li><a id="0" href="JavaScript:void(0);" onclick="Searchstatus('');">ทั้งหมด</a></li>
            <?php foreach ($ordstatuslist as $ord): ?>
                <li ><a id="<? echo $ord->getStatus(); ?>" href="JavaScript:void(0);" onclick="Searchstatus('<? echo $ord->getStatus(); ?>');"><? echo $ord->getDescription() ?></a>
                </li>
            <?php endforeach; ?>
        </ul> 


    </div>

</div>

<? $this->load->view(lang('footer')) ?>