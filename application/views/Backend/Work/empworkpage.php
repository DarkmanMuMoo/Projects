<? $this->load->view(lang('bakheader')); ?>

<div class="container" >
    <div style="margin-top: 100px; margin-left: auto; margin-right: auto; margin-bottom: 20px;"> 
        <h2>งานของ<? $_SESSION['emp']->getEmpno(); ?></h2>
        <hr align="center" size="3" color="#C3C3C3">  </div>

    <div id="search-bar" >  
        <form id="searchform"action="<? echo site_url('Backend/bakwork/empworkpage') ?>" class="form-search" align="center"  method="post">
            Keyword:<input type="text"  name="keyword" id="email" class="input-small " />
            status: <select name="status" id="emp" >  
                <option value="0">All</option>
                <option value="1">งานที่รับผิดชอบ</option>
                <option value="2">งานทที่มีส่วนร่วม
                </option>
            </select>

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
                <?php foreach ($worklist as $index => $work): ?>
                    <tr> <td  ><? echo $index + 1 ?> </td>  
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

    </div>















    <? $this->load->view(lang('bakfooter')); ?>