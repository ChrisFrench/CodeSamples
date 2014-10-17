<?php
/**
 * @package     Joomla.Site
 * @subpackage  mod_custom
 *
 * @copyright   Copyright (C) 2005 - 2014 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */
defined ( '_JEXEC' ) or die ();
?>

<link rel="stylesheet" href="http://test.ammonitenetworks.com/modules/mod_videoad/css/magnific-popup.css">
<style>
#videoWrapper {
width: 95%;
<?php if($params->get ( 'wrapper_height')) : ?>
height:<?php echo $params->get ( 'wrapper_height');?>;
<?php endif; ?>
	margin: 0 auto;
	text-align: center;
	background-image: url('<?php  echo JURI::base().  $params->get ( 'backgroundimage');?>');
	   background-repeat: no-repeat;
    background-attachment: fixed;
    background-position: center; 
}
#videoWrapper a {
width: 100%;
height:100%;
display: block;
}

;
#videoWrapper .player {
	margin: 0 auto;
}

.youtube-player-object {
	border: 1px solid #282828;
}


#close { display:none;}




.close {
background: transparent url(<?php  echo JURI::base(); ?>modules/mod_videoad/tmpl/button-close.png) no-repeat 0 0;
height: 47px;
width: 44px;
z-index: 98;
}

<?php echo $params->get ( 'customcss', '' );
?>
</style>


<script
	src="<?php  echo JURI::base(); ?>modules/mod_videoad/tmpl/cookie.js"></script>
<script type="text/javascript"
	src="http://ajax.googleapis.com/ajax/libs/swfobject/2.2/swfobject.js"></script>

<script
	src="<?php  echo JURI::base(); ?>modules/mod_videoad/tmpl/jquery.youtube.player.min.js"></script>
<script
	src="<?php  echo JURI::base(); ?>modules/mod_videoad/js/jquery.magnific-popup.min.js"></script>	
<script type="text/javascript">


jQuery( document ).ready(function() {

	  

		  
			
			
		  
		
				  var config =  {
						  width: <?php echo $params->get('width', '425');?>,                     // player width (integer or string)
					        height: <?php echo $params->get('height', '356');?>,                    // player height (integer or string)
					        swfobject: window.swfobject,    // swfobject object
					       
					        showPlaylist: 0,                // show playlist on plugin init (boolean)
					        showTime: 1,                    // show current time and duration in toolbar (boolean)
					        showTitleOverlay: 1,            // show video title overlay text (boolean)
					        videoThumbs: 0,                 // show videos as thumbnails in the playlist area (boolean) (experimental)
					        randomStart: 0,                 // show random video on plugin init (boolean)
					        autoStart: 0,                   // auto play the video after the player as been built (boolean)
					        autoPlay: 0,                    // auto play the video when loading it via the playlist or toolbar controls (boolean)
					        repeat: 0,                      // repeat videos (boolean)
					        repeatPlaylist: 0,              // repeat the playlist (boolean) 
					        shuffle: 0,                     // shuffle the play list (boolean)
					        chromeless: 1,                  // chromeless player (boolean)
					        updateHash: 0,                  // update the location hash on video play (boolean)
					        highDef: 0,                     // high definition quality or normal quality (boolean)
					        playlistHeight: 0,              // height of the playlist (integer) (N * playlist item height)
					        playlistBuilder: null,          // custom playlist builder function (null or function) see http://github.com/badsyntax/jquery-youtube-player/wiki/Installation-and-usage
					        playlistBuilderClickHandler: null, // custom playlist video click event handler, useful if you want to prevent default click event (null or function)
					        playlistSpeed: 550,             // speed of playlist show/hide animate
					        toolbarAppendTo: null,          // element to append the toolbar to (selector or null)
					        playlistAppendTo: null,         // element to append the playlist to (selector or null)
					        timeAppendTo: null,             // elemend to append to time to (selector or null)
					        videoParams: {                  // video <object> params (object literal)
					                allowfullscreen: 'true', 
					                allowScriptAccess: 'always',
					                wmode:  'transparent'
					        },      
					        showToolbar: 0,                 // show or hide the custom toolbar (boolean)
					        toolbarButtons: {},             // custom toolbar buttons
					        toolbar: '', // comma separated list of toolbar buttons
											  
			                playlist: {
			                        title: '',
			                        videos: [
			                                { id: '<?php echo $params->get('youtube_id');?>', title: '' }
			                        ]
			                },
			    
			             // callback events

							onReady: function(){
								// 'this' is this playerobject
								// console.debug(this);
								this.playVideo();
								
								//show video shortly after to avoid seeing a buffering screen
								showVideo(this);
								
							},

							onVideoPlay: function(){
						
							
							},
							
							onVideoPaused: function(){
								hideVideo(this);
							
							},

							onError: function(msg){

							

								
							},

							onBuffer: function(){

								
							},
							
							onBeforePlaylistLoaded: function(){

								
							},

							onAfterPlaylistLoaded: function(){

							},

							onVideoLoaded: function(videoID){

							
							},

							onVideoCue: function(videoID){

							}
				  };

				  var playerholder;
					 var player ;

					 jQuery( "#placeHolder" ).click(function() {
						// Open directly via API
							jQuery.magnificPopup.open({
								// you may add other options here, e.g.:
							
								  closeOnBgClick: false,
								  
								  showCloseBtn: false,
								  
								  callbacks: {
								    open: function() {
								    	
								    	  playerholder = jQuery(".player").css('margin', '0 auto').player(config);
								    	  
										  player = playerholder.player('plugin');
										
								    },
								    afterClose: function() {
								    	hideVideo();
								      }
								    
								    // e.t.c.
								  },
								  items: {
									    src: '#videoWrapper', // can be a HTML string, jQuery object, or CSS selector
									    type: 'inline',
									    
									  }
								
							  
							});
						


								
						});
						

					 
				
					
				  
				
					

				 
				  
					function showVideo(player) {
					
						
						setTimeout(function(){
							jQuery('#close').show().css({opacity: 0, visibility: "visible"}).animate({opacity: 1.0}, 1000);
							}, <?php echo $params->get('close_seconds');?>000);
	
						}

					function showVideoPlaceholder() {
						
						player.playVideo();
						jQuery('#videoWrapper').hide();
						jQuery('#videoWrapper').css('position', 'relative');
						jQuery('#videoWrapper').css('margin-left', '0px');
						
						jQuery('#videoWrapper').show().css({opacity: 0, visibility: "visible"}).animate({opacity: 1.0}, 1000);

						jQuery('#placeHolder').hide();	
						
						
					

						setTimeout(function(){
							jQuery('#close').show().css({opacity: 0, visibility: "visible"}).animate({opacity: 1.0}, 1000);
							}, 2000);

						
						
						}
						
					function hideVideo() {
						jQuery.magnificPopup.close();
					
						player.pauseVideo();
						jQuery('#placeHolder').show();
						}

				  
				  jQuery( "#closeButton" ).click(function() {
					  hideVideo();
					});
				 
				  
				     
			
		
			if(jQuery.cookie('videoad') != 'shown') {
				 setTimeout(function(){
						jQuery('#placeHolder').trigger( "click" );
						}, 5000);
			 
			<?php if($params->get ( 'enable_cookie')) : ?>
				jQuery.cookie('videoad', 'shown');
			<?php endif; ?>
			}
	
	});
</script>


<div id="placeHolder"><img alt="" src="<?php  echo JURI::base(). $params->get ( 'placeholder');?>"></div>



<div style="position: relative;" >
<div id="videoWrapper" class="white-popup mfp-hide" >
<div id="close" style="position: absolute; top: 5px; right: 5px">
		<div id="closeButton" class="close"></div>
	</div>
<a href="<?php echo $params->get('link');?>">
	
	<div class="player">
		<div class="youtube-player-video">
			<div class="youtube-player-object"></div>
		</div>
	</div>
</a>
</div>
</div>


