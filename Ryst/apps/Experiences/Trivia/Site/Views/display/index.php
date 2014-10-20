<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title>Trivia</title>
</head>
<body>
<h1>Trivia</h1>

<script src="http://code.jquery.com/jquery-1.7.1.min.js"></script>
<script src="//js.pusher.com/2.2/pusher.min.js" type="text/javascript"></script>
<script type="text/javascript">
    // Enable pusher logging - don't include this in production
    Pusher.log = function(message) {
      if (window.console && window.console.log) {
        window.console.log(message);
      }
    };

    var pusher = new Pusher('<?php echo $this->pusher->getPublicKey();?>');
    var channel = pusher.subscribe('test_channel');
    channel.bind('my_event', function(data) {
      alert(data.message);
    });
  </script>
</body>
</html>

