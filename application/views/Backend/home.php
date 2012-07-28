<? $this->load->view(lang('bakheader'));?>

<div class="container" >
    <div id='mainmenu' >
        
     <?php if ($_SESSION['emp']->getPosition() == 'Boss'): ?>   
<ul>
    <li>
    <a href="<?echo site_url('Backend/bakorders') ?>" class="btn"><span>Order management</span></a></li>
   <li><a class="btn" href="<?echo site_url('Backend/bakwork') ?>"><span> Work management</span></a></li>
   <li><a class="btn" href="<?echo site_url('Backend/bakemp') ?>"><span> employee management</span></a></li>
   <li><a class="btn" href="<?echo site_url('Backend/baksms&email') ?>"><span>Sms & Email management</span></a></li>
</ul>
      <?php else: ?>
        <ul>
            <li>
    <a href="<?echo site_url('Backend/bakemp/empprofile') ?>" class="btn"><span>Profile</span></a></li>
   <li><a class="btn" href="<?echo site_url('Backend/bakwork/getwork') ?>"><span>My Work </span></a></li>

        </ul>
        <?php endif; ?>
</div>
    
    
    
    
</div>






<? $this->load->view(lang('bakfooter'));?>