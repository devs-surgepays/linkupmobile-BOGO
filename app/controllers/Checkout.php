<?php
/* ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL); */
class Checkout extends Controller
{
	private $db;
	//public $landerModel = '';
	//public $plansModel = '';
	public $ordersModel;

	public function __construct()
	{
		$this->db = new Database;
		$this->ordersModel = $this->model('Order');
		//$this->plansModel = $this->model('Plan');		
		//$this->landerModel = $this->model('Lander');
	}

	public function index()
	{

		if ($_SERVER['REQUEST_METHOD'] == 'POST') {

			$plan_id = isset($_POST['plan_id']) ? $_POST['plan_id'] : null;
			$lines = isset($_POST['selectLine']) ? $_POST['selectLine'] : 1;
			$c_id = isset($_POST['c_id']) ? $_POST['c_id'] : null;
			$order_id = (!empty($c_id)) ? encrypt_decrypt('decrypt', $c_id) : null;
			

			$infoPlans = [
				'LMP100' => [
					'plan_id'     => 'LMP100',
					'name'        => 'Premium',
					'description' => '$90* for three months&nbsp;of&nbsp;service ',
					'spec'        => [
						'minutes' => '5G National Coverage',
						'sms'     => 'Unlimited SMS',
						'hotspot' => false,
					],
					'price'       => 30, // USD
					'promo_price' => 90, 
					'data'        => '12 GB',
					'custom_spec' => [
						'activation_fee'   => 0,
						'contract'         => 'No contract',
						'international'    => 'Not included',
						'extra_notes'      => 'Best for low data usage',
					],
				],
				'LMP200' => [
					'plan_id'     => 'LMP200',
					'name'        => 'Unlimited',
					'description' => '$120* for three months&nbsp;of&nbsp;service',
					'spec'        => [
						'minutes' => 'Unlimited nationwide minutes',
						'sms'     => 'Unlimited SMS',
						'hotspot' => true,
					],
					'price'       => 40,
					'promo_price' => 120,
					'data'        => '30 GB',
					'custom_spec' => [
						'activation_fee'   => 0,
						'contract'         => 'Month-to-month',
						'international'    => 'Includes calls to MX & CA',
						'extra_notes'      => 'Good for mixed voice & data usage',
					],
				],
				'LMP300' => [
					'plan_id'     => 'LMP300',
					'name'        => 'UnlimitedPlus',
					'description' => '$150* for three months&nbsp;of&nbsp;service ',
					'spec'        => [
						'minutes' => '5G National Coverage',
						'sms'     => 'Unlimited SMS',
						'hotspot' => true,
					],
					'price'       => 50,
					'promo_price' => 150,
					'data'        => 'UNLIMITED',
					'custom_spec' => [
						'activation_fee'   => 15,
						'contract'         => 'Month-to-month',
						'international'    => 'Includes roaming in MX & CA',
						'extra_notes'      => 'Recommended for streaming & tethering',
					],
				],
			];

			$data = [];
			/* $data = [
				'customerIdPlan' => $_POST['customerIdPlan'],
				'IdPlan' => $_POST['IdPlanSelected'],
				'saInformation' => $_POST['saInformation'],
				'logo' => '/img/UsaSnap15_logo.png',
				'urlRedirect' => $_SERVER['SCRIPT_URI'],
				'css' => '/css/lifeline_form.css',
				'url' =>  $_SERVER['SCRIPT_URI'],
				'program' => "lifeline",
				'source' => "AMBT",
				'origin' => "USASNAP"
			]; */

			if (!empty($c_id)) {

				$data = $this->ordersModel->getOrderInformation($order_id);
							

				 /*$data = array_merge($data, [
					"apikey" => "U3VyZ2VwYXlzMjQ6VyEybTZASnk4QVFk",
					'customer_id' => $c_data['customer_id'] ?? '',
					'first_name' => $c_data['first_name'] ?? '',
					'second_name' => $c_data['second_name'] ?? '',
					'middle_name' => $c_data['middle_name'] ?? '',
					'suffix' => $c_data['suffix'] ?? '',
					'dob' => $c_data['dob'] ?? '',
					'phone' => $c_data['phone_number'] ?? '',
					'email' => $c_data['email'] ?? '',
					'program_benefit' => $c_data['program_benefit'] ?? '',
					'program_before' => $c_data['program_before'] ?? '',
					'medicalSubscriberId' => $c_data['medicalSubscriberId'] ?? '',
					'tribal_id' => $c_data['tribal_id'] ?? '',
					'ssn' => $c_data['ssn'] ?? '',
					'zipcode' => $c_data['zipcode'] ?? '',
					'street_address1' => $c_data['address1'] ?? '',
					'address2' => $c_data['address2'] ?? '',
					'locality' => $c_data['city'] ?? '',
					'state' => $c_data['state'] ?? '',
					'shipping_address1' => $c_data['shipping_address1'] ?? '',
					'shipping_address2' => $c_data['shipping_address2'] ?? '',
					'shipping_city' => $c_data['shipping_city'] ?? '',
					'shipping_state' => $c_data['shipping_state'] ?? '',
					'shipping_zipcode' => $c_data['shipping_zipcode'] ?? '',
					'source' => $c_data['source'] ?? '',
					'company' => $c_data['company'] ?? '',
					'current_benefits' => $c_data['current_benefits'] ?? '',
					'phone_type' => $c_data['phone_type'] ?? '',
					'agree_terms' => $c_data['agree_terms'] ?? '',
					'agree_sms' => $c_data['agree_sms'] ?? '',
					'agree_email' => $c_data['agree_email'] ?? '',
					'transferconsent' => $c_data['transferconsent'] ?? '',
					'agree_pii' => $c_data['agree_pii'] ?? '',
					'utm_source' => $c_data['utm_source'] ?? '',
					'utm_medium' => $c_data['utm_medium'] ?? '',
					'utm_campaign' => $c_data['utm_campaign'] ?? '',
					'utm_content' => $c_data['utm_content'] ?? '',
					'match_type' => $c_data['match_type'] ?? '',
					'utm_adgroup' => $c_data['utm_adgroup'] ?? '',
					'sw' => $c_data['sw'] ?? '',
					'url' => $c_data['url'] ?? '',
					'anotheradultdiscount' => $c_data['anotheradultdiscount'] ?? '',
					'anotheradultshareincome' => $c_data['anotheradultshareincome'] ?? '',
					'shareincome' => $c_data['shareincome'] ?? '',
					'signingPowerAttorney' => $c_data['signingPowerAttorney'] ?? '',
					'number_of_lines' => $c_data['number_of_lines'] ?? '',
					'pob_name' => $pob_doc['filename']
				]); */
				
				/* $idPlan = $data['IdPlan'] ?? null;
				$lines  = $c_data['number_of_lines'] ?? 0; */

				if ($plan_id && isset($infoPlans[$plan_id])) {

					$plan     = $infoPlans[$plan_id];
					
					$basePrice = $plan['promo_price'] ?? 0;
					$unitPrice = $plan['price'] ?? 0;

					// Calculate subtotal per lines if SIM has cost
					$subtotal = $basePrice * $lines;

					// Final price logic
					/* $price = ($shipping > 0 || $sim > 0)
						? ($shipping + $subtotal)
						: $basePrice; */

					$totalPrice = $subtotal;

				} else {
					$price = 0;
					$totalPrice = 0;
				}
				
				$data_address = [

					'price' => $totalPrice,

					'street_address1' => $data['address1'],

					'address2' => $data['address2'],

					'locality' => $data['city'],

					'state' => $data['state'],

					'zipcode' => $data['zipcode'],

				];
				

				/*Calculate the tax*/
				$tax_rate = taxtCalculation($data_address);				
				if ($tax_rate['TotalTax'] > 0){
					$totalPriceWTaxes = $totalPrice + $tax_rate['TotalTax'];
				}else{
					$totalPriceWTaxes = $totalPrice;
				}
				
			}
			$data['IdPlan'] = $plan_id;
			$data['number_of_lines'] = $lines;
			$data['infoPlan'] = $infoPlans[$plan_id]; // Get information Plan
			$data['infoTax'] = $tax_rate ?? []; // Get tax rate
			$data['total'] = $totalPriceWTaxes ?? [];
			$this->view('checkout/index', $data);
			
		} else {

			$utm_source = isset($_GET['utm_source']) ? $_GET['utm_source'] : null;
			$utm_medium = isset($_GET['utm_medium']) ? $_GET['utm_medium'] : null;
			$utm_campaign = isset($_GET['utm_campaign']) ? $_GET['utm_campaign'] : null;
			$utm_content = isset($_GET['utm_content']) ? $_GET['utm_content'] : null;
			$match_type = isset($_GET['match_type']) ? $_GET['match_type'] : null;
			$utm_adgroup = isset($_GET['utm_adgroup']) ? $_GET['utm_adgroup'] : null;

			$data = [
				'title' => "Welcome to Lifeline",
				'description' => "Lorem Ipsum",
				'logo' => '/img/UsaSnap15_logo.png',
				'css' => '/css/lifeline_form.css',
				'url' => "https://$_SERVER[HTTP_HOST]$_SERVER[PHP_SELF]",
				'source' => "usaphone",
				'origin' => "domain_name",
				'program' => "lifeline",
				'utm_source' => $utm_source,
				'utm_medium' => $utm_medium,
				'utm_campaign' => $utm_campaign,
				'utm_content' => $utm_content,
				'match_type' => $match_type,
				'utm_adgroup' => $utm_adgroup
			];

			//print_r($data);
			
			$this->view('pages/indexpayment');
		}
	}
	public function test($type = '', $plan = '', $zipcode = '', $qty = '', $sim = '')
	{

		$data = [
			'title' => "Welcome to SharePosts",
			'description' => "Lorem Ipsum",
			'logo' => 'https://torchwireless.com/wp-content/uploads/2022/06/Torch_Wireless-3-01-2.png',
			'url' => "https://$_SERVER[HTTP_HOST]$_SERVER[PHP_SELF]",
			'source' => "usaphone",
			'origin' => "usaphone",
		];
		if ($plan != "") {
			$plan_detail = $this->plansModel->getPlanDetail($plan, $type);
			//array_push($plan_detail, $zipcode);
			//array_push($plan_detail, $qty);
			$plan_detail['zipcode'] = $zipcode;
			$plan_detail['qty'] = $qty;
			$plan_detail['sim'] = $sim;
			$this->view('checkout/index2', $plan_detail);
		} else {
			$this->view('checkout/index2', $data);
		}
	}
	public function saveApiLog($customer_id, $url, $request, $response, $title)
	{
		$data = [
			"customer_id" => $customer_id,
			"url" => $url,
			"request" => $request,
			"response" => $response,
			"title" => $title
		];
		$this->db->insertQuery("c1_surgephone.agent_acp_apis_log", $data);
	}

	public function createOrder()
	{
		if ($_SERVER['REQUEST_METHOD'] == 'POST') {
			$_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
			$today = date('Y-m-d H:i:s');
			$customer_id = $this->ordersModel->createCustomerId();

			$orderData = [

				'customer_id' => $customer_id,

				'first_name' => $_POST['first_name'],

				'second_name' => $_POST['last_name'],

				'phone_number' => $_POST['phone'],

				'email' => $_POST['email'],

				'address1' => $_POST['address1'],

				'address2' => $_POST['address2'],

				'city' => $_POST['city'],

				'state' => $_POST['state'],

				'zipcode' => $_POST['zipcode'],

				'date_create' => $today,

				'order_step' => $_POST['order_step'],

				'sim' => $_POST['sim_type'],

			];

			if (!empty($_POST['first_name']) && !empty($_POST['email'])) {

				//print_r($orderData);
				//$row = $this->db->insertQuery("linkupmobile_plans.orders", $orderData);
				//print_r($row);
				//exit();
				if ($this->ordersModel->createOrder($orderData)) {

					$response = array(
						'response' => 'OK',
						'customer_id' => $customer_id,
					);
				} else {
					$response = array(
						'response' => 'Error'
					);
				}
			} else {
				$response = array(
					'response' => 'Missing Information'
				);
			}
			//print_r($response);	
			echo json_encode($response);
		}
	}

	public function updateOrder()
	{
		if ($_SERVER['REQUEST_METHOD'] == 'POST') {
			$_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
			$today = date('Y-m-d H:i:s');
			$customer_id = $_POST['customer_id'];

			$orderData = [

				'customer_id' => $customer_id,

				'agree_terms' => $_POST['agree_terms'],

				'pay_message' => $_POST['pay_message'],

				'pay_authcode' => $_POST['pay_authcode'],

				'pay_transid' => $_POST['pay_transid'],

				'pay_accountnumber' => $_POST['pay_accountnumber'],

				'pay_accounttype' => $_POST['pay_accounttype'],

				'pay_transmessage' => $_POST['pay_transmessage'],

				'payment_method' => $_POST['payment_method'],

				'zipcode' => $_POST['zipcode'],

				'updated_at' => $today

			];
			if (empty($data['customer_id'])) {

				$response = array(
					'response' => 'OK',
					'customer_id' => $_POST['customer_id'],
				);

				/*if ($this->db->insertQuery("linkupmobile_plans.orders", $orderData)) {
					$order = $this->recordsModel->getOrder($customer_id);
					$response = array(
						'response' => 'OK',
						'customer_id' => $order['customer_id'],
					);
				} else {
					$response = array(
						'response' => 'Error\r: Please try again',
					);
					die("something wrong");
				}*/
			}

			echo json_encode($response);
		}
	}
}
