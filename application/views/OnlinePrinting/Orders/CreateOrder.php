 <? $this->load->view(lang('header')) ?>
        <script>
        
    	$(function() {
		$( "#selectadd" ).buttonset();
                
                
                $('#selectadd input').click(function(){
                 alert   
                    
                    
        var id = this.id;
        
        if(id=='add1'){
            
         $("#mainaddress").css({"display":"inline"});
          $('#subaddress').css({"display":"none"});
        
            
        }else{
             $("#mainaddress").css({"display":"none"});
          $('#subaddress').css({"display":"inline"});
            
            
        }
                });
	});

        </script>
 
            <? echo  form_open('orders/confirmorder')  ?>
            <p>
                <div id="selectadd">
                    <input type="radio" id="add1" name="add" value="add1" checked="checked" /><label for="add1">main</label>
		<input type="radio" id="add2" name="add" value="add2"  /><label for="add2">sub</label>
	</div>
                
            <h5>จัดส่ง</h5>
            <div id="mainaddress" >
                <? print_r($_SESSION['user']->getAddress1())   ?>
                
                
            </div>
            <div id="subaddress" style="display: none;">
                <? print_r($_SESSION['user']->getAddress2())   ?>
                
                
            </div>
                
            </p>
          <!-- <? echo var_dump($_SESSION); ?>-->
             <?  $totalprice=0; ?>
                <table class="table table-bordered" id="Ccolum" style="width:auto">
                    <thead> <tr> 
                        
                      
                             <td>template</td>
                              <td>กระดาษ</td>
                               <td>option</td>
                                <td>จำนวน</td>
                                 <td>ราคา</td>
                               <!--  <td>ลบ</td>-->

                        </tr> </thead>
                    <tbody>
                    <?php foreach ($_SESSION['temp_orderlinelist'] as $index=>$cart): ?>
                    <tr>
                        
                        <td>   <?php foreach ($templatelist as $orderline): ?>
                            
                            
                            <?php if ($orderline->getTempno() == $cart->getTempno()): ?>
                            <strong> <? echo $orderline->getName();?> &nbsp; <? echo $orderline->getType();?>&nbsp;
                            <? echo $orderline->getSize(); break;?>
                            </strong>
                            <?php endif; ?>
                             <?endforeach;?>
                        </td>
                   
                         <td>   <?php foreach ($paperlist as  $paper): ?>
                              <?php if ($paper->getPaperno() == $cart->getPaperno()): ?>
                            <strong> <? echo $paper->getName();?> &nbsp; <? echo $paper->getGrame(); break;?></strong>
                            <?php endif; ?>
                       
                             <? endforeach;?>
                        </td>
                         <td>   <?php foreach ($optionlist as $option): ?>
                            
                           <?php if ($option->getOptionno() == $cart->getOptionno()): ?>
                            <strong> <? echo $option->getDescription(); break;?> </strong>
                            <?php endif; ?>
                             <? endforeach;?>
                        </td>
                      <td>
                            <? echo $cart->getQty();?>
                      </td>
                          <td>
                            <? echo $cart->getPrice();   $totalprice=$totalprice+$cart->getPrice(); ?>
                      </td>
                    <!--  <td>
                          <a href="<? echo site_url('orders/removeCartItem').'/'.$index;  ?> ">remove </a>
                      </td>-->
                      
                     
                    </tr>
                    <? endforeach;?>

                    </tbody>
                    
                
                </table>
                <div style="float: right" >
                     <strong>ราคารวม :<? echo $totalprice?> บาท</strong>
                </div>
          
          <p>
           <label>จัดส่ง: </label> <select  name="ordsend" >
            <?php foreach ($ordsendlist as $ordsend): ?>
                <option value="<? echo $ordsend->getSendmethod() ?>" >
                    <? echo $ordsend->getDescription() ?></option>
            <?php endforeach; ?>
        </select>
           
          <label>การจ่ายเงิน: </label> <select  name="ordpay" >
            <?php foreach ($ordpaylist as $ordpay): ?>
                <option value="<? echo $ordpay->getPaymethod()  ?>" >
                    <? echo $ordpay->getDescription() ?></option>
            <?php endforeach; ?>
        </select>
          </p>
          <button type="submit" class="btn btn-primary">Create Order</button>
            <? echo form_close(); ?>
     
        
        
        
  <? $this->load->view(lang('footer')) ?>