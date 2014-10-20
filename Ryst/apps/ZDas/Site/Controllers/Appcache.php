<?php 
namespace ZDas\Site\Controllers;

class Appcache extends \Dsc\Controller 
{
   
	
	
  public function manifest() {
  	header("Cache-Control: max-age=0, no-cache, no-store, must-revalidate");
  	header("Pragma: no-cache");
  	header("Expires: Wed, 11 Jan 1984 05:00:00 GMT");
  	header('Content-type: text/cache-manifest');
  	
  	
  	echo 'CACHE MANIFEST'."\n";


  	echo '/das/login'."\n";
  	echo '/das/offline'."\n";
  	echo '/das/test'."\n";
  	echo "\n";
  	
  	echo 'NETWORK:'."\n";
  	echo '*'."\n";
  	
  	echo 'FALLBACK:'."\n";
  	echo '/ /das/offline'."\n";
  	
  	
  	
  }


}
