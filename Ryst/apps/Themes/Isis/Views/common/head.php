<!DOCTYPE html>
<html>
<head>
	<base href="<?php echo $SCHEME . "://" . $HOST . $BASE . "/"; ?>" />
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <meta name="keywords" content="<?php echo $this->app->get('meta.keywords'); ?>" />
	<meta name="description" content="<?php echo $this->app->get('meta.description'); ?>" />
	<meta name="generator" content="<?php echo $this->app->get('meta.generator'); ?>" />
	<meta name="author" content="">

  
    <link rel="stylesheet" type="text/css" href="/Bell/css/ratchet.min.css">
    <link rel="stylesheet" type="text/css" href="/Bell/css/bell.css">
    <title></title>

</head>
<?php if(!empty($event))  :?>
<div id="eventlogo"><a href="/<?php echo $event->event_id; ?>/home/"></a></div> 
<?php else : ?>
<div id="logo"></div> 
<?php endif; ?>
