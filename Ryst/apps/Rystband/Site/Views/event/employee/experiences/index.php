
    <div class="container">
  Using this option your are going to turn this device into a smart station.
    <div class="grid">
      <div class="row">
        <div class="span12" style="padding-top:45px;">
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
      </div>
    </div>
   
        <div class="page-footer">
            <div class="page-footer-content">

                <!--<div data-load="header.html"></div>-->
            </div>
        </div>
    </div>