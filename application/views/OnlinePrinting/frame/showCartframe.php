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
   
            document.getElementById('checkout').click();
    
}
});
        
        
    }
        
    </script>
        <div align="center">
        <p> <h1> your Cart</h1></p>
                <p>  
           <?  $totalprice=0; ?>
                <table class="table table-bordered" id="Ccolum" style="width:auto">
                    <thead> <tr> 
                        
                      
                             <td>template</td>
                              <td>กระดาษ</td>
                               <td>option</td>
                                <td>จำนวน</td>
                                 <td>ราคา</td>
                                 <td>ลบ</td>

                        </tr> </thead>
                    <tbody>
                    <?php foreach ($_SESSION['cart'] as $index=>$cart): ?>
                    <tr>
                        
                        <td>   <?php foreach ($templatelist as $orderline): ?>
                            
                            
                            <?php if ($orderline->getTempno() == $cart->getTempno()): ?>
                            <strong> <? echo $orderline->getName();?> &nbsp; <? echo $orderline->getTypeno();?>&nbsp;
                            <? echo $orderline->getSize();?>
                            </strong>
                            <?php endif; ?>
                             <?endforeach;?>
                        </td>
                   
                         <td>   <?php foreach ($paperlist as  $paper): ?>
                              <?php if ($paper->getPaperno() == $cart->getPaperno()): ?>
                            <strong> <? echo $paper->getName();?> &nbsp; <? echo $paper->getGrame();?></strong>
                            <?php endif; ?>
                       
                             <? endforeach;?>
                        </td>
                         <td>   <?php foreach ($optionlist as $option): ?>
                            
                           <?php if ($option->getOptionno() == $cart->getOptionno()): ?>
                            <strong> <? echo $option->getDescription();?> </strong>
                            <?php endif; ?>
                             <? endforeach;?>
                        </td>
                      <td>
                            <? echo $cart->getQty();?>
                      </td>
                          <td>
                            <? echo $cart->getPrice();   $totalprice=$totalprice+$cart->getPrice(); ?>
                      </td>
                      <td>
                          <a href="<? echo site_url('orders/removeCartItem').'/'.$index;  ?> ">remove </a>
                      </td>
                      
                     
                    </tr>
                    <? endforeach;?>

                    </tbody>
                    
                
                </table>
                <div style="float: left" >
                     <strong>ราคารวม :<? echo $totalprice?> บาท</strong>
                </div>
<div style="float: right" >
    
    <button class="btn btn-success"  onclick="checkuser();"   > <i class="icon-shopping-cart icon-white"></i> CreatOrder </button>
    <a  id="checkout" target="_parent" href="<? echo site_url('orders/Checkout')?>">
                        </a>
                </div>
                  
                
  </div>
      
            
            
              
            
            
            
      