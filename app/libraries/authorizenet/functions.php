<?php

function credentials($clec){
		
		//echo $clec;
		switch($clec){
			case 199:
				$credential = array(
					"CLECID"=>"199",
            		"UserName"=>"Torch Affiliate Orders",
            		"TokenPassword"=>"PLWEDRF-M57K1-12KM6-8PD0-DNBRFT",
            		"PIN"=>"896539"
				);
				break;
			case 200:
				$credential = array(
					"CLECID"=>"200",
            		"UserName"=>"Surge Affiliate Orders",
            		"TokenPassword"=>"KMWEDRF-M097K1-14HKM6-OPPD0-SFBRFT",
            		"PIN"=>"903861"
				);
				break;
			case 202:
				$credential = array(
					"CLECID"=>"202",
            		"UserName"=>"Logics-Surge (Lander)",
            		"TokenPassword"=>"NWEDRF-E07B1-62946-8HD0-DERUI",
            		"PIN"=>"159865"
				);
				break;
			case 203:
				$credential = array(
					"CLECID"=>"203",
            		"UserName"=>"Logics-Torch (Lander)",
            		"TokenPassword"=>"LK63A099-6MN51-9DEF-VC32-4086",
            		"PIN"=>"921563"
				);
				break;
			case 206:
				$credential = array(
					"CLECID"=>"206",
            		"UserName"=>"Torch Fintech",
            		"TokenPassword"=>"P963A099-5C51U-9DEF-BC32-ZXC3802C",
            		"PIN"=>"293189"
				);
			case 207:
				$credential = array(
					"CLECID"=>"207",
            		"UserName"=>"Surge pays Fintech",
            		"TokenPassword"=>"LMC3802C-KM51P-8JMW-P8TY-GT63A09",
            		"PIN"=>"459862"
				);
			case 209:
				$credential = array(
					"CLECID"=>"209",
            		"UserName"=>"Torch - USAPHONE",
            		"TokenPassword"=>"BSWEDRF-E57K1-12586-88D0-DERFU",
            		"PIN"=>"145956"
				);
				break;
			case 210:
				$credential = array(
					"CLECID"=>"210",
            		"UserName"=>"Surge - USAPHONE",
            		"TokenPassword"=>"459180C3D-D6B4-4B9A-B4BB-BA0976910758",
            		"PIN"=>"56449843"
				);
				break;
		}
		return $credential; 
		//return json_encode($credential);
}

function getShortLink($url){
		
	$curl = curl_init();

	curl_setopt_array($curl, array(
	
	  CURLOPT_URL =>  'https://srgp.io/api/create',
	
	  CURLOPT_RETURNTRANSFER => true,
	
	  CURLOPT_ENCODING => '',
	
	  CURLOPT_MAXREDIRS => 10,
	
	  CURLOPT_TIMEOUT => 0,
	
	  CURLOPT_FOLLOWLOCATION => true,
	
	  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
	
	  CURLOPT_CUSTOMREQUEST => 'POST',
	
	  CURLOPT_POSTFIELDS =>'{
	
		"long_url": "'.$url.'"
	
	}',
	
	CURLOPT_HTTPHEADER => array(
	
		'X-USERNAME: test',
	
		'X-LNIQ: AlrmjU18I0dl8JoX3vJKLZQokEg1iSit',
	
		'Accept: application/json',
	
		'Content-Type: application/json'
	
	  ),
	
	));
	
	$response = curl_exec($curl);
	
	curl_close($curl);

    $json=json_decode($response, true);
	
	return $json['short_url'];
}

function check_zipcode($zipcode){
	
	$curl = curl_init();

	curl_setopt_array($curl, array(
	  CURLOPT_URL => 'https://secure-order-forms.com/messenger/api/checkzipcode2',
	  CURLOPT_RETURNTRANSFER => true,
	  CURLOPT_ENCODING => '',
	  CURLOPT_MAXREDIRS => 10,
	  CURLOPT_TIMEOUT => 0,
	  CURLOPT_FOLLOWLOCATION => true,
	  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
	  CURLOPT_CUSTOMREQUEST => 'POST',
	  CURLOPT_POSTFIELDS => '{
		"zipcode":"'.$zipcode.'"
	}',
	  CURLOPT_HTTPHEADER => array(
		'Authorization: Basic bWFueWNoYXRVc2VyOkh0UW54bjIkVjg2WW0qUXo=',
		'Content-Type: application/json'
	  ),
	));

	$response = curl_exec($curl);

	curl_close($curl);
	return $response;
}

function updateOrderData($customer_id,$dataApi,$db){
		
	$stmt = $db->prepare("UPDATE orders SET
				pay_message=:pay_message,
				pay_authocode=:pay_authocode,
				pay_transid=:pay_transid,
				pay_accountnumber=:pay_accountnumber,
				pay_accounttype=:pay_accounttype,
				pay_transmessage=:pay_transmessage,
				payment_method=:payment_method
				WHERE customer_id=:customer_id");
				$stmt->bindParam(':pay_message',$dataApi['pay_message'],PDO::PARAM_STR);
				$stmt->bindParam(':pay_authocode',$dataApi['pay_authocode'],PDO::PARAM_STR);
				$stmt->bindParam(':pay_transid',$dataApi['pay_transid'],PDO::PARAM_STR);
				$stmt->bindParam(':pay_accountnumber', $dataApi['pay_accountnumber'],PDO::PARAM_STR);
				$stmt->bindParam(':pay_accounttype', $dataApi['pay_accounttype'], PDO::PARAM_STR);
				$stmt->bindParam(':pay_transmessage', $dataApi['pay_transmessage'], PDO::PARAM_STR);
				$stmt->bindParam(':payment_method', $dataApi['payment_method'], PDO::PARAM_STR);
			   	$stmt->bindParam(':customer_id',$customer_id,PDO::PARAM_STR);
				$stmt->execute();
}

function cleanPhoneNumber($phoneNumber){
       
	$phoneNumberClean=$phoneNumber;

	// Extract the first two digits
	$firstNumber = substr($phoneNumber, 0, 1);
	$secondNumber = substr($phoneNumber, 1, 1);

	if ($firstNumber==0 or $firstNumber==1){
			
		// Delete position 1
		$phoneNumberClean = substr($phoneNumber, 1); 

		if($secondNumber==0 or $secondNumber==1){
			// Delete position 2
			$phoneNumberClean = substr($phoneNumber, 2); 
		}
	}

	return $phoneNumberClean;
	
}

function retrieveOrder($customer_id,$db){
	
	 $stmt = $db->prepare("select * from c1_surgephone.agent_registration_acp where customer_id =:customer_id");
	 $stmt->bindParam(':customer_id',$customer_id);
	 $stmt->execute();
	 
	 $row = $stmt->fetch(PDO::FETCH_ASSOC);
	 return $row;
}

function saveimg($img,$img_name,$folderPath){
	$image_parts = explode(";base64,", $img);
	$image_file = explode("/",$img);
	if($image_file[0]== "data:application"){
		$image_type_aux = explode("application/", $image_parts[0]);
	}else if ($image_file[0]== "data:image"){
		$image_type_aux = explode("image/", $image_parts[0]);
	}
    $image_type = $image_type_aux[1];

	$image_base64 = base64_decode($image_parts[1]);

	//$img_name = uniqid() . '.'.$image_type;
	if (!file_exists($folderPath)) {

		mkdir($folderPath, 0755, true);

	}

	$file = $folderPath.$img_name.".".$image_type;
	$myfile = $img_name.".".$image_type;

	file_put_contents($file, $image_base64);

	return $myfile;
}

function saveDocuments($customer_id,$filename,$table,$db){
	
	 $stmt = $db->prepare("INSERT INTO ".$table. " SET customer_id=:customer_id,filename=:filename,created_at=now();");
	 $stmt->bindParam(':customer_id',$customer_id);
	 $stmt->bindParam(':filename',$filename);
	 $stmt->execute();
}
 
function createPDF2($c_folder,$customer_id,$row,$signature,$template,$pdf){
	//$customer_id="SP-08292107";
	$folder_signatures='../../../'.$c_folder. '/landing_files/Signatures/';
	$folder_file='../../../'.$c_folder. '/landing_files/ACPConsent/';
	//$signature='SP-08292107.png';
	$sigImage=$folder_signatures.$signature;
	$filename=$folder_file.$customer_id.".pdf";
	if (!file_exists($folder_file)) {
		mkdir($folder_file, 0755, true);
	}

	// add a page 
    $pdf->AddPage(); 

    // set the sourcefile 
	
	$now=date("Y-m-d");
    $pdf->setSourceFile("../../../".$c_folder."/FPDF7/".$template); 
 // import page 1 
    $tplIdx = $pdf->importPage(1); 
    // use the imported page and place it at point 2,2 with a width of 213 mm 
    $pdf->useTemplate($tplIdx, 2, 2, 213);  

    $pdf->SetFont('Arial','B','11'); 
	
	$pdf->SetXY(80,26);
	if($row['origin'] == "Chatbot"){
		
	}else{
		$pdf->Write(0, $row['order_id']);
	}
	$pdf->SetXY(80,33);
	$pdf->Write(0, $row['first_name']);
	
	$pdf->SetXY(80,39);
	$pdf->Write(0, $row['second_name']);
	
	$pdf->SetXY(160,255);
	$pdf->Write(0, $now);

	$pdf->image($sigImage,20,249,40,12);

	$pdf->Output($filename, 'F');
	
	return $filename;
}

function saveApiLog($customer_id,$url,$request,$response,$tittle,$db){
	$data=[
		"customer_id"=>$customer_id,
		"url"=>$url,
		"request"=>$request,
		"response"=>$response,
		"title"=>$tittle
	];
	
	$stmt = $db->prepare("INSERT INTO orders_apis_log SET
	customer_id=:customer_id,
	url=:url,
	request=:request,
	response=:response,
	title=:title");
	$stmt->bindParam(':customer_id',$customer_id,PDO::PARAM_STR);
	$stmt->bindParam(':url',$url,PDO::PARAM_STR);
	$stmt->bindParam(':request',$request,PDO::PARAM_STR);
	$stmt->bindParam(':response',$response,PDO::PARAM_STR);
	$stmt->bindParam(':title',$tittle,PDO::PARAM_STR);
	try{
		$stmt->execute();
	}catch (PDOException $error) {
          //echo 'Connection error: ' . $error->getMessage();
		file_put_contents("excepction.txt",$message.'='.$error->getMessage());
	}
	
}


?>