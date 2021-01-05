<?php
error_reporting(E_ALL & ~E_NOTICE & ~E_WARNING);
ini_set("display_errors", 1);
require("yourdatabaseconnectionfile.php");

$subdomain = "yourbamboosubdomain";
$api_key = "yourreallylongbambooapikey";

$now = new DateTime();
$today = $now->format('Y-m-d H:i:s');
//1 day ago - batch cutoff time - format 2019-07-16T12:06:52Z
$bdate = new DateTime();
$bdate->sub(new DateInterval('P1D'));
$batchdate = $bdate->format('Y-m-d');
$batchtime = $bdate->format('H:i:s');
$since = $batchdate.'T'.$batchtime.'Z';
 
$stuff = getBambooIds($since,$subdomain,$api_key);

foreach($stuff as $s) {
//$s[0] is bambooid, $s[1] is action

//IN BAMBOO, YOU NEED TO ENUMERATE ALL THE FIELDS THAT YOU WANT TO PULL OUT FOR THAT EMPLOYEE
$url1 = "https://$api_key:x@api.bamboohr.com/api/gateway.php/$subdomain/v1/employees/$s[0]?fields=firstName,lastName,bestEmail,status,customDeputyPrimaryLocation,employeeNumber,address1,address2,city,state,zipcode,country,dateOfBirth,gender,mobilePhone,customDeputyLocations,workPhone,homePhone";

$empdetail = doCurlGet($url1);

$node = simplexml_load_string($empdetail, "SimpleXMLElement", LIBXML_NOCDATA);
$employee = json_encode($node);
$emp = json_decode($employee, TRUE);

if($emp) {
//add emergency contact tabular data and other tabular data below to employee array
$url2 = "https://$api_key:x@api.bamboohr.com/api/gateway.php/$subdomain/v1/employees/$s[0]/tables/emergencyContacts";
$empcontacts = doCurlGet($url2);
$contactname = '';
$contactnum = '';

	if($empcontacts) {
		$node1 = simplexml_load_string($empcontacts, "SimpleXMLElement", LIBXML_NOCDATA);
		$employ = json_encode($node1);
		$contacts = json_decode($employ, TRUE);

	if($cf) {
		unset($cf); }
	$cf = array();
	foreach($contacts["row"] as $c) {
			if($c[0]) {
				//one record
				$contactname = $c[0];
				$contactnum = $c[5];
			}
			elseif($c["field"]) {
				foreach($c["field"] as $f) {
					if(!is_array($f)) {
							array_push($cf,$f);
					}
				}
			}
		}			
	}
	if(!$contactname) {
		$contactname = $cf[0];
	}
	$contactnum = $cf[1];
	if(preg_match('/[A-Za-z]+/',$cf[1]) == 1) {
		$contactnum = $cf[2];
	}
	if(preg_match('/[A-Za-z]+/',$cf[1]) == 1 && preg_match('/[A-Za-z]+/',$cf[2]) == 1) {
		$contactnum = $cf[3];
	} 
	 
//add pay rate data
$url3 = "https://$api_key:x@api.bamboohr.com/api/gateway.php/$subdomain/v1/employees/$s[0]/tables/compensation";
$prates = doCurlGet($url3);
$payRate = '';
$payrateEffectiveDate = '';
$payType = '';
$payFrequency = '';

	if($prates) {
		$rates = sortTabulars($prates,TRUE,"PAY");
		$payRate = $rates[0]["rate"];
		$payrateEffectiveDate = $rates[0]["startDate"];
		$payType = $rates[0]["type"];
		$payFrequency = $rates[0]["paySchedule"];
	}

//add employment status data
$empHistoryStatus = '';
$empHistEffectiveDate = '';
$url4 = "https://$api_key:x@api.bamboohr.com/api/gateway.php/$subdomain/v1/employees/$s[0]/tables/employmentStatus";
$history = doCurlGet($url4);
$empHistoryStatus = '';
$empHistEffectiveDate = '';

	if($history) {
		$hist = sortTabulars($history,TRUE,"STATUS");
		$empHistoryStatus = $hist[0]["employmentStatus"];
		$empHistEffectiveDate = $hist[0]["date"];
	}
					//FIELDS FROM BASE EMPLOYEE OBJECT & BAMBOO XML DATA
					if(!is_array($emp["field"][3])) {
						$status = $emp["field"][3];
					} else {
						$status = '';
					}
					if(!is_array($emp["field"][0])) {
						$firstname = $emp["field"][0];
					} else {
						$firstname = '';
					}					
					if(!is_array($emp["field"][1])) {
						$lastname = $emp["field"][1];
					} else {
						$lastname = '';
					}
					if(!is_array($emp["field"][4])) {
						$location = $emp["field"][4];
					} else {
						$location = '';
					}
					if(!is_array($emp["field"][2])) {
						$homeEmail = $emp["field"][2];
					} else {
						$homeEmail = '';
					}
					if(!is_array($emp["field"][5])) {
						$empnumber = $emp["field"][5];
					} else {
						$empnumber = '';
					}
					$bambooid = $s[0];
					
					if(trim($s[1]) == "Inserted") {
						$type = "new";
					} 
					if(trim($s[1]) == "Updated") {
						$type = "update";
					}
					if(!is_array($emp["field"][6])) {
						$address1 = $emp["field"][6];
					} else {
						$address1 = '';
					}
					if(!is_array($emp["field"][7])) {
						$address2 = $emp["field"][7];
					} else {
						$address2 = '';
					}
					if(!is_array($emp["field"][8])) {
						$city = $emp["field"][8];
					} else {
						$city = '';
					}	
					if(!is_array($emp["field"][9])) {
						$state = $emp["field"][9];
					} else {
						$state = '';
					}
					if(!is_array($emp["field"][10])) {
						$zip = $emp["field"][10];
					} else {
						$zip = '';
					}
					if(!is_array($emp["field"][11])) {
						$country = $emp["field"][11];
					} else {
						$country = '';
					}
					if(!is_array($emp["field"][12])) {
						$dateOfBirth = $emp["field"][12];
					} else {
						$dateOfBirth = '';
					}
					if(!is_array($emp["field"][13])) {
						if($emp["field"][13] == "Male") {
							$gender = 1;
						}
						if($emp["field"][13] == "Female") {
							$gender = 2;
						}
					} else {
						$gender = 0;
					}
					if(!is_array($emp["field"][14])) {
						$mobilePhone = $emp["field"][14];
					} elseif(!is_array($emp["field"][16])) {
						$mobilePhone = $emp["field"][16];	
					} elseif(!is_array($emp["field"][17])) {
						$mobilePhone = $emp["field"][17];
					} else {
						$mobilePhone = '';           
					}
					if(!is_array($emp["field"][15])) {
						$deputyLocations = str_replace(",","  ",$emp["field"][15]);
					} else {
						$deputyLocations = '';
					}
					
	$data = [
		'batchdate' => $today,
		'recordtype' => $type,
		'firstname' => $firstname,
		'lastname' => $lastname,
		'email' => $homeEmail,
		'status' => $status,
		'location' => $location,
		'employeeNumber' => $empnumber,
		'bambooID' => $bambooid,
		'address1' => $address1,
		'address2' => $address2,
		'city' => $city,
		'state' => $state,
		'zipcode' => $zip,
		'country' => $country,
		'dateOfBirth' => $dateOfBirth,
		'gender' => $gender,
		'mobilePhone' => $mobilePhone,
		'deputyLocations' => $deputyLocations,
		'processed' => 0,
		'emergencyContact' => $contactname,
		'emergencyContactPhone' => $contactnum,
		'payRate' => $payRate,
		'payrateEffectiveDate' => $payrateEffectiveDate,
		'payType' => $payType,
		'employmentHistoryStatus' => $empHistoryStatus,
		'employmentHistoryEffectiveDate' => $empHistEffectiveDate,
	];
	
	$query ='INSERT INTO bamboobatches_test(
		batchdate,
		recordtype,
		firstname,
		lastname,
		email,
		status,
		location,
		employeeNumber,
		bambooID,
		address1,
		address2,
		city,
		state,
		zipcode,
		country,
		dateOfBirth,
		gender,
		mobilePhone,
		deputyLocations,
		processed,
		emergencyContact,
		emergencyContactPhone,
		payRate,
		payrateEffectiveDate,
		payType,
		employmentHistoryStatus,
		employmentHistoryStatusEffectiveDate
	) VALUES(
		:batchdate,
		:recordtype,
		:firstname,
		:lastname,
		:email,
		:status,
		:location,
		:employeeNumber,
		:bambooID,
		:address1,
		:address2,
		:city,
		:state,
		:zipcode,
		:country,
		:dateOfBirth,
		:gender,
		:mobilePhone,
		:deputyLocations,
		:processed,
		:emergencyContact,
		:emergencyContactPhone,
		:payRate,
		:payrateEffectiveDate,
		:payType,
		:employmentHistoryStatus,
		:employmentHistoryEffectiveDate
	)';

	try {
		$stmt = $pdo->prepare($query);
		$stmt->execute($data);
		$stmt = null;
	} catch (\PDOException $e) {
		throw new \PDOException($e->getMessage(),(int)$e->getCode());
	}
  }
}

//Bamboo returns a lot of data in tabular format which can be hard to process 
function sortTabulars($xml,$sorted,$datatype) {

	$node = simplexml_load_string($xml, "SimpleXMLElement", LIBXML_NOCDATA);		
	$items = array();
	foreach($node as $row) {
		$rowData = array();
		foreach($row->field as $field) {
			$id = (string) $field->attributes()['id'];
			$value = (string) $field;
			$rowData[$id] = $value;
		}
		$items[] = $rowData;
	}
		if($sorted == TRUE) {
			if($datatype == "PAY") {
				usort($items,'date_comparepay');
			}	 
			if($datatype == "STATUS") {
				usort($items,'date_comparestatus');
			}
		}
		return $items;
}

function date_comparepay($a,$b) {
	
	$st1 = strtotime($a['payrateEffectiveDate']);
	$st2 = strtotime($b['payrateEffectiveDate']);
	return $st1 - $st2;
}

function date_comparestatus($c,$d) {

	$st3 = strtotime($c["date"]);
	$st4 = strtotime($d["date"]);
	return $st4 - $st3;
}

function getBambooIds($since,$subdomain,$api_key) {

	$url = "https://$api_key:x@api.bamboohr.com/api/gateway.php/$subdomain/v1/employees/changed/?since=".$since;
	$data = doCurlGet($url);
	$changed = simplexml_load_string($data, "SimpleXMLElement", LIBXML_NOCDATA);
	$fields = json_encode($changed);
	$ids = json_decode($fields,true);
	$new = array();
	$i =0;
	foreach($ids["employee"] as $k=>$v) {
		$new[$i] = array();
		foreach($v as $k=>$v) {
			if($v["action"] !== "Deleted") {
				array_push($new[$i],$v["id"]);
				array_push($new[$i],$v["action"]);
			}
		}
		$i++;
	}
	return $new;
}

function doCurlGet($url){

	$handle = curl_init();
	curl_setopt($handle, CURLOPT_URL, $url);
	curl_setopt($handle, CURLOPT_RETURNTRANSFER, true);
	$data = curl_exec($handle);
	if (curl_error($handle)) {
		$error_msg = curl_error($handle);
		return $error_msg;
	} else {
	curl_close($handle);
	return $data; }
}
?>
