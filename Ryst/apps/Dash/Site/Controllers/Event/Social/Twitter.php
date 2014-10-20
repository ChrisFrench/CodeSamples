<?php 
namespace Dash\Site\Controllers\Event\Social;

class Twitter extends Base

{


    
   function run() {

   		$events = new \Dash\Site\Models\Events;
   		$events->setParam('social.twitter.status', 'on');
   		$docs = $events->getItems();

   		foreach ($docs as $event) {
   			
   	  \Base::instance()->set('eventid',$event->event_id );

     	$consumerKey = 'TLF2hcRb2agGUV90mWkVoA';
     	$consumerSecret = 'qMfRR0lliO931QWEvyYKuT1qkIWHzBhzfjLeyxKX7A';
     	$accessToken = '1049042966-kf31e5uclicB0VpwAeaRHHl7YNTVG06og34P3yB';
     	$accessTokenSecret = 'i31zZ7MbntbDf8FjBb4hN8w9p5pzZW4Ze9ii1PHtfChCT';
     	
     	$twitter = new \Twitter($consumerKey, $consumerSecret, $accessToken, $accessTokenSecret);

		  $tweets = $twitter->search($event->{'social.twitter.tag'});
   		
        		foreach ($tweets as $tweet) {

        			ini_set('mongo.native_long', 1);
              
              try {
                $social = new \Dash\Site\Models\Event\Social;
                $social->insert($this->processTweet($tweet));

              } catch (\Exception $e) {
               // do nothing i guess
                
              }
        			
        		}
   		}

   } 

   function processTweet($tweet) {
   		$array = array();
      //:echo PHP_INT_MAX;
     
   		$array['title'] = $tweet->user->name;
   		$array['source'] = 'twitter';
   		$array['tweet_id'] = $tweet->id;
   		$array['avatar'] = $tweet->user->profile_image_url;
   		//$array['tweeter_banner'] = $tweet->user->profile_banner_url;
   		$array['icon'] = 'twitter';
   		$array['message'] = $tweet->text;
   		$array['published'] = 0;
   		
   		return $array;

   }

}


?>