<?php //echo \Dsc\Debug::dump( $state, false ); ?>
<?php //echo \Dsc\Debug::dump( $list ); ?>

<a class="btn btn-success pull-right" href="./<?php echo $PARAMS['eventid']?>/user/create">New User</a>

<br clear="both"><br>
<form id="list-form" action="./users" method="post">

    <div class="row datatable-header">
      
        <div class="col-sm-4 pull-right">
            <div class="input-group">
                <input class="form-control" type="text" name="filter[keyword]" placeholder="Keyword" maxlength="200" value="<?php echo $state->get('filter.keyword'); ?>"> 
                <span class="input-group-btn">
                    <input class="btn btn-primary" type="submit" onclick="this.form.submit();" value="Search" />
    
                </span>
            </div>
        </div>
    </div>
    
    <br><br>
    <input type="hidden" name="list[order]" value="<?php echo $state->get('list.order'); ?>" />
    <input type="hidden" name="list[direction]" value="<?php echo $state->get('list.direction'); ?>" />

    <div class="table-responsive datatable">
    
    <table class="table table-striped table-bordered table-hover table-highlight table-checkable">
        <thead>
            <tr>
               
            
                <th data-sortable="email">Email</th>
                <th>First Name</th>
                <th data-sortable="last_name">Last Name</th>
                <th>Groups</th>
                <th></th>
            </tr>

        </thead>
        <tbody>    
        
          <?php if (!empty($paginated->items)) { ?>
    
            <?php foreach($paginated->items as $item) { ?>
                <tr>
                                   
                    <td class="">
                        <?php echo $item->email; ?>
                    </td>
                    <td class="">
                        <?php echo $item->first_name; ?>
                    </td>
                    <td class="">
                        <?php echo $item->last_name; ?>
                    </td>
                    <td class="">
                    <ul>
                    <?php if(is_array($item->groups)) : ?> 
                    <?php foreach ($item->groups as $group) : ?>
                    <li id="<?=$group['id'];?>">
                    <?=$group['name'];?>
                    </li>
                    <?php endforeach; ?>
                    <?php endif; ?>
                    </ul> 
                        
                    </td>
                    <td class="text-center">
                        <a class="btn btn-success " href="./<?php echo $PARAMS['eventid'] ?>/user/edit/<?php echo $item->id; ?>">
                            <i class="icon-edit"></i>
                        </a>
                        &nbsp;
                        <a class="btn  btn-danger" data-bootbox="confirm" href="./<?php echo $PARAMS['eventid'] ?>/user/delete/<?php echo $item->id; ?>">
                            <i class="icon-trash"></i>
                        </a>
                    </td>
                </tr>
            <?php } ?>
        
        <?php } else { ?>
            <tr>
            <td colspan="100">
                <div class="">No items found.</div>
            </td>
            </tr>
        <?php } ?>

        </tbody>
    </table>
    
    </div>
      <div class="dt-row dt-bottom-row">
            <div class="row">
                <div class="col-sm-10">
                    <?php if (!empty($paginated->total_pages) && $paginated->total_pages > 1) { ?>
                        <?php echo $paginated->serve(); ?>
                    <?php } ?>
                </div>
                <div class="col-sm-2">
                    <div class="datatable-results-count pull-right">
                        <span class="pagination">
                            <?php echo (!empty($paginated->total_pages)) ? $paginated->getResultsCounter() : null; ?>
                        </span>
                    </div>
                </div>        
            </div>
        </div> 
    
</form>





