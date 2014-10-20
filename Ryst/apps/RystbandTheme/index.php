<!DOCTYPE html>
<html>
<head>
<?php echo $this->renderView('RystbandTheme/Views::common/head.php'); ?>
</head>
    <!-- PAGE -->
    <div class="wrap">
         <tmpl type="system.messages" />
         <tmpl type="view" />
        <!--/FOOTER -->
    </div>
    <!--/PAGE -->
<?php echo $this->renderView('RystbandTheme/Views::common/footer.php'); ?>
 
 <?php if ($this->app->get('DEBUG')) { ?>    
  <?php echo $this->renderView('RystbandTheme/Views::common/debug.php'); ?>
<?php  } ?>

</body>
</html>
