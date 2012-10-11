<? $this->load->view(lang('bakheader')); ?>

<div class="container" >
    <div class="header"> 
        <h2>งานของ<? $_SESSION['emp']->getEmpno(); ?></h2>
        <hr align="center" size="3" color="#C3C3C3">  </div>

    <div id="search-bar" >  
        <form id="searchform"action="<? echo site_url('Backend/bakwork/empworkpage') ?>" class="form-search" align="center"  method="post">
            ชื่องาน:<input type="text" value="<? echo $this->input->post('keyword');?>" name="keyword" id="email" class="input-small " />
            สถานะ: 
            <select name="finish" >
                <option <?  echo($this->input->post('finish')==0)?'selected="selected"':''; ?> value="0"> ทั้งหมด </option>
            <option <?  echo($this->input->post('finish')==1)?'selected="selected"':''; ?> value="1"> เสร็จ </option>
            <option <?  echo($this->input->post('finish')==2)?'selected="selected"':''; ?> value="2"> ไม่เสร็จ </option>
            </select> 
            รับผิดชอบ: <select name="status" id="emp" >  
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
                #
            </th>
            <th>
                รหัสงาน 
            </th>
            <th>
                ชื่องาน
            </th>
            <th>
                ผู้รับผิดชอบ
            </th>
            <th>
                สถานะ
            </th>
            <th>
                วันเริ่มงาน
            </th>
            <th>
                วันสิ้นสุดงาน
            </th>

            <th>
                
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
                         <td>
                            <?php foreach ($emplist as $emp): ?>

                                <?php if ($emp->getEmpno() == $work->getEmpno()): ?>
                                    <? echo $emp->getName(); ?>&nbsp; <? echo $emp->getLastname();
                        break;
                                    ?> 
                                <?php endif; ?>

    <?php endforeach; ?>
                        </td>
    <td>  <? echo ($work->getEnddate() == null) ? 'ยังไม่เสร็จ':'เสร็จ'; ?></td>
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