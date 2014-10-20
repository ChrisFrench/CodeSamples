<?php  $maps = new \Dash\Site\Models\Bingmap; ?>
<div class="content container">
                              <div class="row">
                                <div class="col-lg-12">
                                  <h2 class="page-title">EVENT MANAGEMENT <small>DASHBOARD</small></h2>
                                </div>
                              </div>


                              <!-- PORTFOLIO UNIT -->
    <section id="events" class="color-light text-center">     
        
          <div class="row">
	     <div class="col-sm-2"><a class="btn btn-info" href="/event/create">Create Event</a></div>
            <div class="col-sm-4 col-md-offset-6">
              <div id="filters" class="text-center btn-group">
            
                  <div  class=" btn-group btn-group-justified">
                    <a class="filter btn btn-info active" data-filter="all" href="#">All</a>
                    <a class="filter btn btn-info" data-filter="NSO" href="#">NSO</a>
                    <a class="filter btn btn-info" data-filter="XBOX" href="#">Xbox</a>
                    <a class="filter btn btn-info" data-filter="HR" href="#">HR</a>
                  </div>
		    
              </div>

            </div>

          </div>
	   <br/>
          <div class="container">
            <ul id="grid" class="row">
              <?php foreach ($list as $item) :?>

              <li class="col xs-12 col-sm-4 mix <?php echo  $item->{'category'}; ?>" data-cat="<?php echo  $item->{'category'}; ?>">
                <div class="filter-content">
                        <div class="widget-container">
                    
                                  <div class="stats-heading"><span class="pull-left"><small>  </small></span><a href="/event/edit/<?=$item['_id'];?>" class="btn btn-xs btn-success pull-right"><i class="icon-edit"></i></a><?=$item['name'];?>&nbsp;<a href="/event/delete/<?=$item['_id'];?>" class="btn btn-xs btn-danger pull-right"><i class="icon-remove"></i></a></div>
                                    <div class="text-center">
                               <a href="/<?=$item['event_id'];?>/dashboard/" class="map" style="background:url('<?php echo $maps->width('400')->height('120')->location(@$item["address"]["city"].', '.@$item["address"]["state"])->getImageURL(); ?>');"></a> 
                                              </div>
                                              <div class="widget-footer lt">
                                                  <div class="row">
                                  <div class="col-xs-3"> <small class="text-muted block">Line:</small> <span><?php echo $item['dates']['start_date']; ?></span> </div>
                                  <div class="col-xs-3"> <small class="text-muted block">Concert:</small> <span><?php echo $item['dates']['end_date']; ?></span> </div>
                                  <div class="col-xs-3"> <small class="text-muted block">Wristbands:</small> <span><?php echo $item['wristbands']['ordered']; ?></span> </div>
                                  <div class="col-xs-3"> <small class="text-muted block">Attendees:</small> <span><?php echo $item['attendees']; ?></span> </div>
                                  </div>
                                          </div>
                                  </div>




                </div>
              </li>
              <?php endforeach; ?>

		</ul>


  
    </section>
 
    
    </div>
