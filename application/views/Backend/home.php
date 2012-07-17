<? $this->load->view(lang('bakheader'));?>

<style>
    #mainmenu{
        
        margin: 0 auto;
    padding-top: 100px;
    width: 40%;
    text-align: center;
  
    }
    
   #mainmenu  ul {
list-style: none;
margin: 0;
padding: 0;

}
#mainmenu  li  {
   
    line-height: 50px;
   margin-bottom: 10px;
 
}
#mainmenu  a  {    
    width: 50%;
     height: 50px;
    font-size: 20px;
   letter-spacing: 3px;
  
}

#mainmenu  a  span {   
 vertical-align: middle;
line-height: 50px;

}
</style>
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