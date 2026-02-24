<?php 

use PayPal\Api\ChargeModel;
use PayPal\Api\Currency;
use PayPal\Api\MerchantPreferences;
use PayPal\Api\PaymentDefinition;
use PayPal\Api\Plan;
use PayPal\Api\Patch;
use PayPal\Api\PatchRequest;
use PayPal\Common\PayPalModel;
use PayPal\Api\Agreement;
use PayPal\Api\Payer;
use PayPal\Api\ShippingAddress;
use PayPal\Exception\PayPalConnectionException;
require APPROOT.'/libraries/paypal/vendor/PayPal-PHP-SDK/autoload.php';

class Paypal
{
    public function __construct(){
       // log_message('Debug', 'PHPMailer class is loaded.');
		//echo "Client:".PayPalClientId;
    }

    public function context(){
       $apiContext = new \PayPal\Rest\ApiContext(

		  new \PayPal\Auth\OAuthTokenCredential(PayPalClientId,PayPalSecret)

		);
		return $apiContext;
		
		/*new \PayPal\Auth\OAuthTokenCredential(

			'AVACP5vOuQheKwTdBy_tlt2CY3g9CT4NAK3D8j3gEpMIpiO79WuRXaGi--I1ycXOhlaTfzXauydINNoS',

			'EMA6lVCQBJ20WMKOj93Z-M3t9cB5_sq0lV3AZgB0eu8pX2PKuFAsHus87bz3N6EdVyVmfyX1B3QqsEHG'

		  )*/
    }
	
	
	public function Plan(){
		$plan = new Plan();
		return $plan;
	}
	
	public function PaymentDefinition(){
		$paymentDefinition = new PaymentDefinition();
		return $paymentDefinition;
	}
	
	public function ChargeModel(){
		$chargeModel = new ChargeModel();
		return $chargeModel;
	}
	
	public function MerchantPreferences(){
		$merchantPreferences = new MerchantPreferences();
		return $merchantPreferences;
	}
	
	public function Currency(){
		$currency = new Currency();
		return $currency;
	}
	
	public function Patch(){
		$patch = new Patch();
		return $patch;
	}
    public function PayPalModel($model=""){
		$payPalModel = new PayPalModel($model);
		return $payPalModel;
	}
    public function PatchRequest(){
		$patchRequest = new PatchRequest();
		return $patchRequest;
		
	}
	
	public function Agreement(){
		$agreement = new Agreement();
		return $agreement;
	}
	public function Payer(){
		$payer = new Payer();
		return $payer;
	}
	public function ShippingAddress(){
		$shippingAddress = new ShippingAddress();
		return $shippingAddress;
	}
	
	public function PayPalConnectionException(){
		$exception = new PayPalConnectionException();
		return $exception;
	}
}