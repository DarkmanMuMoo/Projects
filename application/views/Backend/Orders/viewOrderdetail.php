<? $this->load->view(lang('bakheader')); ?>

<div class="container" >
    <style>

        .red{
            color:#F00;
        }

        .blue{
            color:#09C;	
        }
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
        #headline{
            clear: both;


        }

        hr{ text-align:center;
            color:#09F;
            border-color:#09F;
            size:3;
        }
        h1{ font-weight:bolder;
        }

        .bottom{border:dashed;
                border-width:thin;
        }
        .orange{
            color:#1CC69F;
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

    </style>

    <div class="header"> 
        <h1>ใบสั่งสินค้า</h1>
        <hr />
    </div>


    <div id="headline" >
        <div id="order">
            <h2>เลขใบสั่งซื้อ:<span class="orange" > <? echo $order->getOrderno(); ?></span></h2><br>
            <h3>สถานะ <?php foreach ($ordstatuslist as $ordstatus): ?>
                    <?php if ($ordstatus->getStatus() == $order->getOrdstatus()): ?>
                        <span <? echo ($order->getOrdstatus() == 10) ? 'class="red"' : 'class="blue"'; ?> >   <?
                echo $ordstatus->getDescription();
                        ?></span></h3><? break; ?>
                        <?php endif; ?>
            <?php endforeach; ?><br>
            <table>
                <tr>
                    <td><strong>วันที่</strong></td> 
                    <td><strong>&nbsp;:&nbsp; </strong></td>
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
                    <td><? echo ($order->getExpectedshipdate() != null) ? $order->getExpectedshipdate() : '-'; ?></strong><br /></td>
                </tr>
                <tr>
                    <td><strong> วันที่เสร็จสิ้น</strong></td>
                    <td><strong>&nbsp;:&nbsp;</strong></td> 
                    <td><? echo ($order->getRecievedate() != null) ? $order->getRecievedate() : '-'; ?></td>

                </tr>
            </table>

        </div> <div id="address"> 
            <h2>ที่อยู่จัดส่ง</h2><br />


            <address>
                <table>
                    <tr>
                        <td><strong>ที่อยู่</strong> </td>
                        <td><strong>&nbsp;:&nbsp; </strong></td>
                        <td><? echo $order->getAddress(); ?></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td></td>
                        <td> <? echo $order->getProvince(); ?></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td></td>
                        <td><? echo $order->getPostcode(); ?></td>
                    </tr>
            </address>
            <tr>          
                <td><strong>การจัดส่ง</strong></td> 
                <td><strong>&nbsp;:&nbsp;</strong></td> 
                <td><?php foreach ($ordsendlist as $ordsend): ?>
                        <?php if ($ordsend->getSendmethod() == $order->getSendmethod()): ?>
                            <?
                            echo $ordsend->getDescription();
                            break;
                            ?>
                        <?php endif; ?>
                    <?php endforeach; ?></td>
            </tr>
            </table>

        </div>
    </div>
    <div id="orderline" align="center" style="clear: both; margin: 0 auto;">


        <hr class="bottom"></hr>  
        <p>
        <h2>Orderline</h2>
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
            <th>ราคา(บาท)</th>

            <th colspan="2" >ไฟล์</th>
            </thead>

            <tbody>
                <? $totalprice = 0; ?>
                <?php foreach ($orderlinelist as $index => $orderline): ?>   
                    <tr>
                        <td width="5%" ><? echo $index + 1; ?>   </td>

                        <td width="25%" ><? echo $orderline->getTmpname(); ?> &nbsp; 
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
                            ?>&nbsp; 
                        </td>
                        <td width="10%"  >  <?php if (($orderline->getFilepath() == '') || ($orderline->getFilepath() == null)): ?>
                                <? echo '<h6 style="color:red" >notupload</h6>' ?>
                            <?php else: ?>
                                <? echo '<h6>upload</h6>' ?>
                            <?php endif; ?></td>
                        <td  width="30%" >

                            <a target="_blank" href="<? echo site_url('Backend/bakorders/downloadFile') . '/' . $orderline->getOrdlineno(); ?>" class="btn btn-primary">viewFile</a>
                        </td>
                    </tr>  
                <? endforeach; ?>

            </tbody>



        </table>

        <form action="<? echo site_url('Backend/bakorders/seller_comment'); ?>" method="post">
            <div style="clear:both; display:table; width:100%;">


                <div style="float:left ; text-align:left; width:50%; font-size:16px" >
                    <strong>ความคิดเห็นของลูกค้า</strong>
                    <p>
                        <? echo $order->getCusremark(); ?>
                    </p>
                </div>

                <table style="float:left; width:50%;">
                    <tr>
                        <td><strong>ข้อความถึงโรงพิมพ์</strong></td>

                        <td><textarea name="comment" cols="" rows="">
                                <? echo $order->getSellerremark(); ?>
                            </textarea></td>
                    </tr>

                    <tr>
                        <td></td>
                        <td><input class="btn" type="submit" value="ตกลง" /> </td>
                    </tr>

                </table>

            </div>
            <input type="hidden" name="orderno" value="<? echo $order->getOrderno(); ?>">
        </form>


    </div>
    <?php if ($order->getOrdstatus() < 40 && $order->getOrdstatus() > 10): ?>
        <div align="center" style="margin :5% auto;">  
            <a class="btn btn-success" href="<? echo site_url('Backend/bakorders/waitforpay') . '/' . $order->getOrderno(); ?>">Approve</a> 
            <button class="btn btn-danger" onclick="reject('<? echo $order->getOrderno(); ?> ');" >Rejects</button>
        </div>
        <div id="rejectdialog" style="display: none;">
            <form id="rejectform" method="post" action="<? echo site_url('Backend/bakorders/rejects') ?>">
                <input  type="hidden" name="orderno"  value=""/>
                <textarea name="msg"  placeholder="ข้อความที่ต้องการส่งถึงลูกค้า" >
                                   
                </textarea>
            </form>
        </div>
    <?php endif; ?>
    <?php if ($order->getOrdstatus() == 50): ?>
        <div align="center" style="margin :5% auto;">  
            <a class="btn btn-success" href="<? echo site_url('Backend/bakorders/ontransfer') . '/' . $order->getOrderno(); ?>">set to on trasfer</a> 
        </div>
    <?php endif; ?>
    <?php if ($order->getOrdstatus() == 60): ?>
        <div align="center" style="margin :5% auto;">  
            <a class="btn btn-success" href="<? echo site_url('Backend/bakorders/complete') . '/' . $order->getOrderno(); ?>">set to Complete</a> 
        </div>
    <?php endif; ?>
    <? echo(isset($paymentview) ? $paymentview : '') ?>
    
</div>

<? $this->load->view(lang('bakfooter')); ?>
<script>
    function reject(orderno){
        $('#rejectform input[name=orderno]').val(orderno);
        $('#rejectdialog').dialog({
      
            autoOpen: true,
            modal: true,
            title: "Rejectdialog",buttons: [
                {
                    text: "sendEmail",
                    click: function(){ 
                        $('#rejectform').submit();
                        
                        $(this).dialog("close");    
                            
                    }
                           
                            
                }
           
            ]
          
          
        });
    
    }


</script>