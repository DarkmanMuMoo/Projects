  <link href="<? echo base_url("asset/css/bootstrap/css/bootstrap-responsive.css"); ?>" rel="stylesheet">
        <link href="<? echo base_url("asset/css/bootstrap/css/bootstrap.css"); ?>" rel="stylesheet">
         <script src="<? echo base_url("asset/javascript/jquery.js"); ?>" >  </script>
        <script>
        
    function checkuser(){
        
        $.post('<?echo site_url('user/ajaxcheckuser')?>', function(data) {
            
           
if(data=='false'){
    
    alert('please login or Register to create order');
    parent.showloginframe();
}else{
    if(parseInt($('#Ncart').val())>0){
            document.getElementById('checkout').click();
    }else{
        
         alert('ไม่มีสินค้าในตระกร้า');
        
    }
}
});
        
        
    }
        
    </script>
    <div align="center"  >
            <p> <h1> your Cart</h1></p>
                <p>  
           <?  $totalprice=0; ?>
                <table class="table table-bordered" id="Ccolum" style="width:auto; margin-top: 30px;">
                    <thead> <tr> 
                        
                      
                             <td>template</td>
                              <td>กระดาษ</td>
                               <td>option</td>
                                <td>จำนวน</td>
                                 <td>ราคา</td>
                                 <td>ลบ</td>

                        </tr> </thead>
                    <tbody>
                          <?php if (!empty($_SESSION['cart'] )): ?>
                    <?php foreach ($_SESSION['cart'] as $index=>$cart): ?>
                    <tr>
                        
                        <td>   <?php foreach ($templatelist as $orderline): ?>
                            
                            
                            <?php if ($orderline->getTempno() == $cart->getTempno()): ?>
                             <? echo $orderline->getName();?> &nbsp; <? echo $orderline->getTypeno();?>&nbsp;
                            <? echo $orderline->getSize();?>
                           
                            <?php endif; ?>
                             <?endforeach;?>
                        </td>
                   
                         <td>   <?php foreach ($paperlist as  $paper): ?>
                              <?php if ($paper->getPaperno() == $cart->getPaperno()): ?>
                            <? echo $paper->getName();?> &nbsp; <? echo $paper->getGrame();?>
                            <?php endif; ?>
                       
                             <? endforeach;?>
                        </td>
                         <td>   <?php foreach ($optionlist as $option): ?>
                            
                           <?php if ($option->getOptionno() == $cart->getOptionno()): ?>
                            <? echo $option->getDescription();?> 
                            <?php endif; ?>
                             <? endforeach;?>
                        </td>
                      <td>
                            <? echo $cart->getQty();?>
                      </td>
                          <td>
                            <?    echo number_format( $cart->getPrice(), 2, '.', ',');   $totalprice=$totalprice+$cart->getPrice(); ?>บาท
                      </td>
                      <td>
                          <a href="<? echo site_url('product/removeCartItem').'/'.$index;  ?> ">remove </a>
                      </td>
                      
                     
                    </tr>
                    <? endforeach;?>
    <?php else: ?>
                    <tr><td colspan="6" style="text-align: center;" >  <h6>ไม่มีสินค้าในตระกร้า</h6>  </td></tr>
        
        
        <?php endif; ?>
                    </tbody>
                    
                
                </table>
               
<div style="float: right; margin-top: 15px;" >
    <strong>ราคารวม :<?  echo number_format( $totalprice, 2, '.', ',') ?>บาท</strong><p>
        <button class="btn btn-success"  onclick="checkuser();"  style="margin-top: 15px;" > <i class="icon-shopping-cart icon-white"></i> CreatOrder </button>
    </p>
    <a  id="checkout" target="_parent" href="<? echo site_url('orders/Checkout')?>">
                        </a>
                </div>
                <input id="Ncart"  type="hidden" value="<? echo  $Ncart?>" >
                
  </div>
      
            
            
              
            
            
            
      