
<a href="/user"> User Page</a>
<a href="/logout"> LOGOUT</a>
<a href="/b/demo1"> Demo Band 1</a><br>
<a href="/b/demo2"> Demo Band 2</a><br>
<a href="/b/demo3"> Demo Band 3</a><br>

<script src="//js.pusher.com/2.2/pusher.min.js" type="text/javascript"></script>
  <script type="text/javascript">
    // Enable pusher logging - don't include this in production
    Pusher.log = function(message) {
      if (window.console && window.console.log) {
        window.console.log(message);
      }
    };

    var pusher = new Pusher('5b98106a361e7ee3d043');
    var channel = pusher.subscribe('test_channel');
    channel.bind('my_event', function(data) {
      alert(data.message);
    });
  </script>

<pre>
<?php $user = $this->auth->getIdentity(); var_dump($user);?>
</pre>
