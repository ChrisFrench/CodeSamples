<?php  \Dsc\System::instance()->get('session')->set('site.login.redirect', '/'.$event->event_id.'/home'); ?>
<div class="span-6 center">
    <div class="tabs">
      
        <div id="formContent" class="tab-content">
            <div class="tab-pane fade active in" id="login">
        	<?php echo $this->renderLayout('Users/Site/Views::login/login.php'); ?>	     
		</div>
            <div class="tab-pane fade" id="register">
        	<?php // echo $this->renderLayout('Users/Site/Views::login/register.php'); ?>  	
        </div>
        </div>
    </div>
</div>







