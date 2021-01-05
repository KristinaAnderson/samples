<?php
/*******************
returns FALSE if PAYROLL ID does not exist in
Deputy (for new employees) or 
Deputy EmployeeAgreement and Employee objects (joined)
if existing employee in Deputy.
@empnum - string PayrollID from database row
NOTE:  PHP-specific search QUERY array syntax.  
********************/  
function deputyExists($token, $baseurl, $empnum) {

	$url = $baseurl.'/api/v1/resource/EmployeeAgreement/QUERY';
	$search = array('search' => array('field1' => array('field' => 'PayrollId', 'type' => 'eq', 'data' => $empnum)), 'join' => array('Employee'));
		
	$data = json_encode($search);
	$record = doCurlPost($url,$data,$token);
    if($jsondc = json_decode($record)) {
	    $exists = $jsondc; 
		} else {
		$exists = false;
	}
		return $exists;
}


/***************
DEPUTY CURL POST UTIL
returns CURL ERROR if thrown OR
Deputy JSON response object if no 
CURL error thrown 
@url = string API ENDPOINT
@data = JSON string (formatted JSON request)
@token - string (valid API token)
*************************/
function doCurlPost($url,$data,$token) {

    $ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, $url);
	curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($ch, CURLOPT_HEADER, false);                                                                    
	curl_setopt($ch, CURLOPT_POST,true);
		if($data) {
		curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
		}

	curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
	curl_setopt($ch, CURLOPT_HTTPHEADER, array(
		'Content-type: application/json',
		'Accept: application/json',
		'Authorization: OAuth ' . $token,
		 'Content-Length: ' . strlen($data),
		'dp-meta-option: none'
		));

	$result = curl_exec($ch);
	
	if($result === FALSE) {
		//error condition exists
		$curl_error = "CURL ERROR: ".curl_errno()." - ".curl_error();
		curl_close($ch);
		return $curl_error;
	} else { 
	//$info = curl_getinfo($ch);
	//var_dump($info);
		curl_close($ch);
		return $result;	
	}
}
?>
