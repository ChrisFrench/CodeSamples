<div class="content container">
                              <div class="row">
                                <div class="col-lg-12">
                                  <h2 class="page-title">Experiences <small>Management</small></h2>
                                </div>
                              </div>


                              <!-- PORTFOLIO UNIT -->
    <section id="events" class="color-light text-center">     
        
          <div class="row">
	     <div class="col-sm-2"></div>
            <div class="col-sm-4 col-md-offset-6">
              <div id="filters" class="text-center btn-group">
            
                  <div  class=" btn-group btn-group-justified">
                    <a class="filter btn btn-info active" data-filter="all" href="#">All</a>
                    
                  </div>
		    
              </div>

            </div>

          </div>
	   <br/>
          <div class="container">
            <ul id="grid" class="row">

              <?php foreach ($list->items as $item) :?>

              <li class="col xs-12 col-sm-4 mix <?php echo @$item->{'type'}; ?>" data-cat="<?php echo  @$item->{'type'}; ?>">
                <div class="filter-content">
                        <div class="widget-container">
                    

                    <form action="" method="POST">
                    	                  
                                  <div class="stats-heading"><span class="pull-left"><small>  </small></span><a href="/event/edit/<?php echo @$item->id; ?>" class="btn btn-xs btn-success pull-right"><i class="icon-edit"></i></a><?php echo @$item->{'name'}; ?><a href="event/delete/<?php echo @$item->{'id'}; ?>" class="btn btn-xs btn-danger pull-right"><i class="icon-edit"></i></a></div>
                                    <div class="text-center">
                                <input type="hidden" name="name" value="<?php echo @$item->name; ?>">
                                <input type="hidden" name="type" value="<?php echo @$item->type; ?>">
                                <input type="hidden" name="controller" value="<?php echo @$item->controller; ?>">
                                <input type="hidden" name="action" value="<?php echo @$item->action; ?>">
                        
                                              </div>
                                              <div class="widget-footer lt">
                                                  <div class="row">
                                  <div class="col-xs-3"> <small class="text-muted block">Displays:</small> <span>1</span> </div>
                                  <div class="col-xs-3"> <small class="text-muted block">Users:</small> <span></span> </div>
                                  <div class="col-xs-3"> <small class="text-muted block">Wristbands:</small> <span></span> </div>
                                  <div class="col-xs-3"> <small class="text-muted block">Attendees:</small> <span></span> </div>
                                  </div>
                                          </div>

                                          <label> Device Serial :</label><input data-id="<?php echo @$item->id; ?>" class="device_id" name="device_id" type="text"> <input id="<?php echo @$item->id; ?>" type="submit" name="submit" disabled="disable" value="Add" >
                                  </div>

                                

                       </form>             


                </div>
              </li>
              <?php endforeach; ?>

		</ul>


  
    </section>
 
    
    </div>
    <script type="text/javascript">
    $( document ).ready(function() {
		  $( ".device_id" ).change(function() {
		  	 $('#'+$(this).data('id')).attr('disabled',false);		
		});
	});
    </script>
