<a class="btn btn-success pull-right" href="./<?php echo $PARAMS['eventid']?>/attendee/create">New Attendee</a>

<br clear="both"><br>
<form id="searchForm" action="" method="post">

    <div class="row datatable-header">
        <div class="col-sm-6">
            <div class="row row-marginless">
                <?php if (!empty($list->total_pages) && $list->total_pages > 1) { ?>
                                <?php echo $list->serve(); ?>
                 <?php } ?>
                 <?php if (!empty($list->items)) { ?>
                        <div class="col-xs-2 col-sm-2 col-md-2 col-lg-2">
                            <span class="pagination">
                            <?php echo $list->getLimitBox( $state->get('list.limit') ); ?>
                            </span>
                        </div>
                        <?php } ?>

            </div>
        </div>    
        <div class="col-sm-4 pull-right">
            <div class="input-group">
                <input class="form-control" type="text" name="filter[keyword]" placeholder="Keyword" maxlength="200" value="<?php echo $state->get('filter.keyword'); ?>"> 
                <span class="input-group-btn">
                    <input class="btn btn-primary" type="submit" onclick="this.form.submit();" value="Search" />
                </span>
            </div>
        </div>
    </div>
    <br/><br/>
    <input type="hidden" name="list[order]" value="<?php echo $state->get('list.order'); ?>" />
    <input type="hidden" name="list[direction]" value="<?php echo $state->get('list.direction'); ?>" />
    
    <div class="table-responsive datatable">
    
    <table class="table table-striped table-bordered table-hover table-highlight table-checkable">
		<thead>
			<tr>
			  
				<th data-sortable="metadata.title">First Name</th>
				<th>Last Name</th>
				<th>Phone</th>
				<th>Email</th>
				
				<th class="col-md-1"></th>
			</tr>
		</thead>
		<tbody>    
    
        <?php if (!empty($list)) { ?>
    
        <?php foreach ($list->items as $item) { ?>

            <tr>
                
                            
                <td class="">
                    <a href="./<?php echo $PARAMS['eventid'] ?>/attendee/edit/<?php echo $item->id; ?>">
                    <?php echo $item->{'first_name'}; ?>
                    </a>             
                </td>
                
                <td class="">
                    <?php echo $item->{'last_name'}; ?>
                </td>
                
                <td class="">
                    <?php echo $item->{'phone'}; ?>
                </td>
                
                <td class="">
                    <?php echo $item->{'email'}; ?>
                </td>
                                
                <td class="text-center">
                    <a class="btn btn-s btn-success" href="./<?php echo $PARAMS['eventid'] ?>/attendee/edit/<?php echo $item->id; ?>">
                        <i class="icon-edit"></i>
                    </a>
                    &nbsp;
                   <!-- <a class="btn btn-s btn-danger" data-bootbox="confirm" href="./admin/blog/post/delete/<?php echo $item->id; ?>">
                        <i class="icon-trash"></i>
                    </a> -->
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
    
    <div class="row datatable-footer">
         <div class="col-sm-10">
                    <?php if (!empty($list->total_pages) && $list->total_pages > 1) { ?>
                        <?php echo $list->serve(); ?>
                    <?php } ?>
                </div>
                <div class="col-sm-2">
                    <div class="datatable-results-count pull-right">
                        <span class="pagination">
                            <?php echo (!empty($list->total_pages)) ? $list->getResultsCounter() : null; ?>
                        </span>
                    </div>
                </div>           
    </div>

</form>