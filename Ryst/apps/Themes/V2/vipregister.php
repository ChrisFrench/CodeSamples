<!DOCTYPE html>
<html  lang="en" class="default <?php echo @$html_class; ?>" >
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <meta name="keywords" content="<?php echo $this->app->get('meta.keywords'); ?>" />
	<meta name="description" content="<?php echo $this->app->get('meta.description'); ?>" />
	<meta name="generator" content="<?php echo $this->app->get('meta.generator'); ?>" />
	<meta name="author" content="">
		<script type="text/javascript" src="/V2/js/jquery.min.js"></script>
	
    <link rel="stylesheet" type="text/css" href="/V2/css/style.css">  
</head>
<body>
    <!-- PAGE -->
    <body >
     
         <tmpl type="view" />
        <!--/FOOTER -->
    </div>
    <!--/PAGE -->
<?php echo $this->renderView('V2/Views::common/footer.php'); ?>
 
<?php if ($this->app->get('DEBUG')) { ?>    
  <?php echo $this->renderView('V2/Views::common/debug.php'); ?>
<?php  } ?>
</body>
</html>