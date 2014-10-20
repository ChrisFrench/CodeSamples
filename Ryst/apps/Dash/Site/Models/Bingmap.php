<?php 
namespace Dash\Site\Models;

class Bingmap 
{
    //http://dev.virtualearth.net/REST/v1/Imagery/Map/imagerySet/centerPoint/zoomLevel?mapSize=mapSize&pushpin=pushpin&mapLayer=mapLayer&format=format&mapMetadata=mapMetadata&key=BingMapsKey
    var $base = 'http://dev.virtualearth.net/REST/V1/Imagery/Map/Road/';
    var $key = 'AuN2mkocyJhQ0_9RWY3yjrHQUFt9EU1zychBkiaEMucllNPV_OBul0OZPNbd8fyU';
    var $format = 'jpeg';
    var $imagerySet = '';
    var $width = '';
    var $height = '';

    //http://dev.virtualearth.net/REST/V1/Imagery/Map/Road/Salt%20Lake%20City%20utah?key=AuN2mkocyJhQ0_9RWY3yjrHQUFt9EU1zychBkiaEMucllNPV_OBul0OZPNbd8fyU
    public function __construct() {

     
    }

    public function location($location) {
        $this->location = $location;
        return $this;
    }
    public function lat($lat) {
        $this->lat = $lat;
        return $this;
    }
    public function lng($lng) {
        $this->lng = $lng;
        return $this;
    }

     public function width($width = 300) {
        $this->width = (int) $width;
        return $this;
    }
     public function height($height = 200) {
        $this->height = (int) $height;
        return $this;
    }

    public function getImageURL() {
        return $this->base.$this->location.'?mapSize='.$this->width.','.$this->height.'&key='.$this->key.'&dcl=1';
    }

    public function getJPEG() {
        $this->format('jpeg');
        return $this;
    }

    public function getPNG() {
        $this->format('png');
        return $this;
    }

    public function getGIF() {
        $this->format('gif');
        return $this;
    }

}
?>