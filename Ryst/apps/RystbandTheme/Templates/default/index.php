<!DOCTYPE html>
<html lang="en" class="default <?php echo @$html_class; ?>" >
<head>
    <?php echo $this->renderLayout('common/head.php'); ?>
</head>
<body>
	<!-- PAGE -->
	<body class="metro">
		<?php // <tmpl type="system.messages" /> ?>
         <tmpl type="view" />
		<!--/FOOTER -->
	</div>
	<!--/PAGE -->
	
<?php echo $this->renderLayout('common/footer.php'); ?>
</body>
</html>
