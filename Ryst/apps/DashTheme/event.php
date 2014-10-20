<!DOCTYPE html>
<html lang="en" class="default <?php echo @$html_class; ?>" >
<head>
<?php echo $this->renderView('DashTheme/Views::common/head.php'); ?>
   
</head>
<body>



<div class="container">
  <div class="top-navbar header b-b"> <a data-original-title="Toggle navigation" class="toggle-side-nav pull-left" href="#"><i class="icon-reorder"></i> </a>
    <div class="brand pull-left"> <a href="/"><img src="/dash/images/logo.png"></a></div>
  </div>
</div>
  
<div class="wrapper">

  <div class="left-nav">
    <div id="side-nav">
  <tmpl type="modules" name="nav" />
  </div>
  </div>


  <div class="page-content">
   	 <tmpl type="system.messages" />
     <tmpl type="view" />
  </div>
 </div>
 </div>

<?php echo $this->renderView('DashTheme/Views::common/footer.php'); ?>
<?php echo $this->renderView('DashTheme/Views::common/pusher.php'); ?>


</body>
</html>
