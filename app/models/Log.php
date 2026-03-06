<?php 
class Log {

	private $db;
	protected $table = 'apis_log_payments';

	public function __construct(){

		$this->db = new Database;

	}

	public function saveApiLog($data,$configs){

		$this->db->query('INSERT INTO '.$configs['table_log']. ' (customer_id,url,request,response,title) VALUES (:customer_id,:url,:request,:response,:title)');

		$this->db->bind(':customer_id', $data['customer_id']);

		$this->db->bind(':url', $data['url']);

		$this->db->bind(':request', $data['request']);

		$this->db->bind(':response', $data['response']);

		$this->db->bind(':title', $data['title']);

		if ($this->db->execute()) {

			return true;

		} else {

			return false;

		}



	}

	public function log_payment($data)
	{
		return $this->db->insertQuery($this->table, $data);
		
		/* $this->db->query('INSERT INTO $this->table (order_id,response,payment_method,action) VALUES (:order_id,:response,:payment_method,:action)');
		$this->db->bind(':order_id', $data['order_id']);
		$this->db->bind(':response', $data['response']);		
		$this->db->bind(':payment_method', $data['payment_method']);
		$this->db->bind(':action', $data['action']);

		if ($this->db->execute()) {
			return true;
		} else {
			return false;
		} */
	}

	public function getLogPayment($id_order)
	{
		$this->db->query('SELECT * FROM LinkupMobile.' . $this->table . ' WHERE id_order = :id_order ORDER BY created_at DESC LIMIT 1;');
		$this->db->bind("id_order", $id_order);
		$getOrder = $this->db->single();
		return $getOrder;
	}


	public function updateApiLog($data, $configs){

		$this->db->updateQuery($configs['table_log'], $data, "customer_id=:customer_id");

	}



}