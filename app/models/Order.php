<?php

class Order
{
	private $db;
	protected $table = 'orders';

	public function __construct()
	{
		$this->db = new Database;
	}
	public function saveOrdersWithoutshopifyID($data)
	{
		$insertData = [
			'customer_id' => $data['customer_id'],
			'first_name' => $data['first_name'],
			'second_name' => $data['second_name'],
			'phone_number' => $data['phone_number'],
			'email' => $data['email'],
			'autopay' => $data['autopay'],
			'order_step' => $data['order_step'],
			'shopify_OrderId' => $data['shopify_OrderId'],
			'shopify_OrderNumber' => $data['shopify_OrderNumber'],
		];
		$this->db->insertQuery('LinkupMobile.orders', $insertData);
		$lastinsertedId = $this->db->lastinsertedId();

		$this->db->query('INSERT INTO users_detail (id_order,id_user) VALUES (:id_order,:id_user)');
		$this->db->bind(':id_order', $lastinsertedId);
		$this->db->bind(':id_user', $data['user_id']);
		$this->db->execute();

		return $lastinsertedId;
	}

	public function getInformationOrderId($id_order){
		$this->db->query('SELECT company,source,first_name,second_name,address1,address2,city,state,zipcode FROM LinkupMobile.orders where id_order=:id_order');
		$this->db->bind("id_order", $id_order);
		$getOrder = $this->db->single();
		return $getOrder;
	}

	public function getOrderByShopifyNumber($shopify_OrderNumber)
	{
		$this->db->query('SELECT * FROM LinkupMobile.orders WHERE shopify_OrderNumber=:shopify_OrderNumber');
		$this->db->bind("shopify_OrderNumber", $shopify_OrderNumber);
		$getOrder = $this->db->single();
		return $getOrder;
	}

	public function getOrderBy($customer_id)
	{
		$this->db->query('SELECT * FROM LinkupMobile.orders WHERE customer_id=:customer_id');
		$this->db->bind("customer_id", $customer_id);
		$getOrder = $this->db->single();
		return $getOrder;
	}

	public function getOrderTransfer($customer_id, $email)
	{
		$this->db->query('SELECT customer_id,first_name,second_name,email,phone_number,address1,address2,city,state,zipcode,plan_id,transfer,mdn_transfer,current_service_provider,current_account_number,current_account_pin 
		FROM orders WHERE transfer ="1" AND customer_id=:customer_id AND email=:email');
		$this->db->bind("customer_id", $customer_id);
		$this->db->bind("email", $email);
		$getOrder = $this->db->single();
		return $getOrder;
	}
	public function getOrderTransferByShopifyNumber($shopify_OrderNumber, $phone_number)
	{
		$this->db->query('SELECT customer_id,shopify_OrderId,shopify_OrderNumber,first_name,second_name,email,phone_number,address1,address2,city,state,zipcode,plan_id,transfer,mdn_transfer,current_service_provider,current_account_number,current_account_pin 
		FROM orders WHERE transfer ="1" AND shopify_OrderNumber=:shopify_OrderNumber AND phone_number=:phone_number');
		$this->db->bind("shopify_OrderNumber", $shopify_OrderNumber);
		$this->db->bind("phone_number", $phone_number);
		$getOrder = $this->db->single();
		return $getOrder;
	}

	public function getOrderwithPlan($customer_id)
	{
		$this->db->query('SELECT * FROM LinkupMobile.orders o 
		INNER JOIN LinkupMobile.plans pl ON o.plan_id = pl.plan_id WHERE customer_id=:customer_id');
		$this->db->bind("customer_id", $customer_id);
		$getOrder = $this->db->single();
		return $getOrder;
	}

	public function validateOrder($phone_number, $email)
	{

		$this->db->query("SELECT count(id_order) as count FROM LinkupMobile.orders WHERE phone_number=:phone_number and email=email");
		$this->db->bind("phone_number", $phone_number);
		$this->db->bind("email", $email);
		$this->db->execute();
		$row = $this->db->resultSet();
		return $row;
	}

	public function validateLinkupPhoneNumber($linkup_number)
	{

		$this->db->query("SELECT LinkupPhoneNumber FROM LinkupMobile.order_items WHERE LinkupPhoneNumber=:LinkupPhoneNumber");
		$this->db->bind("LinkupPhoneNumber", $linkup_number);
		$this->db->execute();
		$row = $this->db->resultSet();
		return $row;
	}

	public function createOrder($data)
	{
		return $this->db->insertQuery($this->table, $data);
		
	}

	public function updateOrder($data)
	{
		$this->db->query('UPDATE orders SET
		plan              = :plan,
        email             = :email,
        pay_message       = :pay_message,
        pay_authcode      = :pay_authcode,
        pay_transid       = :pay_transid,
        pay_accountnumber = :pay_accountnumber,
        pay_accounttype   = :pay_accounttype,
        pay_transmessage  = :pay_transmessage,
        billing_address1  = :billing_address1,
        billing_address2  = :billing_address2,
        billing_city      = :billing_city,
        billing_state     = :billing_state,
        billing_zipcode   = :billing_zipcode,
        number_of_lines   = :number_of_lines,
        price             = :price,
        amount            = :amount,
        action            = :action
		WHERE id = :id');

		$this->db->bind(':plan',              $data['plan']);
		$this->db->bind(':email',             $data['email']);
		$this->db->bind(':pay_message',       $data['pay_message']);
		$this->db->bind(':pay_authcode',      $data['pay_authcode']);
		$this->db->bind(':pay_transid',       $data['pay_transid']);
		$this->db->bind(':pay_accountnumber', $data['pay_accountnumber']);
		$this->db->bind(':pay_accounttype',   $data['pay_accounttype']);
		$this->db->bind(':pay_transmessage',  $data['pay_transmessage']);
		$this->db->bind(':billing_address1',  $data['billing_address1']);
		$this->db->bind(':billing_address2',  $data['billing_address2']);
		$this->db->bind(':billing_city',      $data['billing_city']);
		$this->db->bind(':billing_state',     $data['billing_state']);
		$this->db->bind(':billing_zipcode',   $data['billing_zipcode']);
		// casteos básicos por si tu clase los maneja como string
		$this->db->bind(':number_of_lines',   (int) $data['number_of_lines']);
		$this->db->bind(':price',             (float) $data['price']);
		$this->db->bind(':amount',            (float) $data['amount']);
		$this->db->bind(':action',            $data['action']);
		$this->db->bind(':id',          	  $data['id']);

		if ($this->db->execute()) {
			return true;
		} else {
			return false;
		}
		//return $this->db->updateQuery($this->table, $data, "order_id=:order_id");
	}

	public function createOrderId()
	{
		$date = date('Y-m-d h:i:s');
		$this->db->query("SELECT count(id) as count from {$this->table} where order_id  !='' and CAST(date_created as date) = current_date()");
		$row = $this->db->single();
		$now = date('mdys');
		$number = $row['count'];
		$number++;
		if ($number < 10) {
			$correlativo = str_pad($number, 2, "0", STR_PAD_LEFT);
		} else {
			$correlativo = $number;
		}
		$order_id = $now . $correlativo;

		return $order_id;
	}

	public function checkDuplicateOrder($data)
	{
		$this->db->query("SELECT count(*) as n FROM {$this->table} WHERE phone_number=:phone_number AND email=:email");
		$this->db->bind("phone_number", $data['phone_number']);
		$this->db->bind("email", $data['email']);
		$count_row = $this->db->single();
		return $count_row;
	}	

	public function updateTransfer($data)
	{
		$this->db->query('UPDATE LinkupMobile.orders SET
		first_name=:first_name,
		second_name=:second_name,
		phone_number=:phone_number,
		email=:email,
		address1=:address1,
		address2=:address2,
		city=:city,
		state=:state,
		zipcode=:zipcode, 
		plan_id=:plan_id,
		mdn_transfer=:mdn_transfer,
		current_service_provider=:current_service_provider,
		current_account_number=:current_account_number,
		current_account_pin=:current_account_pin,
		-- linkup_sim=:linkup_sim,
		-- linkup_sim_activate=:linkup_sim_activate,		
		updated_at=:updated_at,
		order_status=:order_status 
		WHERE customer_id=:customer_id');

		$this->db->bind(':first_name', $data['first_name']);
		$this->db->bind(':second_name', $data['second_name']);
		$this->db->bind(':phone_number', $data['phone_number']);
		$this->db->bind(':email', $data['email']);
		$this->db->bind(':address1', $data['address1']);
		$this->db->bind(':address2', $data['address2']);
		$this->db->bind(':city', $data['city']);
		$this->db->bind(':state', $data['state']);
		$this->db->bind(':zipcode', $data['zipcode']);
		$this->db->bind(':plan_id', $data['plan_id']);
		$this->db->bind(':mdn_transfer', $data['mdn_transfer']);
		$this->db->bind(':current_service_provider', $data['current_service_provider']);
		$this->db->bind(':current_account_number', $data['current_account_number']);
		$this->db->bind(':current_account_pin', $data['current_account_pin']);
		// $this->db->bind(':linkup_sim', $data['linkup_sim']);
		// $this->db->bind(':linkup_sim_activate', $data['linkup_sim_activate']);		
		$this->db->bind(':updated_at', $data['updated_at']);
		$this->db->bind(':order_status', $data['order_status']);
		$this->db->bind(':customer_id', $data['customer_id']);

		if ($this->db->execute()) {
			return true;
		} else {
			return false;
		}
		//$this->db->updateQuery("linkupmobile_plans.orders", $data, "customer_id=:customer_id");
	}

	public function updateSIMActivation($data)
	{
		$this->db->query('UPDATE LinkupMobile.orders SET
		activation_message=:activation_message		
		WHERE customer_id=:customer_id');
		$this->db->bind(':activation_message', $data['message']);
		$this->db->bind(':customer_id', $data['customer_id']);

		if ($this->db->execute()) {
			return true;
		} else {
			return false;
		}
	}

	public function countRegisters($search, $firstload)
	{

		if ($firstload == "YES") {

			$this->db->query("SELECT count(*) as total FROM LinkupMobile.orders order by date_create  desc");
		} else {

			if ($search != "") {
				$this->db->query("SELECT count(*) as total FROM LinkupMobile.orders WHERE $search order by date_create desc");
			} else {
				$this->db->query("SELECT count(*) as total FROM LinkupMobile.orders order by date_create  desc");
			}
		}

		$this->db->execute();
		$count = $this->db->single();
		return $count['total'];
	}

	public function checknlad()
	{
		if ($_SERVER['REQUEST_METHOD'] == 'POST') {
			$_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);


			$payload = array(
				"Credential" => $credentials,
				"SubscriberOrderId" => $order['order_id'],
				"Author" => "Logics Lander Orders",
				"RepNotAssisted" => true
			);
			$mycurl = new Curl();
			//echo json_encode($payload);
			$url2 = "https://wirelessapi.shockwavecrm.com/PrepaidWireless/NationalVerifierEligibilityCheck";
			$request2 = json_encode($payload);
			$header2 = array('Content-Type: application/json');
			$orderres = $mycurl->postJsonAuth($url2, $request2, $header2);
			//echo $orderres;
			$response2 = json_decode($orderres, true);
			$nlad = array(
				"id_order" => $order['id_order'],
				"acp_status" => $response2['AcpStatus']
			);
			$this->recordsModel->updateOrder($orderData);
			$this->recordsModel->saveApiLog($order['customer_id'], $url2, $request2, $orderres, 'checkNlad');
			echo $orderres;
		}
	}

	public function getOrderWithPlansByCustomerID($customer_id)
	{

		$this->db->query("SELECT order_items.*, plans.*, orders.id_order, orders.customer_id FROM
		LinkupMobile.orders
		inner join order_items on order_items.customer_id = orders.customer_id
		inner join plans on plans.plan_id = order_items.plan_id WHERE orders.customer_id = :customer_id;");
		$this->db->bind("customer_id", $customer_id);
		$this->db->execute();
		$row = $this->db->single();
		return $row;
	}

	public function getOrderWithPlansByshopify_OrderId($shopify_OrderId)
	{

		$this->db->query("SELECT order_items.*, plans.*, orders.id_order, orders.customer_id FROM
		LinkupMobile.orders
		inner join order_items on order_items.customer_id = orders.customer_id
		inner join plans on plans.plan_id = order_items.plan_id WHERE orders.shopify_OrderId =:shopify_OrderId;");
		$this->db->bind("shopify_OrderId", $shopify_OrderId);
		$this->db->execute();
		$row = $this->db->single();
		return $row;
	}

	public function checkOrderByOrderNumber($data){
		$this->db->query("SELECT id_orderItem,id_order,
		oi.shopify_OrderId,
		orders.first_name,
		orders.second_name,
		orders.address1,
		orders.city,
		orders.state,
		orders.zipcode,
		oi.plan_id,
		concat('https://myaccount.linkupmobile.com/', (select plan_hero_image from plans where plans.plan_id = oi.plan_id)) as 'image',
		oi.name,
		oi.price,
		if (oi.SIM_activate=1, true, false) as 'SIM_activate',
		oi.TransactionID,oi.SIM,
		oi.LinkupPhoneNumber,
		oi.date_activated,
		orders.subscription_Status,
		orders.subscription_Id,
		orders.subscription_flag
		FROM LinkupMobile.orders inner join order_items oi on orders.customer_id = oi.customer_id 
		WHERE shopify_OrderNumber = :shopify_OrderNumber and (email=:email or phone_number=:phone_number)");
		$this->db->bind("shopify_OrderNumber", $data['order_number']);
		$this->db->bind("email", $data['email']);
		$this->db->bind("phone_number", $data['contact_phone']);
		$row = $this->db->resultSet();
		return $row;
	}

	public function getItemWithOrderByItemId($data){
		$this->db->query("SELECT * FROM LinkupMobile.orders inner join order_items  on orders.customer_id = order_items.customer_id 
		WHERE  (email=:email or phone_number=:phone_number) and order_items.id_orderItem=:id_orderItem;");
		$this->db->bind("email", $data['email']);
		$this->db->bind("phone_number", $data['phone_number']);
		$this->db->bind("id_orderItem", $data['id_orderItem']);
		$row = $this->db->single();

		return $row;

	}

	public function getOrderInformation($id_order){
		$this->db->query("SELECT * FROM {$this->table} where order_id=:order_id;");
		$this->db->bind("order_id", $id_order);
		$this->db->execute();
		$row = $this->db->single();
		return $row;
	}
}
