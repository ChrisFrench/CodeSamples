<?php $images = (new  \ZDas\Models\Assets())->setCondition('type', 'experience.photobooth')->getList(); ?>
<style>

li { float: left; display: block; border: #fff solid 2px; margin: 5px;}



</style>



<ul>
<?php foreach($images as $image) : ?>
<li> <a target="_blank" href="/asset/<?php echo $image->slug; ?>"><img src="/asset/thumb/<?php echo $image->slug; ?>"></a></li>
<?php endforeach; ?>
</ul>
