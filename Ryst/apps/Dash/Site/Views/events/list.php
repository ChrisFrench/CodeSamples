<?php //echo \Dsc\Debug::dump( $state, false ); ?>
<?php //echo \Dsc\Debug::dump( $list, false ); ?>

                              <div class="row">
                                <div class="col-lg-12">
<a class="btn btn-success pull-right" href="/event/create">Create Event</a>
                                  <h2 class="page-title">Events</h2>
                                </div>
                              </div>
          <div class="widget">
            <div class="widget-header"> <i class="icon-table"></i>
              <h3>Events</h3>
            </div>
            <div class="widget-content">
                <div class="body">
                    <form id="searchForm" action="/events" method="post">

    <div class="row datatable-header">
        <div class="col-sm-6">
            <di
                <?php if (!empty($list['count']) && $list['count'] > 1) { ?>
                <div class="col-sm-8">
                    <?php echo $pagination->serve(); ?>
                </div>
                <?php } ?>
            </div>
        </div>    

    </div>
    
    <input type="hidden" name="list[order]" value="<?php echo $state->get('list.order'); ?>" />
    <input type="hidden" name="list[direction]" value="<?php echo $state->get('list.direction'); ?>" />
    
   
    <div class="table-responsive datatable">
    
    <table class="table table-striped table-bordered table-hover table-highlight table-checkable">
        <thead>
            <tr>
                <th class="checkbox-column"><input type="checkbox" class="icheck-input"></th>
                <th data-sortable="name">Name</th>
                <th data-sortable="category">Category</th>
                <th data-sortable="dates.start_date">Start Date</th>
                <th data-sortable="dates.end_date">End Date</th>
                <th data-sortable="">Sortable Value</th>
                <th class="col-md-1"></th>
            </tr>
        </thead>
        <tbody>    
    
        <?php if (!empty($list['subset'])) { ?>
    
        <?php foreach ($list['subset'] as $item) { ?>
            <tr>
                <td class="checkbox-column">
                    <input type="checkbox" class="icheck-input" name="ids[]" value="<?php echo $item->id; ?>">
                </td>
                            
                <td class="">
                    <h5>
                    <a href="/<?php echo $item->event_id .'/dashboard'; ?>">
                    <?php echo $item->name; ?>
                    </a>
                    </h5><small>
                    <?php echo $item->{'address.city'}; ?>, <?php echo $item->{'address.state'}; ?> 
                    </small>            
                </td>
                
                <td class="">
                    <?php echo $item->category; ?>
                </td>
                
                <td class="">
                    <?php echo $item->{'dates.start_date'}; ?>
                </td>
                
                <td class="">
                    <?php echo $item->{'dates.end_date'}; ?>
                </td>
                
                <td class="">
                      </td>
                                
                <td class="text-center">
                    <a class="btn btn-small btn-success" href="/event/edit/<?php echo $item->id; ?>">
                        <i class="btn-icon-only icon-edit"></i>
                    </a> <a class="btn btn-small btn-danger" data-bootbox="confirm" href="/event/delete/<?php echo $item->id; ?>">
                        <i class="btn-icon-only icon-remove"></i>
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
    
    <div class="row datatable-footer">

                <?php if (!empty($list['subset'])) { ?>
                <div class="col-sm-2">
                    <?php echo $pagination->getLimitBox( $state->get('list.limit') ); ?>
                </div>
                <?php } ?>
                <?php if (!empty($list['count']) && $list['count'] > 1) { ?>
                <div class="col-sm-8">
                    <?php echo $pagination->serve(); ?>
                </div>
                <?php } ?>
       
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

                </div>
        	</div>    

         </div>
    
   

</form>



