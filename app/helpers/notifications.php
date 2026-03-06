<?php 
function successOneTimePayment($data,$mailer){
    //$url = URLROOT . 'templates/payment/success_payment.html';
	$url = URLROOT . '/public/templates/payment/success_payment.html';
	//$template = file_get_contents(URLROOT . 'templates/payment/success_payment.html');
	$template = http_get($url);
	$replacements = [
		'{{order_id}}' =>$data['order_id'] ?? '',
		'{{pay_transid}}'=>$data['pay_transid'] ?? '',
		'{{plan}}'=>$data['plan'] ?? '',
		'{{number_of_lines}}'=> $data['number_of_lines'] ?? '',
		'{{price}}'=>$data['price'] ?? '',
		'{{amount}}'=>$data['amount'] ?? ''		
	];
	$message = strtr($template, $replacements);


	try {
		$mail = send_mail($data['email'],'Your Account Information', $message);
	} catch (Exception $e) {
		echo "Error: " . $e->getMessage() . "\n";
	}
	// $mail = $mailer->load();
	// $mail->SMTPDebug = 0;                                       // Enable verbose debug output
	// $mail->isSMTP();                                            // Set mailer to use SMTP
	// $mail->Host       = 'smtp.office365.com';  					// Specify main and backup SMTP servers
	// $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
	// $mail->Username   = EMAIL_USERNAME;                     // SMTP username
	// $mail->Password   = EMAIL_PASS;                               // SMTP password
	// $mail->SMTPSecure = 'TLS/StartTLS';                                  // Enable TLS encryption, `ssl` also accepted
	// $mail->Port       = 587; 	                              // TCP port to connect to
	// //Recipients
	// $mail->setFrom(EMAIL_USERNAME, EMAIL_NAME);
	// $mail->addAddress($email);  		// Add a recipient
	// //$mail->addBCC('jdominguez@surgepays.com');
	// //$mail->addBCC('jparker@surgepays.com');
	// $mail->isHTML(true);                                  // Set email format to HTML
	// $mail->Subject = 'One Time Payment Processed';
	// $mail->Body    = $message;
	// $mail->CharSet = 'UTF-8';
	// if ($mail->send()) {
	// 	//$this->userModel->saveRemembertoken($saveData);
	// 	return true;
	// } else {
	// 	return false;
	// }
	return $mail;
}

function fulfillmentEmail($data, $mailer)
{
    //$url = URLROOT . 'templates/payment/success_paymentECS.html';
	$url = URLROOT . '/public/templates/payment/success_paymentECS.html';
	//$template = file_get_contents(URLROOT . 'templates/payment/success_paymentECS.html');
	$template = http_get($url);
	$replacements = [
		'{{order_id}}'          => $data['order_id'] ?? '',
		'{{first_name}}'        => $data['first_name'] ?? '',
		'{{second_name}}'       => $data['second_name'] ?? '',
		'{{phone_number}}'      => $data['phone_number'] ?? '',
		'{{email}}'             => $data['email'] ?? '',
		'{{address1}}'          => $data['address1'] ?? '',
		'{{address2}}'          => $data['address2'] ?? '',
		'{{city}}'              => $data['city'] ?? '',
		'{{state}}'             => $data['state'] ?? '',
		'{{zipcode}}'           => $data['zipcode'] ?? '',
		'{{area_code}}'         => $data['area_code'] ?? '',
		'{{store}}'             => $data['store'] ?? '',
		'{{promo_code}}'        => $data['promo_code'] ?? '',

		// Payment Information
		'{{pay_transid}}'       => $data['pay_transid'] ?? '',
		'{{pay_transmessage}}'  => $data['pay_transmessage'] ?? '',

		// Shipping Information
		'{{shipping_address1}}' => $data['shipping_address1'] ?? '',
		'{{shipping_address2}}' => $data['shipping_address2'] ?? '',
		'{{shipping_city}}'     => $data['shipping_city'] ?? '',
		'{{shipping_state}}'    => $data['shipping_state'] ?? '',
		'{{shipping_zipcode}}'  => $data['shipping_zipcode'] ?? '',

		'{{plan}}' => $data['plan'] ?? '',
		'{{number_of_lines}}' => $data['number_of_lines'] ?? '',
		'{{price}}' => $data['price'] ?? '',
		'{{plan_price}}' => $data['plan_price'] ?? '',
		'{{amount}}' => $data['amount'] ?? '',
		'{{taxes}}' => $data['taxes'] ?? '',
		'{{response_suggestion}}' => $data['response_suggestion'] ?? '',
	];
	
	$message = strtr($template, $replacements);
	
		$subject = 'New Ambassador Order Created | OrderID: '.$data['order_id'];

	try {
		$mail = send_mail("orders@surgepays.com", $subject, $message);
	} catch (Exception $e) {
		echo "Error: " . $e->getMessage() . "\n";
	}
	// $mail = $mailer->load();
	// $mail->SMTPDebug = 0;                                       // Enable verbose debug output
	// $mail->isSMTP();                                            // Set mailer to use SMTP
	// $mail->Host       = 'smtp.office365.com';  					// Specify main and backup SMTP servers
	// $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
	// $mail->Username   = EMAIL_USERNAME;                     // SMTP username
	// $mail->Password   = EMAIL_PASS;                               // SMTP password
	// $mail->SMTPSecure = 'TLS/StartTLS';                                  // Enable TLS encryption, `ssl` also accepted
	// $mail->Port       = 587; 	                              // TCP port to connect to
	// //Recipients
	// $mail->setFrom(EMAIL_USERNAME, EMAIL_NAME);
	// $mail->addAddress($email);  		// Add a recipient
	// //$mail->addBCC('jdominguez@surgepays.com');
	// //$mail->addBCC('jparker@surgepays.com');
	// $mail->isHTML(true);                                  // Set email format to HTML
	// $mail->Subject = 'One Time Payment Processed';
	// $mail->Body    = $message;
	// $mail->CharSet = 'UTF-8';
	// if ($mail->send()) {
	// 	//$this->userModel->saveRemembertoken($saveData);
	// 	return true;
	// } else {
	// 	return false;
	// }
	return $mail;
}

function successAddOnPayment($data, $mailer)
{
    //$url = URLROOT . 'templates/payment/success_addon.html';
	$url = URLROOT . '/public/templates/payment/success_addon.html'; 
	//$template = file_get_contents(URLROOT . 'templates/payment/success_addon.html');
	$template = http_get($url);
	$replacements = [
		'{{pay_transid}}'   => $data['pay_transid'] ?? '',
		'{{invoice_id}}' => $data['invoice_id'] ?? '',
		'{{plan_name}}' => $data['plan_name'] ?? '',
		'{{price}}' => $data['price'] ?? '',
		'{{amount}}' => $data['amount'] ?? '',
	];
	$message = strtr($template, $replacements);
	try{
		$mail= send_mail($data['email'], 'AddOn Payment Processed', $message);
	} catch (Exception $e) {
		echo "Error: " . $e->getMessage()."\n";
	}
	//$message = $template;
	// $mail = $mailer->load();
	// $mail->SMTPDebug = 0;                                       // Enable verbose debug output
	// $mail->isSMTP();                                            // Set mailer to use SMTP
	// $mail->Host       = 'smtp.office365.com';  					// Specify main and backup SMTP servers
	// $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
	// $mail->Username   = EMAIL_USERNAME;                     // SMTP username
	// $mail->Password   = EMAIL_PASS;                               // SMTP password
	// $mail->SMTPSecure = 'TLS/StartTLS';                                  // Enable TLS encryption, `ssl` also accepted
	// $mail->Port       = 587; 	                              // TCP port to connect to
	//Recipients
	//$mail->setFrom(EMAIL_USERNAME, EMAIL_NAME);
	//$mail->addAddress($data['email']);  		// Add a recipient
	//$mail->addBCC('jdominguez@surgepays.com');
	//$mail->addBCC('jparker@surgepays.com');
	// 	$mail->isHTML(true);                                  // Set email format to HTML
	// 	$mail->Subject = 'AddOn Payment Processed'; 
	// 	$mail->Body    = $message;
	// 	$mail->CharSet = 'UTF-8';
	// 	if ($mail->send()) {
	// 		//$this->userModel->saveRemembertoken($saveData);
	// 		return true;
	// 	} else {
	// 		return false;
	// 	}
	return $mail;
}
	
function successSubscriptionPayment($email,$mailer){
	//$template = file_get_contents(URLROOT . 'templates/payment/successpayment.html');
	$template = URLROOT . '/public/templates/payment/successpayment.html';
	$message = $template;

	try {
		$mail = send_mail($email, 'Your Subscription Payment Processed', $message);
	} catch (Exception $e) {
		echo "Error: " . $e->getMessage() . "\n";
	}

	/* $mail = $mailer->load();
		$mail->SMTPDebug = 0;                                       // Enable verbose debug output
		$mail->isSMTP();                                            // Set mailer to use SMTP
		$mail->Host       = 'smtp.office365.com';  					// Specify main and backup SMTP servers
		$mail->SMTPAuth   = true;                                   // Enable SMTP authentication
		$mail->Username   = EMAIL_USERNAME;                     // SMTP username
		$mail->Password   = EMAIL_PASS;                               // SMTP password
		$mail->SMTPSecure = 'TLS/StartTLS';                                  // Enable TLS encryption, `ssl` also accepted
		$mail->Port       = 587; 	                              // TCP port to connect to
		//Recipients
		$mail->setFrom(EMAIL_USERNAME, EMAIL_NAME);
		$mail->addAddress($email);  		// Add a recipient
		//$mail->addBCC('jdominguez@surgepays.com');
		//$mail->addBCC('jparker@surgepays.com');
		$mail->isHTML(true);                                  // Set email format to HTML
		$mail->Subject = 'Subscription Successfully';
		$mail->Body    = $message;
		$mail->CharSet = 'UTF-8';
		if ($mail->send()) {
			//$this->userModel->saveRemembertoken($saveData);
			return true;
		} else {
			return false;
		} */
	return $mail;
}
	
function failPayment($email,$mailer){
		//$template = file_get_contents(URLROOT . 'templates/payment/failpayment.html');
				
		$url = URLROOT . '/public/templates/payment/failpayment.html';
		$template = http_get($url);
		$message = $template;
		$mail = null;	

		try {
			$mail = send_mail($email,'Fail Payment Process', $message);
		} catch (Exception $e) {
			echo "Error: " . $e->getMessage() . "\n";
		}

	
		return $mail;
	}


function failTopUp($email, $mailer)
{
	$template = file_get_contents(URLROOT . 'templates/payment/failtopup.html');
	$message = $template;

	try {
		$mail = send_mail($email, 'Fail Add-On Process', $message);
	} catch (Exception $e) {
		echo "Error: " . $e->getMessage() . "\n";
	}

	/* $mail = $mailer->load();
		$mail->SMTPDebug = 0;                                       // Enable verbose debug output
		$mail->isSMTP();                                            // Set mailer to use SMTP
		$mail->Host       = 'smtp.office365.com';  					// Specify main and backup SMTP servers
		$mail->SMTPAuth   = true;                                   // Enable SMTP authentication
		$mail->Username   = EMAIL_USERNAME;                     // SMTP username
		$mail->Password   = EMAIL_PASS;                               // SMTP password
		$mail->SMTPSecure = 'TLS/StartTLS';                                  // Enable TLS encryption, `ssl` also accepted
		$mail->Port       = 587; 	                              // TCP port to connect to
		//Recipients
		$mail->setFrom(EMAIL_USERNAME, EMAIL_NAME);
		$mail->addAddress($email);  		// Add a recipient
		//$mail->addBCC('jdominguez@surgepays.com');
		//$mail->addBCC('jparker@surgepays.com');
		$mail->isHTML(true);                                  // Set email format to HTML
		$mail->Subject = 'Fail Payment Process';
		$mail->Body    = $message;
		$mail->CharSet = 'UTF-8';
		if ($mail->send()) {
			//$this->userModel->saveRemembertoken($saveData);
			return true;
		} else {
			return false;
		} */
	return $mail;
}

function http_get($url)
{
    $ch = curl_init($url);

    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);  // devuelve el contenido
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);  // sigue redirecciones
    curl_setopt($ch, CURLOPT_TIMEOUT, 30);           // timeout 30s

    $response = curl_exec($ch);

    if ($response === false) {
        // loguea el error en lugar de hacer echo para no romper la salida
        error_log('cURL error (http_get): ' . curl_error($ch));
        curl_close($ch);
        return false;
    }

    $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);

    if ($httpCode !== 200) {
        error_log('HTTP error (http_get): ' . $httpCode . ' for URL ' . $url);
        return false;
    }

    return $response;
}
