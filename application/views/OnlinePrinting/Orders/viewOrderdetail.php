<? $this->load->view(lang('header')) ?>
<style>
    #order{

        float:left;
        width: 50%;

    }
    #address{
        float:right;
        width: 50%; 

    }


    #orderline th{text-align: center;}
    #orderline td{text-align: center;}

    .red{
        color:#F00;
    }

    .blue{
        color:#09C;	
    }
</style>



<script>
    // not use right now may be some day
    function closedialog(){
     
     
        $('#showuploaddialog').dialog( "close" );
    }
    function checkuploadfile(orderno){
        var url='<? echo site_url('orders/ajaxcheckuploadfile') ?>';
        $.post(url, {order: orderno}, function(data) { 
                                
            if(data==='true'){
                $('#changestatusform').submit();

            }else{
                                        
                alert('you have'+data+'orderline did,t not upload file');

            }
        });
    
    }
    function showupload(orderlineno){
    
        document.getElementById('uploaddialog').src = '<? echo site_url("orders/showuploadframe"); ?>/'+orderlineno; 
        $('#showuploaddialog').dialog({ 
            autoOpen: true,
            modal: true,
            width:500,
            title: "Upload",
            close: function(event, ui) {
                window.location.reload();
                 
            }

        }
            
    );
                    
                   
               
    
    
    
    }


</script>
<div id="page">

    <div id="head" style="clear:both;">
        <div id="order">
            <h2>เลขใบสั่งซื้อ <? echo $order->getOrderno(); ?></h2> <h3>สถานะ :
                <?php foreach ($ordstatuslist as $ordstatus): ?>
                    <?php if ($ordstatus->getStatus() == $order->getOrdstatus()): ?>
                        <span <? echo ($order->getOrdstatus() == 10) ? 'class="red"' : 'class="blue"'; ?> > <? echo $ordstatus->getDescription(); ?> </span></h3> <? break; ?>
                <?php endif; ?>
            <?php endforeach; ?>
            <strong>  วันที่ :</strong>  <? echo $order->getOrderdate(); ?><br>
            <strong> การจัดส่ง :</strong> <?php foreach ($ordpaylist as $ordpay): ?>
                <?php if ($ordpay->getPaymethod() == $order->getPaymethod()): ?>
                    <? echo $ordpay->getDescription();
                    break;
                    ?>
                <?php endif; ?>
<?php endforeach; ?><br>
            <strong>วันส่งสินค้า: <? echo ($order->getRecievedate() != null) ? $order->getRecievedate() : '-'; ?></strong>
            <strong> วันที่เสร็จสิ้น: <? echo ($order->getExpectedshipdate() != null) ? $order->getExpectedshipdate() : '-'; ?></strong><br />


        </div> <div id="address"> 
            <h2>ที่อยู่จัดส่ง</h2>
            <address>
                ที่อยู่ :    <? echo $order->getAddress(); ?></br>
                &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; <? echo $order->getProvince(); ?></br>
                &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; <? echo $order->getPostcode(); ?></br>
            </address>
            <p>
                <strong>การจัดส่ง : </strong>
                <?php foreach ($ordsendlist as $ordsend): ?>
                    <?php if ($ordsend->getSendmethod() == $order->getSendmethod()): ?>
                        <? echo $ordsend->getDescription();
                        break;
                        ?>
    <?php endif; ?>
<?php endforeach; ?><br>
            </p>

        </div>
    </div>

    <div id="orderline" align="center" style="clear: both; margin: 5% auto;">
        <hr style="color: orange;
            background-color: orange;
            height: 3px;"></hr>
        <p>
        <h2>รายการสินค้า</h2>
        </p>
        <table class="table table-bordered" >
            <thead>
            <th>
                #
            </th>

            <th>เทมเพลต</th>
            <th>กระดาษ</th>
            <th>ตัวเลือกพิเศษ</th>
            <th>จำนวน</th>
            <th>ราคา</th>

            <th colspan="2" >ไฟล์</th>
            </thead>

            <tbody>
<? $totalprice = 0; ?>
<?php foreach ($orderlinelist as $index => $orderline): ?>   
                    <tr>
                        <td width="5%" ><? echo $index + 1; ?>   </td>

                        <td width="15%" ><? echo $orderline->getTmpname(); ?> &nbsp; 
    <? echo $orderline->getTmpsize(); ?> &nbsp;

                        </td>
                        <td width="15%"  >  <? echo $orderline->getPapername(); ?> &nbsp; <? echo $orderline->getGram(); ?>        </td>
                        <td width="10%" >  <? echo $orderline->getOptiondescription(); ?>     </td>
                        <td width="10%"  >
                            <? echo $orderline->getQty(); ?>
                        </td>
                        <td width="10%" style="text-align: right;"  >
                            <?
                            echo number_format($orderline->getPrice(), 2, '.', ',');
                            $totalprice+=$orderline->getPrice();
                            ?> &nbsp บาท
                        </td>
                        <td width="10%"  >  <?php if (($orderline->getFilepath() == '') || ($orderline->getFilepath() == null)): ?>
                                <? echo '<h6 style="color:red" >notupload</h6>' ?>
    <?php else: ?>
        <? echo '<h6>upload</h6>' ?>
                            <?php endif; ?></td>
                        <td  width="30%" >

                            <a href="<? echo site_url('orders/downloadtemplate') . '/' . $orderline->getTempno(); ?>" class="btn btn-primary">Download</a>
    <?php if ($order->getOrdstatus() <= 20): ?>
                                <button onclick="showupload('<? echo $orderline->getOrdlineno(); ?>');" class="btn btn-warning">Upload</button> 
                    <?php endif; ?>
                        </td>
                    </tr>  
<? endforeach; ?>

            </tbody>







        </table>

    </div>

    <form action="<? echo site_url('orders/cus_comment') ?>" method="post">
        <div style="clear:both; display:table; width:100%;">
            <table style="float:left; width:50%;">
                <tr>
                    <td><strong>ความคิดเห็นลูกค้า</strong></td>

                    <td><textarea name="comment" cols="" rows="">
<? echo $order->getCusremark(); ?>


                        </textarea>

                    </td>
                </tr>

                <tr>
                    <td></td>
                    <td><input class="btn" name="" type="submit" value="ตกลง" /> </td>
                </tr>

            </table>

            <div style="float:left ; width:50%;" >
                <strong>ข้อความจากโรงพิมพ์</strong>

                <p>
<? echo $order->getSellerremark(); ?>
                </p>
            </div>
            <input type="hidden" name="orderno" value="<? echo $order->getOrderno(); ?>">

        </div>
    </form>





    <?php if ($ordstatus->getStatus() <= 20): ?>
        <div align="left"  > <span style="margin-right: 3%; margin-left: 10%"> เมื่อ upload file ครบแล้ว คลิกที่นี่เพื่อดำเนินการต่อไป------> </span>
            <button onclick="checkuploadfile('<? echo $order->getOrderno(); ?>');" class="btn btn-success">Approve</button> <a class="btn btn-danger" href="<? echo site_url('orders') ?>" >Back</a>    
        </div>
<?php endif; ?>

    <form  method="post" id="changestatusform"action="<? echo site_url('orders/waitforvalidate'); ?>" >
        <input type="hidden" name="status" value="20">
        <input type="hidden" name="orderno" value="<? echo $order->getOrderno(); ?>">
    </form>

</div>

<? $this->load->view(lang('footer')) ?>


<!-- upload dialog-->
<div id="showuploaddialog" style="display:none;">
    <iframe id="uploaddialog" width="500"  style="border-style:none;" scrolling="no"  ></iframe>
</div>
