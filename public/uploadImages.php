<?php
uploadPhoto();
function uploadPhoto(){  
	
	if(file_exists($_FILES['Filedata']['tmp_name'])){
		if(move_uploaded_file($_FILES['Filedata']['tmp_name'], getcwd().'/tmp/'.$_FILES['Filedata']['name'])) {
    	//echo  'Uploaded ';
		}else{
			echo 'Cant upload file for '.$_FILES['Filedata']['tmp_name'];
			return;
		}
	}
	
	
	/** URL path **/
	$curlurl   = "http://travaguide.com/api/testUploadImages?user=webadmin&key=981bce3f4b506c6eb5473debb3275c27&skipSession=1";	
	
	$data['request'] = $_REQUEST;
	$data['files']   = $_FILES;
	//open connection
	$curl_options = array(
	    CURLOPT_URL => $curlurl,
	    CURLOPT_POST => true,
	    CURLOPT_POSTFIELDS => http_build_query( $data ),
	    CURLOPT_HTTP_VERSION => 1.0,
	    CURLOPT_RETURNTRANSFER => true,
	  );

	  $curl = curl_init();
	  curl_setopt_array( $curl, $curl_options );
	  $results = curl_exec( $curl );
	  $results = json_decode($results);
      echo $results ;
      curl_close( $curl );
	
}


?>