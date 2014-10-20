<?php 

$maps = new \Dash\Site\Models\Bingmap;?>


<div class="content container">
                              <div class="row">
                                <div class="col-lg-12">
				      <a href="/event/edit/<?=$event['details']['_id'];?>" class="btn btn-s btn-info pull-right"><i class="icon-edit"></i> Edit</a>
                                  <h1 class="page-title"><?php echo $event['details']->name;?><small> <?php echo $event['details']->category;?></small></h1>
                                </div>
                              </div>
<section id="stats">                           
<div class="col-md-12">
          <div class="row">
		<div class="col-lg-6">
			<div class="widget-container">
            		<div class="widget-footer lt">
              		<div class="row">
                		  <div class="col-xs-4"> <small class="text-muted block"><i class="icon-calendar"></i> Start Date</small> <span><?php echo $event['details']->dates['start_date'];?><br/></span></div>
                		  <div class="col-xs-4"> <small class="text-muted block"><i class="icon-calendar"></i> End Date</small> <span><?php echo $event['details']->dates['end_date'];?><br/></span></div>
		  		  <div class="col-xs-4"> <small class="text-muted block"><i class="icon-map-marker"></i> Address</small> <span><?php echo $event['details']->address['street']; ?> <?php echo $event['details']->address['zip']; ?> <?php echo $event['details']->address['country']; ?></span></small> </div>
              		</div>
              		<div class="row" style="margin:0px;">
			         <div class="col-xs-4"><h3 class="text-info" style="margin:0px;">#HASHTAG</h3></div>
                		  <div class="col-xs-8">Event URL:<br/><A class="text-info" href="http://<?php echo $event['details']->event_id; ?>.msft.cc/home"><i class="icon-link"></i>  http://<?php echo $event['details']->event_id; ?>.msft.css/home</a></div></div>
            		</div>
           		  <div class="">
			   <div class="text-center padder m-t">  <img style="width:100%;opacity:0.6;" src="<?php echo $maps->width('400')->height('181')->location($event['details']['address']['city'] . ', ' . $event['details']['address']['state'])->getImageURL(); ?>" >
			  </div>
            		 </div>

            		<div class="widget-footer lt">
					<legend><i class="icon-user"></i>Social</legend>
              		<div class="row">
	              		<div class="shortcuts"> 
					<div class="shortcut"><h2 class="wbTotal"><?php echo $event['wristbands']['total']; ?></h2><span class="shortcut-label"><i class="icon-facebook-sign"></i> <small>Facebook</small><br/>Likes</span> </div>
					<div class="shortcut"><h2 class="tTotal"><?php echo $event['tickets']['total']; ?></h2><span class="shortcut-label"><i class="icon-facebook-sign"></i> <small>Facebook</small><br/>Shares</span> </div>
					<div class="shortcut"><h2 class="aTotal"><?php echo $event['attendees']->total_items; ?></h2><span class="shortcut-label"><i class="icon-twitter-sign"></i> <small>Twitter</small><br/>Posts</span> </div>
					<div class="shortcut"><h2 class="eTotal"><?php echo $event['wristbands']['withNOAttendeesAndTickets']; ?></h2><span class="shortcut-label"><i class="icon-camera"></i> <small>Instagram</small><br/>Posts</span> </div>
				</div>

				</div>
			</div>
                		 

          		</div>
		</div> 

		<div class="col-md-3 col-xs-12 col-sm-6">
              <div class="stats-heading">Wristbands</div>
              <div class="stats-body-alt" style="height:170px;"> 
                <div class="text-center"><h1><span class="wbAvailable"><?php echo $event['wristbands']['available']; ?></span><small> / <span  class="wbTotal"><?php echo $event['wristbands']['total']; ?></span> </small></h1></div>
		  <small>Inventory Available / Total</small> 
              </div>
              <div class="stats-footer">&nbsp;</div>
              </div>
            <div class="col-md-3 col-xs-12 col-sm-6"> <a href="#" class="stats-container">
              <div class="stats-heading">Attendees</div>
              <div class="stats-body-alt" style="height:170px;"> 
                <!--i class="fa fa-bar-chart-o"></i-->
                <div class="text-center"><h1><span class="aAvailable"><?php echo ( $event['details']['attendees'] - $event['attendees']->total_items ) ?></span><small> / <span class="aTotal"><?php echo $event['details']['attendees']; ?></span> </small></h1></div>
                <small>Available / Capacity </small></div>
              


              <div class="stats-footer"> SMS Opt: <?php echo $event['smsoptin']; ?> | Email Opt: <?php echo $event['emailoptin']; ?></div>
              </a> </div>
		
          
		<div class="col-lg-6">
          		<div class="widget">
            			<div class="widget-header"> <i class="icon-bar-chart"></i>
              			<h3>Wristbands / Attendees </h3>
            			</div>
            			<!-- /widget-header -->
            		<div class="widget-content">
              		<div class="shortcuts"> 
					<div class="shortcut"><h2 class="wbTotal"><?php echo $event['wristbands']['total']; ?></h2><span class="shortcut-label">Total</span> </div>
					<div class="shortcut"><h2 class="tTotal"><?php echo $event['tickets']['total']; ?></h2><span class="shortcut-label">Ticketed</span> </div>
					<div class="shortcut"><h2 class="aTotal"><?php echo $event['attendees']->total_items; ?></h2><span class="shortcut-label">Registered</span> </div>
					<div class="shortcut"><h2 class="eTotal"><?php echo $event['wristbands']['withNOAttendeesAndTickets']; ?></h2><span class="shortcut-label">Empty</span> </div>

					<div class="shortcut"><div class="chart shortcut-icon" data-percent="<?php echo @ceil(( $event['wristbands']['available'] / $event['wristbands']['total'] * 100 )); ?>"><span class="chart-txt"><?php echo ceil(( $event['wristbands']['available'] / $event['wristbands']['total'] * 100 )); ?></span></div><span class="shortcut-label">% Available</span> </div>
					<div class="shortcut"><div class="chart shortcut-icon" data-percent="<?php echo @ceil(( $event['tickets']['total'] / $event['wristbands']['total'] * 100 )); ?>"><span class="chart-txt"><?php echo ceil(( $event['tickets']['total'] / $event['wristbands']['total'] * 100 )); ?></span></div><span class="shortcut-label">% Ticketed</span> </div>
					<div class="shortcut"><div class="chart shortcut-icon" data-percent="<?php echo @ceil(( $event['attendees']->total_items / $event['details']['attendees'] * 100 )); ?>"><span class="chart-txt"><?php echo ceil(( $event['attendees']->total_items / $event['details']['attendees'] * 100 )); ?></span></div><span class="shortcut-label">% Registered</span> </div>
					<div class="shortcut"><div class="chart shortcut-icon" data-percent="<?php echo @ceil(( $event['wristbands']['withNOAttendeesAndTickets'] / $event['wristbands']['total'] * 100 )); ?>"><span class="chart-txt"><?php echo ceil(( $event['wristbands']['withNOAttendeesAndTickets'] / $event['wristbands']['total'] * 100 )); ?></span></div><span class="shortcut-label">% Empty</span> </div>

				</div>
              		<!-- /shortcuts --> 
           		 </div>
            		<!-- /widget-content --> 
          		</div>
        	</div>
          </div>
        </div>
    </div>
</section>
<section id="Activity">

<div class="col-lg-12">
          <div class="widget">
            <div class="widget-header"> <i class="icon-time"></i>
              <h3>Activity</h3>
            </div>
            <div class="widget-content">
<ul class="nav nav-tabs nav-tabs-small" id="filters">
                              <li class="active">
                                    <a class="filter" data-filter="all">All Activity</a>
                              </li>
                              <li class="">
                                    <a class="filter" data-filter="ticket">Tickets</a>
                              </li>
                              <li>
                                    <a class="filter" data-filter="wristband">Wristbands</a>
                              </li>
                              <li>
                                    <a class="filter" data-filter="raffle">Raffle</a>
                              </li>
                              <li>
                                    <a class="filter" data-filter="attendee">Attendees</a>
                              </li>
                              <li>
                                    <a class="filter" data-filter="user">Users</a>
                              </li>
                        </ul>
<legend class="section"></legend>

	
              <div class="timeline-messages" id="activity-log"> 
			<ul id="grid" class="row">
              <?php foreach ($event['activities']->items as $action) : ?>

                <!-- Comment -->
		<li class="mix mix_all <?=$action['type']?> col-lg-12" data-cat="<?=$action['type']?>">
            <div class="filter-content">
                <div class="msg-time-chat"><i class="icon-user message-img 
                  <?php 
                  switch ($action['type']) {
                      case 'prize':
                      echo ' icon-gift ';
                       break;
                        case 'attendee':
                      echo ' icon-check ';
                       break;
                        case 'user':
                      echo ' icon-user ';
                       break;
                        case 'ticket':
                      echo ' icon-headphones ';
                       break;

                     
                     default:
                       # code...
                       break;
                   } ?>


                " style="font-size:55px;"></i>
                  <div class="message-body msg-in"> <span class="arrow"></span>
                    <div class="text">
                      <p class="attribution"><a href=""><?php echo $action['name']; ?></a> at <?php echo $action['timestamp']; ?></p>
                      <p><?php echo $action['message'] ?></p>
                    </div>
                  </div>
                </div>
                <!-- /comment --> 
              </div>
		</li>
                <?php endforeach; ?>
			</ul>
              </div>


            </div>
          </div>
        </div>            
</section>


