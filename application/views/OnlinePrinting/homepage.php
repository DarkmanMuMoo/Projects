<? $this->load->view(lang('header')) ?>



<div id="page">

    <div id="slider" style="width: 696px; height: 241px; overflow: hidden; ">
        <ul style="width: 4176px; margin-left: 0px; ">
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




<? $this->load->view(lang('footer')) ?>
<?
echo (isset($opencart)) ? $opencart : '' ?>

    <script src="<? echo base_url("asset/javascript/easySlider.js"); ?>" >  </script>
    <script>
    
    
    
         $(document).ready(function(){
   // Your code here
  
         $("#slider").easySlider({
		auto: false,
		continuous: true,
		numeric: true
	});
     
           
           
           
       

 }); 
    
    </script>