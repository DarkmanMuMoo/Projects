<? $this->load->view(lang('bakheader'));?>
<style>

    #result th{text-align: center;}
    #result td{text-align: center;}
</style>
<div class="container">
<div id="search-bar">  
            <form id="searchform"action="<? echo site_url('orders') ?>" class="form-search" align="center"  method="post">
                Keyword:<input type="text"  name="keyword" id="email" class="input-small datepicker" />
                From :<input type="text" name="fromdate" id="fromdate" class="input-small datepicker" />
                To:<input type="text" name="todate" id="todate"  class="input-small datepicker"  /> >
                
                Status: <select name="status" id="status" >    <?php foreach ($ordstatuslist as $ordstatus): ?>
                                
                    <option value="<?echo $ordstatus->getStatus();?>" >   <? echo $ordstatus->getDescription();  ?></option>
                              
                                 <?php endforeach; ?></select>
                
                <button type="submit" class="btn">Search</button>
            </form>
        </div>
</div>










<? $this->load->view(lang('bakfooter'));?>