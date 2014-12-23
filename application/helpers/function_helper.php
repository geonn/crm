<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

	function match($key,$arr){		
		return isset($arr[$key]) ? $arr[$key] : '';
	}
	
	function append_query_string($url){
		return $_SERVER['QUERY_STRING'] ? $url.'?'.$_SERVER['QUERY_STRING'] : $url;
	}
	
	function object_to_array($object) {
	    return (array) $object;
	}
	
	function print_pre($text)
	{
		echo "<pre>";
		print_r($text);
		echo "</pre>";
	}

	function pr($text)
	{
		echo "<pre>";
		print_r($text);
		echo "</pre>";
	}
	
	function append_file($file,$string){
		  $logfile = getcwd()."/application/logs/".$file;
			$fh = fopen($logfile, 'a') or die("can't open file");
			fwrite($fh, print_r($string,1));
			fclose($fh);
	}
	
	if ( ! function_exists('set_value')) {
		function set_value($field = '', $default = '') {	
			// if (FALSE === ($OBJ =& _get_validation_object()))
			// {
			
				if (isset($_POST[$field])) {
					return form_prep($_POST[$field], $field);				
				}
	
				if (isset($_GET[$field])) {	
					return form_prep($_GET[$field], $field);				
				}
				
				return $default;
			// }
			// return form_prep($OBJ->set_value($field, $default), $field);
		}
	}
	
	function magic_input($data = '', $value = '', $extra = '') {	var_dump($form);
		if (isset($_POST)) {
			if (isset($_POST[$data])) {
				$value = $_POST[$data];
			}
		}

		return form_input($data,$value,$extra);
	}

	function magic_password($data = '', $value = '', $extra = '') {	
		if ( ! is_array($data))
		{
			$data = array('name' => $data);
		}

		$data['type'] = 'password';		
		return form_input($data, $value, $extra);
	}
	
	function magic_textarea($data = '', $value = '', $extra = '') {
		if (isset($_POST)) {
			if (isset($_POST[$data])) {
				$value = $_POST[$data];
			}
		}
		return form_textarea($data,$value,$extra);
	}	
	
	function magic_dropdown($name = '', $options = array(), $selected = array(), $extra = '')
	{
		if (isset($_POST)) {
			if (isset($_POST[$name])) {
				$selected = $_POST[$name];
			}
		}		
		
		return form_dropdown($name,$options,$selected,$extra);
	}
	
	function change_sort($sort){
		if(empty($sort)){
			 $sort = "1";
			 return $sort;
		}
		
		if($sort == "1"){
			$sort = "2";
		}else{
			$sort = "1";
		}
		 return $sort;
	}
	
	function aasort (&$array, $key) {
	    $sorter=array();
	    $ret=array();
	    reset($array);
	    foreach ($array as $ii => $va) {
	        $sorter[$ii]=$va[$key];
	    }
	    asort($sorter);
	    foreach ($sorter as $ii => $va) {
	        $ret[$ii]=$array[$ii];
	    }
	    $array=$ret;
	}
	
	function date_convert($date_convert, $type=""){	
		 if(substr($date_convert,0,10) == "0000-00-00"){
		 	return "";
		}
		
		$geodate =  strtotime($date_convert);
		$date_convert =  date("Y-m-d H:i:s",$geodate); 
	
		$date_processed = substr(str_replace("/", "-", $date_convert),0,10);
	
		if($type =="int"){
			$element = explode("-", $date_processed);
			
			$date_processed =  $element[2]."-".$element[0]."-".$element[1];
		}elseif($type =="ori"){
			$element = explode("-", $date_processed);
			
			$date_processed =  $element[2]."/".$element[1]."/".$element[0];
		}elseif($type =="full"){
			$element = explode(" ", $date_convert);
			$tarikh  = explode("-", $element[0]);
			$masa  = explode(":", $element[1]);
			if($masa[0] > 12 ){
				$masa[0] = $masa[0] -12;
				$format = "pm";
			}else{
				$masa[0] = $masa[0] -0;
				$format = "am";
			}
			$date_processed =  $tarikh[2]."/".$tarikh[1]."/".$tarikh[0] .", ".$masa[0].":".$masa[1] ."".$format ;
		}else{
			$element = explode("-", $date_processed);

			$d2 = mktime(0,0,0,$element[1],$element[2],$element[0]);
			$date_processed =  date('j M Y', $d2);
		}
		
		return $date_processed;
	}

	
	function decode_key($str){
		
		return urldecode(base64_decode($str));
	}
	
	function encode_key($str){
		return urlencode(base64_encode($str));
	}
	
	function limit_text($text,$limit=null) { 

        // Change to the number of characters you want to display 
        $chars = 35; 
        if(!empty($limit)){
        	$chars= $limit;
        }
        
			 if(strlen($text) >= $chars){
				 	$text = $text." "; 
	        $text = substr($text,0,$chars); 
	        $text = substr($text,0,strrpos($text,' ')); 
	        $text = $text."..."; 
				}
        

        return $text; 

    } 
    
	function magic_radio_label($data = '', $options=array(), $selected = '', $sep='',$extra = '')
	{
		$result = '';
		
		if (isset($_POST)) {
			if (isset($_POST[$data])) {
				$selected = $_POST[$data];
			}
		}		
		
		
		if ( ! is_array($data))
		{
			$data = array('name' => $data);
		}
		$data['type'] = 'radio';
		
		$i = 0;		
		foreach ($options as $key => $value) {
			$id = $key."_".$i;
			$data['id'] = $id;
			$result .= form_checkbox($data, $key, ($selected==$key or ($i==0 and $selected==0) ? TRUE : FALSE), $extra). " <label for=$id>$value</label> ".$sep;
			$i++;
		}
		return $result;
	}
	
	function GUID()
	{
		if (function_exists('com_create_guid') === true)
		{			
			return trim(com_create_guid(), '{}'); 
		}
			
		return sprintf('%04X%04X%04X%04X%04X%04X%04X%04X', mt_rand(0, 65535), mt_rand(0, 65535), mt_rand(0, 65535), mt_rand(16384, 20479), mt_rand(32768, 49151), mt_rand(0, 65535), mt_rand(0, 65535), mt_rand(0, 65535));
	}
	
	function compose_mail($sender_mail, $sender_name, $recipient_email, $cc_email="", $bcc_email="", $subject, $message){
		$CI =& get_instance();	
		$CI->load->library('email');

		$CI->email->from($sender_mail, $sender_name);
		$CI->email->to($recipient_email); 
		$CI->email->cc($cc_email); 
		$CI->email->bcc($bcc_email); 
		
		$CI->email->subject($subject);
		$CI->email->message($message);	
		
		$CI->email->send();
	}
	
	function generate_json($array) {
		arrayRecursive($array, 'urlencode', true);
		$json = json_encode($array);
		return urldecode($json);
	}
	
	function arrayRecursive(&$array, $function, $apply_to_keys_also = false){
		static $recursive_counter = 0;
		if (++$recursive_counter > 1000) {
			die('possible deep recursion attack');
		}
		foreach ($array as $key => $value) {
			if (is_array($value)) {
				arrayRecursive($array[$key], $function, $apply_to_keys_also);
			} else {
				$array[$key] = $function($value);
			}
	 
			if ($apply_to_keys_also && is_string($key)) {
				$new_key = $function($key);
				if ($new_key != $key) {
					$array[$new_key] = $array[$key];
					unset($array[$key]);
				}
			}
		}
		$recursive_counter--;
	}
	
	function key_generator(){
		return md5(uniqid(rand(), true)) . md5(uniqid(rand(), true)) . md5(uniqid(rand(), true)) . md5(uniqid(rand(), true));
	}
	
	function convert_sort($sort_arr=array(),$sorting, $default_value='id'){

		if (!empty($sorting)) {
			$element = explode("-", $sorting);
			$order = $element[0];
			$sort  = $element[1];
    	$sorts = $sort_arr[$sort];
		}else{
			$order = $default_value;
			$sort  = "2";
			$sorts = $sort_arr[$sort];
		}
		$return['order'] = $order;
		$return['sort'] = $sort;
		$return['sorts'] = $sorts;
		
		return $return;
	}
	
	function pageToOffset($limit,$page=1){
		return ($page - 1) * $limit;
	}
	
	function retrievedWeatherUpdates($lat,$lon){
		//set POST variables
		$url = "http://api.openweathermap.org/data/2.5/weather?lat=".$lat."&lon=".$lon;

		//open connection
		$ch = curl_init();
		//set the url, number of POST vars, POST data
		curl_setopt($ch,CURLOPT_URL, $url);

		curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

		//execute post
		$result = curl_exec($ch);
		$result = json_decode($result);
		//close connection
		curl_close($ch);    
		
		$weather = array();
		$weather['main'] = $result->weather[0]->main;
		$weather['description'] = $result->weather[0]->description;
		$weather['icon'] = $result->weather[0]->icon;
		$weather['temp'] = KelvinToCelcius($result->main->temp);
		return $weather;		
	}
	
	function KelvinToCelcius($temp){
		return $temp -  273.15 . "°C";
	}
	
	function br2nl($string) {
        return preg_replace('/\<br(\s*)?\/?\>/i', "\n", $string);
    } 
    
    function convertToDBDate($date){
		$date_processed = explode("/", $date);
		return $date_processed[2]."-".$date_processed[1]."-".$date_processed[0];
	}
	
	/*
	Resizes an image and converts it to PNG returning the PNG data as a string
	*/
	function resize($cur_dir, $cur_file, $newwidth, $output_dir) {
		   
		    $olddir   = getcwd();
		    $thumb = explode('.',$cur_file);
		    $filename = $cur_file;
		    $format   = '';
			$output   = "$output_dir/$filename";
			$new_filename = $thumb[0]."_".$newwidth.".".$thumb[1];
			if(is_file($output)){
				return ;
			}

		    if(preg_match("/.jpg/i", "$filename")) {
		        $format = 'image/jpeg';
		    }
		    if (preg_match("/.gif/i", "$filename")) {
		        $format = 'image/gif';
		    }
		    if(preg_match("/.png/i", "$filename")) {
		        $format = 'image/png';
		    }
		  
		    if($format!='') {	    			    	
		        list($width, $height) = getimagesize($cur_dir."/".$filename);
		      
		        $newheight            = $newwidth;
		        switch($format)
		        {
		            case 'image/jpeg':
		            $source = imagecreatefromjpeg($cur_dir."/".$filename);
		            break;
		            case 'image/gif';
		            $source = imagecreatefromgif($cur_dir."/".$filename);
		            break;
		            case 'image/png':
		            $source = imagecreatefrompng($cur_dir."/".$filename);
		            break;
		        }
		
		        $thumb = imagecreatetruecolor($newwidth,$newheight);
		        imagecolorallocate($thumb, 233, 14, 91);
		    	//imageantialias($thumb, TRUE); 
		        
		        imagealphablending($thumb, true);
				
		        $a = imagecopyresampled($thumb, $source, 0, 0, 0, 0, $newwidth, $newheight, $width, $height);
		        
		        if(!is_dir($output_dir)){
		        	$g = mkdir($output_dir, 0777, true);
		        }
		          
		        $output="$output_dir/$new_filename";
		   		switch($format) {
		            case 'image/jpeg':
		            	@imagejpeg($thumb, $output, 100);
		            	break;
		            case 'image/gif';
		            	@imagegif($thumb, $output);
		            	break;
		            case 'image/png':
		           	 	@imagepng($thumb, $output, 9);
		            	break;
		        }  
		        imagedestroy($thumb);
		        imagedestroy($source);
		    }
	}
	
	function localDate(){
		$timestr = strtotime(date('Y-m-d H:i:s')) + 60*60*13;
		return  date('Y-m-d  H:i:s', $timestr);
	}
	
	/***********************************************************************
	***Push Notification to mobile devices**********************************
	***Param [$title= notification title,
			  $message= notification message,
			  $channel= group of user to send( dealer, dispatcher)
	***************************************************************************/
   function push_notification($title, $message, $channel, $ids="",  $badge=0,  $param = array()){
		/*** SETUP ***************************************************/
		$target = "";
		$extra  = "";
		if(!empty($param)){
			$target = $param['target'];
			$extra  = $param['extra'];
		}
		$message = preg_replace( "/\s+/", " ", $message );
		$badge += 1;
	    $tmp_fname  = 'cookie.txt';
	    $json       = '{"alert":"'. $message .'","title":"'. $title .'","vibrate":true,"icon": "pushicon","sound":"default", "badge": '. $badge.', target: "'.$target.'",extra: "'.$extra.'" }';
	 	$ids        = !empty($ids) ? $ids : "everyone";
	    /*** PUSH NOTIFICATION ***********************************/
	 
	    $post_array = array('login' => ACS_LOGIN, 'password' => ACS_PASSWORD);
	 
	    /*** INIT CURL *******************************************/
	    $curlObj    = curl_init();
	    $c_opt      = array(CURLOPT_URL => 'https://api.cloud.appcelerator.com/v1/users/login.json?key='.ACS_APP_KEY,
	                        CURLOPT_COOKIEJAR => $tmp_fname, 
	                        CURLOPT_COOKIEFILE => $tmp_fname, 
	                        CURLOPT_RETURNTRANSFER => true, 
	                        CURLOPT_POST => 1,
	                        CURLOPT_POSTFIELDS  =>  "login=".ACS_LOGIN."&password=".ACS_PASSWORD,
	                        CURLOPT_FOLLOWLOCATION  =>  1,
	                        CURLOPT_TIMEOUT => 60);
	 
	    /*** LOGIN **********************************************/
	    curl_setopt_array($curlObj, $c_opt); 
	    $session = curl_exec($curlObj);     
	 
	    /*** SEND PUSH ******************************************/
	    curl_setopt_array($curlObj, array(
	    	CURLOPT_URL => "https://api.cloud.appcelerator.com/v1/push_notification/notify_tokens.json?key=".ACS_APP_KEY,
	        CURLOPT_COOKIEJAR => $tmp_fname, 
	        CURLOPT_COOKIEFILE => $tmp_fname, 
	        CURLOPT_RETURNTRANSFER => true, 
	        CURLOPT_POST => 1,
	        CURLOPT_POSTFIELDS  =>  "channel=".$channel."&payload=".$json."&to_tokens=".$ids,
	        CURLOPT_FOLLOWLOCATION  =>  1,
	        CURLOPT_TIMEOUT => 60
	    
	    )); 
	    $session = curl_exec($curlObj);     
	 		
	 		
	    /*** THE END ********************************************/
	    curl_close($curlObj);
	   // echo $session;
	}
	
?>