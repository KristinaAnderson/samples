<?php
//Author Kristina D. Anderson kristina.anderson504@gmail.com 
//Easy Start ActiveCampaign API get: all leads, all tags, leads w tags by ID
error_reporting(E_ALL);
ini_set("display_errors",1);
$contacts = "https://selfemployedsoftwareengineeringconsultant1608733921.api-us1.com/api/3/contacts?status=-1&orders%5Bemail%5D=ASC";
//LIST OF ALL YOUR CONFIGURED TAGS
$tags = "https://selfemployedsoftwareengineeringconsultant1608733921.api-us1.com/api/3/tags";


$leads = doCurl($contacts);
//TRUE = ARRAY; FALSE(DEFAULT) = OBJECT
$leadsarr = json_decode($leads,TRUE);
//var_dump($leadsarr["contacts"]);
foreach($leadsarr["contacts"] as $l) {
	$id = $l["id"];
	$contacttags = "https://selfemployedsoftwareengineeringconsultant1608733921.api-us1.com/api/3/contacts/{$id}/contactTags";
	$mytags = doCurl($contacttags);
	var_dump(json_decode($mytags,TRUE));
	//FROM HERE, GET TAG DATA BY ID OR MAP FROM ALL TAGS ARRAY
}

function doCurl($url,$data=NULL) {

	$handle = curl_init();
	//UNCOMMENT THIS AND ADD $data IF POST
	//curl_setopt($handle, CURLOPT_POST, 1);
	curl_setopt($handle, CURLOPT_URL, $url);
	curl_setopt($handle, CURLOPT_RETURNTRANSFER, 1);
	//UNCOMMENT THESE IN DEV IF YOU WANT TO VIEW ALL HEADERS
	//curl_setopt($handle,CURLOPT_HEADER, true);
	//curl_setopt($handle, CURLINFO_HEADER_OUT, true);
	//ACTIVECAMPAIGN AUTH HEADER FORMAT
	curl_setopt($handle, CURLOPT_HTTPHEADER, array(
		'Api-Token: YOUR REALLY LONG TOKEN STRING HERE'
		));
	$result = curl_exec($handle);
    
	if (curl_error($handle)) {
		$error_msg = curl_error($handle)."-".curl_errno($handle);
		return $error_msg;
	} else {
		return $result;
	}
	curl_close($handle);
}
?>
