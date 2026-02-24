<?php 
//ini_set('display_errors', 1);
//ini_set('display_startup_errors', 1);
//error_reporting(E_ALL);
include_once "../connection/connect.php";
$db = conexion();
	$amount = $_POST['amount'];
$confirmation_id = $_POST['confirmation_id'];
$plan_name = $_POST['plan_name'];
$plan_package = $_POST['pkg'];
$ip = $_POST['ip'];
$inv  = $_POST['inv'];
$device = $_PoST['device'];

$query = $db->prepare("UPDATE order_detail SET
	plan_package=:plan_package,
	plan_name=:plan_name,
	plan_price=:amount,
	device = :device
	WHERE confirmation_id=:confirmation_id");
	$query->bindParam("plan_package",$plan_package);
	$query->bindParam("plan_name",$plan_name);
	$query->bindParam("amount",$amount);
	$query->bindParam('device',$device);
	$query->bindParam("confirmation_id",$confirmation_id);
	$query->execute();
//$confirmation_id = '18040310-1722413108-D';
//$plan_name = 'surgephone plan';
//	include 'config.php';
//	include 'getHostedPaymentForm.php';
//echo $param = $hostedPaymentResponse->token;
////print_r($xml);
//print_r($hostedPaymentResponse);
if(isset($_POST['getKey'])){

	include 'config.php';
	include 'getHostedPaymentForm.php';
//print_r($hostedPaymentResponse);

//print_r($xml);
//print_r($response);

 echo $param = $hostedPaymentResponse->token;
	//echo "hello";
}else{
	echo "sorry";
}