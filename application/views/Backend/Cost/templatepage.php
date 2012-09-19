<? $this->load->view(lang('bakheader')); ?>

<div class="container" >
    <div id="search-bar" >  
        <form id="searchform"action="<? echo site_url('Backend/bakCost/template') ?>" class="form-search" align="center"  method="post">
            Tempname:<input type="text"  value="<? echo $this->input->post('keyword'); ?>" name="keyword" id="email" class="input-small " />
            type: <select name="type" id="type" >  
                <option value="0">All</option>
                <?php foreach ($typelist as $type): ?>

                    <option  <? echo($this->input->post('type') == $type->getTypeno()) ? 'selected="selected"' : ''; ?> value="<? echo $type->getTypeno(); ?>">  <? echo $emp->getType(); ?> </option>

                <?php endforeach; ?>
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
                Templatename 
            </th>
            <th>
                Size
            </th>
            <th>
                Platesize
            </th>

            <th>
                management
            </th>
            </thead>

            <tbody>
                <? $page = ($this->input->post('startrow')) ? $this->input->post('startrow') : 0; ?>
                <?php foreach ($worklist as $index => $work): ?>
                    <tr> <td  ><? echo $index + 1 + $page ?> </td>  
                        <td  >

                            <? echo $work->getWorkno(); ?> 

                        </td> 
                        <td>
                            <? echo $work->getWorkname(); ?> 
                        </td>
                        <td>
                            <?php foreach ($emplist as $emp): ?>

                                <?php if ($emp->getEmpno() == $work->getEmpno()): ?>
                                    <? echo $emp->getName(); ?>&nbsp; <?
                        echo $emp->getLastname();
                        break;
                                    ?> 
                                <?php endif; ?>

    <?php endforeach; ?>
                        </td>
                        <td > <? echo $work->getStartdate(); ?> </td>
                        <td ><? echo ($work->getEnddate() == null) ? '-' : $work->getEnddate(); ?> </td>      
                        <td >
                            <a class="btn btn-info" href="<? echo site_url('Backend/bakwork/viewworkdetail') . "/" . $work->getWorkno(); ?>"> 
                                View
                            </a>
                            <button class="btn btn-danger"  onclick="Confirmdelete('<? echo $work->getWorkno(); ?>');"> 
                                Delete
                            </button>
                        </td>  
                    </tr>
<?php endforeach; ?>

            </tbody>
        </table>

        <div>

        </div>


<? $this->load->view(lang('bakfooter')); ?>
        <script>


            function pag(i){
                $('#searchform input[name=startrow]').val(i);
   
                $('#searchform').submit();
        
            }
        </script>