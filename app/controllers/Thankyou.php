<?php 
class Thankyou extends Controller{
	
	public $orderModel;
	public function __construct()
	{
		//echo 'Pages loaded';
		$this->orderModel = $this->model('Order');
	}

	public function index()
	{
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
			$queryString = http_build_query($c_data);
			$dataToken = encrypt_decrypt('encrypt', $queryString);
			
		}
		$infoPlans = $this->getPlanInfo($plan_id);
		
		$data = [
			'title' => "Thank You",
			'logo' => '/img/MyBenefits_LogoBlanco2.png',
			'urlRedirect' => 'https://usaphone.org',
			'description' => "App to share posts to other users",
			'customer_id'=> $customer_id,
			'infoCustomerId' => $c_data,
		];

		$data['infoPlan'] = $infoPlans;
		$this->view('thankyou/index',$data);
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