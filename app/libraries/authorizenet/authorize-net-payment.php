<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
// require('database.php');
// require('functions.php');
// $database = new Connection();
// $db = $database->openConnection();

$transRequestXmlStr = <<<XML
<?xml version="1.0" encoding="utf-8"?>
<ARBCreateSubscriptionRequest>
	<merchantAuthentication></merchantAuthentication>
	<refId>assignID</refId>
	<subscription>
		<name>assignNAME</name>
		<paymentSchedule>
			<interval>
				<length>1</length>
				<unit>months</unit>
			</interval>
			<startDate>assignDATE</startDate>
			<totalOccurrences>12</totalOccurrences>
			<trialOccurrences>1</trialOccurrences>
		</paymentSchedule>
		<amount>assignAMOUNT</amount>
		<trialAmount>0.00</trialAmount>
		<payment>
			<creditCard>
				<cardNumber>assignCARDNUMBER</cardNumber>
				<expirationDate>assignEXPNUMBER</expirationDate>
			</creditCard>
		</payment>
		<billTo>
			<firstName>assignFIRSTNAME</firstName>
			<lastName>assignLASTNAME</lastName>
		</billTo>
	</subscription>
</ARBCreateSubscriptionRequest>
XML;

$transRequestXml = new SimpleXMLElement($transRequestXmlStr);

/**************************************/
/*Live Values for LinkupMobile*/
/*$loginId = "5Pe73vSVSr";
$transactionKey = "5V5zD945kBhE4cmt";*/
/**************************************/
/**************************************/
/*Test Values Sandbox Account*/
//$loginId = "bizdev05";
//$transactionKey = "4kJd237rZu59qAZd";
$loginId = "7kUuU243";
$transactionKey = "284X6Wb3w3Z3Y8xW";

$Key = "Simon";
/**************************************/
/*POST Values*/
/*$customer_id = $_POST['cusId'];
$first_name = $_POST['first_name'];
$last_name = $_POST['last_name'];
$amount = $_POST['amount'];
$cc = $_POST['cc'];
$expiration_date = $_POST['expdate'];
*/

$customer_id = 'LM0208244301';
$first_name = 'TestLilian';
$last_name = 'Diaz';
$amount = '15';
$cc = '4007000000027';
$expiration_date = '02/26';

$referencefId = 'ref'. time();
$start_date = date("Y-m-d");



/*XML past values*/
$transRequestXml->addAttribute('xmlns', 'AnetApi/xml/v1/schema/AnetApiSchema.xsd');
$transRequestXml->merchantAuthentication->addChild('name', $loginId);
$transRequestXml->merchantAuthentication->addChild('transactionKey', $transactionKey);
$transRequestXml->refId = $referencefId;
$transRequestXml->subscription->name = "Linkup Monthly Subscription ". $last_name;
$transRequestXml->subscription->paymentSchedule->startDate = $start_date;
$transRequestXml->subscription->amount = $amount;
$transRequestXml->subscription->payment->creditCard->cardNumber = $cc;
$transRequestXml->subscription->payment->creditCard->expirationDate = $expiration_date;
$transRequestXml->subscription->billTo->firstName = $first_name;
$transRequestXml->subscription->billTo->lastName = $last_name;


/*URL Test*/
/**************************************/
$url="https://apitest.authorize.net/xml/v1/request.api";

/*Live URL*/
/**************************************/
//$url = "https://api.authorize.net/xml/v1/request.api";
//print_r($transRequestXml->asXML()); 

try {   
    //setting the curl parameters.
    $ch = curl_init();
    if (false === $ch) {
        throw new Exception('failed to initialize');
    }
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/xml'));
    curl_setopt($ch, CURLOPT_POSTFIELDS, $transRequestXml->asXML());
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 300);
    // The following two curl SSL options are set to "false" for ease of development/debug purposes only.
    // Any code used in production should either remove these lines or set them to the appropriate
    // values to properly use secure connections for PCI-DSS compliance.
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);    //for production, set value to true or 1
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);    //for production, set value to 2
    curl_setopt($ch, CURLOPT_DNS_USE_GLOBAL_CACHE, false);
    //curl_setopt($ch, CURLOPT_PROXY, 'userproxy.visa.com:80');
    $content = curl_exec($ch);
    $content = str_replace('xmlns="AnetApi/xml/v1/schema/AnetApiSchema.xsd"', '', $content);


    //$response = new SimpleXMLElement($content);
    $response = simplexml_load_string($content);
    $jsonResult = json_encode($response);

    echo $jsonResult;
    
    $obj = json_decode($jsonResult, true);
    
    if (false === $content) {
        throw new Exception(curl_error($ch), curl_errno($ch));
    }
    curl_close($ch);

} catch (Exception $e) {
    trigger_error(sprintf('Curl failed with error #%d: %s', $e->getCode(), $e->getMessage()), E_USER_ERROR);
}

function thisPageURL()
{
    $pageURL = 'http';
    if ($_SERVER["HTTPS"] == "on") {
        $pageURL .= "s";
    }
    $pageURL .= "://";
    if ($_SERVER["SERVER_PORT"] != "80") {
        $pageURL .= $_SERVER["SERVER_NAME"] . ":" . $_SERVER["SERVER_PORT"] . $_SERVER["REQUEST_URI"];
    } else {
        $pageURL .= $_SERVER["SERVER_NAME"] . $_SERVER["REQUEST_URI"];
    }

    $pageLocation = str_replace('index.php', '', $pageURL);

    return $pageLocation;
}
