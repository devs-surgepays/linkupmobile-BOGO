<?php
//
//class Posts {
//	public function __construct(){
//		echo 'Posts loaded';
//	}
//}
/*ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);*/


class Payment extends Controller{
	public $mailer="";
	public $skuPlansModel = '';
	public $paymentModel = '';
	public $userModel = '';
	public $ordersItemsModel = '';
	public $logModel ='';
	public $addonModel = '';
	public $account = '';
	public function __construct(){
		if(!isLoggedIn()){
			redirect('users/login');
		}
		// $this->postModel = $this->model('Post');
		$this->userModel = $this->model('User');
		$this->paymentModel = $this->model('PaymentModel');
		$this->skuPlansModel = $this->model('SkuPlans');
		$this->account = $this->model('Account');
		$this->logModel = $this->model('ActivityLog');
		$this->mailer = new PHPMailer_Lib();
		$this->ordersItemsModel = $this->model('OrderItems');
		$this->addonModel = $this->model('Addon');
		
		$now =  date('Y-m-d');
		$logfile = "log_" . $now . ".txt";
		$this->log = new Logger($logfile);
		$this->log->setTimestamp("Y-m-d h:i:s");
		//$this->log->putlog("This is a test");
	}
	public function index(){
		$subsID= $_SESSION['plan_show']['subscription_Id'];
		$manuallyPayment= $_SESSION['plan_show']['manualPaymentSubscription'];
		/*$posts = $this->postModel->getPosts();
		$data = [
			'posts'=> $posts
		];*/
		$cpid="";
		if($cpid){
			$response = getToken($cpid);
			$hostedPaymentResponse =getHostedPaymentForm();
			$profileResponse = getProfiles($cpid);
			$profileResponse->token=$response->token;
			$profileResponse->hostedtoken=$hostedPaymentResponse->token;
			$data = $profileResponse;
		}else{
			$data="";
		}
		
		if($subsID && $manuallyPayment!=1){
			//$this->view('subscriptions/index');
			redirect('subscriptions');
		}else{
			$this->view('payment/index',$data);
		}
		
	}
	public function history()
	{
		$subsID = $_SESSION['plan_show']['subscription_Id'];
		$LinkupPhoneNumber = $_SESSION['plan_show']['LinkupPhoneNumber'];
		//$LinkupPhoneNumber = '9012012609';
		$data = [
			'numSimLinkup'=> $LinkupPhoneNumber
		];
		$paymentECSInfo = GetPaymentInfo($data);
		if (!$paymentECSInfo) {
			return;
		}
		//print("<pre>" . print_r($paymentECSInfo, true) . "</pre>");
		$message = $paymentECSInfo['response']['CellularVoucherPurchase']['Message'];
		$payments = $paymentECSInfo['response']['CellularVoucherPurchase']['Payments'];
		
		if (isset($payments['Payment']['Date'])) {
			$sku = $payments['Payment']['SKU'];
			$sku_plan = $this->skuPlansModel->getSKUPlansBySku($sku);
			$payments['Payment']['plan_name'] = $sku_plan['name'] .'/'.$sku_plan['data']. ' Monthly ' ?? 'Unknown Plan';
			
		} else {
			foreach ($payments['Payment'] as $i => $payment) {
				$sku = $payment['SKU'];
				$sku_plan = $this->skuPlansModel->getSKUPlansBySku($sku);
				$payments['Payment'][$i]['plan_name'] = $sku_plan['name'] . '/' . $sku_plan['data']  . ' Monthly ' ?? 'Unknown Plan';
			}
		}
		$response = array(
			'message' => $message,
			'payments' => $payments
		);

		$this->view('payment/history', $response);
	}

	public function msgReturn($status, $msg, $msgDetail, $payments = array())
	{
		$return = array();
		$return['status'] = $status;
		$return['msg'] = $msg;
		$return['msgDetail'] = $msgDetail;
		$return['Payments'] = $payments;
		echo json_encode($return);
		exit();
	}
	
	public function index2(){
		$this->view('payment/index2');
		
	}
	
	public function subscription(){
		
		$this->view('payment/subscription');
		
	}
	
	public function paypal($paymentID,$payerID,$token,$pid="",$action=""){

		ini_set('display_errors', 1);
		ini_set('display_startup_errors', 1);
		error_reporting(E_ALL);

		$user_id = $_SESSION['user_id'];
		$email = $_SESSION['user_email'];		
		$id_order = $_SESSION['plan_show']['id_order'];
		$orderItemId = $_SESSION['plan_show']['id_orderItem'];
		$LinkupPhoneNumber = $_SESSION['plan_show']['LinkupPhoneNumber'];
		$price = $_SESSION['plan_show']['price'];
		$sku= $pid;
		
		successOneTimePayment($email,$this->mailer);

		if ($action == "addon") {

			/*****************************************/
			$description = "LinkUp Mobile ".$action;
			$todayDate = date('Y-m-d h:i:s');
			$newsku_plan = $this->skuPlansModel->getSKUPlansBySku($sku, 1);
			$new_sku = $newsku_plan['sku'];
			$planName = $newsku_plan['name'];
			$new_price = $newsku_plan['price'];
			$new_plan_id = $newsku_plan['plan_id'];
			$new_activation_sku = $newsku_plan['activation_sku'];
			$digital_variant_id = $newsku_plan['digital_variant_id'];
			$shopify_digitalproduct_id = $newsku_plan['shopify_digitalproduct_id'];
			/*****************************************/

			$addOnData = [
				"id_orderItem" => $orderItemId,
				'LinkupPhoneNumber' => $LinkupPhoneNumber,
				'date_addon' => $todayDate,
				'plan_id' => $new_plan_id,
				'sku' => $sku,
				'name' => $planName,
				'price' => $new_price,
				'transactionID' => $token
			];
			$topUpData = [
				'sku' => $sku,
				'phone' => $LinkupPhoneNumber,
				"price" => $new_price
			];
			/*Create AddOn*/
			$this->addonModel->createAddonRecord($addOnData);
			$msg = "The Add On has been successfully added";

			successAddOn($email, $this->mailer);

		}else{

			$topUpData = [
				'sku' => $sku,
				'phone' => $LinkupPhoneNumber,
				"price" => $price
			];

			successOneTimePayment($email, $this->mailer);

		}

		/*Trigger the TopUp API*/
		$ecsTopUp = ecsTopUp($topUpData);
		$this->logModel->log_topup(
			array(
			'id_user' => $user_id, 
			'id_order' => $id_order, 
			'request' => $ecsTopUp['request'], 
			'response' => json_encode($ecsTopUp['response']),
			'topup_action' => $action)
		);

		$data = [
			'paymentID' => $paymentID,
			'payerID' => $payerID,
			'token' => $token,
			'pid' => $pid
		];
	
		$this->view('payment/paypal',$data);
	}
	
	public function paypalResponse($status,$sku="",$orderItemId="",$action = ""){

		ini_set('display_errors', 1);
		ini_set('display_startup_errors', 1);
		error_reporting(E_ALL);
		
		$user_id = $_SESSION['user_id'];
		$email = $_SESSION['user_email'];
		$LinkupPhoneNumber = $_SESSION['plan_show']['LinkupPhoneNumber'];
		$price = $_SESSION['plan_show']['price'];
		$id_order = $_SESSION['plan_show']['id_order'];
		$sessiondata = [
			"user_id" => $user_id,
			'user_email' => $email,
			'LinkupPhoneNumber' => $LinkupPhoneNumber,
			'price' => $price,	

		];
		
		
		//echo $status;
		if($status=="Success"){
			
			//print("<pre>" . print_r($sessiondata, true) . "</pre>");
			$token = $_GET['token'];
			$paypal =new Paypal();
			$apiContext = $paypal->context();
			$agreement = $paypal->Agreement();
			$result = $agreement->execute($token, $apiContext);
			//print_r($agreement);
			$jsonResult = $result->toJSON();
			$payload = json_decode($agreement,true);
			//echo "<pre>";
			//echo $payload['id'];
		
			$todayDate = date('Y-m-d h:i:s');
			/*********************************************/
			/*Get the sku info with the new product_id*/
			$sku_plans = $this->skuPlansModel->getSKUPlansBySku($sku, 1);
			$new_plan_name = $sku_plans['name'];
			$new_price = $sku_plans['price'];
			$new_plan_id = $sku_plans['plan_id'];
			$new_activation_sku = $sku_plans['activation_sku'];
			$digital_variant_id = $sku_plans['digital_variant_id'];
			$shopify_digitalproduct_id = $sku_plans['shopify_digitalproduct_id'];
			
			if($action == "upgrade"){		

				$data = [
					"id_orderItem" => $orderItemId,
					'plan_id' => $new_plan_id,
					'sku' => $sku,
					'activation_sku' => $new_activation_sku,
					'name' => $new_plan_name,
					'price' => $new_price,
					'plan_upgrated' => 'Yes',
					'date_upgrated' => $todayDate,
					"subscription_id" => $payload['id'],
					"subscription_payer" => "payPal",
					"subscription_token" => $token,
					'action' => $_POST['upgrade']
				];
				$topUpData = [
					'sku' => $sku,
					'phone' => $LinkupPhoneNumber,
					"price" => $new_price
				];
				$msg = "Your Plan has been successfully&nbspUpgraded";
				$orderItemPlan = $this->userModel->getPlanByUserAndOrderItem($user_id, $orderItemId);
				$plansGet = $this->userModel->getPlansByUserONcustomerId($user_id);
				$_SESSION['plans'] = $plansGet;
				$_SESSION['plan_show'] = $orderItemPlan[0];

			}elseif ($action == "addon") {
				
				$addOnData = [
					"id_orderItem" => $orderItemId,
					'LinkupPhoneNumber' => $LinkupPhoneNumber,
					'date_addon' => $todayDate,
					'plan_id' => $new_plan_id,
					'sku' => $sku,
					'name' => $new_plan_name,
					'price' => $new_price,
					'transactionID' => $token
				];
				$topUpData = [
					'sku' => $sku,
					'phone' => $LinkupPhoneNumber,
					"price" => $new_price
				];
				/*Create AddOn*/
				$this->addonModel->createAddonRecord($addOnData);
				$msg = "The AddOn has been successfully added";

			}else{

				$data = [
					"id_orderItem" => $orderItemId,
					'plan_id' => $new_plan_id,
					'sku' => $sku,
					'activation_sku' => $new_activation_sku,
					'name' => $new_plan_name,
					'price' => $new_price,
					'plan_upgrated' => 'Yes',
					'date_upgrated' => $todayDate,
					"subscription_id" => $payload['id'],
					"subscription_payer" => "payPal",
					"subscription_token" => $token
				];
				$topUpData = [
					'sku' => $sku,
					'phone' => $LinkupPhoneNumber,
					"price" => $price
				];
				$msg = "Recurring Billing has been set Successfully";
			}
			if($action != "addon"){
				/*Update the item*/
				$this->account->updateOrderItemsRecords($data);
				/*********************************************/
			}
			
			/*Trigger the TopUp API*/
			$ecsTopUp = ecsTopUp($topUpData);
			$this->logModel->log_topup(array('id_user' => $user_id, 'id_order' => $id_order, 'request' => $ecsTopUp['request'], 'response' => json_encode($ecsTopUp['response']), 'topup_action' => $action));
			//print("<pre>" . print_r($ecsTopUp, true) . "</pre>");
			
			if (!empty($ecsTopUp['response'])) {
				$res_message = $ecsTopUp['response']['CellularRtrPurchase']['Message'];
				
				if ($res_message == 'APPROVED') {				

					$TransactionID = $ecsTopUp['response']['CellularRtrPurchase']['PGSTransId'];
					$date_activated = $ecsTopUp['response']['CellularRtrPurchase']['TransDateTime'];
					$termminaldate_activated = $ecsTopUp['response']['CellularRtrPurchase']['TerminalDateTime'];

					if ($action == "upgrade") {

						$msg = '<p class="mb-0">' . $msg . '</p>
							<ul class="mt-2">
							<li style="list-style-type: circle; margin-left: -20px;">Transaction ID: ' . $TransactionID . '</li>
							<li style="list-style-type: circle; margin-left: -20px;">Subscription ID: ' . $payload['id'] . '</b></li></ul>';
						$message_log = "The plan has been upgraded to " . $new_plan_name . " " . $new_price;
						$status = true;
						$this->logModel->saveLog(array('id_user' => $user_id, 'type_log' => 'PaypalUpgradePlan', 'message' =>  $message_log)); // Save log
						/*Assign to the sessions the new ones*/
						$orderItemPlan = $this->userModel->getPlanByUserAndOrderItem($user_id, $orderItemId);
						$plansGet = $this->userModel->getPlansByUserONcustomerId($user_id);
						$_SESSION['plans'] = $plansGet;
						$_SESSION['plan_show'] = $orderItemPlan[0];
					}else{
						$msg = '<p class="mb-0">' . $msg . '</p>
							<ul class="mt-2">
							<li style="list-style-type: circle; margin-left: -20px;">Transaction ID: ' . $TransactionID . '</li>
							<li style="list-style-type: circle; margin-left: -20px;">Subscription ID: ' . $payload['id'] . '</b></li></ul>';
					}	
				}

			}	

			/*Payment Response Log*/
			$paydata=[
				"payment_method"=>"payPal",
				"id_user"=>$_SESSION['user_id'],
				"response"=>$jsonResult,
				"id_order"=>$orderItemId
			];
			$this->logModel->savePaymentLog($paydata);
			
			//successSubscriptionPayment($email,$this->mailer);
		}else if ($status=="Cancel"){
			$msg= "Order Canceled by user";
			failPayment($email,$this->mailer);
		}
		
		$logdata=[
			"id_user"=>$_SESSION['user_id'],
			"type_log"=>"Payment",
			"message"=>$msg
		];
		$this->logModel->saveLog($logdata);
		$response=[
			"msg"=>$msg,
			"sku"=>$sku,
			"status"=>$status
		];
		//echo $_GET['token'];
		if ($action == "addon") {
			$this->view('payment/addon',$response);
		}else{
			$this->view('payment/subscription', $response);
		}
	}
	
	public function subscribe(){
		$subsID= $_SESSION['plan_show']['subscription_Id'];
		if($subsID){
			//$this->view('subscriptions/index');
			redirect('subscriptions');
		}else{
			$this->view('payment/subscribe');
		}
	}
	
	public function paypalSubscription($sku,$price,$position){
		/*echo "Hola0";*/
		ob_start();
		$plan_show = $_SESSION['plan_show'];
		$info = $_SESSION;
		/*echo "<pre>";
		print_r($info['plans'][$position]);*/
		$planName = $info['plans'][$position]['plan_title'];
		$address = $info['plans'][$position]['address1'];
		$city = $info['plans'][$position]['city'];
		$zipcode = $info['plans'][$position]['zipcode'];
		$orderItemId = $info['plans'][$position]['id_orderItem'];
		//exit();
		$paypal =new Paypal();
		//$price = $plan_show['plan_price']-5;
		$apiContext = $paypal->context();
		//$exception = $paypal->PayPalConnectionException();
		$plan = $paypal->Plan();
		$plan->setName($planName)
			->setDescription('LinkUp Mobile Subscription')
			->setType('FIXED');
		
		// Set billing plan definitions
		$paymentDefinition = $paypal->PaymentDefinition();
		$currency = $paypal->Currency();
		$currency = array(
			'value' => $price,
			'currency' => 'USD'
		);
		
		$paymentDefinition->setName('Regular Payments')
			->setType('REGULAR')
			->setFrequency('MONTH')
			->setFrequencyInterval('1')
			->setCycles('12')
			->setAmount($currency);
		
		// Set charge models
		$chargeModel = $paypal->ChargeModel();
		$currency2 = array(
			'value' => $price ,
			'currency' => 'USD'
		);
		$chargeModel->setType('SHIPPING')->setAmount($currency2);
		$paymentDefinition->setChargeModels(array(
			$chargeModel
		));
		
		// Set merchant preferences
		$merchantPreferences = $paypal->MerchantPreferences();
		$merchantPreferences->setReturnUrl('https://myaccount.linkupmobile.com/payment/paypalResponse/Success/'.$sku.'/'.$orderItemId)
			->setCancelUrl('https://myaccount.linkupmobile.com/payment/paypalResponse/Cancel')
			->setAutoBillAmount('yes')
			->setInitialFailAmountAction('CONTINUE')
			->setMaxFailAttempts('0')
			->setSetupFee($currency2);

		$plan->setPaymentDefinitions(array(
			$paymentDefinition
		));
		$plan->setMerchantPreferences($merchantPreferences);
		
		/*try {*/
			   $createdPlan = $plan->create($apiContext);
		
			/*try {*/
				$patch = $paypal->Patch();
				$value = $paypal->PayPalModel('{"state":"ACTIVE"}');
		
				$patch->setOp('replace')
					->setPath('/')
					->setValue($value);
				$patchRequest = $paypal->PatchRequest();
				$patchRequest->addPatch($patch);
				$createdPlan->update($patchRequest, $apiContext);
				$patchedPlan = $plan->get($createdPlan->getId(), $apiContext);
				
				//require_once "createPHPTutorialSubscriptionAgreement.php";
				
				// Create new agreement
				$startDate = date('c', time() + 3600);
				$agreement = $paypal->Agreement();
				$agreement->setName($planName)
					->setDescription('LinkUp Mobile Subscription')
					->setStartDate($startDate);

				// Set plan id
				$plan = $paypal->Plan();
				$plan->setId($patchedPlan->getId());
				$agreement->setPlan($plan);

				// Add payer type
				$payer = $paypal->Payer();
				$payer->setPaymentMethod('paypal');
				$agreement->setPayer($payer);

				// Adding shipping details
				$shippingAddress = $paypal->ShippingAddress();
				$shippingAddress->setLine1($address)
					->setCity($city)
					->setState($city)
					->setPostalCode($zipcode)
					->setCountryCode('US');
				$agreement->setShippingAddress($shippingAddress);

				
				// Create agreement
				$agreement = $agreement->create($apiContext);

				// Extract approval URL to redirect user
				$approvalUrl = $agreement->getApprovalLink();

				//header("Location: " . $approvalUrl);
				locateexternalpage($approvalUrl);
				
			/*} catch (PayPal\Exception\PayPalConnectionException $ex) {
				echo $ex->getCode();
				echo $ex->getData();
				die($ex);
			} catch (Exception $ex) {
				die($ex);
			}
		} catch (PayPal\Exception\PayPalConnectionException $ex) {
			echo $ex->getCode();
			echo $ex->getData();
			die($ex);
		} catch (Exception $ex) {
			die($ex);
		}*/
		
	}

	public function paypalSubscriptionUpgrade($sku, $price, $position)
	{
		/*ini_set('display_errors', 1);
		ini_set('display_startup_errors', 1);
		error_reporting(E_ALL);*/
		
		/*echo "Hola0";*/
		ob_start();
		$plan_show = $_SESSION['plan_show'];
		$id_orderItem = $plan_show['id_orderItem'];
		$id_user = $plan_show['id_user'];
		$info = $_SESSION;
		/*echo $sku."-".$price;
		echo "<pre>";
		print_r($info['plans'][$position]);*/
		$data2 = [
			'id_orderItem' => $id_orderItem,			
			'sku' => $sku,
			'price' => $price,
			'position' => $position,			
		];
		//print("<pre>" . print_r($data2, true) . "</pre>");
		$upgrade= "upgrade";
		$todayDate = date('Y-m-d h:i:s');
		$newsku_plan = $this->skuPlansModel->getSKUPlansBySku($sku, 1);
		$new_sku = $newsku_plan['sku'];
		$planName = $newsku_plan['name'];
		$new_price = $newsku_plan['price'];
		$new_plan_id = $newsku_plan['plan_id'];
		$new_activation_sku = $newsku_plan['activation_sku'];
		$digital_variant_id = $newsku_plan['digital_variant_id'];
		$shopify_digitalproduct_id = $newsku_plan['shopify_digitalproduct_id'];
	
		//$planName = $info['plans'][$position]['plan_title'];
		$address = $info['plans'][$position]['address1'];
		$city = $info['plans'][$position]['city'];
		$zipcode = $info['plans'][$position]['zipcode'];
		//exit();
		$paypal = new Paypal();
		//$price = $plan_show['plan_price']-5;
		$apiContext = $paypal->context();
		//$exception = $paypal->PayPalConnectionException();
		$plan = $paypal->Plan();
		$plan->setName($planName)
			->setDescription('LinkUp Mobile Subscription')
			->setType('FIXED');

		// Set billing plan definitions
		$paymentDefinition = $paypal->PaymentDefinition();
		$currency = $paypal->Currency();
		$currency = array(
			'value' => $price,
			'currency' => 'USD'
		);

		$paymentDefinition->setName('Regular Payments')
		->setType('REGULAR')
		->setFrequency('MONTH')
		->setFrequencyInterval('1')
		->setCycles('12')
		->setAmount($currency);

		// Set charge models
		$chargeModel = $paypal->ChargeModel();
		$currency2 = array(
			'value' => $price,
			'currency' => 'USD'
		);
		$chargeModel->setType('SHIPPING')->setAmount($currency2);
		$paymentDefinition->setChargeModels(array(
			$chargeModel
		));

		// Set merchant preferences
		$merchantPreferences = $paypal->MerchantPreferences();
		$merchantPreferences->setReturnUrl('https://myaccount.linkupmobile.com/payment/paypalResponse/Success/' .$sku . '/' . $id_orderItem . '/' . $upgrade)
			->setCancelUrl('https://myaccount.linkupmobile.com/payment/paypalResponse/Cancel')
			->setAutoBillAmount('yes')
			->setInitialFailAmountAction('CONTINUE')
			->setMaxFailAttempts('0')
			->setSetupFee($currency2);

		$plan->setPaymentDefinitions(array(
			$paymentDefinition
		));
		$plan->setMerchantPreferences($merchantPreferences);

		/*try {*/
		$createdPlan = $plan->create($apiContext);

		/*try {*/
		$patch = $paypal->Patch();
		$value = $paypal->PayPalModel('{"state":"ACTIVE"}');

		$patch->setOp('replace')
		->setPath('/')
		->setValue($value);
		$patchRequest = $paypal->PatchRequest();
		$patchRequest->addPatch($patch);
		$createdPlan->update($patchRequest, $apiContext);
		$patchedPlan = $plan->get($createdPlan->getId(), $apiContext);

		//require_once "createPHPTutorialSubscriptionAgreement.php";

		// Create new agreement
		$startDate = date('c', time() + 3600);
		$agreement = $paypal->Agreement();
		$agreement->setName($planName)
			->setDescription('LinkUp Mobile Subscription')
			->setStartDate($startDate);

		// Set plan id
		$plan = $paypal->Plan();
		$plan->setId($patchedPlan->getId());
		$agreement->setPlan($plan);

		// Add payer type
		$payer = $paypal->Payer();
		$payer->setPaymentMethod('paypal');
		$agreement->setPayer($payer);

		// Adding shipping details
		$shippingAddress = $paypal->ShippingAddress();
		$shippingAddress->setLine1($address)
			->setCity($city)
			->setState($city)
			->setPostalCode($zipcode)
			->setCountryCode('US');
		$agreement->setShippingAddress($shippingAddress);


		// Create agreement
		$agreement = $agreement->create($apiContext);

		// Extract approval URL to redirect user
		$approvalUrl = $agreement->getApprovalLink();

		/***************************/
		$dataUpdate = [
			'id_orderItem' => $id_orderItem,
			'plan_id' => $new_plan_id,
			'sku' => $new_sku,
			'activation_sku' => $new_activation_sku,
			'name' => $planName,
			'price' => $new_price,
			'plan_upgrated' => 'Yes',
			'date_upgrated' => $todayDate,
		];
		$this->ordersItemsModel->updateOrderItemByItemId($dataUpdate);
		$orderItemPlan = $this->userModel->getPlanByUserAndOrderItem($id_user, $id_orderItem);
		$_SESSION['plan_show'] = $orderItemPlan[0];
		/***************************/

		//header("Location: " . $approvalUrl);
		locateexternalpage($approvalUrl);			
	
	}

	public function paypalAction($sku,$price,$position,$action)
	{
		/*ini_set('display_errors', 1);
		ini_set('display_startup_errors', 1);
		error_reporting(E_ALL);*/

		/*echo "Hola0";*/
		ob_start();
		$plan_show = $_SESSION['plan_show'];
		$id_orderItem = $plan_show['id_orderItem'];
		$id_user = $plan_show['id_user'];
		$info = $_SESSION;
		/*echo $sku."-".$price;
		echo "<pre>";
		print_r($info['plans'][$position]);*/
		$data2 = [
			'id_orderItem' => $id_orderItem,
			'sku' => $sku,
			'price' => $price,
			'position' => $position,
		];
		//print("<pre>" . print_r($data2, true) . "</pre>");
		$todayDate = date('Y-m-d h:i:s');
		$newsku_plan = $this->skuPlansModel->getSKUPlansBySku($sku, 1);
		$new_sku = $newsku_plan['sku'];
		$planName = $newsku_plan['name'];
		$new_price = $newsku_plan['price'];
		$new_plan_id = $newsku_plan['plan_id'];
		$new_activation_sku = $newsku_plan['activation_sku'];
		$digital_variant_id = $newsku_plan['digital_variant_id'];
		$shopify_digitalproduct_id = $newsku_plan['shopify_digitalproduct_id'];

		//$planName = $info['plans'][$position]['plan_title'];
		$address = $info['plans'][$position]['address1'];
		$city = $info['plans'][$position]['city'];
		$zipcode = $info['plans'][$position]['zipcode'];

		$description= "LinkUp Mobile "+ $action;
		//exit();
		$paypal = new Paypal();
		//$price = $plan_show['plan_price']-5;
		$apiContext = $paypal->context();
		//$exception = $paypal->PayPalConnectionException();
		$plan = $paypal->Plan();
		$plan->setName($planName)
		->setDescription($description)
		->setType('FIXED');

		// Set billing plan definitions
		$paymentDefinition = $paypal->PaymentDefinition();
		$currency = $paypal->Currency();
		$currency = array(
			'value' => $price,
			'currency' => 'USD'
		);

		$paymentDefinition->setName('Regular Payments')
		->setType('REGULAR')
		->setFrequency('MONTH')
		->setFrequencyInterval('1')
		->setCycles('12')
		->setAmount($currency);

		// Set charge models
		$chargeModel = $paypal->ChargeModel();
		$currency2 = array(
			'value' => $price,
			'currency' => 'USD'
		);
		$chargeModel->setType('SHIPPING')->setAmount($currency2);
		$paymentDefinition->setChargeModels(array(
			$chargeModel
		));

		// Set merchant preferences
		$merchantPreferences = $paypal->MerchantPreferences();
		$merchantPreferences->setReturnUrl('https://myaccount.linkupmobile.com/payment/paypalResponse/Success/' . $sku . '/' . $id_orderItem . '/' . $action)
		->setCancelUrl('https://myaccount.linkupmobile.com/payment/paypalResponse/Cancel')
		->setAutoBillAmount('yes')
		->setInitialFailAmountAction('CONTINUE')
		->setMaxFailAttempts('0')
		->setSetupFee($currency2);

		$plan->setPaymentDefinitions(array(
			$paymentDefinition
		));
		$plan->setMerchantPreferences($merchantPreferences);

		/*try {*/
		$createdPlan = $plan->create($apiContext);

		/*try {*/
		$patch = $paypal->Patch();
		$value = $paypal->PayPalModel('{"state":"ACTIVE"}');

		$patch->setOp('replace')
		->setPath('/')
		->setValue($value);
		$patchRequest = $paypal->PatchRequest();
		$patchRequest->addPatch($patch);
		$createdPlan->update($patchRequest, $apiContext);
		$patchedPlan = $plan->get($createdPlan->getId(), $apiContext);

		//require_once "createPHPTutorialSubscriptionAgreement.php";

		// Create new agreement
		$startDate = date('c', time() + 3600);
		$agreement = $paypal->Agreement();
		$agreement->setName($planName)
		->setDescription('LinkUp Mobile Subscription')
		->setStartDate($startDate);

		// Set plan id
		$plan = $paypal->Plan();
		$plan->setId($patchedPlan->getId());
		$agreement->setPlan($plan);

		// Add payer type
		$payer = $paypal->Payer();
		$payer->setPaymentMethod('paypal');
		$agreement->setPayer($payer);

		// Adding shipping details
		$shippingAddress = $paypal->ShippingAddress();
		$shippingAddress->setLine1($address)
		->setCity($city)
		->setState($city)
		->setPostalCode($zipcode)
		->setCountryCode('US');
		$agreement->setShippingAddress($shippingAddress);


		// Create agreement
		$agreement = $agreement->create($apiContext);

		// Extract approval URL to redirect user
		$approvalUrl = $agreement->getApprovalLink();

		if($action != "addon"){		
			/***************************/
			$dataUpdate = [
				'id_orderItem' => $id_orderItem,
				'plan_id' => $new_plan_id,
				'sku' => $new_sku,
				'activation_sku' => $new_activation_sku,
				'name' => $planName,
				'price' => $new_price,
				'plan_upgrated' => 'Yes',
				'date_upgrated' => $todayDate,
			];
			$this->ordersItemsModel->updateOrderItemByItemId($dataUpdate);
			$orderItemPlan = $this->userModel->getPlanByUserAndOrderItem($id_user, $id_orderItem);
			$_SESSION['plan_show'] = $orderItemPlan[0];
			/***************************/
		}

		//header("Location: " . $approvalUrl);
		locateexternalpage($approvalUrl);
	}

	public function add(){
		if($_SERVER['REQUEST_METHOD']=='POST'){
			//die('Submit');
			$_POST= filter_input_array(INPUT_POST,FILTER_SANITIZE_STRING);

				$data = [
						'title' =>trim($_POST['title']),
						'body' =>trim($_POST['body']),
						'user_id'=>$_SESSION['user_id'],
						'title_err'=>'',
						'body_err'=>'',
						'success'=>''
					];

				if(empty($data['title'])){
					$data['title_err'] = "Please enter a title";
				}

			if(empty($data['body'])){
					$data['body_err'] = "Please enter a body";
				}

			if(empty($data['title_err']) && empty($data['body_err'])){


					//Register process
					if($this->postModel->addPosts($data)){
						flash("post_message","Post Added");
						//redirect("posts");
						$data['success']="OK";
						echo json_encode($data);
					}else{
						die("something wrong");
					}
				}else{
					//$this->view('posts/add',$data);
					echo json_encode($data);
				}


		}else{
			$data = [
			'title' => '',
			'body' => '',
		];
		//$this->view('posts/add',$data);
			echo json_encode($data);
		}
	}

	public function show($id){
		$post = $this->postModel->getSinglePost($id);
		$user = $this->userModel->getUserByID($post->user_id);
		$data = [
			'post' => $post,
			'user' => $user

		];
		$this->view('posts/show',$data);
	}

	public function getedit($id){

			$post = $this->postModel->getSinglePost($id);


			if($post->user_id != $_SESSION['user_id']){
				redirect("posts");
				$permision = "NO";
			}

			$data = [
				'id'=> $id,
			'title' => $post->title,
			'body' => $post->body,
			'permision'=>$permision,
			'title_err'=>'',
			'body_err'=>''
		];
			echo json_encode($data);
		
	}

	public function edit($id){
		if($_SERVER['REQUEST_METHOD']=='POST'){
			//die('Submit');
			$_POST= filter_input_array(INPUT_POST,FILTER_SANITIZE_STRING);

				$data = [
						'id'=>$id,
						'title' =>trim($_POST['title']),
						'body' =>trim($_POST['body']),
						'user_id'=>$_SESSION['user_id'],
						'title_err'=>'',
						'body_err'=>'',
						'success'=>''
					];

				if(empty($data['title'])){
					$data['title_err'] = "Please enter a title";
				}

			if(empty($data['body'])){
					$data['body_err'] = "Please enter a body";
				}

			if(empty($data['title_err']) && empty($data['body_err'])){


					//Register process
					if($this->postModel->updatePosts($data)){
						flash("post_message","Post Updated");
						//redirect("posts");
						$data['success']="OK";
						echo json_encode($data);
					}else{
						die("something wrong");
					}
				}else{
					//$this->view('posts/add',$data);
					echo json_encode($data);
				}


		}else{

			$post = $this->postModel->getPostByID($id);

			if($post->user_id != $_SESSION['user_id']){
				redirect("posts");
			}


			$data = [
				'id'=> $id,
			'title' => $post->title,
			'body' => $post->body
		];
		//$this->view('posts/edit',$data);
			echo json_encode($data);
		}
	}

	public function delete($id){
		if($post = $this->postModel->deletePost($id)){
			flash("post_message","Post Removed");

			$data = [
				'success' => 'OK'
			];

		}else{
			flash("post_message","Something Wrong","Danger");

			$data = [
				'success' => ''
			];
		}
		echo json_encode($data);
	}

    public function processPayment(){
        if ($_SERVER['REQUEST_METHOD'] == 'POST'){

			if(!isset($_POST["formCardNumber"]) || empty($_POST["formCardNumber"])) {

				echo json_encode(["message" => "Fields are required"]);

			} else {
				$result = $this->paymentModel->proccessAuthorizeNetPayment($_POST);
				echo json_encode($result);
				// require_once APPROOT . '/libraries/authorizenet/authorize-net-payment.php';
				// echo json_encode(["post" => $_POST]);
			}
            // // User card information data received via form submit
            // $cc_number = $_POST['cc_number'];
            // $cc_exp_month = $_POST['cc_exp_month'];
            // $cc_exp_year = $_POST['cc_exp_year'];
            // $cc_exp_year_month = $cc_exp_year.'-'.$cc_exp_month;
            // $cvc_code = $_POST['cvc_code'];
            // $amount = $_POST['amount'];
            // if(empty($cc_number) || empty($cc_exp_month) || empty($cc_exp_year) || empty($cvc_code) ){
            //     $status = "<li>Error: Please enter all required fields!</li>";
            // }else{
            //     require_once 'authorize-net-payment.php';
            // }


            // require APPROOT . '/libraries/inc/header.php';
        } else {
            echo "Method not allowed";
        }
    }

	public function upgradePayment($new_sku = '', $id_orderItem = '')
	{
		/*if ($_SERVER['REQUEST_METHOD'] == 'POST') {
			$new_sku = $_POST['newsku'];
			$old_sku = $_POST['sku'];
			$id_order = $_POST['id_order'];
			$id_orderItem = $_POST['id_orderItem'];*/

		$user_id = $_SESSION['user_id'];	

		/*********************************************/
		/*Get the sku info with the new product_id*/
		$newsku_plan = $this->skuPlansModel->getSKUPlansBySku($new_sku, 0);
		$newsku_plan['orderItemID'] = $id_orderItem;
		$orderItemPlan = $this->userModel->getPlanByUserAndOrderItem($user_id,$id_orderItem); // $data['id']
		//$_SESSION['plan_upgrade'] = $orderItemPlan[0];
		$this->view('payment/upgradepayment', $newsku_plan);

	}
	public function upgradeBySubscription($new_sku = '', $id_orderItem = '')
	{
		$user_id = $_SESSION['user_id'];
		/*********************************************/
		/*Get the sku info with the new product_id*/
		$newsku_plan = $this->skuPlansModel->getSKUPlansBySku($new_sku, 1);
		$newsku_plan['orderItemID'] = $id_orderItem;
		//$orderItemPlan = $this->userModel->getPlanByUserAndOrderItem($_SESSION['user_id'], $id_orderItem); // $data['id']
		//$plansGet = $this->userModel->getPlansByUserONcustomerId($_SESSION['user_id']); // $data['id']
		//$_SESSION['plans'] = $plansGet;
		//$_SESSION['plan_show'] = $newsku_plan;
		$this->view('payment/upgradebysubscription', $newsku_plan);
		
	}
	public function addonPayment($new_sku = '', $id_orderItem = '')
	{
		$user_id = $_SESSION['user_id'];
		/*********************************************/
		/*Get the sku info with the new product_id*/
		$newsku_plan = $this->skuPlansModel->getSKUPlansBySku($new_sku,1);
		$newsku_plan['orderItemID'] = $id_orderItem;
		$this->view('payment/addonpayment', $newsku_plan);
	}

}
