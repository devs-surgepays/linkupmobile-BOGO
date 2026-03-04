<?php

	function GetPaymentInfo($data){

		// create API for check linkup payments

		$res = array();

		$url = "https://www.ecsprepaid.com/api/";

		$request = '<Request>

		<CellularVoucherPurchase sku="7999">

		<ApiUsername>ecsapi</ApiUsername>

		<ApiPassword>ko23fs</ApiPassword>

		<TerminalType>1</TerminalType>

		<TerminalId>LinkUpTool</TerminalId>

		<ClerkId>1</ClerkId>

		<Balance>1</Balance>

		<phonenumber>' . $data['numSimLinkup'] . '</phonenumber>

		</CellularVoucherPurchase>

		</Request>';

		$response = postXmlECS($url, $request);

		$xml = simplexml_load_string($response);

		$json = json_encode($xml);

		$array = json_decode($json, TRUE);

		$res['response'] = $array;

		$res['request'] = $request;

		return $res;

	}

    function GetCustomerInfoLinkupPhone($data){

        // create API for check linkup actived and add the order

		$res = array();

		$url = "https://www.ecsprepaid.com/api/";

		$request = '<Request>

		<CellularVoucherPurchase sku="7888">

		<ApiUsername>ecsapi</ApiUsername>

		<ApiPassword>ko23fs</ApiPassword>

		<TerminalType>1</TerminalType>

		<TerminalId>LinkUpTool</TerminalId>

		<ClerkId>1</ClerkId>

		<Balance>0</Balance>

		<phonenumber>'.$data['numSimLinkup'].'</phonenumber>

		</CellularVoucherPurchase>

		</Request>';

		$response = postXmlECS($url, $request);

		$xml = simplexml_load_string($response);

		$json = json_encode($xml);

		$array = json_decode($json, TRUE);

        $res['response'] = $array;

        $res['request'] = $request;

		return $res;

    }

    function ForTest_GetCustomerInfoLinkupPhone($data){

        // create API for check linkup actived and add the order

		$res = array();

		$url = "https://www.ecsprepaid.com/api/";

		$request = '<Request>

		<CellularVoucherPurchase sku="7888">

		<ApiUsername>ecsapi</ApiUsername>

		<ApiPassword>ko23fs</ApiPassword>

		<TerminalType>1</TerminalType>

		<TerminalId>10111601</TerminalId>

		<ClerkId>1</ClerkId>

		<Balance>0</Balance>

		<phonenumber>'.$data['numSimLinkup'].'</phonenumber>

		</CellularVoucherPurchase>

		</Request>';

		// $json = '{"CellularVoucherPurchase":{"@attributes":{"status":"47"},"comment":[],"PGSTransId":"1225959262","TransDateTime":"2024-03-28T20:31:37","TerminalDateTime":"2024-03-28T15:31:37","Message":"PHONE NOT FOUND"}}';

		$json = '{"CellularVoucherPurchase": {"PGSTransId": 1225949246,"TransDateTime": "2024-03-26T19:16:12","TerminalDateTime": "2024-03-26T14:16:12","phone_number": 6157908181,"sim": 8901260853178521000,"plan": 7862,"date_activated": "2024-02-05T16:35:39","last_payment_date": "1901-01-01T00:00:00","Message": "APPROVED 1225949246"}}';

		$array = json_decode($json, TRUE);

        $res['response'] = $array;

        $res['request'] = $request;

		return $res;

    }

    function ecsActivation($data)
	{

        $res = array();

		$url = "https://www.ecsprepaid.com/api/";

		$request = '<Request>

		<CellularVoucherPurchase sku="'.$data['sku'].'">

		<ApiUsername>ecsapi</ApiUsername>

		<ApiPassword>ko23fs</ApiPassword>

		<TerminalType>1</TerminalType>

		<TerminalId>'.$data['terminalId'].'</TerminalId>

		<ClerkId>1</ClerkId>

		<CellKey/>

		<Balance>'.$data['price'].'</Balance>

		<web_order_id>'.$data['shopify_OrderNumber_item'].'</web_order_id>

		<SIM>'.$data['sim'].'</SIM>

		<AreaCode>'.$data['area'].'</AreaCode>

		<name_first>'.$data['first_name'].'</name_first>

		<name_last>'.$data['second_name'].'</name_last>

		<address>'.$data['address1'].'</address>

		<city>'.$data['city'].'</city>

		<state>'.$data['state'].'</state>

		<zip>'.$data['zipcode'].'</zip>

		<email>'.$data['email'].'</email>

		<alt_phone>'.$data['phone_number'].'</alt_phone>

		</CellularVoucherPurchase>

		</Request>';

		$response = postXmlECS($url, $request);

		$xml = simplexml_load_string($response);

		$json = json_encode($xml);

		$array = json_decode($json, TRUE);

        $res['response'] = $array;

        $res['request'] = $request;

		return $res;

	}

    function ForTest_ecsActivation($data)
	{

		$request = '<Request>

		<CellularVoucherPurchase sku="'.$data['sku'].'">

		<ApiUsername>ecsapi</ApiUsername>

		<ApiPassword>ko23fs</ApiPassword>

		<TerminalType>1</TerminalType>

		<TerminalId>'.$data['terminalId'].'</TerminalId>

		<ClerkId>1</ClerkId>

		<CellKey/>

		<Balance>1</Balance>

		<web_order_id>'.$data['shopify_OrderNumber_item'].'</web_order_id>

		<SIM>'.$data['sim'].'</SIM>

		<AreaCode>'.$data['area'].'</AreaCode>

		<name_first>'.$data['first_name'].'</name_first>

		<name_last>'.$data['second_name'].'</name_last>

		<address>'.$data['address1'].'</address>

		<city>'.$data['city'].'</city>

		<state>'.$data['state'].'</state>

		<zip>'.$data['zipcode'].'</zip>

		<email>'.$data['email'].'</email>

		<alt_phone>'.$data['phone_number'].'</alt_phone>

		</CellularVoucherPurchase>

		</Request>';

		// $json = '{"CellularVoucherPurchase":{"@attributes":{"status":"104"},"comment":[],"PGSTransId":"1225714585","TransDateTime":"2024-02-09T16:35:58","TerminalDateTime":"2024-02-09T10:35:58","StreampayReceipt":[],"Message":"INCORRECT SIM NUMBER"}}';

		$json = '{"CellularVoucherPurchase":{"@attributes":{"status":"0"},"comment":{},"PGSTransId":"1225819999","TransDateTime":"2024-02-28T17:12:39","TerminalDateTime":"2024-02-28T11:12:39","Display":"Success","PinNumber":"6157900022","PhoneNumber":"6157900022","Message":"APPROVED","StreampayReceipt":{}}}'; 

		$array = json_decode($json, TRUE);

		$res = array();

		$res['response'] = $array;

        $res['request'] = $request;

		return $res;

	}

    function postXmlECS($url, $request)
	{

		$curl = curl_init();

		curl_setopt_array($curl, array(

			CURLOPT_URL => $url,

			CURLOPT_RETURNTRANSFER => true,

			CURLOPT_ENCODING => "",

			CURLOPT_MAXREDIRS => 10,

			CURLOPT_TIMEOUT => 90,

			CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,

			CURLOPT_CUSTOMREQUEST => "POST",

			CURLOPT_POSTFIELDS => "request=" . urlencode($request),

			CURLOPT_HTTPHEADER => array(

				"cache-control: no-cache",

				"content-type: application/x-www-form-urlencoded",

				"postman-token: 29d4d4ec-4d98-d424-5427-57c43646891b"

			),

		));

		$data = curl_exec($curl);

		// $err = curl_error($curl);

		curl_close($curl);

		return $data;

	}

	function ecsTopUp($data)
    {

        $url = "https://www.ecsprepaid.com/api/";

		$terminalId = '9459282713';

		$request = '<Request>

		<CellularRtrPurchase sku="' . $data['sku'] . '">

		<ApiUsername>ecsapi</ApiUsername>

		<ApiPassword>ko23fs</ApiPassword>

		<TerminalType>1</TerminalType>

		<TerminalId>' . $terminalId . '</TerminalId>

		<ClerkId>2554</ClerkId>

		<AccountNumber>' . $data['phone'] . '</AccountNumber>

		<Amount>' . $data['price'] . '</Amount>

		<PIN/>

		</CellularRtrPurchase>

		</Request>';

        $response = postXmlECS($url, $request);

        $xml = simplexml_load_string($response);

        $json = json_encode($xml);

        $array = json_decode($json, TRUE);

		$res = array();

		$res['response'] = $array;

		$res['request'] = $request;

        return $res;

    }

	function testecsTopUp($data)
	{

		$url = "https://www.ecsprepaid.com/api/";

		$terminalId = '9459282713';

		$request = '<Request>

			<CellularVoucherPurchase sku="' . $data['sku'] . '">

			<ApiUsername>ecsapi</ApiUsername>

			<ApiPassword>ko23fs</ApiPassword>

			<TerminalType>1</TerminalType>

			<TerminalId>LinkUpWebsite</TerminalId>

			<ClerkId>1</ClerkId>

			<CellKey/>

			<AccountNumber>' . $data['phone'] . '</AccountNumber>

			<Balance>' . $data['price'] . '</Balance>

			</CellularVoucherPurchase>

			</Request>';

		//$response = postXmlECS($url, $request);

		//$xml = simplexml_load_string($response);

		$json = '{"CellularVoucherPurchase": {"PGSTransId": 1226017944,"TransDateTime": "2024-04-08T18:33:58","TerminalDateTime": "2024-04-08T13:33:58","Message": "APPROVED"}}';

		$array = json_decode($json, TRUE);

		$res = array();

		$res['response'] = $array;

		$res['request'] = $request;

		return $res;

	}

	function testmakePaymentAutopay($data, $dataCC)
	{

		$url = "https://www.ecsprepaid.com/api/";

		$terminalId = '9102319965';

		$request = '<Request>
		<CellularVoucherPurchase sku="8497">
		<ApiUsername>ecsapi</ApiUsername>
		<ApiPassword>ko23fs</ApiPassword>
		<TerminalType>1</TerminalType>
		<TerminalId>10111601</TerminalId>
		<ClerkId>1</ClerkId>
		<CellKey/>
		<Balance>30</Balance>
		<esim>1</esim>
		<IMEI>356364245476445</IMEI>
		<AreaCode>417</AreaCode>
		<zip>65810</zip>
		<name_first>Mark</name_first>
		<name_last>Garner</name_last>
		<email>noezway.mg@gmail.com</email>
		<address>PO Box 3045</address>
		<city>Springfield</city>
		<state>MO</state>
		<billing_address1>PO Box 3045</billing_address1>
		<billing_city>Springfield</billing_city>
		<billing_state>MO</billing_state>
		<billing_zip>65808</billing_zip>
		<card_type>Visa</card_type>
		<card_number>4397930001147587</card_number>
		<cvv>343</cvv>
		<expiration_month>01</expiration_month>
		<expiration_year>2027</expiration_year>
		<name_on_card>Mark Garner</name_on_card>
		</CellularVoucherPurchase>
		</Request>';

		//$response = postXmlECS($url, $request);

		//$xml = simplexml_load_string($response);

		//$json = json_encode($xml);

		//$array = json_decode($json, TRUE);

		/* $json = '{
        "CellularVoucherPurchase": {
            "@attributes": {
                "status": "123"
            },
            "comment": [],
            "PGSTransId": "1227746329",
            "TransDateTime": "2025-01-06T17:21:37",
            "TerminalDateTime": "2025-01-06T11:21:37",
            "SupplierMessage": "Error occured",
            "Message": "ACTIVATION FAILED"
			}
		}';
		*/
		 $json = '{
			"CellularVoucherPurchase": {
				"@attributes": {
					"status": "0"
				},
				"comment": [],
				"PGSTransId": "1233482180",
				"TransDateTime": "2026-03-03T21:36:50",
				"TerminalDateTime": "2026-03-03T15:36:50",
				"QRCode": "LPA:1$CUST-001-V4-PROD-ATL2.GDSB.NET$0A8796F7E0837DB90F7A1E118DDC9F7D",
				"PinCode": "3049",
				"Display": "Success",
				"PinNumber": "7252475597",
				"PhoneNumber": "7252475597",
				"Message": "APPROVED",
				"StreampayReceipt": []
			}
		}';

		$array = json_decode($json, TRUE);

		$res = array();

		$res['response'] = $array;

		$res['request'] = $request;

		return $res;
	}

	function ecsmakePaymentAutopay($data, $dataCC)
	{

		$url = "https://www.ecsprepaid.com/api/";

		$terminalId = '9102319965';

		$exp_date = explode('/', $dataCC['expiration_date']);
		$expiration_month= $exp_date[0];
		$expiration_year = '20'.$exp_date[1];

		$billing_address1 = !empty($data['billing_address1']) ? $data['billing_address1'] : $data['address1'];
		$billing_city = !empty($data['billing_city']) ? $data['billing_city'] : $data['locality'];
		$billing_state = !empty($data['billing_state']) ? $data['billing_state'] : $data['state'];
		$billing_zip = !empty($data['billing_zipcode']) ? $data['billing_zipcode'] : $data['postcode'];

		$request = '<Request>
			<CellularVoucherPurchase sku="8497">
			<ApiUsername>ecsapi</ApiUsername>
			<ApiPassword>ko23fs</ApiPassword>
			<TerminalType>1</TerminalType>
			<TerminalId>' . $terminalId . '</TerminalId>
			<ClerkId>1</ClerkId>
			<CellKey/>
			<Balance>30</Balance>
			<esim>1</esim>
			<IMEI>' . htmlspecialchars($data['imei'], ENT_XML1, 'UTF-8') . '</IMEI>
			<AreaCode>' . htmlspecialchars($data['areacode'], ENT_XML1, 'UTF-8') . '</AreaCode>
			<zip>' . htmlspecialchars($data['zipcode'], ENT_XML1, 'UTF-8') . '</zip>
			<name_first>' . htmlspecialchars($data['first_name'], ENT_XML1, 'UTF-8') . '</name_first>
			<name_last>' . htmlspecialchars($data['second_name'], ENT_XML1, 'UTF-8') . '</name_last>
			<email>' . htmlspecialchars($data['email'], ENT_XML1, 'UTF-8') . '</email>
			<address>' . htmlspecialchars($data['address1'], ENT_XML1, 'UTF-8') . '</address>
			<city>' . htmlspecialchars($data['city'], ENT_XML1, 'UTF-8') . '</city>
			<state>' . htmlspecialchars($data['state'], ENT_XML1, 'UTF-8') . '</state>
			<billing_address1>'. htmlspecialchars($billing_address1, ENT_XML1, 'UTF-8') . '</billing_address1>
			<billing_city>' . htmlspecialchars($billing_city, ENT_XML1, 'UTF-8') . '</billing_city>
			<billing_state>' . htmlspecialchars($billing_state, ENT_XML1, 'UTF-8') . '</billing_state>
			<billing_zip>' . htmlspecialchars($billing_zip, ENT_XML1, 'UTF-8') . '</billing_zip>
			<card_type>' . htmlspecialchars($dataCC['card_type'], ENT_XML1, 'UTF-8') . '</card_type>
			<card_number>' . htmlspecialchars($dataCC['card_number'], ENT_XML1, 'UTF-8') . '</card_number>
			<cvv>' . htmlspecialchars($dataCC['card_scnumber'], ENT_XML1, 'UTF-8') . '</cvv>
			<expiration_month>' . htmlspecialchars($expiration_month, ENT_XML1, 'UTF-8') . '</expiration_month>
			<expiration_year>' . htmlspecialchars($expiration_year, ENT_XML1, 'UTF-8'). '</expiration_year>
			<name_on_card>Mark Garner</name_on_card>
			</CellularVoucherPurchase>
			</Request>';

			

		$response = postXmlECS($url, $request);

		$xml = simplexml_load_string($response);

		$json = json_encode($xml);

		$jsonr = json_encode($request);

		$arrayre = json_decode($jsonr, TRUE);

		//$array = json_decode($json, TRUE);

		//$json = '{"CellularVoucherPurchase":{"@attributes":{"status":"104"},"comment":[],"PGSTransId":"1225714585","TransDateTime":"2024-02-09T16:35:58","TerminalDateTime":"2024-02-09T10:35:58","StreampayReceipt":[],"Message":"INCORRECT SIM NUMBER"}}';

		//$json = '{"CellularVoucherPurchase":{"@attributes":{"status":"0"},"comment":{},"PGSTransId":"1225819999","TransDateTime":"2024-02-28T17:12:39","TerminalDateTime":"2024-02-28T11:12:39","Display":"Success","PinNumber":"6157900022","PhoneNumber":"6157900022","Message":"APPROVED","StreampayReceipt":{}}}';

		$array = json_decode($json, TRUE);

		$res = array();

		$res['response'] = $array;

		$res['request'] = $arrayre;

		return $res;
	}

	function eSIMECSTelgoo($customerData) {

		$url = 'http://www.vcareapi.com:8080/customer';

		$billingInfoFlag = (
			!empty($data['billing_address1']) &&
			!empty($data['billing_city']) &&
			!empty($data['billing_state']) &&
			!empty($data['billing_zipcode'])
		) ? "true" : "false";

		$customerData = [
			"enrollment_id" => $data['customer_id'],
			"order_id" => $data['order_id'],
			"password" => "",
			"sponsor_id" => "9102319965",
			"first_name" => $data['first_name'],
			"last_name" => $data['second_name'],
			"alternate_phone_number" => $data['phone_number'],
			"email" => $data['email'],
			"pin" => null,
			"activation_type" => "NEWACTIVATION",
			"service_address_one" => ", " . $data['state'] . " " . $data['zipcode'],
			"service_address_two" => $data['address2'],
			"service_city" => $data['city'],
			"service_state" => $data['state'],
			"service_zip" => $data['zipcode'],
			"plan_id" => "8497",
			"device_id" => "356364245476445",
			"carrier" => "LINKUP",
			"is_portin" => "N",
			"enrollment_type" => "SHIPMENT",
			"billing_address_one" => ($billingInfoFlag == "true" ? ', ' . $data['billing_state'] . ' ' . $data['billing_zipcode'] : ', ' . $data['state'] . ' ' . $data['zipcode']) . '',
			"billing_city" => ($billingInfoFlag == "true" ? $data['billing_city'] :  $data['city']),
			"billing_state" => ($billingInfoFlag == "true" ? $data['billing_state'] :  $data['state']),
			"billing_zip" => ($billingInfoFlag == "true" ? $data['billing_zipcode'] :  $data['zipcode']),
			"is_esim" => "Y",
			"no_of_advance_month" => "1",
			"parent_enrollment_id" => "A376249"
		];

		$url = 'http://www.vcareapi.com:8080/customer';

		$headers = [
			'Accept: */*',
			'User-Agent: ECS-CurlWrapper/1.0.0',
			'cache-control: no-cache',
			'content-type: application/json;charset=UTF-8',
			'token: eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJkYXRhIjp7InVzZXJuYW1lIjoiTGlua1VwTW9iaWxlSW5jQ2xpZW50M3Q1bVVzZXIiLCJ2ZW5kb3JfaWQiOiJMaW5rVXBNb2JpbGVJbmNDbGllbnQiLCJsb2dfaWQiOjIyNTE4MDI4MDExMDA5MDN9LCJleHAiOjE3NzI0NjMxNTV9.RPklLj9qX6ZA22H1pyf_Yehdogdtb3LEBIKTTJEFvKY'
		];

		$payload = [
			'lines' => [$customerData],
			'action' => 'create_prepaid_postpaid_customer_v2',
			'source' => 'API',
			'agent_id' => 'LINKUP',
			'request_name' => 'API'
		];

		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
		curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($payload));
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

		$response = curl_exec($ch);
		$httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
		curl_close($ch);

		return [
			'code' => $httpCode,
			'request' => json_encode($payload),
			'response' => json_decode($response, true)
		];
	}

	function testeSIMECSTelgoo($data)
	{
			
		// build the payload
		$data = [
			'lines' => [
				[
					'enrollment_id'        => 'A376436',
					'order_id'             => '369275',
					'password'             => '',
					'sponsor_id'           => '9102319965',
					'first_name'           => 'John',
					'last_name'            => 'Doe',
					'alternate_phone_number' => '',
					'email'                => 'systems@surgepays.com',
					'pin'                  => null,
					'activation_type'      => 'NEWACTIVATION',
					'service_address_one'  => ', TN 38117',
					'service_address_two'  => 'test',
					'service_city'         => 'New York',
					'service_state'        => 'TN',
					'service_zip'          => '38117',
					'plan_id'              => '2576',
					'device_id'            => '356364245476445',
					'carrier'              => 'LINKUP',
					'is_portin'            => 'N',
					'enrollment_type'      => 'SHIPMENT',
					'billing_address_one'  => ', TN 38117',
					'billing_city'         => 'New York',
					'billing_state'        => 'TN',
					'billing_zip'          => '38117',
					'is_esim'              => 'Y',
					'order_id'             => '369275',
					'no_of_advance_month'  => '1',
					'parent_enrollment_id' => 'A376436',
				],
			],
			'action'        => 'create_prepaid_postpaid_customer_v2',
			'source'        => 'API',
			'agent_id'      => 'LINKUP',
			'request_name'  => 'API',
		];

		$json = json_encode($data);

		// initialize curl
		$ch = curl_init('https://www.ecsprepaid.com/api/');

		curl_setopt_array($ch, [
			CURLOPT_POST           => true,
			CURLOPT_RETURNTRANSFER => true,
			CURLOPT_HTTPHEADER     => [
				'Accept: */*',
				'User-Agent: ECS-CurlWrapper/1.0.0',
				'Cache-Control: no-cache',
				'Content-Type: application/json;charset=UTF-8',
				'Token: eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJkYXRhIjp7InVzZXJuYW1lIjoiTGlua1VwTW9iaWxlSW5jQ2xpZW50M3Q1bVVzZXIiLCJ2ZW5kb3JfaWQiOiJMaW5rVXBNb2JpbGVJbmNDbGllbnQiLCJsb2dfaWQiOjIyNTE4MDI4MDE5MDQ3MzF9LCJleHAiOjE3NzI1NjQ4NDF9.C3L_Nx0O02_p1l_RL1L2NizmGEZmIYM9J7n-jjbdDeI',
				'Content-Length: ' . strlen($json),
			],
			CURLOPT_POSTFIELDS     => $json,
		]);

		$response = curl_exec($ch);
		if ($response === false) {
			echo 'Curl error: ' . curl_error($ch);
		} else {
			echo "Response:\n$response\n";
		}

		curl_close($ch);
	}


?>