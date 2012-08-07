<? $this->load->view(lang('bakheader')); ?>

<div class="container" >
    <div id="search-bar" style="margin-top: 100px;">  
        <form id="searchform"action="<? echo site_url('Backend/bakwork') ?>" class="form-search" align="center"  method="post">
            Keyword:<input type="text"  name="keyword" id="email" class="input-small " />
            Employee: <select name="emp" id="emp" >  
                <option value="">All</option>
                <?php foreach ($emplist as $emp): ?>

                    <option value="<? echo $emp->getEmpno(); ?>">  <? echo $emp->getName(); ?>&nbsp; <? echo $emp->getLastname(); ?> </option>

                <?php endforeach; ?></select>

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
                Workname
            </th>
            <th>
                Workno 
            </th>
            <th>
                Employee
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
                <?php foreach ($worklist as $index => $emp): ?>
                    <tr> <td  ><? echo $index + 1 ?> </td>  
                        <td  >

                            <? echo $emp->getWorkno(); ?> 

                        </td> 
                        <td>
                            <? echo $emp->getWorkname(); ?> 
                        </td>
                        <td>
                            <?php foreach ($emplist as $emp): ?>

                                <?php if ($emp->getEmpno() == $emp->getEmpno()): ?>
                                    <? echo $emp->getName(); ?>&nbsp; <? echo $emp->getLastname();
                        break; ?> 
                                <?php endif; ?>

    <?php endforeach; ?>
                        </td>
                        <td > <? echo $emp->getStartdate(); ?> </td>
                        <td ><? echo $emp->getEnddate(); ?> </td>      
                        <td >
                            <a class="btn btn-info" href="<? echo site_url('Backend/bakwork/viewworkdetail') . "/" . $emp->getEmpno(); ?>"> 
                                View
                            </a>
                            <button class="btn btn-danger"  onclick="Confirmdelete('<? echo $emp->getWorkno(); ?>');"> 
                                Delete
                            </button>
                        </td>  
                    </tr>
<?php endforeach; ?>



            </tbody>
        </table>

    </div>
    <button onclick="showinsertform();" class="btn" > insert new Work</button>
    <div  id="insertwork" class="divcenter"  >




    </div>
</div>
<script>



</script>

<? $this->load->view(lang('bakfooter')); ?>