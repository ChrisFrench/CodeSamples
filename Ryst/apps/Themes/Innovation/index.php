<!DOCTYPE html>
<html lang="en" class="default <?php echo @$html_class; ?>" >
<head>
<?php  echo $this->renderView('Themes/Innovation/Views::common/head.php'); ?>
</head>
<body>
    <!-- PAGE -->
    <body >
       <tmpl type="system.messages" />
        <tmpl type="view" />
        <!--/FOOTER -->
    </div>
    <!--/PAGE -->
<?php echo $this->renderView('Themes/Innovation/Views::common/footer.php'); ?>

 <?php if ($this->app->get('DEBUG')) { ?>    
  <?php echo $this->renderView('RystbandTheme/Views::common/debug.php'); ?>
<?php  } ?>
</body>
</html>
