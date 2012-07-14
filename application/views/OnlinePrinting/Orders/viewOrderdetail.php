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
<div id="page">
    
    <div id="head" style="clear:both;"><div id="order">
                 <h2>Orderno: <?echo $order->getOrderno();?></h2>
               
            </div> <div id="address"> 
                <h2>sendto</h2>
                <address>
                    <?echo $order->getAddress();?></br>
                     <?echo $order->getProvince();?></br>
                      <?echo $order->getPostcode();?></br>
                </address>
            
            
            </div> </div>
    <div id="orderline" align="center">
        
     
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
                    <? $totalprice=0;  ?>
                     <?php foreach ($orderlinelist as $index=>$orderline): ?>   
                    <tr>
                        <td><? echo  $index+1; ?>   </td>
                         <td><? echo  $orderline->getOrdlineno(); ?>   </td>
                         <td><? echo $orderline->getTmpname();?> &nbsp; <? echo $orderline->getTmptype();?>&nbsp;
                            <? echo $orderline->getTmpsize();?>  </td>
                         <td>  <? echo $orderline->getPapername();?> &nbsp; <? echo $orderline->getGram();?>        </td>
                         <td>  <? echo $orderline->getOptiondescription();?>     </td>
                       <td>
                            <? echo $orderline->getQty();?>
                      </td>
                          <td>
                            <? echo $orderline->getPrice();   $totalprice+=$orderline->getPrice(); ?>
                      </td>
                      <td><button>Download</button><button>Upload</button> </td>
                    </tr>  
                    <?endforeach;?>
                    
                </tbody>
            
            
            
            
            
            
            
        </table>

    </div>
    
    
    
</div>

  <? $this->load->view(lang('footer')) ?>