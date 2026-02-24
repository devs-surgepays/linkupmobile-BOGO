<?php require APPROOT . '/views/inc/header.php';
//print("<pre>" . print_r($data, true) . "</pre>");
$saInformation = (isset($data['saInformation']) && $data['saInformation'] != NULL) ? json_decode($data['saInformation'], true) : [];
$infoPlan = (isset($data['infoPlan']) && $data['infoPlan'] != NULL) ? $data['infoPlan'] : [];

?>
<section>

    <style>
        .table th {
            padding: 9px !important;
        }

        .currency {
            font-size: 0.85714em;
            vertical-align: 0.2em;
            margin-right: 0.5em;
        }

        .total {
            font-size: 1.71429em;
            font-weight: 600;
            letter-spacing: -0.04em;
            line-height: 1em;
            color: #323232;
        }

        .subt {
            text-align: right;
        }

        .discount {
            font-size: 20px;
        }
    </style>
    <div class="container">
        <div class="row pt-5" id="checkout-form">
            <div class="col-md-6 col-sm-12">
                <h1>Checkout</h1>
                <p>Contact Information</p>
                <div class="row">
                    <div class="mb-3 text-left col-lg-12 col-xs-12">
                        <input type="text" disabled name="email" class="form-control" id="email" placeholder="Email*" value="<?php echo $data['email']; ?>" required="">
                    </div>
                </div>
                <div class="row">
                    <div class="mb-3 text-left col-lg-6 col-xs-12">
                        <label for="FirstName">First Name</label>
                        <input type="text" name="firstName" class="form-control" id="firstName" placeholder="First Name*" value="<?php echo $data['first_name']; ?>" required="">
                    </div>
                    <div class="mb-3 text-left col-lg-6 col-xs-12">
                        <label for="LastName">Last Name</label>
                        <input type="text" name="lastName" class="form-control" id="lastName" placeholder="Last Name*" value="<?php echo $data['second_name']; ?>" required="">
                    </div>
                </div>
                <div class="row">
                    <div class="mb-2 text-left col-lg-12 col-xs-12">
                        <p class="mb-0">Billing Address</p>
                    </div>
                </div>
                <div class="row">
                    <div class="mb-3 text-left col-lg-12 col-xs-12">
                        <label for="addressLine1">Address Line 1</label>
                        <input type="text" name="baddressLine1" class="form-control" id="baddressLine1" placeholder="Address Line 1*" value="<?php echo $data['address1']; ?>" required="">
                    </div>
                </div>
                <div class="row">
                    <div class="mb-3 text-left col-lg-12 col-xs-12">
                        <label for="addressLine2">Address Line 2</label>
                        <input type="text" name="baddressLine2" class="form-control" id="baddressLine2" placeholder="Address Line 2*" value="<?php echo $data['address2']; ?>" required="">
                    </div>
                </div>
                <div class="row">
                    <div class="mb-3 text-left col-lg-12 col-xs-12">
                        <label for="city">City</label>
                        <input type="text" name="bcity" class="form-control" id="bcity" placeholder="City*" value="<?php echo $data['city']; ?>" required="">
                    </div>
                </div>
                <div class="row">
                    <div class="mb-3 text-left col-lg-6 col-xs-12">
                        <label for="state">State</label>
                        <input type="text" name="bstate" class="form-control" id="bstate" placeholder="State*" value="<?php echo $data['state']; ?>" required="">
                    </div>
                    <div class="mb-3 text-left col-lg-6 col-xs-12">
                        <label for="zipcode">Zip Code</label>
                        <input type="text" name="bzipcode" class="form-control" id="bzipcode" placeholder="Zip Code*" value="<?php echo $data['zipcode']; ?>" required="">
                    </div>
                </div>
                <div class="row">
                    <div class="mb-3 text-left col-lg-12 col-xs-12">
                        <label for="mailing_address">Phone Number</label>
                        <input type="text" disabled name="phoneNumer" class="form-control" id="phoneNumer" placeholder="Phone Numer*" value="<?php echo $data['phone_number']; ?>" required="">
                    </div>
                </div>

                <?php if (!empty($data['billing_address1'])) { ?>
                    <div class="row form-check">
                        <div class="mb-3 text-left col-lg-12 col-xs-12">
                            <input class="form-check-input" type="checkbox" disabled checked name="mailing_address" id="mailing_address" value="1" required="">
                            <label class="form-check-label" for="mailing_address">Use different Address for Billing</label>

                        </div>
                    </div>
                    <div class="row">
                        <div class="mb-3 text-left col-lg-12 col-xs-12">
                            <label for="mailing_address1">Billing Street Address</label>
                            <input type="text" disabled name="mailing_address1" class="form-control" id="mailing_address1" placeholder="Mailing Address" value="<?php echo $data['billing_address1']; ?>" required="">
                        </div>
                    </div>
                    <div class="row">
                        <div class="mb-3 text-left col-lg-12 col-xs-12">
                            <label for="mailing_address2">Billing Street Apartmrnt # or Suite #</label>
                            <input type="text" disabled name="mailing_address2" class="form-control" id="mailing_address2" placeholder="Mailing address" value="<?php echo $data['billing_address2']; ?>" required="">
                        </div>
                    </div>
                    <div class="row">
                        <div class="mb-3 text-left col-lg-12 col-xs-12">
                            <label for="mailing_city">Billing City</label>
                            <input type="text" disabled name="mailing_city" class="form-control" id="mailing_city" placeholder="Mailing City" value="<?php echo $data['billing_city']; ?>" required="">
                        </div>
                    </div>
                    <div class="row">
                        <div class="mb-3 text-left col-lg-6 col-xs-12">
                            <label for="mailing_state">Billing Sate</label>
                            <input type="text" disabled name="mailing_state" class="form-control" id="mailing_state" placeholder="Mailing State" value="<?php echo $data['billing_state']; ?>" required="">
                        </div>
                        <div class="mb-3 text-left col-lg-6 col-xs-12">
                            <label for="mailing_zipcode">Billing Zip Code</label>
                            <input type="text" disabled name="mailing_zipcode" class="form-control" id="mailing_zipcode" placeholder="Mailing Zipcode" value="<?php echo $data['billing_zipcode']; ?>" required="">
                        </div>
                    </div>
                <?php } ?>
            </div>
            <div class="col-md-6 col-sm-12">

                <div class="card ">
                    <div class="card-body">
                        <h4 class="chplan-name">Order Summary</h2>
                            <hr style="width: 100%">
                            <table class="table chekcout-table">
                                <tbody>
                                    <tr>
                                        <th width="50%"><?php echo 'Plan: ' . $infoPlan['name']; ?><br><small style="font-weight: 100;"><?php echo $infoPlan['data']; ?> a month*</small></th>
                                        <th class="qty">Qty:<?php echo $data['number_of_lines']; ?></th>
                                        <th class="subt" id="subt" style="text-align: right"><span class="currency">USD</span> $<?php echo number_format($infoPlan['price'], 2, '.', '')  ?></th>
                                    </tr>
                                    <tr>
                                        <th colspan="2">Three months of service</th>
                                        <th colspan="2" class="subt" id="subt" style="text-align: right"><span class="currency">USD</span> $<?php echo number_format($infoPlan['promo_price'], 2, '.', '')  ?></th>
                                    </tr>
                                    <tr id="couponDiscount" style="font-weight:700">
                                        <td colspan="2">Taxes</td>
                                        <td colspan="2" class="subt"><span class="currency">USD</span><span class="discount"> $<?php echo number_format($data['infoTax']['TotalTax'], 2, '.', '')  ?></span></td>
                                    </tr>
                                    <tr style="font-weight:700">
                                        <td colspan="2">Total</td>
                                        <td colspan="2" class="subt" id="total"><span class="currency">USD</span><span id="totalPay" class="total">$<?php echo number_format($data['total'], 2, '.', '') ?></span></td>
                                    </tr>

                                </tbody>
                                <tfoot>
                                    <!-- <tr>
                                        <td colspan="4">
                                            <label for="tc">
                                                <input type="checkbox" id="tc" name="tc" value="accepted" style="margin-right: 10px;text-align: justify; font-size: 14px;">
                                                I acknowledge and agree to the <a href="<?php echo "https://$_SERVER[HTTP_HOST]/" . $data['origin']; ?>/terms/" target="_blank">TERMS&nbsp;OF&nbsp;SERVICE</a></label>
                                        </td>
                                    </tr> -->
                                </tfoot>
                            </table>
                            <div class="row mt-2">
                                <div class="col-md-12 col-sm-12">
                                    <p class="mb-0" style="font-size: smaller !important;">*To activate the program, you must purchase 3 months of service upfront. <strong>The 4th month of service is included at no cost.</strong> After that, you will be billed $40 a month for 30GB of data.</p>
                                </div>
                            </div>

                            <div class="row mt-4">
                                <div class="col-md-12 col-sm-12">
                                    <?php
                                    foreach ($data as $key => $value) {
                                        $safeKey = htmlspecialchars($key);
                                        if (is_array($value)) {
                                            $safeValue = htmlspecialchars(json_encode($value)); // o usar implode si es un array simple
                                        } else {
                                            $safeValue = htmlspecialchars((string)$value);
                                        }
                                        echo "<input type=\"hidden\" name=\"$safeKey\" id=\"$safeKey\" value=\"$safeValue\">" . PHP_EOL;
                                    }
                                    ?>
                                    <input type="hidden" name="idPlan" id="idPlan" value="<?php echo $data['IdPlan']; ?>">
                                    <input type="hidden" name="plan" id="plan" value="<?php echo $infoPlan['name']; ?>">
                                    <input type="hidden" name="dataValue" id="dataValue" />
                                    <input type="hidden" name="dataDescriptor" id="dataDescriptor" />
                                    <input type="hidden" name="number_of_lines" id="number_of_lines" value="<?php echo $data['number_of_lines']; ?>">
                                    
                                     <input type="hidden" id="plan_price" value="<?php echo $infoPlan['price']; ?>">

                                    <input type="hidden" id="regularPrice" value="<?php echo number_format($data['total'], 2, '.', '') ?>">
                                    
                                    <input type="hidden" id="promoPrice" value="<?php echo number_format($infoPlan['promo_price'], 2, '.', '') ?>">
                                    <input type="hidden" id="taxes" value="<?php echo number_format($data['infoTax']['TotalTax'], 2, '.', '') ?>">
                                    


                                    <div class="d-block">
                                        <button class="AcceptUI btn btn-block btn-warning mb-3 text-white btn-creditcard" style="border-radius:10px;background-color:  #ffc439;font-size: 22px;font-weight: 600" data-billingAddressOptions='{"show":false, "required":false}' data-apiLoginID="<?php echo API_LOGIN_ID; ?>" data-clientKey="<?php echo CLIENT_KEY; ?>" data-acceptUIFormBtnTxt="Submit" data-acceptUIFormHeaderTxt="Card Information" data-paymentOptions='{"showCreditCard": true, "showBankAccount": false}' data-responseHandler="responseHandler">
                                            Credit Card
                                        </button>
                                    </div>
                                    <div class="d-block">
                                        <small style="font-size: smaller !important; color:red;">Please make sure the billing address you enter matches the one linked to your credit card, or the transaction may be declined for security reasons.</small>

                                    </div>

                                </div>

                            </div>
                            <div class="row">
                                <div class="col">
                                    <div id="receipt" style="margin-bottom: 0;"></div>
                                </div>
                            </div>
                    </div>
                </div>
                <div id="response" class="mt-3"></div>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="noPaymentModal" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="noPaymentModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="noPaymentModalLabel">Heads Up!</h5>
                    <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                    </button>
                </div>
                <form id="form-notify" method="post">
                    <div class="modal-body">
                        <span>We couldn’t process your card.
                            Would you like to try again or continue with the “Get a Free Phone or SIM Card” option?</span>
                        <!-- <div class="pt-1" id="spinnginresponse"></div> -->
                        <input type="hidden" id="jsonPResponse" name="jsonPResponse" value="">
                    </div>
                    <div id="btnModalNotify" class="modal-footer">
                        <button type="button" class="btn btn-success" data-dismiss="modal">Try again</button>
                        <button type="submit" class="btn btn-primary" id="continueFreePhone">Get a Free Phone or SIM Card</button>
                    </div>
                </form>
            </div>
        </div>
    </div>


    <script type="text/javascript" src="<?php echo ACCEPTURL; ?>" charset="utf-8"></script>
    <script src="https://www.paypalobjects.com/api/checkout.js"></script>

</section>

<?php require APPROOT . '/views/inc/footer.php'; ?>

<script type="text/javascript">
    $(document).ready(function(e) {

        $("#continueFreePhone").click(function(event) {
            event.preventDefault();
            console.log('FreePhone PackageID 1614');

            var error = $('#jsonPResponse').val();

            // Initialize the object 
            let t_response = {
                transactionResponse: {
                    transId: "",
                    responseCode: "",
                    messages: {
                        message: [{
                            text: error
                        }]
                    }
                }
            };

            submitStep3({}, '1614');
        });
    });

    function messageFunc(msg) {
        var classF;
        responseObj = JSON.parse(msg);
        console.log(responseObj);
        let packageID = '1680';

        if (responseObj.errorInternal) {
            $(".btn-creditcard").show();
            classF = "danger";
            message = "<p style='margin-bottom:0;'>Transaction Unsuccessful: " + responseObj.errorInternal.message + "</p>";
            console.log("noPaymentModal");
            $('#jsonPResponse').val(responseObj.errorInternal.message);
            //$('#noPaymentModal').modal('show');

        } else {
            if (responseObj.transactionResponse) {
                console.log("oneTime Payment")
                if (responseObj.messages.resultCode == "Ok") {
                    if (responseObj.transactionResponse.errors != null) { //to do: take care of errors[1] array being parsed into single object
                        classF = "danger";
                        message = "<p style='color:#ff0018;font-size: 25px;'>" + responseObj.transactionResponse.errors.error.errorText + "<br>";
                    } else {
                        classF = "success";
                        message = "<p style='color: #007bff;font-weight: 500;font-size: 20px;'>Your payment has been processed successfully! <br>Transaction ID: " + responseObj.transactionResponse.transId + "</p>";
                        //submitStep3(responseObj, packageID);
                        setTimeout(function() {
                            window.location.href = '/thankyou/';;
                        }, 1000);
                        
                    }

                } else {
                    classF = "danger";
                    message = "<p style='color:#ff0018;font-size: 25px;'>Transaction Unsuccessful.<br>"; //+responseObj.messages.message[0].text;
                    if (responseObj.transactionResponse.errors != null) //to do: take care of errors[1] array being parsed into single object
                    {
                        message += responseObj.transactionResponse.errors.error.errorText;
                    }

                    if (responseObj.transactionResponse.transId != null) {
                        message += "</p>";

                    }
                }

            } else if (responseObj.messages) {
                console.log("subscription Payment")
                if (responseObj.messages.resultCode == "Ok") {
                    message = "<p style='color: #007bff;font-weight: 500;'>Your payment has been processed successfully! <br>Subscription ID: " + responseObj.subscriptionId + "</p>";
                        setTimeout(function() {
                            window.location.href = '/thankyou/';;
                        }, 1000);
                } else {
                    message = "<p style='color:#ff0018; font-size: 25px;'>Transaction Unsuccessful: " + responseObj.messages.message.text + "</p>";
                }
            }

        }

        console.log(classF + message);

        $("#receipt").removeClass('alert alert-warning').addClass("alert alert-" + classF);
        $('#receipt').html(message);
        $("#receipt").focus();
    }

    function createTransactCopy(dataObj) {
        console.table(dataObj);
    }

    function createTransact(dataObj) {
        console.table(dataObj);
        console.log(dataObj)
        var priceplan = $("#plan_price").val();
        var amount = $("#regularPrice").val();
        var promoprice = $("#promoPrice").val();
        var taxes = $("#taxes").val();
        //const checkbox = document.querySelector("#autopay");
        //console.log(checkbox.checked)
        /*if (checkbox.checked) {
            var subscription = 'Yes';
            var url = '/Authorizenets/createSubscription';
        } else {}*/
        var subscription = 'No';
        var url = '/Authorizenets/singlePayment/';

        var fields = {
            "planPrice": priceplan,
            "amount": amount,
            "price": promoprice,
            "taxes": taxes,
            "autoPay": subscription,
            "dataDesc": dataObj.dataDescriptor,
            "dataValue": dataObj.dataValue,
            "orderId": $("#order_id").val(),
            "IdPlan": $("#idPlan").val(),
            "plan": $("#plan").val(),
            "firstName": $("#first_name").val(),
            "lastName": $("#second_name").val(),
            "email": $("#email").val(),
            "phoneNumber": $("#phone_number").val(),
            "address": $("#baddressLine1").val(),
            "address2": $("#baddressLine2").val(),
            "city": $("#bcity").val(),
            "state": $("#bstate").val(),
            "zipcode": $("#bzipcode").val(),
            "number_of_lines": $("#number_of_lines").val()
        }
        console.log(fields)

        $.ajax({
            url: url,
            data: fields,
            method: 'POST',
            beforeSend: function() {
                $("#receipt").addClass("alert alert-warning");
                $("#receipt").html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Please wait, your payment is being processed. Do not refresh or leave the page.');
                $(".btn-creditcard").hide();
                $("#receipt").removeClass('alert-danger alert').addClass("alert alert-warning");

            },
            success: function(response) {
                console.log(response)
                messageFunc(response);
            }

        });

    }
    // Process the response from Authorize.Net to retrieve the two elements of the payment nonce.
    // If the data looks correct, record the OpaqueData to the console and call the transaction processing function.
    function responseHandler(response) {
        if (response.messages.resultCode === 'Error') {
            for (var i = 0; i < response.messages.message.length; i++) {
                console.log(response.messages.message[i].code + ':' + response.messages.message[i].text);
            }
            createTransact(response);
            console.log("acceptJS library error!");
        } else {
            console.log(response.opaqueData.dataDescriptor);
            console.log(response.opaqueData.dataValue);
            createTransact(response.opaqueData);
        }
    }

    function submitStep3(t_response, packageID) {

        let transId = t_response?.transactionResponse?.transId;
        let accountNumber = t_response?.transactionResponse?.accountNumber;
        let accountType = t_response?.transactionResponse?.accountType;
        let pay_authcode = t_response?.transactionResponse?.authCode;
        let pay_transmessage = t_response?.transactionResponse?.messages?.message?.description;
        let pay_message = t_response?.messages?.message?.text;

        var img_gob = $("#img_gob").val();
        var img_pob = $("#img_pob").val();
        var param1 = JSON.stringify({
            "apikey": "U3VyZ2VwYXlzMjQ6VyEybTZASnk4QVFk",
            "currentStep": 2,
            "first_name": $('#first_name').val(),
            "middle_name": $('#middle_name').val(),
            "second_name": $('#second_name').val(),
            "suffix": $('#suffix').val(),
            "phone_number": $('#phone').val(),
            "email": $('#email').val(),
            "program_benefit": $("#program_benefit").val(),
            "program_before": $("#program_before").val(),
            "program": $('#program').val(),
            "medicalSubscriberId": $('#medicalSubscriberId').val(),
            "tribal_id": $('#tribal_id').val(),
            "dob": $('#dob').val(),
            "ssn": $('#ssn').val(),
            "address1": $('#street_address1').val(),
            "address2": $('#address2').val(),
            "city": $('#locality').val(),
            "state": $('#state').val(),
            "zipcode": $('#zipcode').val(),
            "shipping_address1": $('#shipping_address1').val(),
            "shipping_address2": $('#shipping_address2').val(),
            "shipping_city": $('#shipping_city').val(),
            "shipping_state": $('#shipping_state').val(),
            "shipping_zipcode": $('#shipping_zipcode').val(),
            "source": $('#source').val(),
            "company": $('#company').val(),
            "current_benefits": $('#current_benefits').val(),
            "phone_type": $('#phone_type').val(),
            "agree_terms": $('#agree_terms').val(),
            "agree_sms": $('#agree_sms').val(),
            "agree_email": $('#agree_email').val(),
            "transferconsent": $('#transferconsent').val(),
            "agree_pii": $('#agree_pii').val(),
            "utm_source": $("#utm_source").val(),
            "utm_medium": $("#utm_medium").val(),
            "utm_campaign": $("#utm_campaign").val(),
            "utm_content": $("#utm_content").val(),
            "match_type": $("#match_type").val(),
            "utm_adgroup": $("#utm_adgroup").val(),
            "customer_id": $("#customer_id").val(),
            "sw": $('#sw').val(),
            "origin": $("#origin").val(),
            "order_step": 'Step3',
            "url": $("#url").val(),
            "anotheradult": $("#anotheradult").val(),
            "shareincome": $("#shareincome").val(),
            "signingPowerAttorney": $("#signingPowerAttorney").val(),
            "img_gob": img_gob,
            "pob_name": $("#pob_name").val(),
            "pay_message": pay_message,
            "pay_authcode": pay_authcode,
            "pay_transid": transId,
            "pay_accountnumber": accountNumber,
            "pay_accounttype": accountType,
            "pay_transmessage": pay_transmessage,
            "checkoutpackage": packageID,
            "number_of_lines": $("#number_of_lines").val()
        });

        console.log("Parmeters", param1);

        var urlEndPoint = '<?php echo URLROOT; ?>Orders/processSNAPOrder';
        $.ajax({
            type: "POST",
            url: urlEndPoint,
            data: param1,
            dataType: "json",
            contentType: "application/json",
            beforeSend: function() {
                $("#response").html('<div class="alert alert-primary d-flex justify-content-center align-items-center" role="alert"><span class="spinner-border" role="status" aria-hidden="true" style="width: 3rem; height: 3rem; margin-right: 1rem;"></span><div> Please wait, this take 1-2 minutes to complete. Do not refresh or leave the page. </div></div>');
                $("a[href='#finish']").addClass("visited");
                $('.actions > ul > li:last-child').attr('style', 'background: #CCC !important;');
                $('.actions > ul > li:last-child').attr('style', 'border: 0px !important;');

            },
            success: function(response) {

                console.log('Step3 response: ', response);

                var list = '';
                var msg_detail
                if (response.msgDetail != "") {
                    msg_detail = response.msgDetail;
                } else {
                    msg_detail = "Error: It looks like there is a error.";
                }

                if (response.msg == 'Duplicate') {

                    $("a[href='#finish']").removeClass("visited");
                    list = '<div class="alert alert-warning d-flex justify-content-center align-items-center" role="alert"><h4 class="msg-cal"><i class="fa fa-exclamation-triangle"></i> Duplicate Applicant: This information has already been entered. If you believe this is a mistake, please review your information or contact us here <a href="tel:+1866-372-0619">866-372-0619</a></h4></div>';

                } else if (response.msg == 'shockwaveDuplicate') {

                    $("a[href='#finish']").removeClass("visited");
                    list = '<div class="alert alert-warning d-flex justify-content-center align-items-center" role="alert"><h4 class="msg-cal"><i class="fa fa-exclamation-triangle"></i> Duplicate Applicant: ' + response.msgDetail + '<br> Please review your information or contact us here <a href="tel:+1866-372-0619">866-372-0619.</a></h4></div>';

                } else if (response.msg == "SUCCESS") {

                    list = '<div class="alert alert-success d-flex justify-content-center align-items-center" role="alert"><h4 class="msg-cal"> Success: The information has been sent</h4></div>';
                    $("#response").html(list);

                    $('#noPaymentModal').modal('hide');

                    let currentUrl = window.location.href;

                    if (currentUrl.includes("AMBT")) {

                        // Redirigir a la URL con "/thanks"
                        setTimeout(function() {
                            window.location.href = 'https://usaphone.org/AMBT/thankyou' + '?c_id=' + response.customerIdncrypt;
                        }, 1000);

                    } else if (currentUrl.includes("Torch")) {

                        // Redirigir a la URL con "/thanks"
                        setTimeout(function() {
                            window.location.href = 'https://usaphone.org/Torch/thankyou';
                        }, 1000);

                    } else {

                        setTimeout(function() {
                            window.location.href = '/thankyou/' + '?c_id=' + response.customerIdncrypt;
                        }, 1000);
                    }

                } else {

                    $("a[href='#finish']").removeClass("visited");
                    list = '<div class="alert alert-danger d-flex justify-content-center align-items-center" role="alert"><h4 class="msg-cal">' + msg_detail + '</h4></div>';
                }

                $("#response").html(list);
            },
            complete: function(data) {}
        });
    }
</script>