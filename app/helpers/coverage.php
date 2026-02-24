<?php 
function getCoverage($zipcode, $program){

    $requestArr = array("zipcode" => $zipcode,"program" => $program);
    $mycurl = new Curl();
    $url = 'https://secure-order-forms.com/messenger/api/checkzipcode2';
    $request = json_encode($requestArr);
    $header = array('Authorization: Basic bWFueWNoYXRVc2VyOkh0UW54bjIkVjg2WW0qUXo=', 'Content-Type: application/json');
    return $response = $mycurl->postJsonAuth($url, $request, $header);

}