<? $this->load->view(lang('header')) ?>
<style>
    
    .paragraph{
        float: left ; width:45% ;margin-left:5%;
        
    }
    .paragraph-row{
        clear: both;
        display: table;
        
    }
    .force{
        width: auto;
        height: auto; 
        overflow: hidden; 
    }
</style>

<div id="page">
    <div  class="hero-unit" style="margin-top: 20px;">
        <div id="slider" >
            <ul style=" margin-left: 0px; ">
                <li style="float: left; "><a href="http://templatica.com/preview/27">
                        <img src="<? echo base_url("asset/Sys_img/type_img/A.png"); ?>" alt="Css Template Preview"></a></li>				
                <li style="float: left; "><a href="http://templatica.com/preview/30"><img src="<? echo base_url("asset/Sys_img/type_img/A.png"); ?>" alt="Css Template Preview"></a></li>
                <li style="float: left; "><a href="http://templatica.com/preview/7"><img src="<? echo base_url("asset/Sys_img/type_img/A.png"); ?>" alt="Css Template Preview"></a></li>
                <li style="float: left; "><a href="http://templatica.com/preview/25"><img src="<? echo base_url("asset/Sys_img/type_img/A.png"); ?>" alt="Css Template Preview"></a></li>
                <li style="float: left; "><a href="http://templatica.com/preview/26"><img src="<? echo base_url("asset/Sys_img/type_img/A.png"); ?>" alt="Css Template Preview"></a></li>
                <li style="float: left; "><a href="http://templatica.com/preview/27"><img src="<? echo base_url("asset/Sys_img/type_img/A.png"); ?>" alt="Css Template Preview"></a></li>			
                <li style="float: left; "><a href="http://templatica.com/preview/30"><img src="<? echo base_url("asset/Sys_img/type_img/A.png"); ?>" alt="Css Template Preview"></a></li></ul>
        </div>
    </div>
    <hr>
    <div class="paragraph-row"> <div class="paragraph" >

            <h3>Lorem ipsum dolor sit amet</h3>

           <p> Lorem ipsum dolor sit amet, consectetur adipisicing 
            elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. 
            Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut 
            aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate
            velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non 
            proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
        </div><div  class="paragraph" >  <h3>Lorem ipsum dolor sit amet</h3>

           <p> Lorem ipsum dolor sit amet, consectetur adipisicing 
            elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. 
            Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut 
            aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate
            velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non 
            proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p></div>     
    </div>
    <hr>
<div class="paragraph-row"> <div class="paragraph" >

            <h3>Lorem ipsum dolor sit amet</h3>

           <p> Lorem ipsum dolor sit amet, consectetur adipisicing 
            elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. 
            Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut 
            aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate
            velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non 
            proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
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