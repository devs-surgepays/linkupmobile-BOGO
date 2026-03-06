<?php


function get_token()
{

    $tId = TENANT_ID_EMAIL;

    $tokenUrl = 'https://login.microsoftonline.com/' . TENANT_ID_EMAIL . '/oauth2/v2.0/token';

    $tokenFields = http_build_query([
        'client_id'     => CLIENT_ID_EMAIL,
        'client_secret' => CLIENT_SECRET_EMAIL,
        'scope'         => 'https://graph.microsoft.com/.default',
        'grant_type'    => 'client_credentials'
    ]);


    $ch = curl_init($tokenUrl);
    curl_setopt_array($ch, [
        CURLOPT_POST           => true,
        CURLOPT_POSTFIELDS     => $tokenFields,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_HTTPHEADER     => [
            'Content-Type: application/x-www-form-urlencoded'
        ],
        CURLOPT_TIMEOUT        => 60,

        // SOLO PARA PRUEBA LOCAL
        CURLOPT_SSL_VERIFYPEER => false,
        CURLOPT_SSL_VERIFYHOST => false,
    ]);



    $tokenResponse = curl_exec($ch);
    $tokenHttpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);

    $http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);

    if (curl_errno($ch)) {
        stopWithError('Error cURL al obtener token: ' . curl_error($ch));
    }
    curl_close($ch);

    if ($tokenHttpCode !== 200) {
        stopWithError("Error token HTTP $tokenHttpCode: $tokenResponse");
    }

    $tokenData = json_decode($tokenResponse, true);

    if (!isset($tokenData['access_token'])) {
        stopWithError("No se encontró access_token en la respuesta: $tokenResponse");
    }


    return $tokenData['access_token'] ?? null;
}



function send_mail($to, $subject, $templateContentHTML = '')

{

    $url = "https://graph.microsoft.com/v1.0/users/" . rawurlencode(SENDER_EMAIL) . "/sendMail";

    $access_token = get_token();

    $sender = SENDER_EMAIL;

    $cc = "aamaya@surgepays.com";

    //var_dump($templateContentHTML); 

    $payload = [

        "message" => [

            "subject" => (string)($subject ?? ''),

            "body" => [
                "contentType" => "HTML",
                "content" => (string)($templateContentHTML ?? '')
            ],

            "from" => [
                "emailAddress" => [
                    "address" => (string)(SENDER_EMAIL ?? '')
                ]
            ],

            "sender" => [
                "emailAddress" => [
                    "address" => (string)(SENDER_EMAIL ?? '')
                ]
            ],

            "toRecipients" => [
                [
                    "emailAddress" => [
                        "address" => !empty($to) ? (string)$to : ''
                    ]
                ]
            ]

        ],

        "saveToSentItems" => true

    ];



    $headers = [

        "Authorization: Bearer $access_token",

        "Content-Type: application/json"

    ];



    $ch = curl_init($url);

    curl_setopt_array($ch, [

        CURLOPT_RETURNTRANSFER => true,

        CURLOPT_POST           => true,

        CURLOPT_POSTFIELDS     => json_encode($payload),

        CURLOPT_HTTPHEADER     => $headers

    ]);



    $response = curl_exec($ch);

    $http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);



    if ($http_code !== 202) {

        throw new Exception("SendMail HTTP $http_code: $response");
    }



    return true;
}



// ----------------------- MAIN ------------------------------------

// try {

//     $mail = send_mail($data['email'], 'Your SurgePhone Account Information', $message);

// } catch (Exception $e) {

//     echo "Error: " . $e->getMessage() . "\n";

// }

// return $mail;
