 <div class="pushdown" style="padding:10px;margin-top:10px;">
  Using this option your are going to turn this device into a smart station.
 
		<legend>Select Experience</legend>

            <?php 
            //TODO this should probably be a POST
            foreach ($experiences as $experience) : ?>
                <div id="experience" style="text-align:center;">
                    <a href="/<?php echo $event->event_id; ?>/active/experience/<?php echo $experience->id ?>" class="button large inverse fg-white" style="width:80%; margin-bottom:25px;background:rgba(0,0,0,0.6)!important">
                        <?php echo $experience->name; ?>
                    </a>
 
                </div>
            <?php endforeach; ?>
              
             

 </div>
<div id="footer"></div>