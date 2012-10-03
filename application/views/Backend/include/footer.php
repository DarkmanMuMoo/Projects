 



</body>
</html>

<script src="<? echo base_url("asset/javascript/jquery.js"); ?>" >  </script>
<script src="<? echo base_url("asset/javascript/jquery-ui.js"); ?>" >  </script>
        <script>
           $(document).ready(function(){
   // Your code here
  //alert('<?echo get_class(get_instance())?>');
        $('#menu #<?echo get_class(get_instance())?>').addClass('active');
        
 });      
    
</script>
