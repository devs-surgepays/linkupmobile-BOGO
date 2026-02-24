<?php 
//ini_set('display_errors', 1);
//ini_set('display_startup_errors', 1);
//error_reporting(E_ALL);
	$amount = $_POST['amount'];
$confirmation_id = $_POST['confirmation_id'];
$plan_name = $_POST['plan_name'];
if(isset($_POST['getKey'])){

	include 'config.php';
	include 'getHostedPaymentForm.php';
//print_r($hostedPaymentResponse);

print_r($xml);
//print_r($response);

 echo $param = $hostedPaymentResponse->token;
	//echo "hello";
}else{
	echo "sorry";
}