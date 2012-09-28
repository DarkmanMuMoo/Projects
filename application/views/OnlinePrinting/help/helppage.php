<? $this->load->view(lang('header')) ?>
<script type="text/javascript">
   $(document).ready(function(){
        loadpage('<? echo $page?>');
       
   });
function loadpage(page){
    $('#sidebar a').removeClass('hilight');
    $('#'+page).addClass('hilight');
        var url='<? echo site_url('help');?>'+'/'+page;
    $('#content').load(url);
    
}


</script>
<style>
    hr{color: orangeRed;
       background-color: orange;
       height: 1px;

    }
#statuslist> li > a:hover{
        text-decoration: none;
        background-color: #faa732;

    }
.hilight{

        background-color: #faa732;
    }
 .dropdown-menu a{
            
            text-align: left;
        }
        #content{
            
            padding: 0px;
       
        }
</style>

<div id="page">
        <p style ="margin-bottom: 10px;">
    <h1><b>Help</b></h1>
    <h4>คำแนะนำต่างๆ</h4>
</p>
<hr></hr>
    <div id="sidebar">
        <ul id="statuslist"class="nav nav-tabs nav-stacked">
             <li> <a id="step" href="JavaScript:void(0);"  onclick="loadpage('step');">วิธีการใช้งานพิมพ์ออนไลน์</a>  </li>
            <li> <a id="pay" class="hilight"  onclick="loadpage('pay');" href="JavaScript:void(0);"> วิธีชำระเงิน</a>    </li>
             <li> <a id="regis" href="JavaScript:void(0);"onclick="loadpage('regis');" >วิธีการลงทะเบียน</a>  </li>
            
        </ul>
        
    </div>
    
    <div id ="content">
        
        
        
        
        
        
    </div>
    
    
    
    
</div>


<? $this->load->view(lang('footer')) ?>
