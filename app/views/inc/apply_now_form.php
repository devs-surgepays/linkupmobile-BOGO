<form action="" class="form-floating" method="post" enctype="multipart/form-data" id="demographic" autocomplete="off" data-customerid="">
    <div id="wizard">
        <section data="newone">
            <div class="row justify-content-md-center">
                <div class="col-lg-10 col-xs-12 mt-2">
                    <div class="card car-wrapp cp-c cm-c">
                        <div class="card-body container">
                            <div class="row">
                                <div class="mb-3 text-left col-lg-6 col-xs-12">
                                    <!--<label for="fname" class="form-label">First Name*</label>-->
                                    <input type="text" name="first_name" class="form-control form-control-lg" id="fname"
                                        placeholder="First Name*" required>
                                </div>
                                <div class="mb-3 text-left col-lg-6 col-xs-12">
                                    <!--<label for="lname" class="form-label">Last Name*</label>-->
                                    <input type="text" name="last_name" class="form-control form-control-lg" id="lname"
                                        placeholder="Last Name*" required>
                                </div>
                            </div>
                            <div class="row">
                                <div class="mb-3 text-left col-lg-6 col-xs-12">
                                    <!--<label for="phone" class="form-label">Mobile&nbsp;Number*</label>-->
                                    <input class="form-control form-control-lg phone" id="phone" name="phone"
                                        type="text" placeholder="Contact Number*" required>
                                    <div id="error-phone"></div>
                                </div>
                                <div class="mb-3 text-left col-lg-6 col-xs-12">
                                    <!--<label for="email" class="form-label">Email*</label>-->
                                    <input type="text" id="email" class="form-control form-control-lg" name="email"
                                        placeholder="Email*" value="" required>
                                    <div id="error-email"></div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="mb-3 text-left col-lg-6 col-xs-12">
                                    <!--<label for="ssn" class="form-label">Last 4 of SSN*</label>-->
                                    <input type="text" class="form-control form-control-lg" id="areacode" name="areacode"
                                        placeholder="Area Code*" required>
                                    <div id="error-area"></div>
                                </div>
                            </div>
                            <!-- <div class="row">
                                <div class="mb-3 text-left col-lg-12 col-xs-12">
                                    <input type="text" class="form-control form-control-lg" id="sim" name="sim"
                                        placeholder="SIM (20 digits)*" required>
                                    <div id="error-area"></div>
                                </div>
                            </div> -->

                            <!-- <div class="row">
                                <div class="mb-3 text-left col-lg-12 col-xs-12">
                                    <label for="postcodeRes" class="form-label">Zipcode</label>
                                    <input disabled type="number" class="form-control form-control-lg" id="postcodeRes"
                                        name="postcodeRes" placeholder="Zipcode*" value="<? // echo $data['zipcode']; 
                                                                                            ?>">
                                    <div id="error-postcodeRes"></div>
                                </div>
                            </div> -->

                            <div class="row">
                                <div class="mb-3 text-left col-lg-12 col-xs-12">
                                    <label for="street_address1" class="form-label">Residence Address*</label>
                                    <input type="text" name="street_address1" class="form-control form-control-lg"
                                        id="street_address1" autocomplete="off" required>
                                    <div id="poboxwarn"></div>
                                </div>
                                <div class="mb-3 text-left col-lg-12 col-xs-12">
                                    <!--<label for="address2" class="form-label">Apartment # or Suite #</label>-->
                                    <input type="text" name="address2" class="form-control form-control-lg"
                                        id="address2" placeholder="Apartment # or Suite #">
                                </div>
                                <div class="mb-3 text-left col-lg-12 col-xs-12">
                                    <div class="input-group">
                                        <input type="number" class="form-control form-control-lg" id="postcode" name="postcode" placeholder="Zipcode*" value="">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="mb-3 text-left col-lg-6 col-xs-12">
                                    <!--<label for="locality" class="form-label">City</label>-->
                                    <input type="text" class="form-control form-control-lg" id="locality"
                                        name="locality" placeholder="City*" required>
                                </div>
                                <div class="mb-3 text-left col-lg-6 col-xs-12">
                                    <!-- <label for="state" class="form-label">State</label>-->
                                    <!--<input class="form-control form-control-lg" id="state" name="state" placeholder="State*" required />-->
                                    <select class="form-control form-control-lg" name="state" id="state"
                                        aria-required="true" required>
                                        <option value="">Select State</option>
                                        <option value="AL">Alabama</option>
                                        <option value="AK">Alaska</option>
                                        <option value="AZ">Arizona</option>
                                        <option value="AR">Arkansas</option>
                                        <option value="CA">California</option>
                                        <option value="CO">Colorado</option>
                                        <option value="CT">Connecticut</option>
                                        <option value="DE">Delaware</option>
                                        <option value="DC">District of Columbia</option>
                                        <option value="FL">Florida</option>
                                        <option value="GA">Georgia</option>
                                        <option value="HI">Hawaii</option>
                                        <option value="ID">Idaho</option>
                                        <option value="IL">Illinois</option>
                                        <option value="IN">Indiana</option>
                                        <option value="IA">Iowa</option>
                                        <option value="KS">Kansas</option>
                                        <option value="KY">Kentucky</option>
                                        <option value="LA">Louisiana</option>
                                        <option value="ME">Maine</option>
                                        <option value="MD">Maryland</option>
                                        <option value="MA">Massachusetts</option>
                                        <option value="MI">Michigan</option>
                                        <option value="MN">Minnesota</option>
                                        <option value="MS">Mississippi</option>
                                        <option value="MO">Missouri</option>
                                        <option value="MT">Montana</option>
                                        <option value="NE">Nebraska</option>
                                        <option value="NV">Nevada</option>
                                        <option value="NH">New Hampshire</option>
                                        <option value="NJ">New Jersey</option>
                                        <option value="NM">New Mexico</option>
                                        <option value="NY">New York</option>
                                        <option value="NC">North Carolina</option>
                                        <option value="ND">North Dakota </option>
                                        <option value="OH">Ohio</option>
                                        <option value="OK">Oklahoma</option>
                                        <option value="OR">Oregon</option>
                                        <option value="PA">Pennsylvania</option>
                                        <option value="RI">Rhode Island</option>
                                        <option value="SC">South Carolina</option>
                                        <option value="SD">South Dakota</option>
                                        <option value="TN">Tennessee</option>
                                        <option value="TX">Texas</option>
                                        <option value="UT">Utah </option>
                                        <option value="VT">Vermont</option>
                                        <option value="VA">Virginia</option>
                                        <option value="WA">Washington</option>
                                        <option value="WV">West Virginia</option>
                                        <option value="WI">Wisconsin</option>
                                        <option value="WY">Wyoming</option>
                                    </select>
                                </div>
                            </div>
                            <div class="row">
                                <div class="mb-0 pl-4 pr-4 text-left col-lg-12 col-xs-12">
                                    <input type="hidden" id="postal_code_suffix" name="postal_code_suffix" />
                                    <input type="hidden" id="country" name="country" />
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="mailing_address" id="mailing_address" onclick="bqp_checkboox('mailing_address','mailing_area')" data-gtm-form-interact-field-id="4">
                                            <label class="form-check-label pl-0" for="mailing_address">What is your shipping address? <small>(Only fill this out if it is not the same as your home address.) </small></label>
                                        </div>
                                    </div>
                                </div>
                                <div id="mailing_area" style="display: none;">
                                    <div class="card-body row">
                                        <div class="col-lg-12">
                                            <div class="form-group mb-2">
                                                <label>Shipping Street Address</label>
                                                <input class="form-control" id="mailing_address1" name="mailing_address1" type="text">
                                            </div>
                                        </div>
                                        <div class="col-lg-12">
                                            <div class="form-group mb-2">
                                                <label>Shipping Apartment # or Suite #</label>
                                                <input class="form-control" id="mailing_address2" name="mailing_address2" type="text">
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group mb-2">
                                                <label>Shipping City</label>
                                                <input class="form-control" id="mailing_city" name="mailing_city" type="text">
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group mb-2">
                                                <label>Shipping State</label>
                                                <select class="form-control" name="mailing_state" id="mailing_state">
                                                    <option value="">Select State</option>
                                                    <option value="AL">Alabama</option>
                                                    <option value="AK">Alaska</option>
                                                    <option value="AZ">Arizona</option>
                                                    <option value="AR">Arkansas</option>
                                                    <option value="CA">California</option>
                                                    <option value="CO">Colorado</option>
                                                    <option value="CT">Connecticut</option>
                                                    <option value="DE">Delaware</option>
                                                    <option value="DC">District Of Columbia</option>
                                                    <option value="FL">Florida</option>
                                                    <option value="GA">Georgia</option>
                                                    <option value="HI">Hawaii</option>
                                                    <option value="ID">Idaho</option>
                                                    <option value="IL">Illinois</option>
                                                    <option value="IN">Indiana</option>
                                                    <option value="IA">Iowa</option>
                                                    <option value="KS">Kansas</option>
                                                    <option value="KY">Kentucky</option>
                                                    <option value="LA">Louisiana</option>
                                                    <option value="ME">Maine</option>
                                                    <option value="MD">Maryland</option>
                                                    <option value="MA">Massachusetts</option>
                                                    <option value="MI">Michigan</option>
                                                    <option value="MN">Minnesota</option>
                                                    <option value="MS">Mississippi</option>
                                                    <option value="MO">Missouri</option>
                                                    <option value="MT">Montana</option>
                                                    <option value="NE">Nebraska</option>
                                                    <option value="NV">Nevada</option>
                                                    <option value="NH">New Hampshire</option>
                                                    <option value="NJ">New Jersey</option>
                                                    <option value="NM">New Mexico</option>
                                                    <option value="NY">New York</option>
                                                    <option value="NC">North Carolina</option>
                                                    <option value="ND">North Dakota</option>
                                                    <option value="OH">Ohio</option>
                                                    <option value="OK">Oklahoma</option>
                                                    <option value="OR">Oregon</option>
                                                    <option value="PA">Pennsylvania</option>
                                                    <option value="PR">Puerto Rico</option>
                                                    <option value="RI">Rhode Island</option>
                                                    <option value="SC">South Carolina</option>
                                                    <option value="SD">South Dakota</option>
                                                    <option value="TN">Tennessee</option>
                                                    <option value="TX">Texas</option>
                                                    <option value="UT">Utah</option>
                                                    <option value="VT">Vermont</option>
                                                    <option value="VA">Virginia</option>
                                                    <option value="WA">Washington</option>
                                                    <option value="WV">West Virginia</option>
                                                    <option value="WI">Wisconsin</option>
                                                    <option value="WY">Wyoming</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-lg-12">
                                            <div class="form-group mb-2">
                                                <label>Shipping Zip Code</label>
                                                <input class="form-control zip" id="mailing_zipcode" name="mailing_zipcode" type="text" value="">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="mb-3 col-lg-12 col-xs-12">
                                    <p>Employer information</p>
                                </div>
                                <div class="mb-3 col-lg-7 col-xs-12">
                                    <input type="text" class="form-control form-control-lg" id="store"
                                        name="store" placeholder="Store or Distributor*" required>
                                </div>
                            </div>
                            <div class="row">
                                <div class="mb-3 col-lg-7 col-xs-12">
                                    <input type="text" class="form-control form-control-lg" id="promocode"
                                        name="store" placeholder="Store or Distributor Promo Code*" required>
                                </div>
                            </div>
                            <div class="row justify-content-md-center">
                                <div class="mt-3 mb-3  pl-4 pr-4 text-center col-lg-6 col-xs-12">
                                    <input type="hidden" id="IdPlanSelected" name="IdPlanSelected" value="">
                                    <input class="btn btn-primary btn-form" type="submit" value="SUBMIT" style="width: 100%;">
                                </div>
                            </div>
                            <!--<div class="row mt-4" id="paymentFrame">
                                <div class="col-lg-12">
                                    <h4>Details</h4>
                                    <hr style="border: none;border-top: 1px solid #0877BC;margin: 10px 0;">

                                    <div class="purchase-options">
                                        <div class="purchase-options-table">
                                            <div class="purchase-options-row ">
                                                <div class="form-check purchase-options-cell">
                                                    <input class="form-check-input" type="checkbox" value="Yes" id="subscribeSave" checked>
                                                    <label class="form-check-label pl-1" for="subscribeSave">
                                                        <strong><span>Subscribe and Save</span></strong>
                                                    </label>
                                                </div>
                                                <div class=" purchase-options-cell">
                                                    <div class="price-item mt-3">
                                                        <div class="price-list"><span class="price"><span id="Hprice" style="font-size: 24px;color:#0877bc">$27</span></span></div>
                                                    </div>
                                                    <span id="oldPrice" style="color: #a4a4a4;font-size: .9em;text-decoration: line-through;font-style: italic;margin-right: 0.5em;"></span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="card">
                                        <div class="row p-3">
                                            <div class="col-md-12 col-xs-12 text-left ">
                                                <label style="font-weight:700;margin:0">
                                                    CREDIT OR DEBIT CARD</label>
                                                <img src="<?php echo URLROOT; ?>img/credit_card.png" class="img-fluid" width="150" style="float:right">
                                            </div>
                                        </div>
                                        <div class="row pl-3 pr-3">
                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <label for="card_name">Full Name</label>
                                                    <input type="text" id="card_name" class="form-control form-control-lg" name="card_name" required>
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <label for="card_number">Card Number</label>
                                                    <input type="text" id="card_number" class="form-control form-control-lg" name="card_number" required>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row pl-3 pr-3">
                                            <div class="col-lg-4">
                                                <div class="form-group">
                                                    <label for="expiration_date">Expiration Date (MM/YY)</label>
                                                    <input type="text" id="expiration_date" class="form-control form-control-lg" name="expiration_date" required>
                                                    <div id="error-exp_date"></div>
                                                </div>
                                            </div>
                                            <div class="col-lg-4">
                                                <div class="form-group">
                                                    <label for="card_number">Security Code:</label>
                                                    <input type="text" id="card_scnumber" class="form-control form-control-lg" name="card_scnumber" required>
                                                </div>
                                            </div>
                                            <div class="col-lg-4">
                                                <div class="form-group">
                                                    <label for="card_type">Select Card Type:</label>
                                                    <select id="card_type" name="card_type" class="form-control form-control-lg" required>
                                                        <option value="Visa">Visa</option>
                                                        <option value="MasterCard">MasterCard</option>
                                                        <option value="amex">American Express</option>
                                                        <option value="Discover">Discover</option>
                                                        <option value="dinersclub">Diners Club</option>
                                                        <option value="jcb">JCB</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row pl-3 pr-3 pb-3">
                                            <div class="col-lg-12">
                                                <label for="ts">
                                                    <input type="checkbox" id="ts" name="ts" value="accepted" style="margin-right: 10px;text-align: justify; font-size: 14px;">
                                                    I acknowledge and agree to the <a href="https://linkupmobile.com/terms-of-service/" target="_blank">Terms&nbsp;of&nbsp;Service</a></label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>-->
                        </div>
                        <!-- Response Message -->
                        <div id="response"></div>
                    </div>
                </div>
            </div>
        </section>
    </div>
    <!-- <div class="pl-4 pr-4 text-center col-lg-12 col-xs-12">
        <div id="response"></div>
    </div> -->
</form>
<!-- <div class="row">
    <div class="col text-center pt-3">
        <form action="/checkout/" method="post" id="checkoutForm">
            <input type="hidden" id="customerIdPlan" name="customerIdPlan">
            <input type="hidden" id="IdPlanSelected" name="IdPlanSelected">
            <input type="hidden" id="saInformation" name="saInformation">
        </form>
    </div>
</div> -->
<div class="row">
    <div class="col text-center pt-3">
        <form action="/plans/" method="post" id="plansForm">
            <input type="hidden" id="orderId" name="orderId">
            <input type="hidden" id="IdPlanSelected2" name="IdPlanSelected">
        </form>
    </div>
</div>
<script>
    function bqp_checkboox(check_ele, section_ele) {
        // Get the checkbox
        var checkBox = document.getElementById(check_ele);
        // Get the output text
        var section = document.getElementById(section_ele);
        // If the checkbox is checked, display the output text
        if (checkBox.checked == true) {
            section.style.display = "block";
        } else {
            section.style.display = "none";
        }
    }

    function updateInitials(initialID) {

        //var initialINput = document.getElementById(initialID);
        var firstName = $('#fname').val();
        var lastName = $('#lname').val();

        var initials = '';

        if (firstName.length > 0) {
            initials += firstName.charAt(0).toUpperCase();
        }

        if (lastName.length > 0) {
            initials += lastName.charAt(0).toUpperCase();
        }

        $('#' + initialID).val(initials);
    }

    function ischecked(idelement) {
        var check;
        if ($('#' + idelement).is(':checked')) {
            check = 'Yes';
        } else {
            check = 'No';
        }
        return check;
    }

    function validateCreditCardNumber(cardNumber) {
        // Remove any non-digit characters
        cardNumber = cardNumber.replace(/\D/g, '');

        // Check if the card number is empty or not a number
        if (!cardNumber || isNaN(cardNumber)) {
            return false;
        }

        // Check card number length
        if (cardNumber.length < 13 || cardNumber.length > 19) {
            return false;
        }

        // Perform Luhn algorithm check
        let sum = 0;
        let shouldDouble = false;

        for (let i = cardNumber.length - 1; i >= 0; i--) {
            let digit = parseInt(cardNumber.charAt(i), 10);

            if (shouldDouble) {
                digit *= 2;
                if (digit > 9) {
                    digit -= 9;
                }
            }

            sum += digit;
            shouldDouble = !shouldDouble;
        }

        return (sum % 10 === 0);
    }

    function getGeoCode(zip) {
        var city, state;
        var lat;
        var lng;
        var zip_value;
        $("#postcodeRes").val(zip);
        var geocoder = new google.maps.Geocoder();
        geocoder.geocode({
            'address': zip
        }, function(results, status) {
            console.log(status)
            if (status == google.maps.GeocoderStatus.OK) {
                $("#locality").val(results[0].address_components[1].long_name);
                if (results[0].address_components[2].types[0] == "administrative_area_level_2") {
                    zip_value = results[0].address_components[3].short_name;
                } else {
                    zip_value = results[0].address_components[2].short_name;
                }
                $("#state option").each(function() {
                    if ($(this).val() == zip_value) {
                        $('#state option[value="' + zip_value + '"]').attr("selected", "selected");
                    }
                });

            }
        });
    }

    function convertFormDataToObject(formData) {
        const obj = {};
        for (const [key, value] of formData.entries()) {
            obj[key] = value;
        }
        return obj;
    }

    function syncRadioToHidden(radioName, hiddenSelector) {

        $(document).on('change', 'input[name="' + radioName + '"]', function(e) {
            
             $('.card-li').removeClass('plan_active');
             
            //console.log('Radio button changed for ' + radioName);
            const value = $('input[name="' + radioName + '"]:checked').val() || '';
    
            // Add style only to the item that contains the checked radio
            if ($(this).is(':checked')) {
                $(this).closest('.card-li').addClass('plan_active');
            }
            
            //console.log('Setting hidden field ' + hiddenSelector + ' to value: ' + value);
            $(hiddenSelector).val(value);
            
            //$('#form-container').scrollTop($('#form-container')[0].scrollHeight);
            e.preventDefault(); // avoid any default behavior
            $('html, body').animate({
                scrollTop: $('#form-container').offset().top}, 500); // 500ms animation
            });
    }

    var form = $("#demographic");
    form.validate({
        rules: {
            email: {
                email_2: true,
                required: true,
            },
            option: {
                required: true
            },
            fname: "required",
            lname: "required",
            locality: "required",
            state: "required",
            card_type: "required",
            postcode: {
                zipcodeUS: true,
                required: true
            },
            phone: {
                phoneUS: true,
                required: true,
            },
            dmonth: "required",
            dday: "required",
            dyear: {
                birthyear: true,
                required: true
            },
            street_address1: "required",
            locality: "required"
        },
        messages: {
            eligibility_program: "Please select a eligibility program",
            option: "Please select an option benefit",
        },
        invalidHandler: function(form, validator) {
            var errors = validator.numberOfInvalids();
        },
        submitHandler: function(form) {

            event.preventDefault();

            //const selectedPlan = $('input[name="option"]:checked').val();
            let selectedPlan = $("#IdPlanSelected").val();

            var param1 = JSON.stringify({

                "apikey": "U3VyZ2VwYXlzMjQ6VyEybTZASnk4QVFk",

                "first_name": $('#fname').val(),

                "middle_name": $('#mname').val(),

                "second_name": $('#lname').val(),

                "phone_number": $('#phone').val(),

                "email": $('#email').val(),

                "area_code": $('#areacode').val(),

                "promo_code": $('#promocode').val(),

                "store": $('#store').val(),
                
                "promocode": $('#promocode').val(),

                "address1": $('#street_address1').val(),

                "address2": $('#address2').val(),

                "city": $('#locality').val(),

                "state": $('#state').val(),

                "zipcode": $('#postcode').val(),

                "shipping_address1": $('#mailing_address1').val(),

                "shipping_address2": $('#mailing_address2').val(),

                "shipping_city": $('#mailing_city').val(),

                "shipping_state": $('#mailing_state').val(),

                "shipping_zipcode": $('#mailing_zipcode').val(),

                "utm_source": $("#utm_source").val(),

                "utm_medium": $("#utm_medium").val(),

                "utm_campaign": $("#utm_campaign").val(),

                "utm_content": $("#utm_content").val(),

                "match_type": $("#match_type").val(),

                "utm_adgroup": $("#utm_adgroup").val(),

                "ip_client": $('#ip_address').val(),

                "status": "Created",

                "plan": selectedPlan,

                "action": "Create"

            });

            $("#response").html('<div class="mt-3 text-center"><img src="<?php echo URLROOT; ?>/img/loading-buffering.gif" style="width: 40px;"></div>');
            $(".btn-form").addClass("visited");

            var urlEndPoint = '<?php echo URLROOT; ?>FormEndpoint/processAmbassadorLandingData';


            $.ajax({

                type: "POST",

                url: urlEndPoint,

                data: param1,

                dataType: "json",

                beforeSend: function() {

                    $("#response").html('<div class="alert alert-primary d-flex justify-content-center align-items-center" role="alert"><span class="spinner-border" role="status" aria-hidden="true" style="width: 3rem; height: 3rem; margin-right: 1rem;"></span><div> Please wait, this take 1-2 minutes to complete. Do not refresh or leave the page. </div></div>');

                    console.log("BeforeSend Waiting");

                },
                success: function(response) {

                    console.log(response);

                    var list = '';

                    let msg_detail = (response.msgDetail && response.msgDetail.trim() !== "") ?
                        response.msgDetail :
                        "Error: It looks like there was an error.";

                    if (response.msg == 'Duplicate') {

                        list = '<div class="alert alert-warning d-flex justify-content-center align-items-center"   role="alert"><h4 class="msg-cal"><i class="fa fa-exclamation-triangle"></i> Duplicate Applicant: This information has already been entered. If you believe this is a mistake, please review your information or contact us here <a href="tel:+1866-372-0619">866-372-0619</a></h4></div>';

                    } else if (response.msg == "SUCCESS") {

                        list = '<div class="alert alert-success d-flex justify-content-center align-items-center"   role="alert"><h4 class="msg-cal"> Success: The information has been sent</h4></div>';

                        $("#response").html(list);

                        let currentUrl = window.location.href;

                        let order_id = response.TransId;
                        console.log('Order ID:', order_id);

                        if (selectedPlan != "" && order_id != "") {
                            $('#orderId').val(order_id);
                            $('#IdPlanSelected2').val(selectedPlan);

                            const customUrl = '<?php echo $GLOBALS["urlbase"]; ?>plans/' + selectedPlan + '/' + '?c_id=' + response.customerIdncrypt;
                            // $('#plansForm')
                            //     .attr('action', customUrl)
                            //     .submit();
                            setTimeout(function() {
                                window.location.href = '/plans/' + selectedPlan + '/' + '?c_id=' + response.customerIdncrypt;
                            }, 1000);

                        } else {

                            setTimeout(function() {
                                window.location.href = '/plans/' + '?c_id=' + response.customerIdncrypt;
                            }, 1000);

                        }

                    } else {

                        list = '<div class="alert alert-danger d-flex justify-content-center align-items-center" role="alert"><h4 class="msg-cal">' + msg_detail + '</h4></div>';

                    }

                    $("#response").html(list);

                },
                error: function(xhr, status, error) {
                    console.error('AJAX error:', status, error);
                    $("#response").html(
                        '<div class="alert alert-danger" role="alert">' +
                        'Unexpected error. Please try again later.' +
                        '</div>'
                    );
                }
            });

        }
    });

    async function encryptData(data, password) {
        const encoder = new TextEncoder();
        const keyMaterial = await crypto.subtle.importKey(
            'raw',
            encoder.encode(password),
            'PBKDF2',
            false,
            ['deriveKey']
        );

        const salt = crypto.getRandomValues(new Uint8Array(16));
        const key = await crypto.subtle.deriveKey({
                name: 'PBKDF2',
                salt: salt,
                iterations: 100000,
                hash: 'SHA-256'
            },
            keyMaterial, {
                name: 'AES-GCM',
                length: 256
            },
            false,
            ['encrypt']
        );

        const iv = crypto.getRandomValues(new Uint8Array(12));
        const encryptedData = await crypto.subtle.encrypt({
                name: 'AES-GCM',
                iv: iv
            },
            key,
            encoder.encode(JSON.stringify(data))
        );

        return {
            cipherText: Array.from(new Uint8Array(encryptedData)),
            iv: Array.from(iv),
            salt: Array.from(salt)
        };
    }

    async function handleSubmit(event, formData) {
        event.preventDefault();

        const password = 'StrongPassword123'; // Replace this with a securely fetched value
        const encrypted = await encryptData(formData, password);
        const urlEndPoint = 'https://pib.linkupmobile.com/FormEndpoint/processAmbassadorLandingData';

        try {
            const response = await fetch(urlEndPoint, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'accept': 'application/json',
                },
                body: JSON.stringify(encrypted),
            });

            if (!response.ok) {
                throw new Error(`Server error: ${response.statusText}`);
            }

            const data = await response.json();
            let phencry = btoa(data.PhoneNumber);
            let transcry = btoa(data.TransId);
            let message = '';
            switch (data.msg) {
                case 'Duplicate':
                    message = 'Duplicate Applicant: This information has already been entered. If you believe this is a mistake, please review your information or contact us here <a href="tel:+1866-372-0619">866-372-0619</a>';
                    updateUI('warning', message);
                    break;
                case 'SUCCESS':
                    message = 'Success: The information has been sent.  PhoneNumber:' + data.PhoneNumber;
                    updateUI('success', message);
                    setTimeout(() => {
                        window.location.href = '/pages/thankyou/?ti=' + phencry + '|' + transcry;
                    }, 2000);
                    break;
                default:
                    message = 'Error: An error occurred. | ' + data.msgDetail;
                    updateUI('danger', message);
            }

        } catch (error) {
            console.error('Error:', error);
            updateUI('danger', 'An unexpected error occurred. Please try again later.');
        }
        // } finally {
        //     $("#response").html('<div class="mt-3 text-center"><img src="<?php echo URLROOT; ?>/img/loading-buffering.gif" style="width: 40px;"> Redirecting</div>');
        // }
    }

    function updateUI(status, message) {
        const alertType = status === 'success' ? 'success' : status === 'warning' ? 'warning' : 'danger';
        const list = `
        <div class="alert alert-${alertType}" role="alert">
            <h6 class="msg-cal">${message}</h6>
        </div>`;
        $('#response').html(list);
    }

    $(document).ready(function() {

        $("#phone").mask('(000)000-0000');

        $("#areacode").mask('000');

        $('#expiration_date').mask('00/00');

        $("#card_number").mask('0000 0000 0000 0000');

        $("#sim").mask('00000000000000000000');

        syncRadioToHidden('option', '#IdPlanSelected');

        $(document).on('change', '#street_address1,#address2', function(e) {
            var id_field = $(this).attr('id');
            checkPoBox(id_field);
        });

        $(document).on('change', '#postcode', function(e) {
            var zip = $(this).val();
            getGeoCode(zip);
        });

        $(document).on('change', '#expiration_date', function(e) {
            var expdate = $(this).val();
            //console.log(expdate);
            let validate = validateExpirationDate(expdate);
            if (validate == false) {
                $("#error-exp_date").html('<label class="error"> Error:Invalid expiration date.</label>');
            } else {
                $("#error-exp_date").html("");
            }
        });

    });
</script>