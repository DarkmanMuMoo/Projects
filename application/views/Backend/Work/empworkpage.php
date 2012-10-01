<? $this->load->view(lang('bakheader')); ?>

<div class="container" >
    <div class="header"> 
        <h2>งานของ<? $_SESSION['emp']->getEmpno(); ?></h2>
        <hr align="center" size="3" color="#C3C3C3">  </div>

    <div id="search-bar" >  
        <form id="searchform"action="<? echo site_url('Backend/bakwork/empworkpage') ?>" class="form-search" align="center"  method="post">
            Keyword:<input type="text" value="<? echo $this->input->post('keyword');?>" name="keyword" id="email" class="input-small " />
            Status: <select name="status" id="emp" >  
                <option <?  echo($this->input->post('status')==0)?'selected="selected"':''; ?> value="0">All</option>
                <option  <?  echo($this->input->post('status')==1)?'selected="selected"':''; ?>   value="1">งานที่รับผิดชอบ</option>
                <option  <?  echo($this->input->post('status')==2)?'selected="selected"':''; ?> value="2">งานทที่มีส่วนร่วม
                </option>
            </select>
            <input type="hidden" name="startrow" value="0"/>
            <button type="submit" class="btn">Search</button>
        </form>
    </div>
    <div id="result"  align="center">
        <table class="table table-bordered" >
            <thead>
            <th>
                Number
            </th>
            <th>
                Workno   
            </th>
            <th>
                Workname
            </th>

            <th>
                StartDate
            </th>
            <th>
                Enddate
            </th>

            <th>
                management
            </th>
            </thead>

            <tbody>
                  <? $page=($this->input->post('startrow'))?$this->input->post('startrow'):0; ?>
                <?php foreach ($worklist as $index => $work): ?>
                    <tr> <td  ><? echo $index + 1+$page ?> </td>  
                        <td  >

                            <? echo $work->getWorkno(); ?> 

                        </td> 
                        <td>
                            <? echo $work->getWorkname(); ?> 
                        </td>

                        <td > <? echo $work->getStartdate(); ?> </td>
                        <td ><? echo ($work->getEnddate() == null) ? '-' : $work->getEnddate(); ?> </td>      
                        <td >
                            <a class="btn btn-info" href="<? echo site_url('Backend/bakwork/viewworkdetail') . "/" . $work->getWorkno(); ?>"> 
                                View
                            </a>
                        </td>  
                    </tr>
                <?php endforeach; ?>



            </tbody>
        </table>
  <? echo $this->pagination->create_onclick_links(); ?>
    </div>


    <? $this->load->view(lang('bakfooter')); ?>
    <script>
     function pag(i){
        $('#searchform input[name=startrow]').val(i);
   
        $('#searchform').submit();
        
    }

    </script>