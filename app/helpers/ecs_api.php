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

	function ecsActivationLandingPage($data)
	{

		$res = array();

		$url = "https://www.ecsprepaid.com/api/";

		$terminalId = '9102319965';

		$request = '<Request>
		<CellularVoucherPurchase sku="8497">
		<ApiUsername>ecsapi</ApiUsername>
		<ApiPassword>ko23fs</ApiPassword>
		<TerminalType>1</TerminalType>
		<TerminalId>' . $terminalId  . '</TerminalId>
		<ClerkId>1</ClerkId>
		<CellKey/>
		<Balance>' . $data['price'] . '</Balance>
		<esim>1</esim>
		<IMEI>' . $data['imei'] . '</IMEI>
		<AreaCode>' . $data['areacode'] . '</AreaCode>
		<zip>' . $data['zipcode'] . '</zip>
		<name_first>' . $data['first_name'] . '</name_first>
		<name_last>' . $data['second_name'] . '</name_last>
		<email>' . $data['email'] . '</email>
		<address>' . $data['address1'] . '</address>
		<city>' . $data['city'] . '</city>
		<state>' . $data['state'] . '</state>
		</CellularVoucherPurchase>
		</Request>';

		// $request = '<Request>
		// 	<CellularVoucherPurchase sku="' . $data['sku'] . '">
		// 	<ApiUsername>ecsapi</ApiUsername>
		// 	<ApiPassword>ko23fs</ApiPassword>
		// 	<TerminalType>1</TerminalType>
		// 	<TerminalId>' . $data['terminalId'] . '</TerminalId>
		// 	<ClerkId>1</ClerkId>
		// 	<CellKey/>
		// 	<Balance>' . $data['price'] . '</Balance>
		// 	<web_order_id>' . $data['shopify_OrderNumber_item'] . '</web_order_id>
		// 	<SIM>' . $data['sim'] . '</SIM>
		// 	<AreaCode>' . $data['area'] . '</AreaCode>
		// 	<name_first>' . $data['first_name'] . '</name_first>
		// 	<name_last>' . $data['second_name'] . '</name_last>
		// 	<address>' . $data['address1'] . '</address>
		// 	<city>' . $data['city'] . '</city>
		// 	<state>' . $data['state'] . '</state>
		// 	<zip>' . $data['zipcode'] . '</zip>
		// 	<email>' . $data['email'] . '</email>
		// 	<alt_phone>' . $data['phone_number'] . '</alt_phone>
		// 	</CellularVoucherPurchase>
		// 	</Request>';

		$response = postXmlECS($url, $request);

		$xml = simplexml_load_string($response);

		$json = json_encode($xml);

		$array = json_decode($json, TRUE);

		$res['response'] = $array;

		$res['request'] = $request;

		return $res;
	}

	function testecsActivationLandingPage($data)
	{

		$res = array();

		$url = "https://www.ecsprepaid.com/api/";

		$request = '<Request>
		<CellularVoucherPurchase sku="8497">
		<ApiUsername>ecsapi</ApiUsername>
		<ApiPassword>ko23fs</ApiPassword>
		<TerminalType>1</TerminalType>
		<TerminalId>9102319965</TerminalId>
		<ClerkId>1</ClerkId>
		<CellKey/>
		<Balance>30</Balance>
		<esim>1</esim>
		<IMEI>354802263841372</IMEI>
		<AreaCode>702</AreaCode>
		<zip>89146</zip>
		<name_first>Ana</name_first>
		<name_last>Amaya</name_last>
		<email>ana.test@example.com</email>
		<address>1234 S Rainbow Blvd</address>
		<city>Las Vegas</city>
		<state>NV</state>
		</CellularVoucherPurchase>
		</Request>';

		// $request = '<Request>
		// 	<CellularVoucherPurchase sku="' . $data['sku'] . '">
		// 	<ApiUsername>ecsapi</ApiUsername>
		// 	<ApiPassword>ko23fs</ApiPassword>
		// 	<TerminalType>1</TerminalType>
		// 	<TerminalId>' . $data['terminalId'] . '</TerminalId>
		// 	<ClerkId>1</ClerkId>
		// 	<CellKey/>
		// 	<Balance>' . $data['price'] . '</Balance>
		// 	<web_order_id>' . $data['shopify_OrderNumber_item'] . '</web_order_id>
		// 	<SIM>' . $data['sim'] . '</SIM>
		// 	<AreaCode>' . $data['area'] . '</AreaCode>
		// 	<name_first>' . $data['first_name'] . '</name_first>
		// 	<name_last>' . $data['second_name'] . '</name_last>
		// 	<address>' . $data['address1'] . '</address>
		// 	<city>' . $data['city'] . '</city>
		// 	<state>' . $data['state'] . '</state>
		// 	<zip>' . $data['zipcode'] . '</zip>
		// 	<email>' . $data['email'] . '</email>
		// 	<alt_phone>' . $data['phone_number'] . '</alt_phone>
		// 	</CellularVoucherPurchase>
		// 	</Request>';

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

	
?>