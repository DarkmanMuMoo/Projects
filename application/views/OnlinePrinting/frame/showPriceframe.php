   <style type="text/css">

          #Ccolum td{
                text-align: center;
                width: 50%;           
            }
    </style>
    

     <link href="<? echo base_url("asset/css/bootstrap/css/bootstrap-responsive.css"); ?>" rel="stylesheet">
        <link href="<? echo base_url("asset/css/bootstrap/css/bootstrap.css"); ?>" rel="stylesheet">
<p> <h1> ตารางแสดงราคา</h1></p>
                <p>  
      
                <table class="table table-bordered" id="Ccolum">
                    <tr><td> <strong> ประเภทงาน </strong></td><td> <?echo (isset($type))? $type:'-' ?> </td></tr>
                     <tr><td><strong> กระดาษ  </strong></td><td><?echo (isset($paper))? $paper:'-' ?>  </td></tr>
                      <tr><td><strong> template  </strong></td><td>  <?echo (isset($template))? $template:'-' ?> </td></tr>
                       <tr><td><strong> จำนวน  </strong></td><td> <?echo (isset($qty))? $qty:'-' ?>  </td></tr>
                        <tr><td><strong> option </strong></td><td> <?echo (isset($option))? $option:'-' ?>  </td></tr>
                         <tr><td><strong> ราคารวม </strong></td><td>  <?echo (isset($price))?  number_format( $price, 2, '.', ',').' บาท':'-' ?>  </td></tr>
                </table>
                <?php if (isset($price)): ?>
                
                <div  align="center" >   <a class="btn btn-success"  href="<?echo site_url('home/addtocart') ?>"
                                            target="_parent" >
                        <i class="icon-shopping-cart icon-white"></i>Add to cart</a>   </div>
               
                </p>
                <?php endif; ?>