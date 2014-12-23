<?php
	/**********************************
	* Get nearby location with coordinate
	* Creator : Geo
	***********************************/
	
	class GeoLocation{
		private $CI;
		private $lattitude = '';
   		private $longitude = '';
    
    function __construct()  {
    	$this->CI  =& get_instance();	
    }
    
    public function setAddress($address) {
        //   $geocode            = file_get_contents('http://maps.google.com/maps/api/geocode/json?address=' . $address . '&sensor=false');
		/********************CURL START*********************************/ // jSON URL which should be requested
		$address = str_replace(' ','%20',$address);
		$json_url = "http://maps.google.com/maps/api/geocode/json?address=" . $address . "&sensor=false";
		// Initializing curl
		$ch = curl_init( $json_url );
		
		 // Configuring curl options
		$options = array(
			CURLOPT_RETURNTRANSFER => true,
			CURLOPT_HTTPHEADER => array('Content-type: application/json') ,
		);
		 curl_setopt_array( $ch, $options );
		// Getting results
		$result =  curl_exec($ch); // Getting jSON result string
		  
		$output = json_decode($result);
		/*****************************CURL END****************************************************/

        $this->lattitude    = $output->results[0]->geometry->location->lat;
        $this->longitude    = $output->results[0]->geometry->location->lng;
    }
    
    public function getLattitude() {
        return $this->lattitude;
    }
    
    public function getLongitude() {
        return $this->longitude;
    }
    
}

class RadiusCheck extends GeoLocation {
    private $maxLat;
    private $minLat;
    private $maxLong;
    private $minLong;
    
    function RadiusCheck($Latitude, $Longitude, $Miles) {

        $EQUATOR_LAT_MILE = 69.172;
        
        $this->maxLat  = $Latitude + $Miles / $EQUATOR_LAT_MILE;
        $this->minLat  = $Latitude - ($this->maxLat - $Latitude);
        
        $this->maxLong = $Longitude + $Miles / (cos($this->minLat * M_PI / 180) * $EQUATOR_LAT_MILE);
        $this->minLong = $Longitude - ($this->maxLong - $Longitude);
        
    }
    
    function MaxLatitude() {
        return $this->maxLat;        
    }
    
    function MinLatitude() { 
        return $this->minLat; 
    }
    
    function MaxLongitude() { 
        return $this->maxLong; 
    }
    
    function MinLongitude() { 
        return $this->minLong; 
    } 
} 

class DistanceCheck {
    
    function DistanceCheck() {}        
 
    function distanceCalculate($lat1, $lon1, $lat2, $lon2, $unit){
	    $theta = $lon1 - $lon2; 
		$dist = sin(deg2rad($lat1)) * sin(deg2rad($lat2)) +  cos(deg2rad($lat1)) * cos(deg2rad($lat2)) * cos(deg2rad($theta)); 
		$dist = acos($dist); 
		$dist = rad2deg($dist); 
		$miles = $dist * 60 * 1.1515;
		$unit = strtoupper($unit);
	 
		if($unit == "K") {
			return ($miles * 1.609344); 
		}
		elseif($unit == "N") {
			return ($miles * 0.8684);
		}
		else
		{
			return $miles;
		}
	}
}
?>