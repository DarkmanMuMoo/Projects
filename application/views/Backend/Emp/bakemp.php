<? $this->load->view(lang('bakheader'));?>

<div class="container" >
    <style>

    #result th{text-align: center;}
    #result td{text-align: center;}
</style>
<div id="search-bar" style="margin-top: 100px;">  
            <form id="searchform"action="<? echo site_url('orders') ?>" class="form-search" align="center"  method="post">
                Keyword:<input type="text"  name="keyword" id="email" class="input-small " />
                position: <select name="status" id="status" >    <?php foreach ($positionlist as $pos): ?>
                                
                    <option value="<?echo $pos->getPosition();?>">  <? echo $pos->getPosdescription();  ?></option>
                              
                                 <?php endforeach; ?></select>
                
                <button type="submit" class="btn">Search</button>
            </form>
 </div>
<div id="result"  align="center">
            <table class="table table-bordered" >
                <thead>
                <th>
                    Number
                </th>
                <th>
                    empno 
                </th>
                <th>
                    Name
                </th>
                <th>
                    Lastname
                </th>
                <th>
                    Email
                </th>
                <th>
                    Phone
                </th>
                <th>
                    Position
                </th>
                <th>
                   management
                </th>
                </thead>

                <tbody>
                    <?php foreach ($emplist as $index => $order): ?>
                        <tr> <td  ><? echo $index + 1 ?> </td>  
                            <td  >
                                
                                    <? echo $order->getEmpno(); ?> 
                              
                            </td> 
                            <td>
                                 <? echo $order->getName(); ?> 
                            </td>
                                <td>
                                 <? echo $order->getLastname(); ?> 
                            </td>
                            <td > <? echo $order->getEmail(); ?> </td>
                             <td ><? echo $order->getPhone(); ?> </td>      
                            <td >
                                 <?php foreach ($positionlist as $pos): ?>
                                <?php if ($pos->getPosition() == $order->getPosition() ): ?>
                                <? echo $pos->getPosdescription(); break; ?>
                               <?php endif; ?>
                                 <?php endforeach; ?>
                            </td> 
                     
                            <td >
                                <a class="btn btn-info" href="<?echo site_url('Backend/bakemp/viewempdetail') . "/" .$order->getEmpno();   ?>"> 
                                   View
                                </a>
                              
                            </td>  
                        </tr>
                    <?php endforeach; ?>


                </tbody>

            </table>

    <hr/>
        </div>


    <button class="btn" > insert new emp</button>
 
    <form id="insertform" action="" method="post">
           
            
            
        </form>
        
        
    </div>
    
    

</div>



<? $this->load->view(lang('bakfooter'));?>