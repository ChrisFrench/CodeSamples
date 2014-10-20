<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" class="default <?php echo @$html_class; ?>">
<head>
    <?php echo $this->renderView('Bell/Views::common/head.php'); ?>
    <link rel="stylesheet" href="./bell/css/style.css" type="text/css" />
    
</head>
<body class="dsc-wrap <?php echo !empty($body_class) ? $body_class : 'default'; ?>">

<div id="login-container">
    
    <tmpl type="system.messages" />
    
    <tmpl type="view" />
    
</div> <!-- #wrapper -->
<script src="./bell/js/script.js"></script>
</body>

</html>