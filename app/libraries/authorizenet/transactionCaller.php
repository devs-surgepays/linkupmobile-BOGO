<?php
/*ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);*/
require ('database.php');
require ('functions.php');
$database = new Connection();
$db = $database->openConnection();
//default transaction type: authCaptureTransaction
$transRequestXmlStr = <<<XML
<?xml version="1.0" encoding="UTF-8"?>
<createTransactionRequest xmlns="AnetApi/xml/v1/schema/AnetApiSchema.xsd">
      <merchantAuthentication></merchantAuthentication>
      <transactionRequest>
         <transactionType>authOnlyTransaction</transactionType>
         <amount>assignAMOUNT</amount>
         <currencyCode>USD</currencyCode>
         <payment>
            <opaqueData>
               <dataDescriptor>assignDD</dataDescriptor>
               <dataValue>assignDV</dataValue>
            </opaqueData>
         </payment>
      </transactionRequest>
</createTransactionRequest>
XML;

$transRequestXml=new SimpleXMLElement($transRequestXmlStr);

/*Test Values*/
$loginId = "8q35FqpYa";
$transactionKey = "3f78vJF5Wp3S53Zm";
//$loginId = "6dgFn3wj5Ak";
/**************************************/
/*Live Values*/
//$loginId = "96Xv9uu24H7b";
//$transactionKey = "65247m3EV83wdF2g"; 
/**************************************/
//$transactionKey = "7X3gG63upg47Lgwz";
$amount= $_POST['amount'];
$transRequestXml->merchantAuthentication->addChild('name',$loginId);
$transRequestXml->merchantAuthentication->addChild('transactionKey',$transactionKey);
$transRequestXml->transactionRequest->amount=$amount;
$transRequestXml->transactionRequest->payment->opaqueData->dataDescriptor=$_POST['dataDesc'];
$transRequestXml->transactionRequest->payment->opaqueData->dataValue=$_POST['dataValue'];

if($_POST['dataDesc'] === 'COMMON.VCO.ONLINE.PAYMENT')
{
    $transRequestXml->transactionRequest->addChild('callId',$_POST['callId']);  
}

$customer_id=$_POST['cusId'];

//$company=$_POST['company'];

if(isset($_POST['paIndicator'])){
    //$transRequestXml->transactionRequest->addChild('cardholderAuthentication');
    //$transRequestXml->transactionRequest->cardholderAuthentication->addChild('authenticationIndicator',$_POST['paIndicator']);
    //$transRequestXml->transactionRequest->cardholderAuthentication->addChild('cardholderAuthenticationValue',$_POST['paValue']);
}

/*URL Test*/
$url="https://apitest.authorize.net/xml/v1/request.api";

/*Live URL*/
//$url="https://api.authorize.net/xml/v1/request.api";
//print_r($transRequestXml->asXML()); 

try{	//setting the curl parameters.
        $ch = curl_init();
        if (FALSE === $ch)
        throw new Exception('failed to initialize');
        curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/xml'));
        curl_setopt($ch, CURLOPT_POSTFIELDS, $transRequestXml->asXML());
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 300);
		// The following two curl SSL options are set to "false" for ease of development/debug purposes only.
		// Any code used in production should either remove these lines or set them to the appropriate
		// values to properly use secure connections for PCI-DSS compliance.
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);	//for production, set value to true or 1
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);	//for production, set value to 2
        curl_setopt($ch, CURLOPT_DNS_USE_GLOBAL_CACHE, false );
        $content = curl_exec($ch);
        if (FALSE === $content)
        	throw new Exception(curl_error($ch), curl_errno($ch));
        curl_close($ch);
		
		$xmlResult=simplexml_load_string($content);

		$jsonResult=json_encode($xmlResult);
		
		echo $jsonResult;
		//saveApiLog($customer_id,$url,$transRequestXml->asXML(),$jsonResult,'Payment Authorizenet',$db);
		$obj = json_decode($jsonResult,true);
		//print("<pre>".print_r($obj,true)."</pre>");
		$messageResult=$obj['messages']['resultCode'];
		$messageText=$obj['messages']['message']['text'];
		$transRespond = $obj['transactionResponse']['responseCode'];
		if($transRespond=="1"){
			$authCode=$obj['transactionResponse']['authCode'];
			//$text="Successful.";
			$transId=$obj['transactionResponse']['transId'];
			$accountNumber=$obj['transactionResponse']['accountNumber'];
			$accountType=$obj['transactionResponse']['accountType'];
			$message= $obj['transactionResponse']['messages']['message']['description']; 
	
		}else{
			$authCode=$obj['transactionResponse']['authCode'];
			//$text="The transaction was unsuccessful.";
			$transId=$obj['transactionResponse']['transId'];
			$accountNumber=$obj['transactionResponse']['accountNumber'];
			$accountType=$obj['transactionResponse']['accountType'];
			$message= $obj['transactionResponse']['errors']['error']['errorText'];
		}
	
		$callback = array(
			"pay_message"=>$messageText,
			"pay_authocode"=>$authCode,
			"pay_transid"=>$transId,
			"pay_accountnumber"=>$accountNumber,
			"pay_accounttype"=>$accountType,
			"pay_transmessage"=>$message,
			"order_status"=>"payment",
			"payment_method"=>"Credit Card",
			"customer_id"=>$customer_id
		);
		//updateOrderData($customer_id, $callback, $db);
		//savePayInfo($callback,$customer_id,$db);
		//$db->updateQuery($table,$callback,"customer_id=:customer_id");
	
		//echo json_encode($callback);
		//	if($_POST['shipping']=="Yes"){
		//			$data=array(
		//				"address1"=>$_POST['s_address1'],
		//				"address2"=>$_POST['s_address2'],
		//				"city"=>$_POST['s_city'],
		//				"state"=>$_POST['s_state'],
		//				"zipcode"=>$_POST['s_zipcode'],
		//				"shipping"=>$_POST['shipping'],
		//				"customer_id"=>$customer_id
		//			);
		//			saveShippingInfo($data,$db);
		//		}
		
		
}catch(Exception $e) {
    	trigger_error(sprintf('Curl failed with error #%d: %s', $e->getCode(), $e->getMessage()), E_USER_ERROR);
}

?>
