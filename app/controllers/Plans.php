<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
class Plans extends Controller{

    private $db;
	public $ratesModel;
    public $orderModel;
    public $logModel;

	public function __construct()
	{
        $this->db = new Database;
        $this->orderModel = $this->model('Order');
	}


    public function index($plan = '', $type = '')
    {
        $c_id = null;            
        $requestedPlanName = preg_replace('/(?<!^)([A-Z])/', ' $1', $plan);
        $data = [];
        /* if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            $order_id = isset($_POST['orderId']) ? $_POST['orderId'] : null;
            $plan_selected = isset($_POST['IdPlanSelected']) ? $_POST['IdPlanSelected'] : null;
            if ($order_id != "") {
                $order_data = $this->orderModel->getOrderInformation($order_id);
            }
            $postdata = [
                'IdPlan' => $_POST['IdPlanSelected'],
                'order' => $order_data
            ];
            $data['plan_selected'] = $plan_selected;
            $data['order'] = $order_data;
        } */

        $plans = [
            [
                'plan_id'     => 'LMP100',
                'name'        => 'Premium',
                'description' => '$90* for three months&nbsp;of&nbsp;service ',
                'spec'        => [
                    'minutes' => '5G National Coverage',
                    'sms'     => 'Unlimited SMS',
                    'hotspot' => false,
                ],
                'price'       => 30, // USD
                'promo_price' => 90, // USD
                'data'        => '12 GB',
                'custom_spec' => [
                    'activation_fee'   => 0,
                    'contract'         => 'No contract',
                    'international'    => 'Not included',
                    'extra_notes'      => 'Best for low data usage',
                ],
            ],
            [
                'plan_id'     => 'LMP200',
                'name'        => 'Unlimited',
                'description' => '$120* for three months&nbsp;of&nbsp;service',
                'spec'        => [
                    'minutes' => 'Unlimited nationwide minutes',
                    'sms'     => 'Unlimited SMS',
                    'hotspot' => true,
                ],
                'price'       => 40,
                'promo_price' => 120, // USD
                'data'        => '30 GB',
                'custom_spec' => [
                    'activation_fee'   => 0,
                    'contract'         => 'Month-to-month',
                    'international'    => 'Includes calls to MX & CA',
                    'extra_notes'      => 'Good for mixed voice & data usage',
                ],
            ],
            [
                'plan_id'     => 'LMP300',
                'name'        => 'UnlimitedPlus',
                'description' => '$150* for three months&nbsp;of&nbsp;service ',
                'spec'        => [
                    'minutes' => '5G National Coverage',
                    'sms'     => 'Unlimited SMS',
                    'hotspot' => true,
                ],
                'price'       => 50,
                'promo_price' => 150, // USD
                'data'        => 'UNLIMITED',
                'custom_spec' => [
                    'activation_fee'   => 15,
                    'contract'         => 'Month-to-month',
                    'international'    => 'Includes roaming in MX & CA',
                    'extra_notes'      => 'Recommended for streaming & tethering',
                ],
            ],
        ];

          if ($_SERVER['REQUEST_METHOD'] == 'GET') {
            $c_id = isset($_GET['c_id']) ? $_GET['c_id'] : null;
            $order_id = (!empty($c_id)) ? encrypt_decrypt('decrypt', $c_id) : null;
            if (!empty($order_id)) {
                $order_data = $this->orderModel->getOrderInformation($order_id);
            }
            /*$postdata = [
                'IdPlan' => $_POST['IdPlanSelected'],
                'order' => $order_data
            ];
            $data['plan_selected'] = $plan_selected;*/
            $data['c_id'] = $c_id;
            //$data['order'] = $order_data;
        }
    
        // Base data
        $data = array_merge($data, [
            'title'       => "Welcome to SharePosts",
            'description' => "Lorem Ipsum",
            'logo'        => 'https://torchwireless.com/wp-content/uploads/2022/06/Torch_Wireless-3-01-2.png',
            'url'         => "https://$_SERVER[HTTP_HOST]$_SERVER[PHP_SELF]",
            'source'      => "amabassador",
            'origin'      => "Parichute_LinkupMobile",
        ]);
    
        // 🔑 Build index of plans by normalized name (lowercase, no spaces)
        $plansByName = [];
        foreach ($plans as $p) {
            $key = strtolower(str_replace(' ', '', $p['name']));
            $plansByName[$key] = $p;
        }
    
        // Normalize requested name the same way
        $key = strtolower(str_replace(' ', '', $requestedPlanName));
    
        $selectedPlan = $plansByName[$key] ?? null;
    
        if ($selectedPlan) {
            // If found, send only that plan (or you can also send all + selected)
            $data['plan']  = $selectedPlan;
        } else {
            // If not found, send full list
            $data['plans'] = $plans;
        }
    
        $this->view('plans/index', $data);
    }



	public function getallPlans()
	{

		$active_promos = $this->ratesModel->getPromoRates();

		$active_rates = $this->ratesModel->getRates();

		$row = $this->plansModel->getallPlans();

		$row['promos'] = $active_promos;

		$row['rates'] = $active_rates;

		echo json_encode($row);

	}

	

	

	public function limitedOffer(){

		$data = $this->plansModel->getallPlans();

		$this->view('plans/limited', $data);

	}



	public function merchantPlans()

	{

		$data = $this->plansModel->getallPlans();

		$this->view('plans/merchant', $data);

	}



	/*public function getPromos()

	{

		$active_promos = $this->ratesModel->getPromoRates();

		echo json_encode($active_promos);

	}*/



	public function getPromos()

	{

		if ($_SERVER['REQUEST_METHOD'] == 'POST') {

			$_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

			$active_promos = $this->ratesModel->getPromoRates();

			echo json_encode($active_promos);

		}

	}



	public function getRates()

	{

		$active_rates = $this->ratesModel->getRates();

		echo json_encode($active_rates);

	}

	

}