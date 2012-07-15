 <? $this->load->view(lang('header')) ?>
            <? echo form_open('orders/ordersummary') ?>
            <p>


            <h5>จัดส่ง</h5>
            <div id="sendaddress" >
                <?
                if ($address == 'add1') {

                    print_r($_SESSION['user']->getAddress1());
                } else {

                    print_r($_SESSION['user']->getAddress2());
                }
                ?>

                <input type="hidden" name="address" value="<? echo  $address?>"/>
            </div>


        </p>
        <!-- <? echo var_dump($_SESSION); ?>-->
        <? $totalprice = 0; ?>
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
                <?php foreach ($_SESSION['temp_orderlinelist'] as $index => $cart): ?>
                    <tr>

                        <td>   <?php foreach ($templatelist as $orderline): ?>


                                <?php if ($orderline->getTempno() == $cart->getTempno()): ?>
                                    <strong> <? echo $orderline->getName(); ?> &nbsp; <? echo $orderline->getType(); ?>&nbsp;
                                        <? echo $orderline->getSize();  break;?>
                                    </strong>
                                <?php endif; ?>
                            <? endforeach; ?>
                        </td>

                        <td>   <?php foreach ($paperlist as $paper): ?>
                                <?php if ($paper->getPaperno() == $cart->getPaperno()): ?>
                                    <strong> <? echo $paper->getName(); ?> &nbsp; <? echo $paper->getGrame(); break;?></strong>
                                <?php endif; ?>

                            <? endforeach; ?>
                        </td>
                        <td>   <?php foreach ($optionlist as $option): ?>

                                <?php if ($option->getOptionno() == $cart->getOptionno()): ?>
                                    <strong> <? echo $option->getDescription(); break; ?> </strong>
                                <?php endif; ?>
                            <? endforeach; ?>
                        </td>
                        <td>
                            <? echo $cart->getQty(); ?>
                        </td>
                        <td>
                            <? echo $cart->getPrice();
                            $totalprice = $totalprice + $cart->getPrice(); ?>
                        </td>
                      <!--  <td>
                            <a href="<? echo site_url('orders/removeCartItem') . '/' . $index; ?> ">remove </a>
                        </td>-->


                    </tr>
<? endforeach; ?>

            </tbody>


        </table>
        <div style="float: right" >
            <strong>ราคารวม :<? echo $totalprice ?> บาท</strong>
            <input type="hidden" name="totalprice" value="<? echo $totalprice ?>">
        </div>

        <p>
            <label>จัดส่ง: </label> 
           
            <strong><? echo $ordsend->getDescription(); ?>   </strong>
            <input name="ordsend"  type="hidden" value="<? echo $ordsend->getSendmethod() ?>"
     
        </p>
           
<p>
            <label>การจ่ายเงิน: </label> 
                   
            
            <strong><? echo $ordpay->getDescription(); ?>   </strong>
            <input name="ordpay"  type="hidden" value="<? echo $ordpay->getPaymethod(); ?>"

         
        </p>
        <p>
        <button  onclick="history.back();" class="btn btn-primary">Back</button> 
        <button type="submit" class="btn btn-primary">Confirm</button>
        </p>
<? echo form_close(); ?>

  <? $this->load->view(lang('footer')) ?>