 



</body>
</html>

<script src="<? echo base_url("asset/javascript/jquery.js"); ?>" >  </script>
<script src="<? echo base_url("asset/javascript/jquery-ui-1.8.20.custom.min.js"); ?>" >  </script>
        <script>
           $(document).ready(function(){
   // Your code here
  //alert('<?echo get_class(get_instance())?>');
        $('#menu #<?echo get_class(get_instance())?>').addClass('active');
        
 });      
    
</script>
