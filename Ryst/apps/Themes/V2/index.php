<!DOCTYPE html>
<html  lang="en" class="default <?php echo @$html_class; ?>" >
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <meta name="keywords" content="<?php echo $this->app->get('meta.keywords'); ?>" />
	<meta name="description" content="<?php echo $this->app->get('meta.description'); ?>" />
	<meta name="generator" content="<?php echo $this->app->get('meta.generator'); ?>" />
	<meta name="author" content="">

    <link rel="stylesheet" type="text/css" href="/V2/css/style.css">  
</head>
<body>
    <!-- PAGE -->
    <body >
        <?php // <tmpl type="system.messages" /> ?>
         <tmpl type="view" />
        <!--/FOOTER -->
    </div>
    <!--/PAGE -->

<?php echo $this->renderView('V2/Views::common/footer.php'); ?>
 
 
 <?php $channel = $this->session->get('tapchannel');
 
if(!empty($channel)): ?>
<script src="//js.pusher.com/2.2/pusher.min.js" type="text/javascript"></script>

<script type="text/javascript">
// Enable pusher logging - don't include this in production
Pusher.log = function(message) {
  if (window.console && window.console.log) {
    window.console.log(message);
  }
};

var pusher = new Pusher('5b98106a361e7ee3d043');
var channel = pusher.subscribe('<?php echo $channel ?>');

channel.bind('redirect', function(data) {
	window.location = data.route
});
</script>
<?php endif; ?>
<?php if ($this->app->get('DEBUG')) { ?>    
  <br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
<br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
<br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
<h1>Debugging</h1>
<hr>
    <div class="clearfix">
        <div class="stats list-group">
            <h4>Stats</h4>
            <div class="list-group-item">
                <?php echo \Base::instance()->format('Page rendered in {0} msecs / Memory usage {1} KB',round(1e3*(microtime(TRUE)-$TIME),2),round(memory_get_usage(TRUE)/1e3,1)); ?>
            </div>
        </div>
        
        <tmpl type="system.loaded_views" />
        
    </div>


<?php  } ?>
</body>
</html>