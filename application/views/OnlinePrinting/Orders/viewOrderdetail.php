<? $this->load->view(lang('header')) ?>
<style>
 
    .headelement{
         float:left;
        width: 30%; 
        
    }

    #orderline th{text-align: center;}
    #orderline td{text-align: center;}

    .red{
        color:#F00;
    }

    .blue{
        color:#09C;	
    }
    .orange{
        color:#F60;
    }
    #paystatus{float: left;
               margin-top: 30px;
               margin-left: 30px;
               font-size: 18px;
               line-height: 2em;}

    #result th{text-align: center;}
    #result td{text-align: center;}
    #payconfirm{ margin-top: 15px;
                 float: left;
                 margin-left: 100px;
                 width: 50%;}
    #payconfirm form{
        margin-left: 20px;
        margin-top: 15px;

    }

    #con{

        width: 20%;
        margin-left: 10%;
    }
    hr{color: orangeRed;
       background-color: orange;
       height: 1px;

    }
    #head{
        
        clear: both;
display: table;
width: 100%;
    }
</style>



<div id="page">

    <div id="head" >
        <div id="order" class="headelement">
            <h2 >เลขใบสั่งซื้อ <span class="orange" ><? echo $order->getOrderno(); ?></span></h2> <h3>สถานะ 
                <?php foreach ($ordstatuslist as $ordstatus): ?>
                    <?php if ($ordstatus->getStatus() == $order->getOrdstatus()): ?>
                        <span <? echo ($order->getOrdstatus() == 10) ? 'class="red"' : 'class="blue"'; ?> > <? echo $ordstatus->getDescription(); ?> </span></h3> <? break; ?>
                <?php endif; ?>
            <?php endforeach; ?>
            <table>
                <tr>
                    <td><strong>วันที่</strong></td> 
                    <td><strong>&nbsp;:&nbsp;</strong></td>  
                    <td><? echo $order->getOrderdate(); ?></td>
                </tr>
                <tr>
                    <td><strong> การชำระ </strong></td>
                    <td><strong>&nbsp;:&nbsp;</strong></td> 
                    <td><?php foreach ($ordpaylist as $ordpay): ?>
                            <?php if ($ordpay->getPaymethod() == $order->getPaymethod()): ?>
                                <?
                                echo $ordpay->getDescription();
                                break;
                                ?>
                            <?php endif; ?>
                        <?php endforeach; ?></td>
                </tr>
                <tr>
                    <td><strong>วันส่งสินค้า</strong></td>
                    <td><strong>&nbsp;:&nbsp;</strong></td>
                    <td><? echo ($order->getExpectedshipdate() != null) ? $order->getExpectedshipdate() : '-'; ?></strong></td>
                </tr>
                <tr>
                    <td><strong> วันที่เสร็จสิ้น</strong></td>
                    <td><strong>&nbsp;:&nbsp;</strong></td> 
                    <td><? echo ($order->getRecievedate() != null) ? $order->getRecievedate() : '-'; ?></td>

                </tr>
            </table>


        </div> 
        <div id="address" class="headelement"> 
            <h2>ที่อยู่จัดส่ง</h2>

            <table>
                <tr>
                    <td><strong>ที่อยู่</strong></td> 
                    <td><strong>&nbsp;:&nbsp;</strong></td>    
                    <td><? echo $order->getAddress(); ?></br></td>
                </tr>
                <tr>
                    <td></td>
                    <td></td>
                    <td><? echo $order->getProvince(); ?></td>
                </tr>
                <tr>
                    <td></td>
                    <td></td>
                    <td><? echo $order->getPostcode(); ?> &nbsp;<? echo $order->getPhone(); ?> </td>
                </tr>

                <tr>
                    <td><strong>การจัดส่ง</strong></td> 
                    <td><strong>&nbsp;:&nbsp; </strong></td>
                    <td><?php foreach ($ordsendlist as $ordsend): ?>
                            <?php if ($ordsend->getSendmethod() == $order->getSendmethod()): ?>
                                <?
                                echo $ordsend->getDescription();
                                break;
                                ?>
                            <?php endif; ?>
                        <?php endforeach; ?><br>
                    </td>
                </tr>
                <tr>
                    <td><strong>tracking no</strong></td> 
                    <td><strong>&nbsp;:&nbsp; </strong></td>
                    <td><br>
                      <?echo (isset($ordtracking))?$ordtracking:''?></td>
                </tr>
            </table>

        </div>
        <div id="address2" class="headelement"> 
            <h2>ที่อยู่ออกใบเสร็จ</h2>

            <table>
                <tr>
                    <td><strong>ที่อยู่</strong></td> 
                    <td><strong>&nbsp;:&nbsp;</strong></td>    
                    <td><? echo $order->getAddress2(); ?></br></td>
                </tr>
                <tr>
                    <td></td>
                    <td></td>
                    <td><? echo $order->getProvince2(); ?></td>
                </tr>
                <tr>
                    <td></td>
                    <td></td>
                    <td><? echo $order->getPostcode2(); ?>&nbsp;<? echo $order->getPhone2(); ?></td>
                </tr>

                <tr>
                    <td><strong>การจัดส่ง</strong></td> 
                    <td><strong>&nbsp;:&nbsp; </strong></td>
                    <td><?php foreach ($ordsendlist as $ordsend): ?>
                            <?php if ($ordsend->getSendmethod() == $order->getSendmethod()): ?>
                                <?
                                echo $ordsend->getDescription();
                                break;
                                ?>
                            <?php endif; ?>
                        <?php endforeach; ?><br>
                    </td>
                </tr>
             
            </table>

        </div>
    </div>

  
    <div id="orderline" align="center" style="clear: both; margin: 0 auto;">
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

                        <td width="20%" ><? echo $orderline->getTmpname(); ?> &nbsp; 
                            <? echo $orderline->getTmpsize(); ?> &nbsp;

                        </td>
                        <td width="10%"  >  <? echo $orderline->getPapername(); ?> &nbsp; <? echo $orderline->getGram(); ?>        </td>
                        <td width="10%" >  <? echo $orderline->getOptiondescription(); ?>     </td>
                        <td width="5%"  >
                            <? echo $orderline->getQty(); ?>
                        </td>
                        <td width="10%" style="text-align: right;"  >
                            <?
                            echo number_format($orderline->getPrice(), 2, '.', ',');
                            $totalprice+=$orderline->getPrice();
                            ?> &nbsp บาท
                        </td>
                        <td width="20%"  >  <?php if (($orderline->getFilepath() == '') || ($orderline->getFilepath() == null)): ?>
                                <h6 style="color:red" >Not upload</h6>'
                            <?php else: ?>
                                <h6>Uploaded(<a target="_blank" href="<? echo site_url('orders/previewfile/' . $orderline->getOrdlineno()); ?>">Preview File</a>)</h6>
                            <?php endif; ?></td>
                        <td  width="20%" >

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
                    <td><strong>ข้อความถึงโรงพิมพ์</strong></td>

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
 <? echo(isset($paymentview) ? $paymentview : '') ?>
 



</div>

<? $this->load->view(lang('footer')) ?>


<!-- upload dialog-->
<div id="showuploaddialog" style="display:none;">
    <iframe id="uploaddialog" width="500" height="200" style="border-style:none;" scrolling="no"  ></iframe>
</div>
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
            width:'auto',
            title: "Upload",
            close: function(event, ui) {
                window.location.reload();
                 
            }

        }
            
    );
                    
                   
               
    
    
    
    }


</script>