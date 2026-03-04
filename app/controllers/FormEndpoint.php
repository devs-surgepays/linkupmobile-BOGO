<?php
// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
// error_reporting(E_ALL); 
class FormEndpoint extends Controller
{
    public $orderModel;
    public $logModel;

    public function __construct()
    {
        $this->orderModel = $this->model('Order');
        $this->logModel = $this->model('Log');

        $allowed_origins = [
            'http://localhost/',
            'https://ambassador.linkupmobile.com/',
            'https://pib.linkupmobile.com/',
            'https://parichute.linkupmobile.com/',
            'https://secure-order-forms.com/'            
        ];
        $origin = $_SERVER['HTTP_ORIGIN'] ?? '';

        if (in_array($origin, $allowed_origins)) {
            header("Access-Control-Allow-Origin: $origin");
            header("Access-Control-Allow-Credentials: true");
        }
        header('Access-Control-Allow-Methods: GET, POST, OPTIONS');
        header("Access-Control-Allow-Headers: Content-Type, Authorization");
        header("Content-Type: application/json; charset=UTF-8");
        header("Connection: keep-alive");
    }

    public function orders()
    {
        $raw = file_get_contents("php://input");
       /*  $raw = '{
            "apikey": "U3VyZ2VwYXlzMjQ6VyEybTZASnk4QVFk",
            "first_name": "Ana",
            "middle_name": "Lilian",
            "second_name": "Amaya",
            "middle_initial": "L",
            "suffix": "",
            "phone_number": "(702)555-0199",
            "email": "ana.test@example.com",
            "address1": "1234 S Rainbow Blvd",
            "address2": "Apt 21",
            "city": "Las Vegas",
            "state": "NV",
            "zipcode": "89146",
            "shipping_address1": "1234 S Rainbow Blvd",
            "shipping_address2": "Apt 21",
            "shipping_city": "Las Vegas",
            "shipping_state": "NV",
            "shipping_zipcode": "89146",
            "billing_address1": "2126 Sun Swept Way",
            "billing_address2": "",
            "billing_city": "Henderson",
            "billing_state": "NV",
            "billing_zipcode": "89074",
            "source": "landing_page",
            "agree_terms": true,
            "customer_id": "CUST-10002458",
            "utm_source": "google",
            "utm_medium": "cpc",
            "utm_campaign": "linkup_30bogo_brand",
            "utm_content": "ad_variation_1",
            "match_type": "exact",
            "utm_adgroup": "brand_core",
            "url": "https://30bogo.linkupmobile.com/checkout",
            "address_type": "billing",
            "terminal_id": "TERM-001",
            "clerk_id": "CLK-123",
            "cake_clickId": "CK-9f3b2a8c-4d12-4f27-a9f1-0a1b2c3d4e5f",
            "card_number": "4400662246955194",
            "card_name": "Ana Amaya",
            "expiration_date": "08/26",
            "card_scnumber": "888",
            "card_type": "Visa",
            "Imei": "354802263841372"
        }'; */
        
        $arrayPost = json_decode($raw, true);
        $logfile = "log_" . date('Y-m-d') . ".txt";
        $log = new Logger($logfile);
        $log->setTimestamp("Y-m-d h:i:s");
        $log->putLog("Rawdata: " . json_encode($raw, true));
        $this->checkAuthentication(isset($arrayPost['apikey']) ? $arrayPost['apikey'] : '');
        $sw = $arrayPost['sw'] ?? 'null';
        $signature_text = $arrayPost['first_name'] . " " . $arrayPost['second_name'];

        if (empty($arrayPost['first_name']) and (empty($arrayPost['second_name']))) {
            $this->msgResponse(false, 'FIELD_REQUIRED', 'There are required fields.', array()); // Exit
        }
        $customer_id = $this->orderModel->createCustomerId();

        $data = [
            'customer_id' => $customer_id,
            'first_name' => $this->sanitizeInput($arrayPost['first_name'], 'string'),
            'second_name' => $this->sanitizeInput($arrayPost['second_name'], 'string'),
            'phone_number' => $this->sanitizeInput($arrayPost['phone_number'], 'phone'),
            'email' => $this->sanitizeInput($arrayPost['email'], 'email'),
            'address1' => $this->sanitizeInput($arrayPost['address1'], 'string'),
            'address2' => $this->sanitizeInput($arrayPost['address2'], 'string'),
            'city' => $this->sanitizeInput($arrayPost['city'], 'string'),
            'state' => $this->sanitizeInput($arrayPost['state'], 'string'),
            'zipcode' => $this->sanitizeInput($arrayPost['zipcode'], 'string'),
            "shipping_address1" => $this->sanitizeInput($arrayPost['shipping_address1'], 'string'),
            "shipping_address2" => $this->sanitizeInput($arrayPost['shipping_address2'], 'string'),
            "shipping_city" => $this->sanitizeInput($arrayPost['shipping_city'], 'string'),
            "shipping_state" => strtoupper($this->sanitizeInput($arrayPost['shipping_state'], 'string')),
            "shipping_zipcode" => $this->sanitizeInput($arrayPost['shipping_zipcode'], 'string'),
            "billing_address1" => $this->sanitizeInput($arrayPost['billing_address1'], 'string'),
            "billing_address2" => $this->sanitizeInput($arrayPost['billing_address2'], 'string'),
            "billing_city" => $this->sanitizeInput($arrayPost['billing_city'], 'string'),
            "billing_state" => strtoupper($this->sanitizeInput($arrayPost['billing_state'], 'string')),
            "billing_zipcode" => $this->sanitizeInput($arrayPost['billing_zipcode'], 'string'),
            'agree_terms' => $this->sanitizeInput($arrayPost['agree_terms'], 'string'),
            'utm_source' => $this->sanitizeInput($arrayPost['utm_source'], 'string'),
            'utm_medium' => $this->sanitizeInput($arrayPost['utm_medium'], 'string'),
            'utm_campaign' => $this->sanitizeInput($arrayPost['utm_campaign'], 'string'),
            'utm_content' => $this->sanitizeInput($arrayPost['utm_content'], 'string'),
            'match_type' => $this->sanitizeInput($arrayPost['match_type'], 'string'),
            'source' => $this->sanitizeInput($arrayPost['source'], 'string'),
            'URL' => $this->sanitizeInput($arrayPost['url'], 'url'),
            'terminal_id' => $this->sanitizeInput($arrayPost['terminal_id'], 'string'),
        ];
        $log->putLog("SanitizeData: " . json_encode($data, true));

        $expiration_date = encrypt_decrypt('decrypt',$arrayPost['expiration_date']);
        $data_cc = [
            'card_type' => encrypt_decrypt('decrypt', $arrayPost['card_type']),
            'card_name' => encrypt_decrypt('decrypt',$arrayPost['card_name']),
            'card_number' => encrypt_decrypt('decrypt',$arrayPost['card_number']),
            'expiration_date' => date("m/y", strtotime(trim($expiration_date))),
            'card_scnumber' => encrypt_decrypt('decrypt',$arrayPost['card_scnumber']),
        ];
        $log->putLog("Credit Card Data: " . json_encode($data_cc, true));               

        /*Create Customer ID*/
        /*******************************/


        /*Create Order ID*/
        /*******************************/
        if (!empty($data['order_id'])) {
            $order_id = $data['order_id'];
            $actionDatabase = 'updateOrder';
        } else {
            $actionDatabase = 'addOrder';
            $order_id = $this->orderModel->createOrderId();
            $data['order_id'] = $order_id;
        }
        $log->putLog("OrderID: " . json_encode($order_id, true));

        /*Create Order Record*/
        if(isset($data['order_id']) && !empty($data['order_id']) && $actionDatabase == 'updateOrder') {
            $order = $this->orderModel->updateOrder($data);
        } else {
            $order = $this->orderModel->createOrder($data);
        }

        /*Calling the API  */
        if ($order == true) {

            $order_response = 'SUCCESS';            
           
            /* $line_payload = '{
                "enrollment_id": "' . $data['order_id'] . '",
                "order_id": "'.$data['order_id']. '",
                "password": "",
                "sponsor_id": "9102319965",
                "first_name": "' . $data['first_name'] . '",
                "last_name": "' . $data['last_name'] . '",
                "alternate_phone_number": "",
                "email": "' . $data['email'] . '",
                "pin": "",
                "activation_type": "NEWACTIVATION",
                "service_address_one": ", '. $data['state'] . ' ' . $data['zipcode'] . '",
                "service_address_two": "'. $data['address2'].'",
                "service_city": "' . $data['city'] . '",
                "service_state": "'. $data['state'] . '",
                "service_zip": "'. $data['zipcode']. '",
                "plan_id": "8497",
                "device_id": "356364245476445",
                "carrier": "LINKUP",
                "is_portin": "N",
                "enrollment_type": "SHIPMENT",
                "billing_address_one": "' . ($billingInfoFlag == "true" ? ', ' . $data['billing_state'] . ' ' . $data['billing_zipcode'] : ', ' . $data['state'] . ' ' . $data['zipcode']) . '",
                "billing_city": "' . ($billingInfoFlag == "true" ? $data['billing_city'] :  $data['city']) . '",
                "billing_state": "' . ($billingInfoFlag == "true" ? $data['billing_state'] :  $data['state']) . '",
                "billing_zip": "' . ($billingInfoFlag == "true" ? $data['billing_zipcode'] :  $data['zipcode']) . '",
                "is_esim": "Y",
                "order_id": "'.$data['order_id'].'",
                "no_of_advance_month": "1",
                "parent_enrollment_id": "A376249"
            }'; */

            
            /*ECS Telgo API*/
            /*******************************/
            //$ecs_response = ECSTelgoo($data, $data_cc);
            $data['areacode'] = $this->getAreaCode($data['phone_number']);
            $data['imei'] = $arrayPost['Imei'] ?? '';
            //$ecs_response = ecsmakePaymentAutopay($data, $data_cc);
            $ecs_response = testmakePaymentAutopay($data, $data_cc);
            $log->putLog(
                "ECSResponse: " .
                json_encode(array(
                    'request' => $ecs_response['request'],
                    'response' => $ecs_response['response'],
                ))
            );
            $msg_response = $ecs_response["response"]["CellularVoucherPurchase"]["Message"]; 

            if ($msg_response == 'APPROVED') {
                $msg[] = $this->msgResponse(
                    true,
                    'SUCCESS',
                    $ecs_response["response"]["CellularVoucherPurchase"]["Message"],
                    $ecs_response["response"]["CellularVoucherPurchase"]["PGSTransId"],
                    $ecs_response["response"]["CellularVoucherPurchase"]["PhoneNumber"],
                    $ecs_response["response"]["CellularVoucherPurchase"]["PinCode"],
                    $ecs_response["response"]["CellularVoucherPurchase"]["QRCode"],
                );
            } else {
                $msg[] = $this->msgResponse(false, 'ERROR', $msg_response, "", "");
            }

        } else {
            $order_response = 'ERROR';
        }
    
        $log->putLog("OrderResponse: " . json_encode($order_response, true));

    }

    public function processAmbassadorLandingData()
    {
        $raw = file_get_contents("php://input");
        $input = json_decode($raw, true);
        $logfile = "log_" . date('Y-m-d') . ".txt";
        $log = new Logger($logfile);
        $log->setTimestamp("Y-m-d h:i:s");
        $log->putLog("Rawdata: " . json_encode($input, true));
        //$this->checkAuthentication($arrayPost['apikey']);       

        //$sw = $input['sw'] ?? 'null';        
       
        try {
            //$jsonPost = $this->decryptData($raw, $password);
            $arrayPost = json_decode($raw, true);
            //print_r($arrayPost);
            //echo "Decrypted Data: $arrayPost\n";
            //$arrayPost = $this->decryptData($cipherText, $iv, $salt, $password, $tag);
            //$log->putLog("RawPost: " . json_encode($arrayPost, true));
            $signature_text = $arrayPost['first_name'] . " " . $arrayPost['second_name'];

            if (empty($arrayPost['first_name']) and (empty($arrayPost['second_name']))) {
                $this->msgResponse(false, 'FIELD_REQUIRED', 'There are required fields.', array()); // Exit
            }

            $data = [
                    'first_name' => $this->sanitizeInput($arrayPost['first_name'], 'string'),
                    'second_name' => $this->sanitizeInput($arrayPost['second_name'], 'string'),
                    'phone_number' => $this->sanitizeInput($arrayPost['phone_number'], 'phone'),
                    'email' => $this->sanitizeInput($arrayPost['email'], 'email'),  
                    'address1' => $this->sanitizeInput($arrayPost['address1'], 'string'),
                    'address2' => $this->sanitizeInput($arrayPost['address2'], 'string'),
                    'city' => $this->sanitizeInput($arrayPost['city'], 'string'),
                    'state' => $this->sanitizeInput($arrayPost['state'], 'string'),
                    'zipcode' => $this->sanitizeInput($arrayPost['zipcode'], 'string'),
                    "shipping_address1" => $this->sanitizeInput($arrayPost['shipping_address1'], 'string'),
                    "shipping_address2" => $this->sanitizeInput($arrayPost['shipping_address2'], 'string'),
                    "shipping_city" => $this->sanitizeInput($arrayPost['shipping_city'], 'string'),
                    "shipping_state" => strtoupper($this->sanitizeInput($arrayPost['shipping_state'], 'string')),
                    "shipping_zipcode" => $this->sanitizeInput($arrayPost['shipping_zipcode'], 'string'),
                    'area_code' => $this->sanitizeInput($arrayPost['area_code'], 'int'),
                    'store' => $this->sanitizeInput($arrayPost['store'], 'string'),
                    'promo_code' => $this->sanitizeInput($arrayPost['promo_code'], 'string'),
                    'status' => $this->sanitizeInput($arrayPost['status'], 'string'),
                    'plan' => $this->sanitizeInput($arrayPost['plan'], 'string'),
                    'utm_source' => $this->sanitizeInput($arrayPost['utm_source'], 'string'),
                    'utm_medium' => $this->sanitizeInput($arrayPost['utm_medium'], 'string'),
                    'utm_campaign' => $this->sanitizeInput($arrayPost['utm_campaign'], 'string'),
                    'utm_content' => $this->sanitizeInput($arrayPost['utm_content'], 'string'),
                    'match_type' => $this->sanitizeInput($arrayPost['match_type'], 'string'),
                    'utm_adgroup' => $this->sanitizeInput($arrayPost['utm_adgroup'], 'string'),
                    'action' => $this->sanitizeInput($arrayPost['action'], 'string')
            ];
            $log->putLog("SanitizeData: " . json_encode($data, true));

            /*Create Order ID*/
            /*******************************/
            if (!empty($data['order_id'])) {
                $order_id = $data['order_id'];
                $actionDatabase = 'updateOrder';
            } else {
                $actionDatabase = 'addOrder';
                $order_id = $this->orderModel->createOrderId();
                $data['order_id'] = $order_id;
            }
            $log->putLog("OrderID: " . json_encode($order_id, true));

           
            
            /*Test User Validation*/
            /*******************************/
            if (strtolower($data['first_name']) === "sms" && strtolower($data['second_name']) === "test") {
                $source = "QA";
                $sw = "test";
            }

            /*Duplicates records validate*/
            /*****************************/
            $count_row = $this->validateDuplicate($data);
            $log->putLog("DuplicateResponse: " . json_encode($count_row, true));
            if ($count_row['n'] > 0) {
                $this->msgResponse(false, 'Duplicate Applicant: ', 'This information has already been entered. If you believe this is a mistake, please review your information or contact us here <a href="tel:+1904-596-0304">904-596-0304</a>', '');
            } else {

               /*Create or Update Order*/
                /*******************************/
                if ($actionDatabase == 'updateOrder') {
                    $order = $this->orderModel->updateOrder($data);
                } else {                  
                    /*Create Record*/
                    $order = $this->orderModel->createOrder($data);
                   
                }
                
                if ($order == true) {
                    $order_response = 'SUCCESS';
                } else {
                    $order_response = 'ERROR';
                }

                $log->putLog("OrderResponse: " . json_encode($order, true));

                /*ECS Telgo API*/
                /*******************************/
                //$ecs_response = ECSTelgoo($data, $data_cc);
                //$ecs_response = testECSTelgoo($data, $data_cc);
                // $log->putLog(
                //     "ECSResponse: " .
                //     json_encode(array(
                //         'request' => $ecs_response['request'],
                //         'response' => $ecs_response['response'],
                //     ))
                // );
                // $msg_response = $ecs_response["response"]["CellularVoucherPurchase"]["Message"]; 
                // if ($msg_response == 'APPROVED') {
                //     $msg[] = $this->msgResponse(
                //         true,
                //         'SUCCESS',
                //         $ecs_response["response"]["CellularVoucherPurchase"]["Message"],
                //         $ecs_response["response"]["CellularVoucherPurchase"]["PGSTransId"],
                //         $ecs_response["response"]["CellularVoucherPurchase"]["PhoneNumber"]
                //     );
                // } else {
                //     $msg[] = $this->msgResponse(false, 'ERROR', $msg_response, "", "");
                // }
            }
            if ($order_response == 'SUCCESS') {
               
                $msg[] = $this->msgResponse(
                    true,
                    'SUCCESS',
                    'The record was updated/created successfully',
                    $order_id > 0 ? $order_id : null,
                    $data['phone_number']
                );

            } else {

                $msg[] = $this->msgResponse(false, 'ERROR', 'Error, the record was not updated/created', []);
                
            }

        } catch (Exception $e) {
            echo "Error: " . $e->getMessage();
        }
        
        
    }

    public function processLinkupMobileLanding()
    {
        $raw = file_get_contents("php://input");
        $arrayPost = json_decode($raw, true);
        $logfile = "log_" . date('Y-m-d') . ".txt";
        $log = new Logger($logfile);
        $log->setTimestamp("Y-m-d h:i:s");
        //$log->putLog("Rawdata: " . json_encode($raw, true));
        $this->checkAuthentication($arrayPost['apikey']);       
        $sw = $arrayPost['sw'] ?? 'null';
        $signature_text = $arrayPost['first_name'] . " " . $arrayPost['last_name'];

        if (empty($arrayPost['first_name']) and (empty($arrayPost['last_name']))) {
            $this->msgResponse(false, 'FIELD_REQUIRED', 'There are required fields.', array()); // Exit
        }

        $data = [
            'first_name' => $this->sanitizeInput($arrayPost['first_name'], 'string'),
            'second_name' => $this->sanitizeInput($arrayPost['last_name'], 'string'),
            'phone_number' => $this->sanitizeInput($arrayPost['phone_number'], 'phone'),
            'email' => $this->sanitizeInput($arrayPost['email'], 'email'),
            'area_code' => strtolower($this->sanitizeInput($arrayPost['area_code'], 'int')),
            'sim' => strtolower($this->sanitizeInput($arrayPost['sim'], 'string')),
            'address1' => $this->sanitizeInput($arrayPost['address1'], 'string'),
            'address2' => $this->sanitizeInput($arrayPost['address2'], 'string'),
            'city' => $this->sanitizeInput($arrayPost['city'], 'string'),
            'state' => $this->sanitizeInput($arrayPost['state'], 'string'),
            'zipcode' => $this->sanitizeInput($arrayPost['zipcode'], 'string'),
            "shipping_address1" => $this->sanitizeInput($arrayPost['shipping_address1'], 'string'),
            "shipping_address2" => $this->sanitizeInput($arrayPost['shipping_address2'], 'string'),
            "shipping_city" => $this->sanitizeInput($arrayPost['shipping_city'], 'string'),
            "shipping_state" => strtoupper($this->sanitizeInput($arrayPost['shipping_state'], 'string')),
            "shipping_zipcode" => $this->sanitizeInput($arrayPost['shipping_zipcode'], 'string'),
            "billing_address1" => $this->sanitizeInput($arrayPost['billing_address1'], 'string'),
            "billing_address2" => $this->sanitizeInput($arrayPost['billing_address2'], 'string'),
            "billing_city" => $this->sanitizeInput($arrayPost['billing_city'], 'string'),
            "billing_state" => strtoupper($this->sanitizeInput($arrayPost['billing_state'], 'string')),
            "billing_zipcode" => $this->sanitizeInput($arrayPost['billing_zipcode'], 'string'),
            'agree_terms' => $this->sanitizeInput($arrayPost['agree_terms'], 'string'),                  
            'utm_source' => $this->sanitizeInput($arrayPost['utm_source'], 'string'),
            'utm_medium' => $this->sanitizeInput($arrayPost['utm_medium'], 'string'),
            'utm_campaign' => $this->sanitizeInput($arrayPost['utm_campaign'], 'string'),
            'utm_content' => $this->sanitizeInput($arrayPost['utm_content'], 'string'),
            'match_type' => $this->sanitizeInput($arrayPost['match_type'], 'string'),
            'utm_adgroup' => $this->sanitizeInput($arrayPost['utm_adgroup'], 'string'),
            'plan_price' => 30,
        ];
        $log->putLog("SanitizeData: " . json_encode($data, true));
        $data_cc = [
            'card_type' => $this->sanitizeInput($arrayPost['card_type'], 'string'),
            'card_name' => $this->sanitizeInput($arrayPost['card_name'], 'string'),
            'card_number' => $this->sanitizeInput($arrayPost['card_number'], 'string'),
            'expiration_date' => date("m/y", strtotime(trim($arrayPost['expiration_date']))),
            'card_scnumber' => $this->sanitizeInput($arrayPost['card_scnumber'], 'number'),          
        ];
            
        /*Create Customer ID*/
        /*******************************/
        //if (!empty($data['customer_id'])) {
            //$customer_id = $data['customer_id'];
        //} else {
            //$customer_id = $this->orderModel->createCustomerId();
        //}
        //$data['customer_id'] = $customer_id;
        //$log->putLog("CustomerID: " . json_encode($customer_id, true));

      
        /*Test User Validation*/
        /*******************************/
        $sw = $this->sanitizeInput($arrayPost['sw'], 'string');
        $origin = $this->sanitizeInput($arrayPost['origin'], 'string');
        $url = $this->sanitizeInput($arrayPost['url'], 'string');
        if (strtolower($data['first_name']) === "sms" && strtolower($data['second_name']) === "test") {
            $source = "QA";
            $sw = "test";
        }

        /*Duplicates records validate*/
        /*****************************/
        $count_row = $this->validateDuplicate($data);
        $log->putLog("DuplicateResponse: " . json_encode($count_row, true));
        if ($count_row['n'] > 0) {
            $this->msgResponse(true, 'Duplicate', '', '');
        } else {

            $zip_data = getCoverage($data['zipcode'], 'ACP');
            $json = json_decode($zip_data, true);
            $zipcode_data = [
                'zipcode_valid' => $json['valid'],
                'zipcode_state' => $json['state'],
                'carrier' => $json['carrier'],
                'company_2' => $json['company'],
            ];
            /*Apply the Action Update/Insert*/
            /*******************************/
           if ($zipcode_data['zip_type'] == "PO BOX") {

                $order_status = ($zipcode_data['zip_type'] == "PO BOX") ? $zipcode_data['zip_type'] . ' Zipcode' : $zipcode_data['zipcode_state'] . ' State';
      
            } else {
                //$order = $this->orderModel->createOrder($data);
                $order = true;
            }

            if ($order == true) {
                $order_response = 'SUCCESS';
            } else {
                $order_response = 'ERROR';
            }

            $log->putLog("OrderResponse: " . json_encode($order, true));


            /*ECS Telgo API*/
            /*ECS Telgo API*/
            /*******************************/
            $ecs_response = testECSTelgoo($data, $data_cc);
            $log->putLog(
                "ECSResponse: " .
                json_encode(array(
                    'request' => $ecs_response['request'],
                    'response' => $ecs_response['response'],
                ))
            );
            if ($order_response == 'SUCCESS') {
                $msg[] = $this->msgResponse(
                    true,
                    'SUCCESS',
                    $ecs_response["response"]["CellularVoucherPurchase"]["Message"],
                    $customer_id,
                    $ecs_response["response"]["CellularVoucherPurchase"]["PGSTransId"],
                    $ecs_response["response"]["CellularVoucherPurchase"]["Message"]
                );
            } else {
                $msg[] = $this->msgResponse(false, 'ERROR', 'Error: The record was not updated or created', "","", $order_status);
            }
        }
    }

    public function testECSTelgoo(){

        $logfile = "log_test" . date('Y-m-d') . ".txt";
        $log = new Logger($logfile);
        $log->setTimestamp("Y-m-d h:i:s");
        $ecs_response = testECSTelgoo('', '');
        $log->putLog(
            array(
                'customer_id' => "",
                'request' => $ecs_response['request'],
                'response' => json_encode($ecs_response['response']),
            )
        );

        $msg[] = $this->msgResponse(
            true,
            'SUCCESS',
            $ecs_response["response"]["CellularVoucherPurchase"]["Message"],
            "12345",
            $ecs_response["response"]["CellularVoucherPurchase"]["PGSTransId"],
            $ecs_response["response"]["CellularVoucherPurchase"]["Message"]
        );
        
    }

    public function verifyDuplicateRecord()
    {
        $raw = file_get_contents("php://input");
        $arrayPost = json_decode($raw, true);

        $this->CheckAuthentication($arrayPost['apikey']); // Error-Exit / True-continue

        if (empty($arrayPost['phone_number'])) {
            $this->msgReturn_getIntems(false, 'FIELD_REQUIRED', 'There are required fields.', array()); // Exit
        }
        $cleanphone = preg_replace('/[^0-9]/', '', $arrayPost['phone_number']);
        if ($cleanphone[0] == 1) {
            $phone_number  =  $cleanphone[1] . $cleanphone[2] . $cleanphone[3] . $cleanphone[4] . $cleanphone[5] . $cleanphone[6] . $cleanphone[7] . $cleanphone[8] . $cleanphone[9] . $cleanphone[10];
        } else {
            $phone_number = $cleanphone;
        }
        $data = array(
            'numSimLinkup' => $phone_number
        );

        $orders = $this->orderModel->validateLinkupPhoneNumber($phone_number);
        if (!empty($orders)) {
            $this->msgReturn_getIntems(true, 'SUCCESS', '', $orders);
        } else {
            $resEcsInfo = GetCustomerInfoLinkupPhone($data);
            $Message = $resEcsInfo['response']['CellularVoucherPurchase']['Message'];
            $phone_numberLink = $resEcsInfo['response']['CellularVoucherPurchase']['phone_number'];
            $response = array(
                'message' => $Message,
                'phone_number' => $phone_numberLink
            );
            if ($Message == "PHONE NOT FOUND") {
                $this->msgReturn_getIntems(false, 'NO_RECORD_FOUND', 'No phone number found.', array());
            } else {
                $this->msgReturn_getIntems(true, 'SUCCESS', '', $response);
            }
        }
    }
   
    public function msgResponse($status, $msg, $msgDetail='',$orderID = '', $phone = '')
    {
        $return = array();
        $return['status'] = $status;
        $return['msg'] = $msg;
        $return['msgDetail'] = $msgDetail;
        $return['TransId'] = $orderID;
        $return['PhoneNumber'] = $phone;
        $return['customerIdncrypt']  = (!empty($orderID)) ? encrypt_decrypt('encrypt', $orderID) : null;
        echo json_encode($return);
        exit();

    }

    public function validateDuplicate($data){

        if (strtolower($data['first_name']) == "lmweb" && strtolower($data['second_name']) == "test") {

            $count_row['n'] = 0;

        } else if ($data['action'] == "update") {

            $count_row['n'] = 0;

        } else {

            $count_row = $this->orderModel->checkDuplicateOrder($data);
            //$count_row['n'] = 0;
        }
        return $count_row; 
    }

    public function sanitizeInput($input, $type)
    {

        if(isset($input) && !empty($input)) {
            switch ($type) {
                case 'string':
                    // Sanitize string: Trim, remove HTML tags, escape HTML characters
                    $input = trim($input);
                    $input = strip_tags($input); // Removes HTML and PHP tags
                    return htmlspecialchars($input, ENT_QUOTES, 'UTF-8');

                case 'email':
                    // Sanitize email
                    return filter_var($input, FILTER_SANITIZE_EMAIL);

                case 'phone':
                    // Sanitize phone
                    $cleanphone= preg_replace('/[^0-9]/', '', $input);
                    $phone = trim($cleanphone);
                    return $phone;

                case 'url':
                    // Sanitize URL
                    return filter_var($input, FILTER_SANITIZE_URL);

                case 'int':
                    // Sanitize integer
                    return filter_var($input, FILTER_SANITIZE_NUMBER_INT);

                case 'float':
                    // Sanitize float
                    return filter_var($input, FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);

                case 'boolean':
                    // Sanitize boolean
                    return filter_var($input, FILTER_VALIDATE_BOOLEAN);

                case 'csrf':
                    // Check CSRF token (assumes token is stored in session)
                    session_start(); // Start session if not started
                    if ($input !== $_SESSION['csrf_token']) {
                        die("CSRF token validation failed");
                    }
                    return $input;

                default:
                    // Return unmodified input if type is unknown
                    return $input;
            }
        } else {
             return $input= '';
        }
    }

    public function checkAuthentication($Apikey)
    {
        // $headers = getallheaders();
        // $Apikey = $headers['Apikey'];
        if (!isset($Apikey) || strlen($Apikey) <> 32) {
            $this->authenticateError();
        }
        // Decode base64-encoded username and password
        list($username, $password) = explode(':', base64_decode($Apikey));
        $validUsername = 'Surgepays24';
        $validPassword = 'W!2m6@Jy8AQd';
        if ($username !== $validUsername || $password !== $validPassword) {
            $this->authenticateError();
        }
        // Authentication successful - continue
        // echo 'Authentication successful!';
    }
    
    public function authenticateError()
    {
        echo json_encode(array("status" => false, "msg" => 'Unauthorized'));
        exit;
    }

    public function decryptData($jsonInput, $password)
    {
        $iterations = 100000; // PBKDF2 iterations

        // Parse the JSON input
        $data = json_decode($jsonInput, true);
        //print_r($data);
        if (!isset($data['cipherText'], $data['iv'], $data['salt'])) {
            throw new InvalidArgumentException('Invalid input data: Missing required fields.');
        }

        // Convert numeric arrays to binary strings
        $cipherText = pack('C*', ...$data['cipherText']);
        $iv = pack('C*', ...$data['iv']);
        $salt = pack('C*', ...$data['salt']);

        // Validate IV length
        if (strlen($iv) !== openssl_cipher_iv_length('aes-256-gcm')) {
            throw new InvalidArgumentException('Invalid IV length.');
        }

        // Derive the encryption key using PBKDF2
        $key = hash_pbkdf2('sha256', $password, $salt, $iterations, 32, true);

        // Decrypt the data
        $tag = substr($cipherText, -16); // Extract the last 16 bytes as the tag
        $cipherText = substr($cipherText, 0, -16); // Remove the tag from the ciphertext

        $decryptedData = openssl_decrypt($cipherText, 'aes-256-gcm', $key, OPENSSL_RAW_DATA, $iv, $tag);

        if ($decryptedData === false) {
            throw new RuntimeException('Decryption failed: ' . openssl_error_string());
        }

        return $decryptedData;
    }

    public function getAreaCode($phone)
    {
        $digits = preg_replace('/\D+/', '', $phone);
        return strlen($digits) >= 3 ? substr($digits, 0, 3) : null;
    }

    function decryptField(string $b64): string
    {
        $key = substr(hash('sha256', CARD_ENCRYPTION_KEY, true), 0, 32); // 32 bytes
        $raw = base64_decode($b64);
        $iv  = substr($raw, 0, 16);
        $ciphertext = substr($raw, 16);
        return openssl_decrypt($ciphertext, 'AES-256-CBC', $key, OPENSSL_RAW_DATA, $iv);
    }

}
