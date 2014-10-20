<!DOCTYPE html>
<html lang="en" class="default <?php echo @$html_class; ?>" >
<head><?php echo $this->renderView('DashTheme/Views::common/head.php'); ?>

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

<script src="http://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.3/jquery.easing.min.js"></script>
<script src="/dash/javascript/jquery.easypiechart.min.js"></script>
<script type="text/javascript">
  $(function() {
    $('.chart').easyPieChart({size:50,barColor:'#b482ff'});
  });
</script>

</body>
</html>
