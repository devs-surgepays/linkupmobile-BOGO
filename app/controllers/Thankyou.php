<?php 
class Thankyou extends Controller{
	
	public $orderModel;
	public $logModel;

	public function __construct()
	{
		$this->orderModel = $this->model('Order');
		$this->logModel = $this->model('Log');
	}

	public function index($lang = NULL)
	{
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

				//
				'thankyou_h1' => 'ORDER',
				'thankyou_h1_2' => 'HAS BEEN PLACED!',
				'thankyou_desc' => 'Thank you for your order. You will receive your eSIM and your order confirmation via email.',
				'orderreview_label' => 'Order Review',
				'transid_label' => 'Transaction Id:',
				'transpgst_label' => 'Transaction PGS:',
				'phone_number_label' => 'Phone Number',
				'back_btn' => 'GO BACK HOME',
				
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

				//
				'thankyou_h1' => 'ORDEN',
				'thankyou_h1_2' => 'HA SIDO COLOCADA!',
				'thankyou_desc' => 'Gracias por su pedido. Recibirá su eSIM y la confirmación del pedido por correo electrónico.',
				'orderreview_label' => 'Revisión de Pedido',
				'transid_label' => 'Transacción Id:',
				'transpgst_label' => 'Transacción PGS:',
				'phone_number_label' => 'Número de teléfono',
				'back_btn' => 'REGRESAR',

			]

		];

		$c_id = null;
		$defaultPlan = 'BOGO30';
		if ($_SERVER['REQUEST_METHOD'] == 'GET') {

			$utm_source = isset($_GET['utm_source']) ? $_GET['utm_source'] : null;
			$utm_medium = isset($_GET['utm_medium']) ? $_GET['utm_medium '] : null;
			$utm_campaign = isset($_GET['utm_campaign']) ? $_GET['utm_campaign'] : null;
			$utm_content = isset($_GET['utm_content']) ? $_GET['utm_content '] : null;
			$match_type = isset($_GET['match_type']) ? $_GET['match_type'] : null;
			$utm_adgroup = isset($_GET['utm_adgroup']) ? $_GET['utm_adgroup'] : null;
			$gclid = isset($_GET['gclid']) ? $_GET['gclid'] : null;
			$fbclid = isset($_GET['fbclid']) ? $_GET['fbclid'] : null;
			$c_id = isset($_GET['cid']) ? $_GET['cid'] : null;
			$plan_id = isset($_POST['plan_id']) ? $_POST['plan_id'] : $defaultPlan;			
		}

		$customer_id = (!empty($c_id)) ? encrypt_decrypt('decrypt', $c_id) : null;

		// echo encrypt_decrypt('encrypt', 'LP15042520201');
		$c_data = [];
		$dataToken = "";

		if (!empty($customer_id)) {
			$c_data = $this->orderModel->getOrderBy($customer_id);

			if (!empty($c_data)) {
				$queryString = http_build_query($c_data);
				$dataToken = encrypt_decrypt('encrypt', $queryString);

				if (!empty($c_data['id_order'])) {
					$response = $this->logModel->getLogPayment($c_data['id_order']);
					$array_response = json_decode($response, true);
				}
			}
		}

		$infoPlans = $this->getPlanInfo($plan_id);
		
		$data_post = [
			'title' => "Thank You",
			'logo' => '/img/MyBenefits_LogoBlanco2.png',
			'urlRedirect' => 'https://usaphone.org',
			'description' => "App to share posts to other users",
			'customer_id'=> $customer_id,
			'infoCustomerId' => $c_data,
			'response' => isset($array_response) ? $array_response : [],
		];
		$data_post['infoPlan'] = $infoPlans;

		$data['en'] = array_merge($data['en'], $data_post);
		$data['es'] = array_merge($data['es'], $data_post);

		//print_r($data);

		$this->view('thankyou/index', $data[$lang]);
	}

	public function getPlanInfo($plan_name = null)
	{
		if (isset($plan_name) && !empty($plan_name)) {

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

}