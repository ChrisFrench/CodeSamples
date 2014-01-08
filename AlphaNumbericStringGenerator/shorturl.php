<?php
namespace models;

class ShortUrl  {
    var $db;
    var $mapper;
    var $key;
    var $min = 0;
    var $max ;

    //protected $chars = array('a','A','b','B','c','C','d','D','f','F','g','G','h','H','i','I','j','J','k','K','l','L','m','M','n','N','o','O','p','P','q','Q','r','R','s','S','t','T','u','U','v','V','w','W','x','X','y','Y','z','Z', '1','2','3','4','5','6','7','8','9','0');
    protected $chars = array('c','x','7','O','f','6','A','1','o','d','B','v','4','J','T','H','S','l','q','k','C','t','F','j','0','n','g','M','N','W','3','V','5','G','m','2','X','U','r','Q','y','u','R','p','K','b','D','w','9','s','i','a','8','L','P','z','I','Z','Y','h');

      // Instantiate mapper
     public function __construct($length = 10, $subdomain = null) {


        $this->db=new \DB\Jig('db/data/',\DB\Jig::FORMAT_JSON);
        
        $this->mapper=new \DB\Jig\Mapper($this->db,'urls');
        $this->mapper->load(array('@length=?',$length));
        
        $this->key =  $this->mapper->key;
        $this->max = count($this->chars);
        $this->max--;
    } 

    public function getShortUrl() {
        
        $exploded = str_split($this->key);
        $positions = array();

        // convert our characters to array positions of the chartater array
        foreach ($exploded as $value) {
            $positions[] = array_search($value, $this->chars);

        }
        // now we need to calucation  the increase, so we add +1 to the last element and check if we need to increase going left.
        $keys = array_keys($positions);
        $currentKey =  end($keys); 
    
        $update = true;
        while ($update == true) {
          $positions[$currentKey]++;
          if($positions[$currentKey] > $this->max) {
            $positions[$currentKey] = $this->min;
            $currentKey--;
          } else {
             $update = false;
          }
        }
        //convert the positions back to a string
        $url = '';
        foreach ($positions as $key) {
            $url .= $this->chars[$key];
        }

        $this->mapper->key = $url;
        $this->mapper->update();
        
        return $url;
    }
}