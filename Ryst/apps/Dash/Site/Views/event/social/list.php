<a class="btn btn-sucess pull-right" href="./<?php echo $PARAMS['eventid']?>/social/create">New Social Post</a>

<br clear="both"><br>








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
    





 <?php if (!empty($paginated->items)) : ?>
 <div class="filter-content">
<?php foreach($paginated->items as $item) :  ?>

                        <div class="widget-container">
                    
                                  <div class="stats-heading">
                                  <span class="pull-left">
                                  <small> <a href="">Publish</a> </small></span>
                                  <a href="edit/<?php echo $item->id; ?>" class="btn btn-xs btn-success pull-right"><i class="icon-edit"></i></a><?php echo $item->title; ?></div>
                                    <div class="text-center">
                               <a href="/testproject/dashboard/" class="map" style="background:url('<?php echo $item->img; ?>');"></a> 
                                              </div>
                                              <div class="widget-footer lt">
                                                  <div class="row">
                                  <div class="col-xs-12"> <?php echo $item->message; ?></div>
                                  </div>
                                          </div>
                                  </div>




       
<?php endforeach; ?>
         </div>
<?php else : ?>
No items found.
<?php endif; ?>