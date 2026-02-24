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
		if ($_SERVER['REQUEST_METHOD'] == 'GET') {

			$utm_source = isset($_GET['utm_source']) ? $_GET['utm_source'] : null;
			$utm_medium = isset($_GET['utm_medium']) ? $_GET['utm_medium '] : null;
			$utm_campaign = isset($_GET['utm_campaign']) ? $_GET['utm_campaign'] : null;
			$utm_content = isset($_GET['utm_content']) ? $_GET['utm_content '] : null;
			$match_type = isset($_GET['match_type']) ? $_GET['match_type'] : null;
			$utm_adgroup = isset($_GET['utm_adgroup']) ? $_GET['utm_adgroup'] : null;
			$gclid = isset($_GET['gclid']) ? $_GET['gclid'] : null;
			$fbclid = isset($_GET['fbclid']) ? $_GET['fbclid'] : null;
			$c_id = isset($_GET['c_id']) ? $_GET['c_id'] : null;
		}

		$customer_id = (!empty($c_id)) ? encrypt_decrypt('decrypt', $c_id) : null;

		// echo encrypt_decrypt('encrypt', 'LP15042520201');
		$c_data = [];
		$dataToken = "";

		/*if (!empty($customer_id)) {
			$c_data = $this->orderModel->getOrder($customer_id);
			$queryString = http_build_query($c_data);
			$dataToken = encrypt_decrypt('encrypt', $queryString);
		}*/
		$data = [
			'title' => "Thank You",
			'logo' => '/img/MyBenefits_LogoBlanco2.png',
			'urlRedirect' => 'https://usaphone.org',
			'description' => "App to share posts to other users",

		];
		$this->view('thankyou/index',$data);
	}
	
	// public function index()
	// {
	// 	//echo "This is Terms Controller";
	// 	$data = [
	// 		'title' => "Welcome to SharePosts",
	// 		'description'=>"Lorem Ipsum",
	// 		'logo' => '/img/USAPhoneABTWhiteTelecomunication.png',
	// 		'url' => "https://$_SERVER[HTTP_HOST]$_SERVER[PHP_SELF]",
	// 		'source'=> "usaphone",
	// 		'origin'=>"usaphone",
	// 		'urlRedirect' => 'https://usaphone.org',
	// 	];
	// 	$this->view('thankyou/index',$data);
	// }
}