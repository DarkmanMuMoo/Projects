<? $this->load->view(lang('bakheader')); ?>

<div class="container" >
      <div style="margin-top: 100px; margin-left: auto; margin-right: auto; margin-bottom: 20px;"> 
        <h1>Template</h1>
        <hr > </hr> 
    </div>
    <div id="search-bar" >  
        <form id="searchform"action="<? echo site_url('Backend/bakCost/template') ?>" class="form-search" align="center"  method="post">
            Tempname:<input type="text"  value="<? echo $this->input->post('keyword'); ?>" name="keyword" id="email" class="input-small " />
            type: <select name="type" id="type" >  
                <option value="0">All</option>
                <?php foreach ($typelist as $type): ?>

                    <option  <? echo($this->input->post('type') == $type->getTypeno()) ? 'selected="selected"' : ''; ?> value="<? echo $type->getTypeno(); ?>">  <? echo $type->getType(); ?> </option>

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
                Type
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
                <?php foreach ($templatelist as $index => $template): ?>
                    <tr> <td  ><? echo $index + 1 + $page ?> </td>  
                        <td  >

                            <? echo $template->getName(); ?> 

                        </td> 
                        <td>
                            <? echo $template->getSize(); ?> 
                        </td>
                        <td>
                            <?php foreach ($typelist as $type): ?>

                                <?php if ($type->getTypeno() == $template->getTypeno()): ?>
                                  <?
                        echo $type->getType();
                        break;
                                    ?> 
                                <?php endif; ?>

                            <?php endforeach; ?>
                        </td>
                        <td > <? echo $template->getPlatesize(); ?> </td>
                           
                        <td >
                            <a class="btn btn-info" href="<? echo site_url('Backend/bakCost/templatedetail') . "/" . $template->getTempno(); ?>"> 
                                View
                            </a>
                           
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