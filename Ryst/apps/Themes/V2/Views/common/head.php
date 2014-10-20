

    <link rel="stylesheet" type="text/css" href="/V2/css/bell.css">
    <title></title>

</head>
<?php if(!empty($event))  :?>
<div id="eventlogo"><a href="/<?php echo $event->event_id; ?>/home/"></a></div> 
<?php else : ?>
<div id="logo"></div> 
<?php endif; ?>
