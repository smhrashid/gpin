<?php
  $conn=oci_connect('user', 'pass', 'scima'); 
$curl = curl_init(); 
curl_setopt_array($curl, array(
  //CURLOPT_URL => "https://empapp.grameenphone.com/api/v1/health/dependents?key=VGhpcyFLZXlASXMjRm9yJFByb2dvdGkl",
  CURLOPT_URL => "https://onegp.grameenphone.com/api/v1/health/dependents?key=VGhpcyFLZXlASXMjRm9yJFByb2dvdGkl",
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => "",
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 30,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => "GET",
  CURLOPT_HTTPHEADER => array(
    "accept: application/json"
   // "cache-control: no-cache",
   // "postman-token: d65e1ecb-376d-7c20-0d97-a4befe7bc930"
  ),
));
$response = curl_exec($curl);
$err = curl_error($curl);
curl_close($curl);
if ($err) {
  echo "cURL Error #:" . $err;
} else {
		echo '<pre>';
			
			print_r ($response);
		echo '</pre>';
			
			
			$findme   = '}],"';
			$pos = strpos($response, $findme);
			
			if ($pos === false) {
				echo $mystring;
			} else {
				//echo $pos;
				$asd= substr($response,23,($pos-21));
			}
			
			
			
			//echo $asd;
			$characters = (json_decode($asd));
			
			
			
		foreach ($characters as $character) {
			echo $character->id."','".$character->memid."','".$character->memname."','".$character->emp_id."','".$character->dob."','".$character->gender."','".$character->relation."','".$character->status."','".$character->created."','".$character->email_address."','".$character->mobile_number."','".$character->effective_date."','".$character->marital_status."
			','".$character->age."</br>";
			$ids[]=$character->id;
	$query_vpc_ins = "insert into grp.gp_api_data
	(id,memid,memname,emp_id,dob,gender,relation,status,created,email_address,mobile_number,effective_date,marital_status,age,insert_date)
	  					VALUES 
	('$character->id','$character->memid','$character->memname','$character->emp_id','$character->dob','$character->gender','$character->relation','$character->status','$character->created','$character->email_address','$character->mobile_number','$character->effective_date','$character->marital_status','$character->age',sysdate)";		
	$stid_vpc_ins = OCIParse($conn, $query_vpc_ins);
	  OCIExecute($stid_vpc_ins);
			
			
			
		}
		
		
}
?>

<?php

		for($x = 0; $x < count($ids); $x++) {
			echo $ids[$x]."</br>";
				
					$curl = curl_init(); 
					curl_setopt_array($curl, array(
					  CURLOPT_URL => 'https://onegp.grameenphone.com/api/v1/health/dependents/'.$ids[$x],
					  CURLOPT_RETURNTRANSFER => true,
					  CURLOPT_ENCODING => "",
					  CURLOPT_MAXREDIRS => 10,
					  CURLOPT_TIMEOUT => 30,
					  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
					  CURLOPT_CUSTOMREQUEST => "PUT",
					  CURLOPT_HTTPHEADER => array(
						"accept: application/json"
					  ),
					));
					$response = curl_exec($curl);
					$err = curl_error($curl);
					curl_close($curl);
					if ($err) {
					  echo "cURL Error #:" . $err;
					} else {
					}
				
			}

?>



