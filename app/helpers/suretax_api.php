<?php
//error_reporting(E_ALL & ~E_NOTICE);
//ini_set("display_errors", 1);
//ini_set("display_startup_errors", 1);

function taxtCalculation($data){

		// $ClientNumber = CLIENT_NUMBER;
		// $ValidationKey = VALIDATION_KEY;
		// $url = SURETAX_URL;
		// $url= SURETAX_URL;
		$ClientNumber = "D002860001";
		$ValidationKey = "27FEBA39-C2B8-4629-A1E5-458C97018E0E";

		$url = "https://api.taxrating.net/Services/Communications/V01/SureTax.asmx/PostRequest";
		//$url = "https://testapi.taxrating.net/Services/Communications/V01/SureTax.asmx/PostRequest";
		$innerData = [
			"ClientNumber" => $ClientNumber,
			"ValidationKey" => $ValidationKey,
			"DataYear" => date('Y'),
			"DataMonth" => date('m'),
			"CmplDataYear" => date('Y'),
			"CmplDataMonth" => date('m'), 
			"TotalRevenue" => "100",
			"ReturnFileCode" => "0",
			"ClientTracking" => "TEST",
			"ResponseGroup" => "00",
			"ResponseType" => "D6",
			"STAN" => "",
			"ItemList" => [[
				"LineNumber" => "1",
				"InvoiceNumber" => "INVOICE01",
				"CustomerNumber" => "CUSTOMER01",
				"TransDate" => date("m-d-Y"),
				"Revenue" => $data["price"],
				"Units" => "1",
				"UnitType" => "00",
				"Seconds" => "1",
				"TaxIncludedCode" => "0",
				"TaxSitusRule" => "04",
				"TransTypeCode" => "990101",
				"SalesTypeCode" => "B",
				"RegulatoryCode" => "03",
				"TaxExemptionCodeList" => ["00"],
				"ExemptReasonCode" => "None",
				"Address" => [
					"PrimaryAddressLine" => $data["street_address1"],
					"SecondaryAddressLine" => $data["address2"],
					"County" => "",
					"City" => $data["locality"],
					"State" => $data["state"],
					"PostalCode" => $data["zipcode"],
					"Plus4" => "",
					"Country" => "",
					"Geocode" => "",
					"VerifyAddress" => "0"
				]
			]]
		];
		$outerData = [
			"request" => json_encode($innerData)
		];
		
		$jsonData = json_encode($outerData);
		$response = postSureTAXApi($url, $jsonData);

		// Decode first level of response
		$taxResponse = json_decode($response, true);

		// Validate existence of 'd' in response
		if (!isset($taxResponse['d'])) {
			return ["TotalTax" => 0.00];
		}

		// Decode nested JSON
		$parsedResponse = json_decode($taxResponse['d'], true);

		if (isset($parsedResponse["Successful"]) && $parsedResponse["Successful"] === "Y") {
			$rawTax = $parsedResponse["TotalTax"] ?? 0.00;
			$decimalDigits = strlen(substr(strrchr((string)$rawTax, "."), 1));
			$precision = ($decimalDigits === 3) ? 3 : 2;

			return [
				"TotalTax" => number_format($rawTax, $precision, '.', '')
			];
		}

		return ["TotalTax" => number_format(0.00, 2, '.', '')];
}

function postSureTAXApi($url, $request)
{
	//echo '{"request":"'. urlencode($request).'"}';
	$curl = curl_init();
	curl_setopt_array($curl, array(
		CURLOPT_URL => $url,
		CURLOPT_RETURNTRANSFER => true,
		CURLOPT_ENCODING => '',
		CURLOPT_MAXREDIRS => 10,
		CURLOPT_TIMEOUT => 0,
		CURLOPT_FOLLOWLOCATION => true,
		CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		CURLOPT_CUSTOMREQUEST => 'POST',
		CURLOPT_POSTFIELDS => $request,
		CURLOPT_HTTPHEADER => array(
			'Content-Type: application/json'
		),
	));
	$response = curl_exec($curl);
	curl_close($curl);
	return $response;
}

?>