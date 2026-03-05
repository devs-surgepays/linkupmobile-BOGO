<?php
/* ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);*/
libxml_use_internal_errors(true);
class Authorizenets extends Controller
{

	private $db;
	public $mailer = "";
	public $log;
	public $logModel;
	//public $userModel = '';
	//public $addonModel = '';
	public $orderModel;

	public function __construct()
	{
		$this->db = new Database;
		$this->logModel = $this->model('Log');
		//$this->userModel = $this->model('User');
		//$this->addonModel = $this->model('Addon');		
		$this->orderModel = $this->model('Order');
		

		$this->mailer = new PHPMailer_Lib();

		//$this->log->putlog("This is a test");
	}

	public function index()
	{

		//$response = $this->getToken();
		//$response = $this->getProfiles($cpid);
		//$hostedPaymentResponse =$this->getHostedPaymentForm();
		//$xmlResult=simplexml_load_string($response);
		//$jsonResult=json_encode($xmlResult);
		//echo "<pre>";
		//print_r($response);
		//echo $response->messages->resultCode;

	}

	public function payment2()
	{
		$cpid = "516502024";
		$response = $this->getToken($cpid);
		$hostedPaymentResponse = $this->getHostedPaymentForm();
		$profileResponse = $this->getProfiles($cpid);
		if ($response->messages->resultCode != "Ok") {
			$_SESSION["cpid_error"] = 'true';
			setcookie("cpid", '', time() - 1, "/");
			setcookie("temp_cpid", '', time() - 1, "/");
			//header('Location: login.php');
			//exit();	
		} else {
			$_SESSION["cpid_error"] = 'false';
		}

		$profileResponse->token = $response->token;
		$profileResponse->hostedtoken = $hostedPaymentResponse->token;
		//print_r($profileResponse);
		$this->view("pages/payment2", $profileResponse);
	}

	public function paymentPage()
	{
		$cpid = "516502024";
		$response = $this->getToken($cpid);
		$hostedPaymentResponse = $this->getHostedPaymentForm();
		$profileResponse = $this->getProfiles($cpid);
		if ($response->messages->resultCode != "Ok") {
			$_SESSION["cpid_error"] = 'true';
			setcookie("cpid", '', time() - 1, "/");
			setcookie("temp_cpid", '', time() - 1, "/");
			//header('Location: login.php');
			//exit();	
		} else {
			$_SESSION["cpid_error"] = 'false';
		}

		$profileResponse->token = $response->token;
		$profileResponse->hostedtoken = $hostedPaymentResponse->token;
		//print_r($profileResponse);
		$this->view("pages/payment", $profileResponse);
	}

	public function singlePayment()
	{

		$now =  date('Y-m-d');
		$logfile = "logpayment_" . $now . ".txt";
		$log = new Logger($logfile);
		$log->setTimestamp("Y-m-d h:i:s");

		if ($_SERVER['REQUEST_METHOD'] == 'POST') {
			//die('Submit');
			$_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

			$customer_id = $this->orderModel->createCustomerId();
			//echo $_POST['orderItemId'];
			$data = [
				'customer_id' => $customer_id,
				'first_name' => isset($_POST['first_name']) ? $this->sanitizeInput($_POST['first_name'], 'string') : '',
				'second_name' => isset($_POST['second_name']) ? $this->sanitizeInput($_POST['second_name'], 'string') : '',
				'phone_number' => isset($_POST['phone_number']) ? $this->sanitizeInput($_POST['phone_number'], 'phone') : '',
				'email' => isset($_POST['email']) ? $this->sanitizeInput($_POST['email'], 'email') : '',
				'address1' => isset($_POST['address1']) ? $this->sanitizeInput($_POST['address1'], 'string') : '',
				'address2' => isset($_POST['address2']) ? $this->sanitizeInput($_POST['address2'], 'string') : '',
				'city' => isset($_POST['city']) ? $this->sanitizeInput($_POST['city'], 'string') : '',
				'state' => isset($_POST['state']) ? $this->sanitizeInput($_POST['state'], 'string') : '',
				'zipcode' => isset($_POST['zipcode']) ? $this->sanitizeInput($_POST['zipcode'], 'string') : '',
				'shipping_address1' => isset($_POST['shipping_address1']) ? $this->sanitizeInput($_POST['shipping_address1'], 'string') : '',
				'shipping_address2' => isset($_POST['shipping_address2']) ? $this->sanitizeInput($_POST['shipping_address2'], 'string') : '',
				'shipping_city' => isset($_POST['shipping_city']) ? $this->sanitizeInput($_POST['shipping_city'], 'string') : '',
				'shipping_state' => isset($_POST['shipping_state']) ? strtoupper($this->sanitizeInput($_POST['shipping_state'], 'string')) : '',
				'shipping_zipcode' => isset($_POST['shipping_zipcode']) ? $this->sanitizeInput($_POST['shipping_zipcode'], 'string') : '',
				'billing_address1' => isset($_POST['billing_address1']) ? $this->sanitizeInput($_POST['billing_address1'], 'string') : '',
				'billing_address2' => isset($_POST['billing_address2']) ? $this->sanitizeInput($_POST['billing_address2'], 'string') : '',
				'billing_city' => isset($_POST['billing_city']) ? $this->sanitizeInput($_POST['billing_city'], 'string') : '',
				'billing_state' => isset($_POST['billing_state']) ? strtoupper($this->sanitizeInput($_POST['billing_state'], 'string')) : '',
				'billing_zipcode' => isset($_POST['billing_zipcode']) ? $this->sanitizeInput($_POST['billing_zipcode'], 'string') : '',
				'agree_terms' => isset($_POST['agree_terms']) ? $this->sanitizeInput($_POST['agree_terms'], 'string') : '',
				'utm_source' => isset($_POST['utm_source']) ? $this->sanitizeInput($_POST['utm_source'], 'string') : '',
				'utm_medium' => isset($_POST['utm_medium']) ? $this->sanitizeInput($_POST['utm_medium'], 'string') : '',
				'utm_campaign' => isset($_POST['utm_campaign']) ? $this->sanitizeInput($_POST['utm_campaign'], 'string') : '',
				'utm_content' => isset($_POST['utm_content']) ? $this->sanitizeInput($_POST['utm_content'], 'string') : '',
				'match_type' => isset($_POST['match_type']) ? $this->sanitizeInput($_POST['match_type'], 'string') : '',
				'source' => isset($_POST['source']) ? $this->sanitizeInput($_POST['source'], 'string') : '',
				'URL' => isset($_POST['url']) ? $this->sanitizeInput($_POST['url'], 'url') : '',
			];
			$log->putLog("DataReceived: " . json_encode($data, true));

			/*Handle the Order ID*/
			/*********************************************/
			if (!empty($data['order_id'])) {
				$order_id = $data['order_id'];
				$actionDatabase = 'updateOrder';
			} else {
				$actionDatabase = 'addOrder';
				$order_id = $this->orderModel->createOrderId();
				$data['order_id'] = $order_id;
			}
			$log->putLog("OrderID: " . json_encode($order_id, true));

			/*Create Order Record*/
			/*********************************************/
			if (isset($data['order_id']) && !empty($data['order_id']) && $actionDatabase == 'updateOrder') {
				$order = $this->orderModel->updateOrder($data);
			} else {
				$order = $this->orderModel->createOrder($data);
			}

			$data_pay = [
				'plan_price' => trim($_POST['planPrice']),
				'amount' => trim($_POST['amount']),
				'price' => $_POST['price'],
				'taxes' => trim($_POST['taxes']),
				'dataDesc' => trim($_POST['dataDesc']),
				'dataValue' => $_POST['dataValue'],				
				'plan_id' => trim($_POST['IdPlan']),
				'plan' => trim($_POST['plan']),
				'number_of_lines' => $_POST['number_of_lines'],
				'imei' => $_POST['imei'],
				'country' => 'USA',						
			];
			$log->putLog("DataPay: " . json_encode($data_pay, true));


			$transRequestXmlStr = <<<XML
                    <?xml version="1.0" encoding="UTF-8"?>
                    <createTransactionRequest xmlns="AnetApi/xml/v1/schema/AnetApiSchema.xsd">
                        <merchantAuthentication></merchantAuthentication>
                        <transactionRequest>
                            <transactionType>authOnlyTransaction</transactionType>
                            <amount>assignAMOUNT</amount>
                            <currencyCode>USD</currencyCode>
                            <payment>
                                <opaqueData>
                                <dataDescriptor>assignDD</dataDescriptor>
                                <dataValue>assignDV</dataValue>
                                </opaqueData>
                            </payment>
                            <lineItems>
                                <lineItem>
                                    <itemId>assignPId</itemId>
                                    <name>assignName</name>
                                    <description>assignDesc</description>
                                    <quantity>assignQuantity</quantity>
                                    <unitPrice>assignPrice</unitPrice>
                                </lineItem>
                            </lineItems>
                            <billTo>
                                <firstName>assignFName</firstName>
                                <lastName>assignLName</lastName>
                                <address>assignAddress</address>
                                <city>assignCity</city>
                                <state>assignState</state>
                                <zip>assignZip</zip>
                                <country>assignCountry</country>
                                <phoneNumber>assignPhoneNumber</phoneNumber>
                                <email>assignEmail</email>
                            </billTo>
                        </transactionRequest>
                    </createTransactionRequest>
                    XML;

			$transRequestXml = new SimpleXMLElement($transRequestXmlStr);
			$loginId = API_LOGIN_ID;
			$transactionKey = TRANSACTION_KEY;
			$url = APIURL;
			$transRequestXml->merchantAuthentication->addChild('name', $loginId);
			$transRequestXml->merchantAuthentication->addChild('transactionKey', $transactionKey);
			$transRequestXml->transactionRequest->amount = $data_pay['amount'];
			$transRequestXml->transactionRequest->payment->opaqueData->dataDescriptor = $data_pay['dataDesc'];
			$transRequestXml->transactionRequest->payment->opaqueData->dataValue = $data_pay['dataValue'];
			$transRequestXml->transactionRequest->lineItems->lineItem->itemId = '1';
			$transRequestXml->transactionRequest->lineItems->lineItem->name = $data_pay['plan_id'];
			$transRequestXml->transactionRequest->lineItems->lineItem->description = $data_pay['plan'];
			$transRequestXml->transactionRequest->lineItems->lineItem->quantity = $data_pay['number_of_lines'];
			$transRequestXml->transactionRequest->lineItems->lineItem->unitPrice = $data_pay['price'];
			//$transRequestXml->transactionRequest->tax->amount = $data['taxes'];
			$transRequestXml->transactionRequest->billTo->firstName = $data['first_name'];
			$transRequestXml->transactionRequest->billTo->lastName = $data['second_name'];
			$transRequestXml->transactionRequest->billTo->address = $data['address1'];
			$transRequestXml->transactionRequest->billTo->city = $data['city'];
			$transRequestXml->transactionRequest->billTo->state = $data['state'];
			$transRequestXml->transactionRequest->billTo->zip = $data['zipcode'];
			$transRequestXml->transactionRequest->billTo->country = $data_pay['country'];
			$transRequestXml->transactionRequest->billTo->phoneNumber = $data['phone_number'];
			$transRequestXml->transactionRequest->billTo->email = $data['email'];


			if ($_POST['dataDesc'] === 'COMMON.VCO.ONLINE.PAYMENT') {
				$transRequestXml->transactionRequest->addChild('callId', $_POST['callId']);
			}

			//$customer_id=$_POST['cusId'];

			if (isset($_POST['paIndicator'])) {
				//$transRequestXml->transactionRequest->addChild('cardholderAuthentication');
				//$transRequestXml->transactionRequest->cardholderAuthentication->addChild('authenticationIndicator',$_POST['paIndicator']);
				//$transRequestXml->transactionRequest->cardholderAuthentication->addChild('cardholderAuthenticationValue',$_POST['paValue']);
			}

			//$url=APIURL;
			//$url="https://api.authorize.net/xml/v1/request.api";
			//print_r($transRequestXml->asXML()); 

			try {	//setting the curl parameters.
				$ch = curl_init();
				if (FALSE === $ch)
					throw new Exception('failed to initialize');
				curl_setopt($ch, CURLOPT_URL, $url);
				curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/xml'));
				curl_setopt($ch, CURLOPT_POSTFIELDS, $transRequestXml->asXML());
				curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
				curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 300);
				// The following two curl SSL options are set to "false" for ease of development/debug purposes only.
				// Any code used in production should either remove these lines or set them to the appropriate
				// values to properly use secure connections for PCI-DSS compliance.
				curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);	//for production, set value to true or 1
				curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);	//for production, set value to 2
				curl_setopt($ch, CURLOPT_DNS_USE_GLOBAL_CACHE, false);
				$content = curl_exec($ch);
				if (FALSE === $content)
					throw new Exception(curl_error($ch), curl_errno($ch));
				curl_close($ch);

				$xmlResult = simplexml_load_string($content);
				$jsonResult = json_encode($xmlResult);
				$obj = json_decode($jsonResult, true);
				//$log->putLog("XMData: " . json_encode($jsonResult, true)); // save log	

				//print_r($_SESSION);			
				$messageResultCode = $obj['messages']['resultCode'];
				$transactionResponse = $obj['transactionResponse'] ?? [];
				$transactionCode = isset($transactionResponse['messages']['message']['code']) ?? '';
				$messageTransactionCode = $transactionCode ?? $transactionResponse['errors']['error']['errorCode'] ?? '';				
				$messageResultCode = $obj['messages']['resultCode'];
				$messageResultText = $obj['messages']['message']['text'];

				if (isset($transactionResponse['errors']['error']['errorText'])	&& $transactionResponse['errors']['error']['errorText'] !== '') {

					$pay_transmessage = $transactionResponse['errors']['error']['errorText'];
				} else {
					$pay_transmessage = '';
				}

				if (isset($transactionResponse['messages']['message']['description']) && $transactionResponse['messages']['message']['description'] !== '') {

					$pay_transmessage_success = $transactionResponse['messages']['message']['description'];
				} else {
					$pay_transmessage_success = $pay_transmessage;
				}

				/*********************************************/
				$action_response = $this->getAuthorizeResponseCode($messageTransactionCode);
				$log->putLog("ResponseCodeText: " . json_encode($action_response, true));
				// Get the error suggestions
				$otherRaw       = trim($action_response['other_suggestions'] ?? '');
				$integrationRaw = trim($action_response['integration_suggestions'] ?? '');
				$textRaw        = trim($action_response['text'] ?? '');
				$result = $otherRaw !== ''
					? $otherRaw
					: ($integrationRaw !== ''
						? $integrationRaw
						: $textRaw);

				$pay_message = $obj['messages']['message']['text'] . ' ' . $result;
				/*$pay_message = "The transaction was accepted and was authorized, but is being held for merchant review.";*/

				/*Apis_log_payments */
				/*********************************************/
				$this->logModel->log_payment(array('order_id' => $order_id, 'response' =>  $jsonResult, 'payment_method' => "Credit Card", 'action' => 'Single Payment'));
				/*********************************************/

				$updateData = [
					"order_id" => $order_id,
					'plan' => $data_pay['plan'],
					'email' => $data['email'],
					'pay_message' => $pay_message,
					'pay_authcode' => $obj['transactionResponse']['authCode'],
					'pay_transid' => $obj['transactionResponse']['transId'],
					'pay_accountnumber' => $obj['transactionResponse']['accountNumber'],
					'pay_accounttype' => $obj['transactionResponse']['accountType'],
					'pay_transmessage' => $pay_transmessage_success,
					'billing_address1' => !empty($data['billing_address1']) ? $data['billing_address1'] : $data['address1'],
					'billing_address2' => !empty($data['billing_address1']) ? $data['billing_address2'] : $data['address2'],
					'billing_city' => !empty($data['billing_city']) ? $data['billing_city'] : $data['city'],
					'billing_state' => !empty($data['billing_state']) ? $data['billing_state'] : $data['state'],
					'billing_zipcode' => !empty($data['billing_zipcode']) ? $data['billing_zipcode'] : $data['zipcode'],
					/*"number_of_lines" => $data['number_of_lines'],
					'price' => $data_pay['price'],
					'amount' => $data_pay['amount'], */
				];


				if ($messageResultCode == "Ok") {

					if (!empty($pay_transmessage)) { /*Fail Payment*/
						$updateData['payment_status'] = "Failed";
						//failPayment($data['email'], $this->mailer);
					} else {

						if ($messageResultText == "Successful." && $transactionCode != "") {
							if (!empty($order_id)) {
								$order_data = $this->orderModel->getOrderInformation($order_id);
							}
							$updateData['id_order'] = $order_data['id_order'];
							$updateData['payment_status'] = "Paid";
							$log->putLog("UpdatedData: " . json_encode($updateData, true));

							$order = $this->orderModel->updateOrder($updateData);
							$log->putLog("UpdatedRecord: " . $order);

							//successOneTimePayment($updateData, $this->mailer);

							$get_order = $this->orderModel->getOrderInformation($order_id);
							$get_order['response_suggestion'] = $pay_message;
							$get_order['plan_price'] = $data_pay['plan_price'];
							$get_order['taxes'] = $data_pay['taxes'];

							/*ECS Telgo API*/
							/*******************************/
							//$ecs_response = ECSTelgoo($data, $data_cc);
							$data['areacode'] = $this->getAreaCode($data['phone_number']);
							$data['price'] = $data_pay['price'];
							$data['imei'] =  $data_pay['imei']	;		
	
							$ecs_response = ecsActivationLandingPage($data);
							//$ecs_response = testecsActivationLandingPage($data);
							$log->putLog(
								"ECSResponse: " .
									json_encode(array(
										'request' => $ecs_response['request'],
										'response' => $ecs_response['response'],
									))
							);
							$msg_response = $ecs_response["response"]["CellularVoucherPurchase"]["Message"];

							if ($msg_response == 'APPROVED') {

								$obj['Message'] = $ecs_response["response"]["CellularVoucherPurchase"]["Message"];
								$obj['PGSTransId'] = $ecs_response["response"]["CellularVoucherPurchase"]["PGSTransId"];
								$obj['PhoneNumber'] = $ecs_response["response"]["CellularVoucherPurchase"]["PhoneNumber"];
								$obj['PinCode'] = $ecs_response["response"]["CellularVoucherPurchase"]["PinCode"];
								$obj['QRCode'] = $ecs_response["response"]["CellularVoucherPurchase"]["QRCode"];
								$obj['customerIdncrypt']  = (!empty($data['customer_id'])) ? encrypt_decrypt('encrypt', $data['customer_id']) : null;
								
							} else {
								$obj['Message'] = $ecs_response["response"]["CellularVoucherPurchase"]["Message"];
							}

						}			

					}
							
				} else {
					//failPayment($data['email'], $this->mailer);
				}
			} catch (Exception $e) {

				$obj['errorInternal'] = ['message' => 'There was an internal problem. Please try again.', 'messageDetails' => $e->getCode(), $e->getMessage()];
				//trigger_error(sprintf('Curl failed with error #%d: %s', $e->getCode(), $e->getMessage()), E_USER_ERROR);
			}
		} else {
			$obj['errorInternal'] = ['message' => 'There was an internal problem. Please try again. [POST]'];
		}

		echo json_encode($obj);
	}

	public function getAreaCode($phone)
	{
		$digits = preg_replace('/\D+/', '', $phone);
		return strlen($digits) >= 3 ? substr($digits, 0, 3) : null;
	}

	public function recurringPayment()
	{
		if ($_SERVER['REQUEST_METHOD'] == 'POST') {
			$_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
			$data = [
				'amount' => trim($_POST['amount']),
				'dataDesc' => trim($_POST['dataDesc']),
				'dataValue' => $_POST['dataValue'],
				'first_name' => $_POST['firstname'],
				'last_name' => $_POST['lastname']
			];
		}
		/*print_r($data);
		exit();*/
		//$data = json_decode(file_get_contents("php://input"), 'rb');
		$transRequestXmlStr = <<<XML
		<?xml version="1.0" encoding="UTF-8"?>
		<createTransactionRequest xmlns="AnetApi/xml/v1/schema/AnetApiSchema.xsd">
			<merchantAuthentication></merchantAuthentication>
			<transactionRequest>
				<transactionType>authOnlyTransaction</transactionType>
				<amount>assignAMOUNT</amount>
				<currencyCode>USD</currencyCode>
				<payment>
					<opaqueData>
					<dataDescriptor>assignDD</dataDescriptor>
					<dataValue>assignDV</dataValue>
					</opaqueData>
				</payment>
			</transactionRequest>
		</createTransactionRequest>
		XML;

		$loginId = API_LOGIN_ID;
		$transactionKey = TRANSACTION_KEY;
		$transRequestXml = new SimpleXMLElement($transRequestXmlStr);
		$transRequestXml->merchantAuthentication->addChild('name', $loginId);
		$transRequestXml->merchantAuthentication->addChild('transactionKey', $transactionKey);
		$transRequestXml->transactionRequest->amount = $data['amount'];
		$transRequestXml->transactionRequest->payment->opaqueData->dataDescriptor = $data['dataDesc'];
		$transRequestXml->transactionRequest->payment->opaqueData->dataValue = $data['dataValue'];

		//if($_POST['dataDesc'] === 'COMMON.VCO.ONLINE.PAYMENT')
		//	{
		//		$transRequestXml->transactionRequest->addChild('callId',$_POST['callId']);  
		//	}
		//$customer_id=$_POST['cusId'];
		//if(isset($_POST['paIndicator'])){
		//$transRequestXml->transactionRequest->addChild('cardholderAuthentication');
		//$transRequestXml->transactionRequest->cardholderAuthentication->addChild('authenticationIndicator',$_POST['paIndicator']);
		//$transRequestXml->transactionRequest->cardholderAuthentication->addChild('cardholderAuthenticationValue',$_POST['paValue']);
		//}

		$url = APIURL;
		//$url="https://api.authorize.net/xml/v1/request.api";
		/*print_r($transRequestXml->asXML()); 
	exit();*/

		try {	//setting the curl parameters.
			$ch = curl_init();
			if (FALSE === $ch)
				throw new Exception('failed to initialize');
			curl_setopt($ch, CURLOPT_URL, $url);
			curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/xml'));
			curl_setopt($ch, CURLOPT_POSTFIELDS, $transRequestXml->asXML());
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
			curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 300);
			// The following two curl SSL options are set to "false" for ease of development/debug purposes only.
			// Any code used in production should either remove these lines or set them to the appropriate
			// values to properly use secure connections for PCI-DSS compliance.
			curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);	//for production, set value to true or 1
			curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);	//for production, set value to 2
			curl_setopt($ch, CURLOPT_DNS_USE_GLOBAL_CACHE, false);
			$content = curl_exec($ch);
			if (FALSE === $content)
				throw new Exception(curl_error($ch), curl_errno($ch));
			curl_close($ch);

			$xmlResult = simplexml_load_string($content);

			$jsonResult = json_encode($xmlResult);

			$obj = json_decode($jsonResult, true);

			$messageResult = $obj['messages']['resultCode'];
			$messageText = $obj['messages']['message']['text'];
			$transRespond = $obj['transactionResponse']['responseCode'];


			if ($messageResult == "Ok") {
				$data['authCode'] = $obj['transactionResponse']['authCode'];
				$data['text'] = "Success";
				$data['transId'] = $obj['transactionResponse']['transId'];
				$data['accountNumber'] = $obj['transactionResponse']['accountNumber'];
				$data['accountType'] = $obj['transactionResponse']['accountType'];
				$data['message'] = $obj['transactionResponse']['messages']['message']['description'];

				$callback = array("pay_message" => $messageText, "pay_authocode" => $authCode, "pay_transid" => $transId, "pay_accountnumber" => $accountNumber, "pay_accounttype" => $accountType, "pay_transmessage" => $message, "order_status" => "payment", "payment_method" => "Credit Card", "response" => $text, "customer_id" => $customer_id);
				//updateOrderData($customer_id, $callback, $db);

				$callback = $this->createSubscription($data);
				//include("create-subscription.php");

			} else {
				$data['authCode'] = $obj['transactionResponse']['authCode'];
				$data['text'] = "Unsuccessful.";
				$data['transId'] = $obj['transactionResponse']['transId'];
				$data['accountNumber'] = $obj['transactionResponse']['accountNumber'];
				$data['accountType'] = $obj['transactionResponse']['accountType'];
				$data['message'] = $obj['transactionResponse']['errors']['error']['errorText'];

				$callback = array("pay_message" => $messageText, "pay_authocode" => $authCode, "pay_transid" => $transId, "pay_accountnumber" => $accountNumber, "pay_accounttype" => $accountType, "pay_transmessage" => $message, "order_status" => "payment", "payment_method" => "Credit Card", "response" => $text, "customer_id" => $customer_id);
				//updateOrderData($customer_id, $callback, $db);
			}
			echo json_encode($callback);
		} catch (Exception $e) {
			trigger_error(sprintf('Curl failed with error #%d: %s', $e->getCode(), $e->getMessage()), E_USER_ERROR);
		}
	}

	public function createSubscription()
	{
		if ($_SERVER['REQUEST_METHOD'] == 'POST') {
			$_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
			$data = [
				'amount' => trim($_POST['amount']),
				'dataDesc' => trim($_POST['dataDesc']),
				'dataValue' => $_POST['dataValue'],
				'first_name' => $_POST['firstname'],
				'last_name' => $_POST['lastname'],
				'phone' => $_POST['linkupNumber'],
				'sku' => $_POST['sku'],
				'price' => trim($_POST['amount']),
				'action' => $_POST['upgrade'],
				'orderItemId' => $_POST['orderItemId']
			];
		}

		/**************************************/
		/*Live Values for LinkupMobile*/
		$loginId = API_LOGIN_ID;
		$transactionKey = TRANSACTION_KEY;
		/**************************************/
		/*POST Values*/
		//$customer_id = $_POST['cusId'];
		$first_name = $data['first_name'];
		$last_name = $data['last_name'];
		$amount = number_format($data['amount'], 2, '.', '');
		$dataDesc = $data['dataDesc'];
		$dataValue = $data['dataValue'];
		$referencefId = 'ref' . time();
		$data['referencefId'] = $referencefId;
		//$start_date = date("Y-m-d");
		$start_date = date('Y-m-d', strtotime("+30 days"));
		$transRequestXmlStr = "<ARBCreateSubscriptionRequest  xmlns='AnetApi/xml/v1/schema/AnetApiSchema.xsd'>
									<merchantAuthentication>
									<name>" . $loginId . "</name>
     								<transactionKey>" . $transactionKey . "</transactionKey>
									</merchantAuthentication>
									<refId>" . $referencefId . "</refId>
									<subscription>
										<name>Linkup Monthly Subscription</name>
										<paymentSchedule>
											<interval>
												<length>1</length>
												<unit>months</unit>
											</interval>
											<startDate>" . $start_date . "</startDate>
											<totalOccurrences>12</totalOccurrences>
											<trialOccurrences>1</trialOccurrences>
										</paymentSchedule>
										<amount>" . $amount . "</amount>
										<trialAmount>0.00</trialAmount>
										<payment>
											<opaqueData>
											   <dataDescriptor>" . $dataDesc . "</dataDescriptor>
											   <dataValue>" . $dataValue . "</dataValue>
											</opaqueData>
										</payment>
										<billTo>
											<firstName>" . $first_name . "</firstName>
											<lastName>" . $last_name . "</lastName>
										</billTo>
									</subscription>
								</ARBCreateSubscriptionRequest>";

			//$transRequestXml2 = new SimpleXMLElement($transRequestXmlStr);


			/*XML past values*/
			//$transRequestXml2->addAttribute('xmlns', 'AnetApi/xml/v1/schema/AnetApiSchema.xsd');
			//$transRequestXml2->merchantAuthentication->addChild('name',$loginId);
//				$transRequestXml2->merchantAuthentication->addChild('transactionKey',$transactionKey);
//				$transRequestXml2->refId = $referencefId;
//				$transRequestXml2->subscription->name = "Linkup Monthly Subscription ".$first_name." ".$last_name;
//				$transRequestXml2->subscription->paymentSchedule->startDate = $start_date;
//				$transRequestXml2->subscription->amount = $amount;
//				$transRequestXml2->subscription->payment->opaqueData->dataDescriptor = $dataDesc;
//				$transRequestXml2->subscription->payment->opaqueData->dataValue = $dataValue;
//				$transRequestXml2->subscription->billTo->firstName = $first_name;
//				$transRequestXml2->subscription->billTo->lastName = $last_name;
			//$transRequestXml->subscription->payment->creditCard->cardNumber = $cc;
			//$transRequestXml->subscription->payment->creditCard->expirationDate = $expiration_date;
			//if ($dataDesc === 'COMMON.VCO.ONLINE.PAYMENT') {
				//$transRequestXml->transactionRequest->addChild('callId', $_POST['callId']);
			//}
		/**************************************/
		$url = APIURL;
		//$transRequestXml2->asXML();
		//print_r($transRequestXml2->asXML());
		//exit();

		try {
			//setting the curl parameters.
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
				CURLOPT_POSTFIELDS => $transRequestXmlStr,
				CURLOPT_HTTPHEADER => array(
					'Content-Type: text/xml'
				),
			));

			$content = curl_exec($curl);

			curl_close($curl);


			//$response = new SimpleXMLElement($content);
			$response = simplexml_load_string($content);
			$jsonResult = json_encode($response);

			$obj = json_decode($jsonResult, true);
			//print("<pre>".print_r($obj,true)."</pre>");
			$responserefId = $obj['refId'];
			$messageResultCode = $obj['messages']['resultCode'];
			$messageText = $obj['messages']['message']['text'];
			$email = $_SESSION['user_email'];
			/**********************/
			if ($messageResultCode == "Ok") {

				$data['createSubscriptionText'] = $messageText;
				$data['transactionResponse']['responseCode'] = 1;
				$data['transactionResponse']['transId'] = $obj['subscriptionId'];
				$data['customerProfileId'] = $obj['profile']['customerProfileId'];
				$data['customerPaymentProfileId'] = $obj['profile']['customerPaymentProfileId'];
				$dataUpdate['subscription_refId'] = $responserefId;
				$dataUpdate['subscription_resultCode'] = $messageResultCode;
				$dataUpdate['subscription_Status'] = $messageText;
				$dataUpdate['subscription_Id'] = $obj['subscriptionId'];
				$dataUpdate['id'] = $_SESSION['plans'][0]['id_order'];
				$dataUpdate['pay_message'] = "paid";
				$dataUpdate['payment_method'] = "Credit Card";
				$dataUpdate['payment_source'] = "Authorizenet";
				//$chargeCustomerProfile = $this->chargeCustomerProfile($data);
				//include("chargeCustomerProfile.php");
				$data2 = [
					"id_orderItem" => $data['sku'],
					"subscription_id" => $dataUpdate['subscription_Id'],
					"subscription_payer" => "AuthorizeNet"
				];
				$user_id = $_SESSION['user_id'];
				$id_order = $_SESSION['plan_show']['id_order'];
				$this->account->updateOrderItemsRecords($data2);
				$topupresponse = ecsTopUp($data);
				$this->logModel->log_topup(array('id_user' => $user_id, 'id_order' => $id_order, 'request' => $topupresponse['request'], 'response' => json_encode($topupresponse['response']), 'topup_action' => $data['action']));

				//$this->log->putlog(json_encode($topupresponse));
				successSubscriptionPayment($email, $this->mailer);
				if ($data['action'] == "upgrade") {

					/*********************************************/
					/*Get the sku info with the new product_id*/
					$sku_plans = $this->skuPlansModel->getSKUPlansBySku($data['sku'], 1);
					$new_plan_name = $sku_plans['name'];
					$new_price = $sku_plans['price'];
					$new_plan_id = $sku_plans['plan_id'];
					$new_activation_sku = $sku_plans['activation_sku'];
					$todayDate = date('Y-m-d h:i:s');
					$upgradeData = [
						"id_orderItem" => $data['orderItemId'],
						'plan_id' => $new_plan_id,
						'sku' => $data['sku'],
						'activation_sku' => $new_activation_sku,
						'name' => $new_plan_name,
						'price' => $new_price,
						'plan_upgrated' => 'Yes',
						'date_upgrated' => $todayDate
					];
					/*Update the item*/
					$this->account->updateOrderItemsRecords($upgradeData);
					/*********************************************/
					$orderItemPlan = $this->userModel->getPlanByUserAndOrderItem($user_id, $data['orderItemId']);
					$plansGet = $this->userModel->getPlansByUserONcustomerId($user_id);
					$_SESSION['plans'] = $plansGet;
					$_SESSION['plan_show'] = $orderItemPlan[0];
				}
			} else {
				$data['transactionResponse']['responseCode'] = 0;
				$data['createSubscriptionText'] = $messageText;

				$dataUpdate['subscription_refId'] = $responserefId;
				$dataUpdate['subscription_resultCode'] = $messageResultCode;
				$dataUpdate['subscription_Status'] = $messageText;
				$dataUpdate['id'] = $_SESSION['plans'][0]['id_order'];

				failPayment($email, $this->mailer);
			}
			$paydata = [
				"payment_method" => "AuthorizeNet",
				"id_user" => $_SESSION['user_id'],
				"request" => $transRequestXmlStr,
				"response" => $jsonResult,
				"id_order" => $_SESSION['plans'][0]['id_order']
			];
			$this->logModel->savePaymentLog($paydata);
			//print_r($dataUpdate);

			$logdata = [
				"id_user" => $_SESSION['user_id'],
				"type_log" => "Payment",
				"message" => $dataUpdate['subscription_Status']
			];
			$this->logModel->saveLog($logdata);

			$this->account->updateOrderRecord($dataUpdate);

			echo $jsonResult;
		} catch (Exception $e) {
			trigger_error(sprintf('Curl failed with error #%d: %s', $e->getCode(), $e->getMessage()), E_USER_ERROR);
		}
	}

	public function chargeCustomerProfile($data)
	{
		$transRequestXmlStr = <<<XML
		<?xml version="1.0" encoding="UTF-8"?>
		<createTransactionRequest xmlns="AnetApi/xml/v1/schema/AnetApiSchema.xsd">
		  <merchantAuthentication></merchantAuthentication>
		  <refId>assignrefId</refId>
		  <transactionRequest>
			<transactionType>authOnlyTransaction</transactionType>
			<amount>assignAMOUNT</amount>
			<profile>
			  <customerProfileId>assignProfileId</customerProfileId>
			  <paymentProfile>
				<paymentProfileId>assignpaymentProfileId</paymentProfileId>
			  </paymentProfile>
			</profile>
			<processingOptions>
				<isSubsequentAuth>true</isSubsequentAuth>
			</processingOptions>
			<subsequentAuthInformation>
				<originalNetworkTransId>assignTransId</originalNetworkTransId>
				<originalAuthAmount>assignAuthAmoutn</originalAuthAmount>
				<reason>resubmission</reason>
			</subsequentAuthInformation>
			<authorizationIndicatorType>
				<authorizationIndicator>final</authorizationIndicator>
			</authorizationIndicatorType>
		  </transactionRequest>
		</createTransactionRequest>
		XML;

		$transRequestXml = new SimpleXMLElement($transRequestXmlStr);

		$loginId = API_LOGIN_ID;
		$transactionKey = TRANSACTION_KEY;
		$transRequestXml->merchantAuthentication->addChild('name', $loginId);
		$transRequestXml->merchantAuthentication->addChild('transactionKey', $transactionKey);
		$transRequestXml->refId = $data['referencefId'];
		$transRequestXml->transactionRequest->amount = $data['amount'];
		$transRequestXml->transactionRequest->profile->customerProfileId = $data['customerProfileId'];
		$transRequestXml->transactionRequest->profile->paymentProfile->paymentProfileId = $data['customerPaymentProfileId'];
		$transRequestXml->transactionRequest->subsequentAuthInformation->originalNetworkTransId = $_POST['dataValue'];
		$transRequestXml->transactionRequest->subsequentAuthInformation->originalAuthAmount = $data['amount'];



		/*URL Test*/
		$url = APIURL;

		/*Live URL*/
		//$url="https://api.authorize.net/xml/v1/request.api";
		//print_r($transRequestXml->asXML()); 

		try {	//setting the curl parameters.
			$ch = curl_init();
			if (FALSE === $ch)
				throw new Exception('failed to initialize');
			curl_setopt($ch, CURLOPT_URL, $url);
			curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/xml'));
			curl_setopt($ch, CURLOPT_POSTFIELDS, $transRequestXml->asXML());
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
			curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 300);
			// The following two curl SSL options are set to "false" for ease of development/debug purposes only.
			// Any code used in production should either remove these lines or set them to the appropriate
			// values to properly use secure connections for PCI-DSS compliance.
			curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);	//for production, set value to true or 1
			curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);	//for production, set value to 2
			curl_setopt($ch, CURLOPT_DNS_USE_GLOBAL_CACHE, false);
			$content = curl_exec($ch);
			if (FALSE === $content)
				throw new Exception(curl_error($ch), curl_errno($ch));
			curl_close($ch);

			$xmlResult = simplexml_load_string($content);

			$jsonResult = json_encode($xmlResult);

			//echo $jsonResult;
			//saveApiLog($customer_id,$url,$transRequestXml->asXML(),$jsonResult,'Payment Authorizenet',$db);
			$obj = json_decode($jsonResult, true);
			//print("<pre>".print_r($obj,true)."</pre>");
			$messageResult = $obj['messages']['resultCode'];
			$messageText = $obj['messages']['message']['text'];
			$transRespond = $obj['transactionResponse']['responseCode'];
			if ($transRespond == "1") {
				$authCode = $obj['transactionResponse']['authCode'];
				$text = "Success";
				$transId = $obj['transactionResponse']['transId'];
				$accountNumber = $obj['transactionResponse']['accountNumber'];
				$accountType = $obj['transactionResponse']['accountType'];
				$message = $obj['transactionResponse']['messages']['message']['description'];

				$callback = array("pay_message" => $messageText, "pay_authocode" => $authCode, "pay_transid" => $transId, "pay_accountnumber" => $accountNumber, "pay_accounttype" => $accountType, "pay_transmessage" => $message, "order_status" => "payment", "payment_method" => "Credit Card", "response" => $text, "customer_id" => $customer_id);
				//updateOrderData($customer_id, $callback, $db);
				//include("create-subscription.php");
			} else {
				$authCode = $obj['transactionResponse']['authCode'];
				$text = "Unsuccessful.";
				$transId = $obj['transactionResponse']['transId'];
				$accountNumber = $obj['transactionResponse']['accountNumber'];
				$accountType = $obj['transactionResponse']['accountType'];
				$message = $obj['transactionResponse']['errors']['error']['errorText'];

				$callback = array("pay_message" => $messageText, "pay_authocode" => $authCode, "pay_transid" => $transId, "pay_accountnumber" => $accountNumber, "pay_accounttype" => $accountType, "pay_transmessage" => $message, "order_status" => "payment", "payment_method" => "Credit Card", "response" => $text, "customer_id" => $customer_id);
				//updateOrderData($customer_id, $callback, $db);
			}

			return $callback;
		} catch (Exception $e) {
			trigger_error(sprintf('Curl failed with error #%d: %s', $e->getCode(), $e->getMessage()), E_USER_ERROR);
		}
	}

	public function subscriptionPayment()
	{
		$data = json_decode(file_get_contents("php://input"), 'rb');
		$transRequestXmlStr = <<<XML
		<ARBCreateSubscriptionRequest xmlns="AnetApi/xml/v1/schema/AnetApiSchema.xsd">
		<merchantAuthentication>
			<name>3kFew5Z8Ra</name>
			<transactionKey>8y25f3QT9qj3A6uh</transactionKey>
		</merchantAuthentication>
		<refId>123456</refId>
		<subscription>
			<name>Sample subscription</name>
			<paymentSchedule>
				<interval>
					<length>1</length>
					<unit>months</unit>
				</interval>
				<startDate>2020-08-30</startDate>
				<totalOccurrences>12</totalOccurrences>
				<trialOccurrences>1</trialOccurrences>
			</paymentSchedule>
			<amount>10.29</amount>
			<trialAmount>0.00</trialAmount>
			<payment>
				<opaqueData>
					<dataDescriptor>COMMON.ACCEPT.INAPP.PAYMENT</dataDescriptor>
					<dataValue>eyJjb2RlIjoiNTBfMl8wNjAwMDUyNUMxREY1NEVGNDBGQkNDNDdCNTk3QjI2QzI5MjAzNUJEOTUwRTQ3MjBCMTJDODM2NDk2NDhBMTgwNjg4RTlENTZGMDg5RTE1MEJGMjI4Q0U0NkJCMzQ3QzcwODk1QjE5IiwidG9rZW4iOiI5NTI3ODM1MzMxMzgzOTQ5MTA0NjA0IiwidiI6IjEuMSJ9</dataValue>
				</opaqueData> 
			</payment>
			<billTo>
				<firstName>John</firstName>
				<lastName>Smith</lastName>
			</billTo>
		</subscription>
		</ARBCreateSubscriptionRequest>
		XML;

		$transRequestXml = new SimpleXMLElement($transRequestXmlStr);

		$loginId = API_LOGIN_ID;
		$transactionKey = TRANSACTION_KEY;

		//$loginId = "8q35FqpYa";
		//	$transactionKey = "4uNJ2266n86Z7vax";
		//$loginId = "6dgFn3wj5Ak";
		//$loginId = "96Xv9uu24H7b";
		//$transactionKey = "7X3gG63upg47Lgwz";
		//$transactionKey = "65247m3EV83wdF2g"; 
		$amount = 11;
		$refId = 'ref' . time();
		$startDate = date("Y-m-d");
		$transRequestXml->merchantAuthentication->name = $loginId;
		$transRequestXml->merchantAuthentication->transactionKey = $transactionKey;
		$transRequestXml->refId = $refId;
		$transRequestXml->subscription->name = "Test Subscription";
		$transRequestXml->subscription->paymentSchedule->startDate = $startDate;
		$transRequestXml->subscription->amount = $amount;

		$transRequestXml->subscription->payment->opaqueData->dataDescriptor = $data['dataDesc'];
		$transRequestXml->subscription->payment->opaqueData->dataValue = $data['dataValue'];
		$transRequestXml->subscription->billTo->firstName = $data['firstname'];
		$transRequestXml->subscription->billTo->lastName = $data['lastname'];
		if ($_POST['dataDesc'] === 'COMMON.VCO.ONLINE.PAYMENT') {
			//$transRequestXml->transactionRequest->addChild('callId',$_POST['callId']);  
		}

		$customer_id = $data['customerId'];

		if (isset($_POST['paIndicator'])) {
			//$transRequestXml->transactionRequest->addChild('cardholderAuthentication');
			//$transRequestXml->transactionRequest->cardholderAuthentication->addChild('authenticationIndicator',$_POST['paIndicator']);
			//$transRequestXml->transactionRequest->cardholderAuthentication->addChild('cardholderAuthenticationValue',$_POST['paValue']);
		}

		$url = APIURL;
		//$url="https://api.authorize.net/xml/v1/request.api";
		//print_r($transRequestXml->asXML()); 

		try {	//setting the curl parameters.
			$ch = curl_init();
			if (FALSE === $ch)
				throw new Exception('failed to initialize');
			curl_setopt($ch, CURLOPT_URL, $url);
			curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/xml'));
			curl_setopt($ch, CURLOPT_POSTFIELDS, $transRequestXml->asXML());
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
			curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 300);
			// The following two curl SSL options are set to "false" for ease of development/debug purposes only.
			// Any code used in production should either remove these lines or set them to the appropriate
			// values to properly use secure connections for PCI-DSS compliance.
			curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);	//for production, set value to true or 1
			curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);	//for production, set value to 2
			curl_setopt($ch, CURLOPT_DNS_USE_GLOBAL_CACHE, false);
			$content = curl_exec($ch);
			if (FALSE === $content)
				throw new Exception(curl_error($ch), curl_errno($ch));
			curl_close($ch);

			$xmlResult = simplexml_load_string($content);

			$jsonResult = json_encode($xmlResult);

			echo $jsonResult;
		} catch (Exception $e) {
			trigger_error(sprintf('Curl failed with error #%d: %s', $e->getCode(), $e->getMessage()), E_USER_ERROR);
		}
	}

	public function getToken($cpid)
	{
		//$param = parse_ini_file("config.txt");
		$xmlStr = <<<XML
		<?xml version="1.0" encoding="utf-8"?>
		<getHostedProfilePageRequest xmlns="AnetApi/xml/v1/schema/AnetApiSchema.xsd">
		<merchantAuthentication></merchantAuthentication>
		<customerProfileId></customerProfileId>
		<hostedProfileSettings>
		<setting><settingName>hostedProfileReturnUrl</settingName></setting>
		<setting><settingName>hostedProfileIFrameCommunicatorUrl</settingName></setting>
		<setting><settingName>hostedProfileReturnUrlText</settingName><settingValue>Back to Confirmation Page</settingValue></setting>
		<setting><settingName>hostedProfilePageBorderVisible</settingName><settingValue>false</settingValue></setting>
		<setting><settingName>hostedProfileBillingAddressOptions</settingName><settingValue>showBillingAddress</settingValue></setting>
		<!--<setting><settingName>hostedProfileManageOptions</settingName><settingValue>showPayment</settingValue></setting> -->
		<setting><settingName>hostedProfilePaymentOptions</settingName><settingValue>showCreditCard</settingValue></setting>
		</hostedProfileSettings>
		</getHostedProfilePageRequest>
		XML;
		$xml = new SimpleXMLElement($xmlStr);

		$loginId = API_LOGIN_ID;
		$transactionKey = TRANSACTION_KEY;

		$xml->merchantAuthentication->addChild('name', $loginId);
		$xml->merchantAuthentication->addChild('transactionKey', $transactionKey);
		/*if (isset($_COOKIE['cpid'])) {
			$cpid = $_COOKIE['cpid'];
		} else if (isset($_COOKIE['temp_cpid'])) {
			$cpid = $_COOKIE['temp_cpid'];
		}*/
		//$cpid="516502024";

		$xml->customerProfileId = $cpid;
		$xml->hostedProfileSettings->setting[0]->addChild('settingValue', URLROOT . "/public/authorizenet/return.html");
		$xml->hostedProfileSettings->setting[1]->addChild('settingValue', URLROOT . "/public/authorizenet/IFrameCommunicator.html");

		$url = APIURL;

		try {    //setting the curl parameters.
			$ch = curl_init();
			if (false === $ch) {
				throw new Exception('failed to initialize');
			}
			curl_setopt($ch, CURLOPT_URL, $url);
			curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/xml'));
			curl_setopt($ch, CURLOPT_POSTFIELDS, $xml->asXML());
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
			curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 300);
			// The following two curl SSL options are set to "false" for ease of development/debug purposes only.
			// Any code used in production should either remove these lines or set them to the appropriate
			// values to properly use secure connections for PCI-DSS compliance.
			curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);    //for production, set value to true or 1
			curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);    //for production, set value to 2
			curl_setopt($ch, CURLOPT_DNS_USE_GLOBAL_CACHE, false);
			$content = curl_exec($ch);
			$response = new SimpleXMLElement($content);
			return $response;
			if (false === $content) {
				throw new Exception(curl_error($ch), curl_errno($ch));
			}
			curl_close($ch);
		} catch (Exception $e) {
			trigger_error(sprintf('Curl failed with error #%d: %s', $e->getCode(), $e->getMessage()), E_USER_ERROR);
		}
	}

	public function getProfiles($cpid)
	{
		$profileReq = <<<XML
		<?xml version="1.0" encoding="utf-8"?>
		<getCustomerProfileRequest xmlns="AnetApi/xml/v1/schema/AnetApiSchema.xsd">
		<merchantAuthentication></merchantAuthentication>
		<customerProfileId></customerProfileId>
		</getCustomerProfileRequest>
		XML;
		$loginId = API_LOGIN_ID;
		$transactionKey = TRANSACTION_KEY;
		$xml = new SimpleXMLElement($profileReq);
		$xml->merchantAuthentication->addChild('name', $loginId);
		$xml->merchantAuthentication->addChild('transactionKey', $transactionKey);
		$xml->customerProfileId = $cpid;
		$url = APIURL;
		try {	//setting the curl parameters.
			$ch = curl_init();
			if (FALSE === $ch)
				throw new Exception('failed to initialize');
			curl_setopt($ch, CURLOPT_URL, $url);
			curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/xml'));
			curl_setopt($ch, CURLOPT_POSTFIELDS, $xml->asXML());
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
			curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 300);
			// The following two curl SSL options are set to "false" for ease of development/debug purposes only.
			// Any code used in production should either remove these lines or set them to the appropriate
			// values to properly use secure connections for PCI-DSS compliance.
			curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);	//for production, set value to true or 1
			curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);	//for production, set value to 2
			curl_setopt($ch, CURLOPT_DNS_USE_GLOBAL_CACHE, false);
			$content = curl_exec($ch);
			$profileResponse = new SimpleXMLElement($content);
			if (FALSE === $content)
				throw new Exception(curl_error($ch), curl_errno($ch));
			curl_close($ch);
			return $profileResponse;
		} catch (Exception $e) {
			trigger_error(sprintf('Curl failed with error #%d: %s', $e->getCode(), $e->getMessage()), E_USER_ERROR);
		}
	}

	public function getHostedPaymentForm()
	{
		$xmlStr = <<<XML
			<?xml version="1.0" encoding="utf-8"?>
			<getHostedPaymentPageRequest xmlns="AnetApi/xml/v1/schema/AnetApiSchema.xsd">
				<merchantAuthentication></merchantAuthentication>
				<transactionRequest>
					<transactionType>authCaptureTransaction</transactionType>
					<amount>0.50</amount>
					<order>
						<invoiceNumber>INV-12345</invoiceNumber>
						<description>Product Description</description>
					</order>
					<poNumber>456654</poNumber>
					<customerIP>192.168.1.1</customerIP>
				</transactionRequest>
				<hostedPaymentSettings>
					<setting>
						<settingName>hostedPaymentIFrameCommunicatorUrl</settingName>
					</setting>
					<setting>
						<settingName>hostedPaymentButtonOptions</settingName>
						<settingValue>{"text": "Pay"}</settingValue>
					</setting>
					<setting>
						<settingName>hostedPaymentReturnOptions</settingName>
					</setting>
					<setting>
						<settingName>hostedPaymentOrderOptions</settingName>
						<settingValue>{"show": false}</settingValue>
					</setting>
					<setting>
						<settingName>hostedPaymentPaymentOptions</settingName>
						<settingValue>{"cardCodeRequired": true, "showBankAccount": false}</settingValue>
					</setting>
					<setting>
						<settingName>hostedPaymentBillingAddressOptions</settingName>
						<settingValue>{"show": true, "required":true}</settingValue>
					</setting>
					<setting>
						<settingName>hostedPaymentShippingAddressOptions</settingName>
						<settingValue>{"show": false, "required":false}</settingValue>
					</setting>
					<setting>
						<settingName>hostedPaymentSecurityOptions</settingName>
						<settingValue>{"captcha": false}</settingValue>
					</setting>
					<setting>
						<settingName>hostedPaymentStyleOptions</settingName>
						<settingValue>{"bgColor": "green"}</settingValue>
					</setting>
					<setting>
						<settingName>hostedPaymentCustomerOptions</settingName>
						<settingValue>{"showEmail": true, "requiredEmail":true, "showBankAccount": false}</settingValue>
					</setting>
				</hostedPaymentSettings>
			</getHostedPaymentPageRequest>
			XML;
		$loginId = API_LOGIN_ID;
		$transactionKey = TRANSACTION_KEY;
		$xml = simplexml_load_string($xmlStr, 'SimpleXMLElement', LIBXML_NOWARNING);
		// $xml = new SimpleXMLElement($xmlStr);
		$xml->merchantAuthentication->addChild('name', $loginId);
		$xml->merchantAuthentication->addChild('transactionKey', $transactionKey);

		$commUrl = json_encode(array('url' => URLROOT . "/public/authorizenet/IFrameCommunicator.html"), JSON_UNESCAPED_SLASHES);
		$xml->hostedPaymentSettings->setting[0]->addChild('settingValue', $commUrl);

		$retUrl = json_encode(array("showReceipt" => false, 'url' => URLROOT . "/public/authorizenet/return.html", "urlText" => "Continue to site", "cancelUrl" => URLROOT . "/public/authorizenet/return.html", "cancelUrlText" => "Cancel"), JSON_UNESCAPED_SLASHES);
		$xml->hostedPaymentSettings->setting[2]->addChild('settingValue', $retUrl);

		$url = APIURL;

		try {   //setting the curl parameters.
			$ch = curl_init();
			if (false === $ch) {
				throw new Exception('failed to initialize');
			}
			curl_setopt($ch, CURLOPT_URL, $url);
			curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/xml'));
			curl_setopt($ch, CURLOPT_POSTFIELDS, $xml->asXML());
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
			curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 300);
			// The following two curl SSL options are set to "false" for ease of development/debug purposes only.
			// Any code used in production should either remove these lines or set them to the appropriate
			// values to properly use secure connections for PCI-DSS compliance.
			curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);    //for production, set value to true or 1
			curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);    //for production, set value to 2
			curl_setopt($ch, CURLOPT_DNS_USE_GLOBAL_CACHE, false);
			//curl_setopt($ch, CURLOPT_PROXY, 'userproxy.visa.com:80');
			$content = curl_exec($ch);
			$content = str_replace('xmlns="AnetApi/xml/v1/schema/AnetApiSchema.xsd"', '', $content);

			$hostedPaymentResponse = new SimpleXMLElement($content);

			return $hostedPaymentResponse;
			if (false === $content) {
				throw new Exception(curl_error($ch), curl_errno($ch));
			}
			curl_close($ch);
		} catch (Exception $e) {
			trigger_error(sprintf('Curl failed with error #%d: %s', $e->getCode(), $e->getMessage()), E_USER_ERROR);
		}
	}

	public function getAuthorizeResponseCode($code)
	{
		// Cachear el JSON
		static $errors = null;

		if ($errors === null) {
			$jsonPath = URLROOT . '/files/responseCodesAuthorize.json';

			$json   = file_get_contents($jsonPath);
			$errors = json_decode($json, true);

			if (!is_array($errors)) {
				// Si el JSON está mal, evitamos warnings después
				$errors = [];
			}
		}

		// Normalizamos el código a string
		$code = (string) $code;

		$codes = array_column($errors, 'code');
		$index = array_search($code, $codes, true);
		return $index !== false ? $errors[$index] : null;
	}

	public function sanitizeInput($input, $type)
	{

		if (isset($input) && !empty($input)) {
			switch ($type) {
				case 'string':
					// Sanitize string: Trim, remove HTML tags, escape HTML characters
					$input = trim($input);
					$input = strip_tags($input); // Removes HTML and PHP tags
					return htmlspecialchars($input, ENT_QUOTES, 'UTF-8');

				case 'email':
					// Sanitize email
					return filter_var($input, FILTER_SANITIZE_EMAIL);

				case 'phone':
					// Sanitize phone
					$cleanphone = preg_replace('/[^0-9]/', '', $input);
					$phone = trim($cleanphone);
					return $phone;

				case 'url':
					// Sanitize URL
					return filter_var($input, FILTER_SANITIZE_URL);

				case 'int':
					// Sanitize integer
					return filter_var($input, FILTER_SANITIZE_NUMBER_INT);

				case 'float':
					// Sanitize float
					return filter_var($input, FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);

				case 'boolean':
					// Sanitize boolean
					return filter_var($input, FILTER_VALIDATE_BOOLEAN);

				case 'csrf':
					// Check CSRF token (assumes token is stored in session)
					session_start(); // Start session if not started
					if ($input !== $_SESSION['csrf_token']) {
						die("CSRF token validation failed");
					}
					return $input;

				default:
					// Return unmodified input if type is unknown
					return $input;
			}
		} else {
			return $input = '';
		}
	}
}
