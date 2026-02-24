<?php 
//ini_set('display_errors', 1);
//ini_set('display_startup_errors', 1);
//error_reporting(E_ALL);
require 'config.php';
require 'sdk/autoload.php';

use net\authorize\api\contract\v1 as AnetAPI;
  use net\authorize\api\controller as AnetController;
  


function getTransactionDetails($transactionId)
{
    /* Create a merchantAuthenticationType object with authentication details
       retrieved from the constants file */
    $merchantAuthentication = new AnetAPI\MerchantAuthenticationType();
    $merchantAuthentication->setName(API_LOGIN_ID);
    $merchantAuthentication->setTransactionKey(TRANSACTION_KEY);
    
    // Set the transaction's refId
    // The refId is a Merchant-assigned reference ID for the request.
    // If included in the request, this value is included in the response. 
    // This feature might be especially useful for multi-threaded applications.
    $refId = 'ref' . time();

    $request = new AnetAPI\GetTransactionDetailsRequest();
    $request->setMerchantAuthentication($merchantAuthentication);
    $request->setTransId($transactionId);

    $controller = new AnetController\GetTransactionDetailsController($request);

    $response = $controller->executeWithApiResponse( \net\authorize\api\constants\ANetEnvironment::SANDBOX);

    if (($response != null) && ($response->getMessages()->getResultCode() == "Ok"))
    {
        //echo "SUCCESS: Transaction Status:" . $response->getTransaction()->getTransactionStatus() . "\n";
        //echo "                Auth Amount:" . $response->getTransaction()->getAuthAmount() . "\n";
        //echo "                   Trans ID:" . $response->getTransaction()->getTransId() . "\n";
		//echo "EMAIL:".$response->getTransaction()->getCustomer()->getEmail()."\n";
     }
    else
    {
        echo "ERROR :  Invalid response\n";
        $errorMessages = $response->getMessages()->getMessage();
        echo "Response : " . $errorMessages[0]->getCode() . "  " .$errorMessages[0]->getText() . "\n";
    }

    return $response;
  }

  
  
//print("<pre>".print_r($resp,true)."</pre>");