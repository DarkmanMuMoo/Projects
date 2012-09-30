<? $this->load->view(lang('header')) ?>
<style>
    
    .paragraph{
        float: left ; width:45% ;margin-left:5%; text-align:center;
        
    }
    .paragraph-row{
        clear: both;
        display: table;
		width:100%;
        
    }
    .force{
        width: auto;
        height: auto; 
        overflow: hidden; 
    }
    .hero-unit{
        margin-top: 20px;
        height:130px;
        background:url(asset/css/images/Banner.png);
    }
</style>

<div id="page">
    <div  class="hero-unit" >
        
    </div>
    <hr>
    <div class="paragraph-row"> <div class="paragraph" >

            <img  src="<? echo base_url("asset/css/images/cash.png"); ?>"

           <p></p>
        </div><div  class="paragraph" > 

<img  src="<? echo base_url("asset/css/images/showcal.png"); ?>"

           <p></p></div>     
    </div>
    <hr>
<div class="paragraph-row"> <div class="paragraph" >

           
<img  src="<? echo base_url("asset/css/images/step.gif"); ?>"
           <p> </p>
        </div><div  class="paragraph" >  <h3>Lorem ipsum dolor sit amet</h3>

           <p> Lorem ipsum dolor sit amet, consectetur adipisicing 
            elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. 
            Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut 
            aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate
            velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non 
            proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p></div>     
    </div>

</div>




<? $this->load->view(lang('footer')) ?>
<? echo (isset($opencart)) ? $opencart : '' ?>

<script src="<? echo base_url("asset/javascript/easySlider.js"); ?>" >  </script>
<script>
    
    
    
    $(document).ready(function(){
        // Your code here
    
        $("#slider").easySlider({
            auto: false,
            continuous: true,
            numeric: true
        });
     if($('#slider').css('width')=='0px'){
         $('#slider').attr('style','');
           $("#slider").addClass('force');
     
     }
       

    }); 
    
</script>