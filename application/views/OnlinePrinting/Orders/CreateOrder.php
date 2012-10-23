<? $this->load->view(lang('header')) ?>
<script>
    var totalprice;
    $(function() {
$("#phone").mask("99-999-9999");
$("#phone1").mask("99-999-9999");

        changeprice();
        changesendaddress();
        changereceiptaddress();
        $('#ordsend').change(function(){changeprice();});
        $('#choosereceiptdaddress').change(function(){ changereceiptaddress(); });
        $('#choosesendaddress').change(function(){ changesendaddress(); });
        $('#selectadd input').click(function(){

            var value = $(this).attr('value');
            $('.tabadd').hide();
            $('#'+value).fadeToggle()
        });
        
        
    });
    function changeprice(){
        var sid =document.getElementById('ordsend').options[document.getElementById('ordsend').selectedIndex].value;
        $.post('<? echo site_url('orders/ajaxordersendprice'); ?>', {id:sid}, function(data){      
            $('#adprice').html(data);   
            $('#sumprice').html((parseFloat(data)+(totalprice*1.07)).toFixed(2));
        });
    
    }
    function changesendaddress(){
        var sid=$('#choosesendaddress').val();
        if(sid=='0'){
            
            $('#showsendadd').hide();
            $('#newsendadd').show();
        }else{
            $('#showsendadd').show();
            $('#newsendadd').hide();
            $.post('<? echo site_url('orders/ajaxorderaddress'); ?>', {id:sid}, function(data){
                $("#showsendadd #line1").html(data.address);
                $("#showsendadd #line2").html("จังหวัด: "+data.province+"  รหัสไปรษณีย์: "+data.postcode);
                $("#showsendadd #line3").html("โทรศัพท์: "+data.phone);
            });
        }
    }
    function changereceiptaddress(){
        var sid=$('#choosereceiptdaddress').val();
        if(sid=='0'){
            $('#newreceiptadd').show();
             $('#showreceiptadd').hide();
        }else{
            $('#newreceiptadd').hide();
            $('#showreceiptadd').show();
            $.post('<? echo site_url('orders/ajaxorderaddress'); ?>', {id:sid}, function(data){
                
                $("#showreceiptadd #line1").html(data.address);
                $("#showreceiptadd #line2").html("จังหวัด"+data.province+"  รหัสไปรษณีย์"+data.postcode);
                $("#showreceiptadd #line3").html("โทรศัพท์ "+data.phone);
            });
        }
    }
</script>
<style>
    #mainaddress address {
        font-weight: lighter;
        line-height: 20px;
    }
    form{
        padding: 20px;
        width: 80%;
        margin: 0 auto;
    }
    hr{color: orangeRed;
       background-color: orange;
       height: 1px;

    }
    #addressbar{
        width:100%;
        clear: both;
        display: table;
    }
    #sendaddress{
        width: 50%;
        float: left;
    }
    #receiptadd{
        width: 50%;
        float: right;

    }
</style>
<div id="page">
    <p style ="margin-bottom: 10px;">
    <h1><b>Create Order</b></h1>
    <h4>สร้างออร์เดอร์</h4>
</p>
<hr></hr>

<? echo form_open('orders/confirmorder') ?>
<div id="addressbar">
    <div id="sendaddress">
        <h5>ที่อยู่จัดส่ง</h5> <br/>
        <select id="choosesendaddress" name="choosesendaddress">
            <?php foreach ($addresslist as $address): ?>
                <option value="<? echo $address->getAddressno(); ?>"><? echo $address->getAddressname(); ?></option>
            <?php endforeach; ?>
            <option value="0">ที่อยู่อื่นๆ</option>
        </select>
        <br/><h5>จัดส่ง</h5> <br/>
        <div id="showsendadd" >

            <address id="line1" ></address>
            <address id="line2" ></address>
            <address id="line3" ></address>

        </div>
        <div  id="newsendadd" style="display: none;" >
            <table>
                <tr>
                    <td>ที่อยู่</td> 
                    <td><textarea name="address" id="address" placeholder ="111/235 ซ.ตัวอย่าง ถ.ตัวอย่าง แขวงตัวอย่าง เขตตัวอย่าง" > </textarea></td>
                </tr>
                <tr>
                    <td>จังหวัด</td> 
                    <td><select name="province" id="province">
                            <?php foreach ($provincelist as $province): ?>
                                <option  value="<? echo $province->getProvinceid(); ?>"><? echo $province->getProvincename(); ?></option>
                            <? endforeach; ?>
                        </select></td>
                </tr>
                <tr>
                    <td>รหัสไปรษณีย์ &nbsp;&nbsp;&nbsp;</td> 
                    <td><input type="text"id="postcode" name="postcode" maxlength="5" value=""/></td>
                </tr>
                <tr>
                    <td>โทรศัพท์</td> 
                    <td><input type="text" name="phone" value=""  id="phone"/></td>
                </tr>
            </table>
        </div>

        </p>
        <!-- <? echo var_dump($_SESSION); ?>-->
    </div>
    <div id="receiptadd">
        <h5>ที่อยู่ออกใบเสร็จ</h5> <br/>
        <select id="choosereceiptdaddress" name="choosereceiptdaddress">
            <?php foreach ($addresslist as $address): ?>
                <option value="<? echo $address->getAddressno(); ?>"><? echo $address->getAddressname(); ?></option>
            <?php endforeach; ?>
            <option value="0">ที่อยู่อื่นๆ</option>
        </select>
        <br/><h5>จัดส่ง</h5> <br/>
        <div id="showreceiptadd" >
            <address id="line1" ></address>
            <address id="line2" ></address>
            <address id="line3" ></address>
        </div>
        <div   id="newreceiptadd" style="display: none;" >
            <table>
                <tr>
                    <td>ที่อยู่</td> 
                    <td><textarea name="address1" id="address1" placeholder ="111/235 ซ.ตัวอย่าง ถ.ตัวอย่าง แขวงตัวอย่าง เขตตัวอย่าง" > </textarea></td>
                </tr>
                <tr>
                    <td>จังหวัด</td> 
                    <td><select name="province1" id="province1">
                            <?php foreach ($provincelist as $province): ?>
                                <option  value="<? echo $province->getProvinceid(); ?>"><? echo $province->getProvincename(); ?></option>
                            <? endforeach; ?>
                        </select></td>
                </tr>
                <tr>
                    <td>รหัสไปรษณีย์ &nbsp;&nbsp;&nbsp;</td> 
                    <td><input type="text"id="postcode1" name="postcode1" maxlength="5" value=""/></td>
                </tr>
                <tr>
                    <td>โทรศัพท์</td> 
                    <td><input type="text" name="phone1" value=""  id="phone1"/></td>
                </tr>
            </table>
        </div>

        </p>
        <!-- <? echo var_dump($_SESSION); ?>-->
    </div>

</div>
<? $totalprice = 0; ?>
<table class="table table-bordered" id="Ccolum" style="width:auto">
    <thead> <tr> 


            <td>เทมเพลต</td>
            <td>กระดาษ</td>
            <td>ตัวเลือกพิเศษ</td>
            <td>จำนวน</td>
            <td>ราคา</td>
          <!--  <td>ลบ</td>-->

        </tr> </thead>
    <tbody>
        <?php foreach ($_SESSION['temp_orderlinelist'] as $index => $cart): ?>
            <tr>

                <td>   <?php foreach ($templatelist as $orderline): ?>


                        <?php if ($orderline->getTempno() == $cart->getTempno()): ?>
                            <strong> <? echo $orderline->getName(); ?> &nbsp; <? echo $orderline->getTypeno(); ?>&nbsp;
                                <?
                                echo $orderline->getSize();
                                break;
                                ?>
                            </strong>
                        <?php endif; ?>
                    <? endforeach; ?>
                </td>

                <td>   <?php foreach ($paperlist as $paper): ?>
                        <?php if ($paper->getPaperno() == $cart->getPaperno()): ?>
                            <strong> <? echo $paper->getName(); ?> &nbsp; <?
                echo $paper->getGrame();
                break;
                            ?></strong>
                        <?php endif; ?>

                    <? endforeach; ?>
                </td>
                <td>   <?php foreach ($optionlist as $option): ?>

                        <?php if ($option->getOptionno() == $cart->getOptionno()): ?>
                            <strong> <?
                echo $option->getDescription();
                break;
                            ?> </strong>
                        <?php endif; ?>
                    <? endforeach; ?>
                </td>
                <td>
                    <? echo $cart->getQty(); ?>
                </td>
                <td>
                    <?
                    echo number_format($cart->getPrice(), 2, '.', ',');
                    $totalprice = $totalprice + $cart->getPrice();
                    ?>&nbsp; บาท
                </td>
              <!--  <td>
                    <a href="<? echo site_url('orders/removeCartItem') . '/' . $index; ?> ">remove </a>
                </td>-->


            </tr>
        <? endforeach; ?>

    </tbody>
</table>
<div style="float: right; margin-right: 30%" >
    <table>
        <tr>
            <td><strong>ราคาสินค้า</strong></td> 
            <td><strong>&nbsp;: &nbsp;</strong></td>
            <td><strong><? echo number_format($totalprice, 2, '.', ','); ?> บาท</strong></td>
        </tr>
        <tr>
            <td><strong>ค่าจัดส่ง</strong></td> 
            <td><strong>&nbsp;: &nbsp;</strong></td>
            <td><strong><span  id="adprice">120.00</span> บาท</strong></td>
        </tr>
        <tr>
            <td><strong>ภาษี 7%</strong></td> 
            <td><strong>&nbsp;: &nbsp;</strong></td>
            <td><strong><? echo number_format($totalprice * 0.07, 2, '.', ','); ?>บาท</strong></td>
        </tr>
        <tr>
            <td><strong>ราคารวม</strong></td> 
            <td><strong>&nbsp;: &nbsp;</strong></td>
            <td><strong><span  id="sumprice"></span> บาท</strong></td>
        </tr>

    </table>
</div>

<p>
    <label>จัดส่ง: </label> <select id="ordsend" name="ordsend" >
        <?php foreach ($ordsendlist as $ordsend): ?>
            <option <? echo ($this->session->flashdata('ordsend') == $ordsend->getSendmethod()) ? 'selected="selected"' : '' ?> value="<? echo $ordsend->getSendmethod() ?>" >
                <? echo $ordsend->getDescription() ?></option>
        <?php endforeach; ?>
    </select>

    <label>การจ่ายเงิน: </label> <select  name="ordpay" >
        <?php foreach ($ordpaylist as $ordpay): ?>
            <option   <? echo ($this->session->flashdata('ordpay') == $ordpay->getPaymethod()) ? 'selected="selected"' : '' ?>   value="<? echo $ordpay->getPaymethod() ?>" >
                <? echo $ordpay->getDescription() ?></option>
        <?php endforeach; ?>
    </select>

</p>

<label> ข้อความถึงโรงพิมพ์: </label>
<textarea name="cusremark">


</textarea>
<div style="text-align: center;"> <button type="submit" class="btn btn-primary">Create Order</button> </div>
<? echo form_close(); ?>

</div>


<? $this->load->view(lang('footer')) ?>
<script>  totalprice=<? echo $totalprice; ?>;  </script>