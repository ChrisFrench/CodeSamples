<div id="top">		
   <div class="center">


<form action="user/change-avatar" method="post" enctype="multipart/form-data"  style="opacity:0;height:1px!important;" >

  <input style="opacity:0;height:1px!important;" id="fileupload" type="file" name="avatar" accept="image/*" capture>

</form>


	<label for="fileupload">
	<div class="first ch-item ch-img-1 profileimg">
<div class="spinner moon"></div>
            <div class="ch-info">
                <h3><?php echo $user->first_name.' '.$user->last_name; ?></h3>
                <p>Welcome to Ryst!</p>
            </div>
        </div>
	</label>
   </div>
</div>
<ul id="nav">
<li class="active"><a href="#files" data-id="files">Files</a></li>
<li><a href="#connnections" data-id="connections">Connections</a></li>
<?php if(!empty($user->events)) : ?>
<li><a href="#events">My Events</a></li>
<?php endif; ?>
<li><a href="#social">Social</a></li>
</ul>
<div id="bottom">
<div id="files">
  <ul class="files">
    <li class="file">
      <img src="/media/img/icons/photos.png">
      <h3>filename.jpg</h3>
      <h4>43kb</h4>
    </li>
    <li class="file">
      <img src="/media/img/icons/photos.png">
      <h3>filename.jpg</h3>
      <h4>43kb</h4>
    </li>
    <li class="file">
      <img src="/media/img/icons/photos.png">
      <h3>filename.jpg</h3>
      <h4>43kb</h4>
    </li>
    <li class="file">
      <img src="/media/img/icons/photos.png">
      <h3>filename.jpg</h3>
      <h4>43kb</h4>
    </li>
  </ul>
</div>

<div id="connections">


  <ul class="files">
  
    <li class="file">
      <img src="/media/img/icons/photos.png">
      <h3>john</h3>
      <h4>doe</h4>
    </li>
    <li class="file">
      <img src="/media/img/icons/photos.png">
      <h3>filename.jpg</h3>
      <h4>43kb</h4>
    </li>
    <li class="file">
      <img src="/media/img/icons/photos.png">
      <h3>filename.jpg</h3>
      <h4>43kb</h4>
    </li>
    <li class="file">
      <img src="/media/img/icons/photos.png">
      <h3>filename.jpg</h3>
      <h4>43kb</h4>
    </li>
  </ul>
</div>

</div>

<script type="text/javascript">
var sel="files";

   $('#nav a').click( function(e) {
	e.preventDefault();
	var sd= $(this).data('id');
	console.log(sd);
	$('#' + sel).hide();
	$('.active').removeClass('active');
	$(this).parent('li').addClass('active');
	sel=$(this).data('id');
	$('#' + sel).fadeIn();
		
   });
   $(window).load( function() {
	setTimeout( function() {
	
	 $(".ch-item").removeClass("first");
	}, 1100)
   });

$(':file').change(function(){

 		var formData = new FormData($('form')[0]);
             $('.ch-img-1').css('background-image', "url(/media/img/loader.gif)");
		if (formData) {
        $.ajax({
            url: "user/change-avatar",
            type: "POST",
	     enctype: 'multipart/form-data',
            data:  formData,
	     dataType: "json",
            contentType: false,
            cache: false,
            processData:false,
            success: function(data){
	//	console.log(data);
               $('.ch-img-1').css('background-image', "url("+ data.slug +")");
		
            }           
       });
   

}
	
});
	$('.profileimg').bind('touchstart click', function(e){

		e.preventDefault();
		console.log('click!');
		$('#fileupload').click();
	});

</script>
<style type="text/css">
	.ch-img-1 { 
	    background-image: url(<?php echo $user->profilePicture();?>);
	    background-size:cover;
	}
</style>

