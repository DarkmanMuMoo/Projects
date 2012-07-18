<? $this->load->view(lang('bakheader'));?>

<div class="container" >
    <div id='mainmenu' >
<ul>
    <li class='active '><a href="<?echo site_url('Backend/bakorder') ?>" class="btn"><span>Order management</span></a></li>
   <li><a class="btn" href="<?echo site_url('Backend/bakwork') ?>"><span> Work management</span></a></li>
   <li><a class="btn" href="<?echo site_url('Backend/bakemp') ?>"><span> employee management</span></a></li>
   <li><a class="btn" href="<?echo site_url('Backend/baksms&email') ?>"><span>Sms & Email management</span></a></li>
</ul>
</div>
    
    
    
</div>






<? $this->load->view(lang('bakfooter'));?>