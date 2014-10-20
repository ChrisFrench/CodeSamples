<a class="btn btn-success pull-right" href="./<?php echo $PARAMS['eventid']?>/device/create">New Device</a>

<br clear="both"><br>
<form id="searchForm" action="" method="post">

    <div class="row datatable-header">
        <div class="col-sm-6">
            <div class="row row-marginless">
                <?php if (!empty($list['subset'])) { ?>
                <div class="col-sm-4">
                    <?php echo $pagination->getLimitBox( $state->get('list.limit') ); ?>
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
			  
				<th data-sortable="metadata.title">Device name</th>
				<th>Device ID</th>
				<th>type</th>
				<th>action</th>
				
				<th class="col-md-1"></th>
			</tr>
		</thead>
		<tbody>    
    
        <?php if (!empty($list['subset'])) { ?>
    
        <?php foreach ($list['subset'] as $item) { ?>

            <tr>
                
                            
                <td class="">
                    <a href="./<?php echo $PARAMS['eventid'] ?>/device/edit/<?php echo $item->id; ?>">
                    <?php echo $item->{'device'}; ?>
                    </a>             
                </td>
                
                <td class="">
                    <?php echo $item->{'device_id'}; ?>
                </td>
                
                <td class="">
                    <?php echo $item->{'type'}; ?>
                </td>
                
                <td class="">
                    <?php echo $item->{'action'}; ?>
                </td>
                                
                <td class="text-center">
                    <a class="btn btn-s btn-success" href="./<?php echo $PARAMS['eventid'] ?>/device/edit/<?php echo $item->id; ?>">
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
        <?php if (!empty($list['count']) && $list['count'] > 1) { ?>
        <div class="col-sm-10">
            <?php echo (!empty($list['count']) && $list['count'] > 1) ? $pagination->serve() : null; ?>
        </div>
        <?php } ?>
        <div class="col-sm-2 pull-right">
            <div class="datatable-results-count pull-right">
            <?php echo $pagination ? $pagination->getResultsCounter() : null; ?>
            </div>
        </div>        
    </div>

</form>