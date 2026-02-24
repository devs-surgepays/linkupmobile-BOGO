<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
require('database.php');
require('functions.php');
$db = new Database();

$customer_id = "LM1218234409";
$url = "https://apitest.authorize.net/xml/v1/request.api";
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

$transRequestXml = new SimpleXMLElement($transRequestXmlStr);

$jsonResult="test";

saveApiLog($customer_id, $url, $transRequestXml->asXML(), $jsonResult, 'Payment Authorizenet', $db);


?>