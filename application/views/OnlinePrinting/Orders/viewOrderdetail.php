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
    #address address{

        margin-left: 20%;
    }


</style>
<script>

 function closedialog(){
     
     
      $('#showuploaddialog').dialog( "close" );
 }

function showupload(orderlineno){
    
     document.getElementById('uploaddialog').src = '<? echo site_url("orders/showuploadframe"); ?>/'+orderlineno; 
        $('#showuploaddialog').dialog({ 
                    autoOpen: true,
                    modal: true,
                    width:500,
                    title: "Upload"

                }
            
            );
                    
                   
               
    
    
    
}


</script>
<div id="page">

    <div id="head" style="clear:both;"><div id="order">
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

    <div id="orderline" align="center" style="clear: both">
        <hr style="color: orange;
background-color: orange;
height: 3px;"></hr>
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
            <th>file</th>
            </thead>

            <tbody>
                <? $totalprice = 0; ?>
                <?php foreach ($orderlinelist as $index => $orderline): ?>   
                    <tr>
                        <td><? echo $index + 1; ?>   </td>
                        <td><? echo $orderline->getOrdlineno(); ?>   </td>
                        <td><? echo $orderline->getTmpname(); ?> &nbsp; <? echo $orderline->getTmptype(); ?>&nbsp;
                            <? echo $orderline->getTmpsize(); ?>  </td>
                        <td>  <? echo $orderline->getPapername(); ?> &nbsp; <? echo $orderline->getGram(); ?>        </td>
                        <td>  <? echo $orderline->getOptiondescription(); ?>     </td>
                        <td>
                            <? echo $orderline->getQty(); ?>
                        </td>
                        <td>
                            <? echo $orderline->getPrice();
                            $totalprice+=$orderline->getPrice(); ?>
                        </td>
                        <td><a href="<? echo site_url('orders/downloadtemplate').'/'.$orderline->getTempno(); ?>" class="btn btn-primary">Download</a>&nbsp;&nbsp;&nbsp;
                            <button onclick="showupload('<? echo $orderline->getOrdlineno(); ?>');" class="btn btn-warning">Upload</button> </td>
                    </tr>  
<? endforeach; ?>

            </tbody>







        </table>

    </div>



</div>

<? $this->load->view(lang('footer')) ?>


<!-- upload dialog-->
<div id="showuploaddialog" style="display:none;">
    <iframe id="uploaddialog" width="500"  style="border-style:none;" scrolling="no"  ></iframe>
</div>