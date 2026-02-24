<?php 

require 'getinfo.php';
include_once "../connection/connect.php";
$db = conexion();
$transID = $_POST['transid'];
$pmt_status = $_POST['pmtstatus'];
$resCode = $_POST['rescode'];
$confirmation_id = $_POST['confirmation_id'];
$cardNum = $_POST['cardNum'];
if($resCode == 1){
	  $resp = getTransactionDetails($transID);

	$first_name = preg_replace("/[^A-Za-z\.]/", "", $resp->getTransaction()->getBillTo()->getFirstName());
$last_name =  preg_replace("/[^A-Za-z\.]/", "", $resp->getTransaction()->getBillTo()->getLastName());
$dob = '01/01/1970'; //$_POST['dob'];
//$ssn = '1234'; //$_POST['ssn'];
$ssn = rand(1000,9999); 
$contact_phone_number = $resp->getTransaction()->getBillTo()->getPhoneNumber();
$email = $resp->getTransaction()->getCustomer()->getEmail();
//$r_house = $_POST['house'];
//$referral = $_POST['referral'];
$r_street = addslashes($resp->getTransaction()->getBillTo()->getAddress());
$r_city = ucfirst(strtolower($resp->getTransaction()->getBillTo()->getCity()));
$r_state = ucfirst($resp->getTransaction()->getBillTo()->getState());
$r_zip = $resp->getTransaction()->getBillTo()->getZip();
$same_address = "yes";


$birth=str_replace("/","",$dob);
$customer_id=$last_name.$first_name.$birth;
$b_first_name=$_POST['fname'];
$b_last_name=$_POST['lname'];

if($same_address == 'Yes'){
	$s_house=$r_house;
	$s_street=$r_street;
	$s_city=$r_city;
	$s_state=$r_state;
	$s_zip=$r_zip;
	
	$b_house=$r_house;
	$b_street=$r_street;
	$b_city=$r_city;
	$b_state=$r_state;
	$b_zip=$r_zip;
	
	/*$b_first_name=$first_name;
	$b_last_name=$last_name;*/
	
	
	
}else{
	$s_house=$r_house;
	$s_street=$r_street;
	$s_apt=$r_apt;
	$s_city=$r_city;
	$s_state=$r_state;
	$s_zip=$r_zip;
	
	
	$b_house= $_POST['bhouse'];
	$b_street=$_POST['bstreet'];
	$b_city= ucfirst(strtolower($_POST['bcity']));
	$b_state=ucfirst($_POST['bstate']);
	$b_zip=$_POST['bzip'];	
}

try{

$query = $db->prepare("UPDATE order_detail SET
	pmt_error_code=:rescode,
	pmt_status=:pmt_status,
	pmt_transaction=:pmt_transaction,
	first_name=:first_name,
	last_name=:last_name,
	dob=:dob,
	ssn=:ssn,
	contact_phone_number=:contact_phone_number,
	email=:email,
	r_street=:r_street,
	r_city=:r_city, 
	r_state=:r_state,
	r_zip=:r_zip,
	s_street=:s_street, 
	s_city=:s_city, 
	s_state=:s_state,
	s_zip=:s_zip,
	b_street=:b_street, 
	b_city=:b_city, 
	b_state=:b_state,
	b_zip=:b_zip,
	b_first_name=:b_first_name,
	b_last_name=:b_last_name
	WHERE confirmation_id=:confirmation_id");
	$query->bindParam("rescode",$resCode);
	$query->bindParam("pmt_transaction",$transID);
	$query->bindParam("pmt_status",$pmt_status);
	$query->bindParam("first_name",$first_name);
	$query->bindParam("last_name",$last_name);
	$query->bindParam("dob",$dob);
	$query->bindParam("ssn",$ssn);
	$query->bindParam("contact_phone_number",$contact_phone_number);
	$query->bindParam("email",$email);
	$query->bindParam("r_street",$r_street);
	$query->bindParam("r_city",$r_city);
	$query->bindParam("r_state",$r_state);
	$query->bindParam("r_zip",$r_zip);
	$query->bindParam("s_street",$s_street);
	$query->bindParam("s_city",$s_city);
	$query->bindParam("s_state",$s_state);
	$query->bindParam("s_zip",$s_zip);
	$query->bindParam("b_street",$b_street);
	$query->bindParam("b_city",$b_city);
	$query->bindParam("b_state",$b_state);
	$query->bindParam("b_zip",$b_zip);
	$query->bindParam("b_first_name",$first_name);
	$query->bindParam("b_last_name",$last_name);
	$query->bindParam("confirmation_id",$confirmation_id);
	if ($query->execute()) {
		$back = array("update"=>"1","success"=>"ok");
		
		
	  } else {
		$error = "<script>console.log(" . print_r($db->errorInfo()) . ");</script>";
		
		$back = array("update"=>"1","success"=>"no","error"=>$error);
		
		
	  }

}catch(PDOException $e) {
			$error = 'trycatch_customer:'.$e->getMessage();
			$back = array("update"=>"1","success"=>"no","error"=>$error);
		
		}


//$query = "UPDATE order_detail SET 
//	customer_id='$customer_id',
//	referred_by='$referral',
//	first_name='$first_name',
//	last_name='$last_name',
//	dob='$dob',
//	ssn='$ssn',
//	contact_phone_number='$contact_phone_number',
//	email='$email',
//	r_house='$r_house',
//	r_street='$r_street',
//	r_city='$r_city', 
//	r_state='$r_state',
//	r_zip='$r_zip',
//	s_house='$s_house',
//	s_street='$s_street', 
//	s_city='$s_city', 
//	s_state='$s_state',
//	s_zip='$s_zip',
//	b_house='$b_house',
//	b_street='$b_street', 
//	b_city='$b_city', 
//	b_state='$b_state',
//	b_zip='$b_zip',
//	b_first_name='$b_first_name',
//	b_last_name='$b_last_name'
//	WHERE confirmation_id='$confirmation_id';";
//			$result = mysql_query($query, $db) or die( "query". mysql_error());
//			
//				if(!$result) {
//				die(mysql_error());
//				}

}else{
	try{

$query = $db->prepare("UPDATE order_detail SET
	pmt_error_code=:rescode,
	pmt_status=:pmtstatus,
	pmt_transaction=:pmt_transaction,
	
	WHERE confirmation_id=:confirmation_id");
	$query->bindParam("rescode",$resCode);
	$query->bindParam("pmt_transaction",$transID);
	$query->bindParam("pmt_status",$pmt_status);
	$query->bindParam("confirmation_id",$confirmation_id);
	if ($query->execute()) {
		$back = array("update"=>"2","success"=>"ok");
		
	  } else {
		$error = "<script>console.log(" . print_r($db->errorInfo()) . ");</script>";
		
		$back = array("update"=>"2","success"=>"no","error"=>$error);
	  }

}catch(PDOException $e) {
			$error = 'trycatch_customer:'.$e->getMessage();
			
			$back = array("update"=>"2","success"=>"no","error"=>$error);
		}
}

echo json_encode($back);
   ?>

