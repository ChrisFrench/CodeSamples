<!DOCTYPE html>
<html lang="en" class="default <?php echo @$html_class; ?>" >
<head>
<?php  echo $this->renderView('Themes/Bell/Views::common/head.php'); ?>
</head>
<body>
    <!-- PAGE -->
    <body class="metro">
       <tmpl type="system.messages" />
         <tmpl type="view" />
        <!--/FOOTER -->
    </div>
    <!--/PAGE -->
<?php echo $this->renderView('Themes/Bell/Views::common/footer.php'); ?>

<?php if ($this->app->get('DEBUG')) { ?>    
  <?php echo $this->renderView('Theme/Views::common/debug.php'); ?>
<?php  } ?>

</body>
</html>
