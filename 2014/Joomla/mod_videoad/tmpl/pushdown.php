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
<style>
#videoWrapper {
	text-align: center;
		<?php if($params->get ( 'wrapper_height')) : ?>
	height:<?php echo $params->get ( 'wrapper_height');?>;
	<?php endif; ?>
}

;
#videoWrapper .player {
	margin: 0 auto
}

!
important ;

.youtube-player {
	font-size: 86%;
	position: relative;
}

.youtube-player-toolbar {
	background: #111;
	margin: .1em 0 0 0;
}

.youtube-player-toolbar li.youtube-player-time {
	float: right;
	font-weight: normal;
	font-size: 10px;
	line-height: 28px;
	margin: 0pt 5px 0pt 0pt;
	padding: 0;
	display: none;
	cursor: default;
}

.youtube-player-object {
	border: 1px solid #282828;
}

.youtube-player-toolbar li {
	cursor: pointer;
	float: left;
	list-style: none outside none;
	margin: 2px;
	padding: 4px 0;
}

.youtube-player-toolbar li span.ui-icon {
	float: left;
	margin: 0 4px;
}

.youtube-player-playlist-container {
	border: 1px solid #282828;
	margin-top: .2em;
	position: relative;
	display: none;
}

.youtube-player-playlist {
	list-style: decimal;
	overflow: auto;
	margin: 2px;
	padding: 0;
}

#close { display:none;}

.youtube-player-playlist li {
	overflow-x: hidden;
	border: 0;
	cursor: pointer;
	text-decoration: none;
	list-style-type: decimal;
	padding: 2px 4px 2px;
	white-space: nowrap;
	font-size: 13px;
}

.youtube-player-playlist .youtube-player-thumb {
	float: left;
	height: 90px;
	width: 124px;
	list-style: none;
	overflow: hidden;
}

.youtube-player-playlist .youtube-player-thumb img {
	height: 90px;
	width: 124px;
}

.ui-state-default, .ui-widget-content .ui-state-default {
	background-position: -9999px -9999px;
}

.ui-state-hover, .ui-widget-content .ui-state-hover, .ui-widget-header .ui-state-hover,
	.ui-state-focus, .ui-widget-content .ui-state-focus, .ui-widget-header .ui-state-focus
	{
	background-position: 50% 50%;
}

.ui-state-default, .ui-widget-content .ui-state-default,
	.ui-widget-header .ui-state-default {
	border-color: #333;
}
#videoWrapper {
background-image: url('<?php  echo JURI::base().  $params->get ( 'backgroundimage');?>');
}

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
	src="http://test.ammonitenetworks.com/modules/mod_videoad/tmpl/cookie.js"></script>
<script type="text/javascript"
	src="http://ajax.googleapis.com/ajax/libs/swfobject/2.2/swfobject.js"></script>

<script
	src="http://test.ammonitenetworks.com/modules/mod_videoad/tmpl/jquery.youtube.player.min.js"></script>
<script type="text/javascript">


jQuery( document ).ready(function() {

	console.log('ready');
	  if(jQuery.cookie('videoad') != 'shown') {
		  
		
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
								console.log('player ready');
								// 'this' is this playerobject
								// console.debug(this);
								this.playVideo();
								
								//show video shortly after to avoid seeing a buffering screen
								setTimeout(showVideo(this), 700);
								
							},

							onVideoPlay: function(){
						
								console.log('video play');
							},
							
							onVideoPaused: function(){
								hideVideo(this);
								console.log('video paused');
							},

							onError: function(msg){

								alert(msg);

								console.log(msg);
							},

							onBuffer: function(){

								console.log('buffer');
							},
							
							onBeforePlaylistLoaded: function(){

								console.log('playlist loading');
							},

							onAfterPlaylistLoaded: function(){

								console.log('playlist loaded');
							},

							onVideoLoaded: function(videoID){

								console.log('video loaded: ' + videoID);
							},

							onVideoCue: function(videoID){

								console.log('video cued: ' + videoID);
							}
				  };
	       
				  console.log('running');
				  var playerholder = jQuery(".player").player(config);
				  var player = playerholder.player('plugin');
				
				  
					function showVideo(player) {
						
						
						
						jQuery('#videoWrapper').hide();
						jQuery('#videoWrapper').css('position', 'relative');
						jQuery('#videoWrapper').css('margin-left', '0px');
						jQuery('#videoWrapper .player').css('margin', '0 auto');
						
						jQuery('#videoWrapper').show().css({opacity: 0, visibility: "visible"}).animate({opacity: 1.0}, 1000);
						
						
						jQuery('html, body').animate({
						        scrollTop: jQuery("#videoWrapperScroll").offset().top
						    }, 2000);
						

						setTimeout(function(){
							jQuery('#close').show().css({opacity: 0, visibility: "visible"}).animate({opacity: 1.0}, 1000);
							}, 9000);

						
						
						}

					function showVideoPlaceholder() {
						
						player.playVideo();
						jQuery('#videoWrapper').hide();
						jQuery('#videoWrapper').css('position', 'relative');
						jQuery('#videoWrapper').css('margin-left', '0px');
						
						jQuery('#videoWrapper').show().css({opacity: 0, visibility: "visible"}).animate({opacity: 1.0}, 1000);

						jQuery('#placeHolder').hide();	
						
						
						jQuery('html, body').animate({
						        scrollTop: jQuery("#videoWrapperScroll").offset().top
						    }, 2000);
						

						setTimeout(function(){
							jQuery('#close').show().css({opacity: 0, visibility: "visible"}).animate({opacity: 1.0}, 1000);
							}, 2000);

						
						
						}
						
					function hideVideo() {
					
						player.pauseVideo();
						jQuery('#videoWrapper').css({opacity: 1.0, visibility: "visible"}).animate({opacity: 0}, 1000);
						
						jQuery('#videoWrapper').css('position', 'absolute');
						jQuery('#videoWrapper').css('margin-left', '-10000px');
						jQuery('#placeHolder').show().css({opacity: 0, visibility: "visible"}).animate({opacity: 1.0}, 1000);
						}

				  
				  jQuery( "#closeButton" ).click(function() {
					  hideVideo();
					});
				  jQuery( "#placeHolder" ).click(function() {
					  showVideoPlaceholder();
					});
					
				  
				     
			<?php if($params->get ( 'enable_cookie')) : ?>
				jQuery.cookie('videoad', 'shown');
			<?php endif; ?>
		
	     
		  
		}

	  <?php if(!$params->get ( 'enable_cookie')) : ?>
	  jQuery.cookie('videoad', '');
	<?php endif; ?>
	
	});
</script>
<div id="videoWrapperScroll"></div>
<div id="videoWrapper"
	style="position: absolute; margin-left: -10000px; ">
	<div id="close" style="position: absolute; top: 5px; right: 5px">
		<div id="closeButton" class="close"></div>
	</div>
	<div class="player">
		<div class="youtube-player-video">
			<div class="youtube-player-object"></div>
		</div>
	</div>
</div>

<div id="placeHolder" style="display:none;"><img alt="" src="<?php  echo JURI::base(). $params->get ( 'placeholder');?>"></div>

