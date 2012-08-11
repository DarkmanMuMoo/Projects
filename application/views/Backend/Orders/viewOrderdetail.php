<? $this->load->view(lang('bakheader'));?>

<div class="container" >
    <style>


      #order{

        float:left;
        width: 50%;
    }
    #address{
        float:right;
        width: 50%; 

    }
    #address address{

        margin-left: 20%;
    }

 #orderline th{text-align: center;}
    #orderline td{text-align: center;}
    #headline{
        clear: both;
margin-top: 100px;

    }
</style>
<div id="headline" >
    <div id="order">
            <h2>Orderno: <? echo $order->getOrderno(); ?></h2><br>
            <?php foreach ($ordstatuslist as $ordstatus): ?>
                <?php if ($ordstatus->getStatus() == $order->getOrdstatus()): ?>
                    <? echo $ordstatus->getDescription();  break;?>
                <?php endif; ?>
            <?php endforeach; ?><br>
           Orderdate : <? echo $order->getOrderdate(); ?><br>
            Paymethod : <?php foreach ($ordpaylist as $ordpay): ?>
                <?php if ($ordpay->getPaymethod() == $order->getPaymethod()): ?>
                    <? echo $ordpay->getDescription();  break;?>
                <?php endif; ?>
            <?php endforeach; ?><br>
        </div> <div id="address"> 
            <h2>sendto</h2>
            <address>
                <? echo $order->getAddress(); ?></br>
                <? echo $order->getProvince(); ?></br>
                <? echo $order->getPostcode(); ?></br>
            </address>
            <p>
            <h4>sends method 
                <?php foreach ($ordsendlist as $ordsend): ?>
                <?php if ($ordsend->getSendmethod() == $order->getSendmethod()): ?>
                    <? echo $ordsend->getDescription();  break;?>
                <?php endif; ?>
            <?php endforeach; ?><br></h4>
        </p>

        </div>
     </div>
  <div id="orderline" align="center" style="clear: both; margin: 0 auto;">
        <hr style="color: orange;
background-color: orange;
height: 3px; margin: 0 0;"></hr>
        <p>
        <h2>Orderline</h2>
    </p>
        <table class="table table-bordered" >
            <thead>
            <th>
                Number
            </th>
            <th>
                Orderlineno
            </th>
            <th>template</th>
            <th>กระดาษ</th>
            <th>option</th>
            <th>จำนวน</th>
            <th>ราคา</th>
            
            <th colspan="2" >file</th>
            </thead>

            <tbody>
                <? $totalprice = 0; ?>
                <?php foreach ($orderlinelist as $index => $orderline): ?>   
                    <tr>
                        <td width="5%" ><? echo $index + 1; ?>   </td>
                        <td width="5%"  ><? echo $orderline->getOrdlineno(); ?>   </td>
                        <td width="15%" ><? echo $orderline->getTmpname(); ?> &nbsp; 
                            <? echo $orderline->getTmpsize(); ?> &nbsp;
                           
                             </td>
                        <td width="15%"  >  <? echo $orderline->getPapername(); ?> &nbsp; <? echo $orderline->getGram(); ?>        </td>
                        <td width="10%" >  <? echo $orderline->getOptiondescription(); ?>     </td>
                        <td width="10%"  >
                            <? echo $orderline->getQty(); ?>
                        </td>
                        <td width="10%" style="text-align: right;"  >
                            <? echo $orderline->getPrice();
                            $totalprice+=$orderline->getPrice(); ?>
                        </td>
                        <td width="10%"  >  <?php if (($orderline->getFilepath() == '') || ($orderline->getFilepath() == null)):?>
                        <?  echo '<h6 style="color:red" >notupload</h6>' ?>
                            <?php else: ?>
                                    <?  echo '<h6>upload</h6>' ?>
                <?php endif; ?></td>
                        <td  width="30%" >
                          
                            <a target="_blank" href="<? echo site_url('Backend/bakorders/downloadFile').'/'.$orderline->getOrdlineno(); ?>" class="btn btn-primary">viewFile</a>
                            </td>
                    </tr>  
<? endforeach; ?>

            </tbody>







        </table>

    </div>
<div align="center" style="margin :5% auto;">  
    <a class="btn btn-success" href="<? echo site_url('Backend/bakorders/waitforpay').'/'.$order->getOrderno();?>">Approve</a> 
<a class="btn btn-danger" href="<? echo site_url('Backend/bakorders/rejects').'/'.$order->getOrderno();?>">Rejects</a>
</div>
</div>










<? $this->load->view(lang('bakfooter'));?>