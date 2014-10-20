<h1>My Events</h1>
<?php if(!empty($user->rystbands)) : ?>

<ul>
<?php foreach($user->rystbands as $band) : ?>
<li><h2><a href="/b/<?php echo $band['tagid']; ?>"><?php echo $band['event']['name'] ?></h2></li>
<?php endforeach; ?>
</ul>

<?php else : ?>

<?php endif; ?>