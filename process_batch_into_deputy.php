<?php
require("deputy_functions.php");

//PULL OUT UNPROCESSED 
$qy = "SELECT * FROM $table WHERE processed = 0 ORDER BY id DESC";
$stmt = $pdo->prepare($qy);
$stmt->execute();
$arr = $stmt->fetchAll(PDO::FETCH_ASSOC);

	foreach($arr as $a) {
		$exists =  deputyExists($token,$baseurl,$a['employeeNumber']);
		
		if(is_array($exists)) {	
		$thiseid = $exists[0]->EmployeeId;
		//this exists - UPDATE then terminate if needed 
			//test for active
			if(!$exists[0]->Employee->Active) {
				$urlA = $baseurl."/api/v1/supervise/employee/$thiseid/activate";
				$activate = doCurlPost($urlt,NULL,$token);
				//var_dump($activate);
			} 
		
			$sdata = buildData($a,"UPDATE");
			
			$data = [
				'id' => $a['id'],
				'jsondata' => "UPDATE: ".$sdata
			];
			
			$url = $baseurl."/api/v1/supervise/employee/$thiseid";
			$updatejson = insertLastJson($pdo,$data);
			//INSERT LAST JSON REQUEST FOR ITEM INTO DB
			$update = doCurlPost($url,$sdata,$token);
			var_dump($update);
			$response = updateAfter($pdo,$a['id'],$update);
			$pdata = buildPayData($a);
			if($pdata) {
				$updatepay = doCurlPost($url,$pdata,$token);
				$payresponse = updateRateFields($pdo,$a['id'],$update);
			}
			
			if($a["employmentHistoryStatus"] == "Terminated") {	

				if(($comparedate <= $a['employmentHistoryStatusEffectiveDate']) && ($a['processed_empstatus'] != 1)) {
				//make sure not a future date and process was not already performed
				echo("TYPE: TERMINATION<br/>");
				$urlt = $baseurl."/api/v1/supervise/employee/$thiseid/terminate";
				$terminate = doCurlPost($urlt,NULL,$token);
				$response = updateTerminationFields($pdo,$a['id'],$terminate);
				}
			}
		}
		
		if(!is_array($exists)) {
			//this does not exist - create NEW in Deputy
			$sdata = buildData($a,"NEW");
		
			$data = [
				'id' => $a['id'],
				'jsondata' => "NEW: ".$sdata
			];
			
			$newjson = insertLastJson($pdo,$data);
			$url = $baseurl.'/api/v1/supervise/employee'; 
			$makenew = doCurlPost($url,$sdata,$token);
			//var_dump($makenew);
			$response = updateAfter($pdo,$a['id'],$makenew);
			$payresponse = updateRateFields($pdo,$a['id'],$makenew);
			//var_dump($response);
		}	
	}
?>
