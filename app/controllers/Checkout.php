<?php
/* ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);  */
class Checkout extends Controller
{
	private $db;
	public $orderModel;
	public $logModel;

	public function __construct()
	{
		$this->db = new Database;
		$this->orderModel = $this->model('Order');
		$this->logModel = $this->model('Log');
	}

	public function index($lang = NULL)
	{
		$defaultPlan = 'BOGO30';
		$lang = $lang ? $lang : 'en';

		$data = [

			'en' => [
				'title' => "BOGO PROMO",
				'description' => "Lorem Ipsum",
				'logo' => '/img/UsaSnap15_logo.png',
				'css' => '/css/lifeline_form.css',
				'url' => "https://$_SERVER[HTTP_HOST]$_SERVER[PHP_SELF]",
				'source' => "BOGO30landing",
				'origin' => "domain_name",
				'program' => "",
				

				'lang' => 'en',
				'title' => 'Welcome to LinkUp Mobile',
				'main_title' => '2X EVERYTHING',
				'blue_heading_1' => '2X&nbsp;THE&nbsp;COVERAGE. 2X&nbsp;THE&nbsp;DATA. 2X&nbsp;THE&nbsp;VALUE',
				'main_description' => '<span>Activate your line</span> with this <span>limited-time offer</span> and your second month is completely free! Don&apos;t miss out, get started&nbsp;today.',

				// Offer Countdown 
				'offer_msg' => 'OFFER ENDS SOON!',
				'offer_day' => 'DAYS',
				'offer_minutes' => 'MINUTES',
				'offer_hours' => 'HOURS',
				'offer_seconds' => 'SECONDS',
				// Promo Details Section
				'promo_bubble_text' => 'BUY 1 MONTH, <br> GET 1 MONTH FREE',
				'promo_bubble_text_2' => 'UNLIMITED TALK & TEXT + <br> ROAMING TO & WITHIN MEXICO',
				'promo_perks_description' => 'With your LinkUp data plan you get <span>additional perks</span> such as <span>unlimited talk & text</span> as well as roaming included to and within&nbsp;Mexico',

				//Form 
				'form_title'=> 'Service Address',
				'first_name_label' => 'First Name',
				'last_name_label' => 'Last Name',
				'email_label' => 'Email Address',
				'street_label' => 'Street Address',
				'state_label' => 'State',
				'city_label' => 'City',
				'zipcode_label' => 'Zip Code',
				'phone_label' => 'Phone',
				'billingcheck_label' => 'I have a different mailing address. <small>(Only fill this out if your shipping address is different from your physical&nbsp;address.) </small>',
				'billing_street_label' => 'Billing Street Address',
				'billing_street2_label' => 'Billing Apartment # or Suite #',
				'billing_city_label' => 'Billing City',
				'billing_state_label' => 'Billing State',
				'billing_zipcode_label' => 'Billing Zip Code',

				//OrderReview
				'cart_title' => 'Order Review',
				'cart_number' => '1 item in cart',
				'summary_title' => 'Billing Summary',
				'summary_subtotal' => 'Subtotal',
				'summary_discount' => 'Discount',
				'summary_tax' => 'Tax',
				'summary_shipping' => 'Shipping',
				'summary_total' => 'Grand total',
				'summary_pending' => 'Pending Service Address Section',
				'summary_pending_msg' => 'Enter your Billing Address to calculate taxes and display the Grand Total.',
				'summary_comment_label' => 'Order Comment',
				'summary_comment_placeholder' => 'Type here...',
				'summary_terms_label' => 'I acknowledge LinkUp Mobile’s',
				'summary_privacy' => 'Privacy Policy',
				'summary_terms' => 'Terms Policy',
				'summary_pays_label' => 'Pay'

			],
			'es' => [
				'title' => "BOGO PROMO",
				'description' => "Lorem Ipsum",
				'logo' => '/img/UsaSnap15_logo.png',
				'css' => '/css/lifeline_form.css',
				'url' => "https://$_SERVER[HTTP_HOST]$_SERVER[PHP_SELF]",
				'source' => "BOGO30landing",
				'origin' => "domain_name",
				'program' => "",				
				'lang' => 'es',
				'title' => 'Bienvenido a LinkUp Mobile',
				'main_title' => 'DUPLICA TU PLAN',
				'blue_heading_1' => 'DOBLE&nbsp;COBERTURA. DOBLE&nbsp;DE&nbsp;DATOS. DOBLE&nbsp;VALOR',
				'main_description' => '<span>Activa una linea</span> con esta oferta por <span>tiempo limitado</span> y disfruta del segundo mes completamente gratis. ¡No te la pierdas, empieza hoy&nbsp;mismo!',

				// Offer Countdown 
				'offer_msg' => '¡LA OFERTA TERMINA PRONTO!',
				'offer_day' => 'DIAS',
				'offer_minutes' => 'MINUTOS',
				'offer_hours' => 'HORAS',
				'offer_seconds' => 'SEGUNDOS',
				// Promo Details Section
				'promo_bubble_text' => 'COMPRA 1 MES, <br> TE REGALAMOS 1 MES',
				'promo_bubble_text_2' => 'LLAMADAS Y TEXTOS ILIMITADOS + <br> ROAMING HACIA Y DENTRO DE MEXICO',
				'promo_perks_description' => 'Con tu plan de datos LinkUp obtienes <span>beneficios adicionales</span> como <span>llamadas y mensajes de texto ilimitados</span>, así como roaming incluido hacia y dentro de México.',

				//Form 
				'form_title' => 'Dirección de servicio',
				'first_name_label' => 'Primer Nombre',
				'last_name_label' => 'Apellido',
				'email_label' => 'Correo Electrónico',
				'street_label' => 'Dirección',
				'state_label' => 'Estado',
				'city_label' => 'Ciudad',
				'zipcode_label' => 'Código postal',
				'phone_label' => 'Teléfono',
				'billingcheck_label' => 'Mi dirección de facturación y envío son las mismas.',
				'billing_street_label' => 'Dirección de facturación',
				'billing_street2_label' => '# de Apartamento',
				'billing_city_label' => 'Ciudad de facturación',
				'billing_state_label' => 'Estado de facturación',
				'billing_zipcode_label' => 'Código postal de facturación',

				//OrderReview
				'cart_title' => 'Revisión de pedido',
				'cart_number' => '1 artículo en el carrito',
				'summary_title' => 'Resumen de facturación',
				'summary_subtotal' => 'Total parcial',
				'summary_discount' => 'Descuento',
				'summary_tax' => 'Impuesto',
				'summary_shipping' => 'Envío',
				'summary_total' => 'Gran total',
				'summary_pending' => 'Sección de dirección pendiente',
				'summary_pending_msg' => 'Tengo una dirección postal diferente. (Complete este campo solo si su dirección de facturación es diferente a su dirección física).',
				'summary_comment_label' => 'Comentario del pedido',
				'summary_comment_placeholder' => 'Escribe aqui...',
				'summary_terms_label' => 'Reconozco la responsabilidad de LinkUp Mobile’s ',
				'summary_privacy' => 'Política de Privacidad',
				'summary_terms' => 'Términos y Condiciones',
				'summary_pays_label' => 'Pagar'

			]

		];


		if ($_SERVER['REQUEST_METHOD'] == 'POST') {

			$tid = isset($_POST['tid']) ? $_POST['tid'] : '';
			$plan_id = isset($_POST['plan_id']) ? $_POST['plan_id'] : $defaultPlan;
			$imei = isset($_POST['imei']) ? $_POST['imei'] : '';
			$lines = isset($_POST['selectLine']) ? $_POST['selectLine'] : 1;
			$infoPlans = $this->getPlanInfo($plan_id);

			//$price_data = $this->calculatePlanPriceWithTax();
			$utm_source = isset($_GET['utm_source']) ? $_GET['utm_source'] : null;
			$utm_medium = isset($_GET['utm_medium']) ? $_GET['utm_medium'] : null;
			$utm_campaign = isset($_GET['utm_campaign']) ? $_GET['utm_campaign'] : null;
			$utm_content = isset($_GET['utm_content']) ? $_GET['utm_content'] : null;
			$match_type = isset($_GET['match_type']) ? $_GET['match_type'] : null;
			$utm_adgroup = isset($_GET['utm_adgroup']) ? $_GET['utm_adgroup'] : null;
			
			$data_post = [
				'utm_source' => $utm_source,
				'utm_medium' => $utm_medium,
				'utm_campaign' => $utm_campaign,
				'utm_content' => $utm_content,
				'match_type' => $match_type,
				'utm_adgroup' => $utm_adgroup,
				'imei' => $imei,
				'tid' => $tid,
				'imei' => $imei,
				'IdPlan' => $plan_id,
				'number_of_lines' => $lines ?? 1,
				'infoPlan' => $infoPlans, // Get information Plan
				'infoTax' => isset($tax_rate) ? $tax_rate : [], // Get tax rate
				'total' => isset($totalPriceWTaxes) ? $totalPriceWTaxes : [],
			];

			$data['en'] = array_merge($data['en'], $data_post);
			$data['es'] = array_merge($data['es'], $data_post);
			//print_r($data_post);

			//$this->view('checkout/index', $data[$lang]);
			
		} else {

			$infoPlans = $this->getPlanInfo($defaultPlan);
			//$price_data = $this->calculatePlanPriceWithTax();
			$utm_source = isset($_GET['utm_source']) ? $_GET['utm_source'] : null;
			$utm_medium = isset($_GET['utm_medium']) ? $_GET['utm_medium'] : null;
			$utm_campaign = isset($_GET['utm_campaign']) ? $_GET['utm_campaign'] : null;
			$utm_content = isset($_GET['utm_content']) ? $_GET['utm_content'] : null;
			$match_type = isset($_GET['match_type']) ? $_GET['match_type'] : null;
			$utm_adgroup = isset($_GET['utm_adgroup']) ? $_GET['utm_adgroup'] : null;

			$data_post = [
				'title' => "BOGO PROMO",
				'description' => "Lorem Ipsum",
				'logo' => '/img/UsaSnap15_logo.png',
				'css' => '/css/lifeline_form.css',
				'url' => "https://$_SERVER[HTTP_HOST]$_SERVER[PHP_SELF]",
				'source' => "bogo30landing",
				'origin' => "domain_name",
				'program' => "",
				'utm_source' => $utm_source,
				'utm_medium' => $utm_medium,
				'utm_campaign' => $utm_campaign,
				'utm_content' => $utm_content,
				'match_type' => $match_type,
				'utm_adgroup' => $utm_adgroup,
				'IdPlan' => $defaultPlan,
				'number_of_lines' => $lines ?? 1,
				'infoPlan' => $infoPlans, // Get information Plan
				'infoTax' => isset($tax_rate) ? $tax_rate : [], // Get tax rate
				'total' => isset($totalPriceWTaxes) ? $totalPriceWTaxes : [],
			];


			$data['en'] = array_merge($data['en'], $data_post);
			$data['es'] = array_merge($data['es'], $data_post);
			//print_r($data_post);	

			//print_r($data);

			
		}
		$this->view('checkout/index', $data[$lang]);
	}

	public function indexTEst()
	{
		$defaultPlan = 'BOGO30';

		if ($_SERVER['REQUEST_METHOD'] == 'POST') {

			$plan_id = isset($_POST['plan_id']) ? $_POST['plan_id'] : $defaultPlan;
			$infoPlans = $this->getPlanInfo($plan_id);

			$lines = isset($_POST['selectLine']) ? $_POST['selectLine'] : 1;
			$c_id = isset($_POST['c_id']) ? $_POST['c_id'] : null;
			$order_id = isset($_POST['order_id']) ? $_POST['order_id'] : null;

			/*Create Order ID*/
			/*******************************/
			if (!empty($order_id)) {
				$actionDatabase = 'updateOrder';
			} else {
				$actionDatabase = 'addOrder';
				$order_id = $this->orderModel->createOrderId();
				$data['order_id'] = $order_id;
			}
			$this->logModel->putLog("OrderID: " . json_encode($order_id, true));

			$data = [];

			if (!empty($c_id)) {

				$data = $this->orderModel->getOrderInformation($order_id);


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
				$addressData = [

					'street_address1' => $data['address1'],

					'address2' => $data['address2'],

					'locality' => $data['city'],

					'state' => $data['state'],

					'zipcode' => $data['zipcode'],

				];
			}
			$pricing = $this->calculatePlanPriceWithTax($plan_id, $infoPlans, $lines, $addressData);
			//echo $pricing['price'];
			//echo $pricing['total_with_taxes'];
			//echo $pricing['tax_rate'];

			$data['IdPlan'] = $plan_id;
			$data['number_of_lines'] = $lines;
			$data['infoPlan'] = $infoPlans[$plan_id]; // Get information Plan
			$data['infoTax'] = $tax_rate ?? []; // Get tax rate
			$data['total'] = $totalPriceWTaxes ?? [];

			$this->view('checkout/index', $data);
		} else {

			$infoPlans = $this->getPlanInfo($defaultPlan);

			//$price_data = $this->calculatePlanPriceWithTax();

			$utm_source = isset($_GET['utm_source']) ? $_GET['utm_source'] : null;
			$utm_medium = isset($_GET['utm_medium']) ? $_GET['utm_medium'] : null;
			$utm_campaign = isset($_GET['utm_campaign']) ? $_GET['utm_campaign'] : null;
			$utm_content = isset($_GET['utm_content']) ? $_GET['utm_content'] : null;
			$match_type = isset($_GET['match_type']) ? $_GET['match_type'] : null;
			$utm_adgroup = isset($_GET['utm_adgroup']) ? $_GET['utm_adgroup'] : null;

			$data = [
				'title' => "BOGO PROMO",
				'description' => "Lorem Ipsum",
				'logo' => '/img/UsaSnap15_logo.png',
				'css' => '/css/lifeline_form.css',
				'url' => "https://$_SERVER[HTTP_HOST]$_SERVER[PHP_SELF]",
				'source' => "bogo30landing",
				'origin' => "domain_name",
				'program' => "",
				'utm_source' => $utm_source,
				'utm_medium' => $utm_medium,
				'utm_campaign' => $utm_campaign,
				'utm_content' => $utm_content,
				'match_type' => $match_type,
				'utm_adgroup' => $utm_adgroup
			];
			$data['encryption_key'] = CARD_ENCRYPTION_KEY;
			$data['IdPlan'] = $defaultPlan;
			$data['number_of_lines'] = $lines ?? 1;
			$data['infoPlan'] = $infoPlans; // Get information Plan
			$data['infoTax'] = $tax_rate ?? []; // Get tax rate
			$data['total'] = $totalPriceWTaxes ?? [];

			//print_r($data);

			$this->view('checkout/index', $data);
		}
	}
	
	public function getPlanInfo($plan_name = null)
	{
		if(isset($plan_name) && !empty($plan_name)){
	
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
				'BOGO30' => [
					'plan_id'     => 'BOGO30',
					'name'        => 'BOGO - Premium Plan',
					'description' => '12 GB eSIM + 1 FREE MONTH',
					'image'       => '/img/BOGOeSIM_plan.png',
					'spec'        => [
						'minutes' => '',
						'sms'     => '',
						'hotspot' => '',
					],
					'price'       => 60,
					'promo_price' => 30,
					'shipping' => 0,
					'sim_fee' => 0,
					'data'        => '12 GB',
					'custom_spec' => [
						'activation_fee'   => 0,
						'contract'         => '',
						'international'    => '',
						'extra_notes'      => '',
					],					
					'sim' => 'eSIM',
					'autopay' => false,
				],
			];

		} else {
			$infoPlans = [];
		}
		return isset($infoPlans[$plan_name]) ? $infoPlans[$plan_name] : null;
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


	public function calculatePlanPriceWithTax()
	{
		//$raw = file_get_contents("php://input");
		$raw= '{"plan_id":"BOGO30","infloPlan":"BOGO - Premium Plan","number_of_lines":"1","address1":"2126 Sun Swept way","address2":"","city":"Las Vegas","state":"NV","zipcode":"89074"}';
		$arrayPost = json_decode($raw, true);
		$logfile = "log_" . date('Y-m-d') . ".txt";
		$log = new Logger($logfile);
		$log->setTimestamp("Y-m-d h:i:s");
		$log->putLog("Rawdata: " . $raw, true);
		//$this->checkAuthentication($arrayPost['apikey']);

		$result = [
			'subtotal' => 0.0,
			'shipping' => 0.0,
			'sim_fee' => 0.0,
			'tax' => 0.0,
			'total_with_taxes' => 0.0,
			'address' => [],
			'lines' => 0,
			'plan_id' => $arrayPost['plan_id'] ?? null,
		];

		$infoPlans = $this->getPlanInfo($arrayPost['plan_id']);
		$log->putLog("Plan Info: " . json_encode($infoPlans, true));
		

		// normalize plan input: accept either a single plan or an array keyed by plan_id
		if (isset($infoPlans) && !empty($infoPlans)) {
			$plan = $infoPlans;			
			
		} else {
			// invalid plan
			echo json_encode($result);
		}

		// normalize numeric inputs
		$lines = max(1, (int)$arrayPost['number_of_lines']);
		$basePrice = isset($plan['price']) && (float)$plan['price'] > 0
			? (float)$plan['price']
			: (float)($plan['promo_price'] ?? 0.0);
		$promoPrice = isset($plan['promo_price']) && (float)$plan['promo_price'] > 0
			? (float)$plan['promo_price']
			: (float)($plan['price'] ?? 0.0);

		$shipping = (float)($plan['shipping'] ?? 0.0);
		$sim_fee = (float)($plan['sim_fee'] ?? $plan['sim'] ?? 0.0);

		// normalize address keys (accept both address1/street_address1 and city/locality)
		$addr = [
			'address1' => isset($arrayPost['address1']) ? $arrayPost['address1'] : '',
			'address2' => isset($arrayPost['address2']) ? $arrayPost['address2'] : '',
			'city'     => isset($arrayPost['city']) ? $arrayPost['city'] : '',
			'state'    => isset($arrayPost['state']) ? $arrayPost['state'] : '',
			'zipcode'  => isset($arrayPost['zipcode']) ? $arrayPost['zipcode'] : (isset($arrayPost['postal_code']) ? $arrayPost['postal_code'] : '')
		];
		$log->putLog("Address: " . json_encode($addr, true));

		// compute subtotal & totals
		$subtotal = $basePrice * $lines;

		// compute subtotal & totals
		$subtotalDiscount = $promoPrice * $lines;
		
		$discount = isset($plan['promo_price']) ? (float)$plan['price'] - (float)$plan['promo_price'] : 0.0;
		$totalPrice = $subtotalDiscount + $shipping + $sim_fee;

		// tax calculation (call external helper safely)
		$taxAmount = 0.0;
		try {
			if (!empty($addr['zipcode']) && !empty($addr['state'])) {
				// taxtCalculation is expected to accept an array with price & address fields
				$taxPayload = [
					'price' => $totalPrice,
					'street_address1' => $addr['address1'],
					'address2' => $addr['address2'],
					'locality' => $addr['city'],
					'state' => $addr['state'],
					'zipcode' => $addr['zipcode'],
				];
				$taxData = taxtCalculation($taxPayload);
				$log->putLog("Tax Data: " . json_encode($taxData, true));

				$taxAmount = isset($taxData['TotalTax']) ? (float)$taxData['TotalTax'] : 0.0;
			}
		} catch (\Throwable $e) {
			// optionally log $e->getMessage() here via $this->logModel
			$taxAmount = 0.0;
		}

		$result['subtotal'] = round($subtotal, 2);
		$result['normal_price'] = round($plan['price'], 2);
		$result['shipping'] = round($shipping, 2);
		$result['sim_fee'] = round($sim_fee, 2);
		$result['tax'] = round($taxAmount, 2);
		$result['total_with_taxes'] = round($totalPrice + $taxAmount, 2);
		$result['address'] = $addr;
		$result['lines'] = $lines;
		$log->putLog("Result: " . json_encode($result, true));

		echo json_encode($result);
		exit();
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

	public function encrypt()
	{
		if ($_SERVER['REQUEST_METHOD'] == 'POST') {

			$input = isset($_POST['input']) ? trim($_POST['input']) : null;

			if ($input === null || $input === '') {
				echo json_encode(['response' => 'Error', 'message' => 'Input empty']);
				exit();
			}

			try {
				$encrypted = encrypt_decrypt('encrypt', $input);
				echo json_encode(['response' => 'OK', 'encrypted' => $encrypted]);
			} catch (\Throwable $e) {
				echo json_encode(['response' => 'Error', 'message' => $e->getMessage()]);
			}
		} else {
			echo json_encode(['response' => 'Error', 'message' => 'Invalid request method']);
		}
		exit();
	}
}
