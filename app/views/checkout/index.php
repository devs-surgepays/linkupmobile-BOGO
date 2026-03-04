<?php
require APPROOT . '/views/inc/header.php';
//print("<pre>" . print_r($data, true) . "</pre>");
$saInformation = (isset($data['saInformation']) && $data['saInformation'] != NULL) ? json_decode($data['saInformation'], true) : [];
$infoPlan = (isset($data['infoPlan']) && $data['infoPlan'] != NULL) ? $data['infoPlan'] : [];
?>
<style>
    .paypal-button>.paypal-button-label-container>* {
        vertical-align: top;
        height: 100%;
        text-align: left;
    }

    .paypal-button-logo {
        padding: 0;
        display: inline-block;
        background: none;
        border: none;
        width: auto;
    }

    #zoid-outlet {
        width: 100% !important;
    }
</style>

<section>
    <form action="" class="form-floating" method="post" enctype="multipart/form-data" id="LinkupmobileOrder" autocomplete="off"
        data-customerid="" data-formtype="stepsForm" data-tf-element-role="offer">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-6 col-sm-6 white-bg">
                    <div class="row justify-content-start pt-5">
                        <div class="col-xl-3"></div>
                        <div class="col-xl-8">
                            <div class="row pt-5" id="checkout-form">
                                <div class="col-lg-12 customer-card mb-4 px-4 pt-4 pb-4">
                                    <div class="row">
                                        <div class="mb-4 text-start col-lg-12 col-xs-12">
                                            <div class="fw-bold fs-5">Billing Address</div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="mb-3 text-start col-lg-6 col-xs-12">
                                            <label for="first_name">First Name</label>
                                            <input type="text" name="first_name" class="form-control" id="first_name" placeholder="First Name*" value="<?php echo (isset($data['first_name'])) ? $data['first_name'] : '';  ?>" required="">
                                        </div>
                                        <div class="mb-3 text-start col-lg-6 col-xs-12">
                                            <label for="last_name">Last Name</label>
                                            <input type="text" name="last_name" class="form-control" id="last_name" placeholder="Last Name*" value="<?php echo (isset($data['last_name'])) ? $data['last_name'] : ''; ?>" required="">
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="mb-3 text-start col-lg-12 col-xs-12">
                                            <label for="email">Email Address</label>
                                            <input type="text" name="email" class="form-control" id="email" placeholder="Email*" value="<?php echo (isset($data['email'])) ? $data['email'] : ''; ?>" required="">
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="mb-3 text-start col-lg-12 col-xs-12">
                                            <label for="street_address1">Street Address</label>
                                            <input type="text" name="street_address1" class="form-control" id="street_address1" placeholder="Address Line 1*" value="<?php echo (isset($data['address1'])) ? $data['address1'] : ''; ?>" required="">
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="mb-3 text-start col-lg-12 col-xs-12">
                                            <input type="text" name="address2" class="form-control" id="address2" placeholder="Address Line 2*" value="<?php echo (isset($data['address2'])) ? $data['address2'] : ''; ?>">
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="mb-3 text-start col-lg-6 col-xs-12">
                                            <label for="state">State</label>
                                            <!-- <input type="text" name="state" class="form-control" id="state" placeholder="State*" value="<?php echo (isset($data['state'])) ? $data['state'] : ''; ?>" required=""> -->
                                            <select class="form-control" name="state" id="state"

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
                                        <div class="mb-3 text-start col-lg-6 col-xs-12">
                                            <label for="locality">City</label>
                                            <input type="text" name="locality" class="form-control" id="locality" placeholder="City*" value="<?php echo (isset($data['city'])) ? $data['city'] : ''; ?>" required="">
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="mb-3 text-start col-lg-6 col-xs-12">
                                            <label for="postcode">Zip Code</label>
                                            <input type="text" name="postcode" class="form-control" id="postcode" placeholder="Zip Code*" value="<?php echo (isset($data['zipcode'])) ? $data['zipcode'] : ''; ?>" required="">
                                        </div>
                                        <div class="mb-3 text-start col-lg-6 col-xs-12">
                                            <label for="phone_number">Phone</label>
                                            <input type="text" name="phone_number" class="form-control" id="phone_number" placeholder="Phone Number*" value="<?php echo (isset($data['phone_number'])) ? $data['phone_number'] : ''; ?>" required="">
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <div class="col-lg-12">
                                            <div class="form-group">
                                                <div class="form-check text-start">
                                                    <input class="form-check-input" type="checkbox" name="mailing_address" id="mailing_address" onclick="bqp_checkboox_mailing_area()" checked>
                                                    <label class="form-check-label" for="mailing_address"> My billing and shipping address are the same.</small></label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>


                                    <div id="mailing_area" style="display: none;">

                                        <div class="card-body row">

                                            <div class="col-lg-12">

                                                <div class="form-group mb-2">

                                                    <label for="mailing_address1">Billing Street Address</label>

                                                    <input class="form-control" id="mailing_address1" name="mailing_address1" type="text" value="<?php echo (isset($data['mailing_address1'])) ? $data['mailing_address1'] : '';  ?>">

                                                </div>

                                            </div>

                                            <div class="col-lg-12">

                                                <div class="form-group mb-2">

                                                    <label for="mailing_address2">Billing Apartment # or Suite #</label>

                                                    <input class="form-control" id="mailing_address2" name="mailing_address2" type="text" value="<?php echo (isset($data['mailing_address2'])) ? $data['mailing_address2'] : '';  ?>">

                                                </div>

                                            </div>

                                            <div class="col-lg-6">

                                                <div class="form-group mb-2">

                                                    <label for="mailing_city">Billing City</label>

                                                    <input class="form-control" id="mailing_city" name="mailing_city" type="text" value="<?php echo (isset($data['mailing_city'])) ? $data['mailing_city'] : '';  ?>">

                                                </div>

                                            </div>

                                            <div class="col-lg-6">

                                                <div class="form-group mb-2">

                                                    <label for="mailing_state">Billing State</label>

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

                                                    <label for="mailing_zipcode">Billing Zip Code</label>

                                                    <input class="form-control zip" id="mailing_zipcode" name="mailing_zipcode" type="text" value="<?php echo (isset($data['mailing_zipcode'])) ? $data['mailing_zipcode'] : '';  ?>">

                                                </div>

                                            </div>

                                        </div>

                                    </div>

                                </div>

                                <!--  <div class="col-lg-12 shipping-card mb-4 px-4 pt-4 pb-4">
                                    <div class="row">
                                        <div class="mb-4 text-start col-lg-12 col-xs-12">
                                            <div class="fw-bold fs-5">Shipping Method</div>
                                        </div>
                                    </div>
                                    <div class="row pb-3">
                                        <div class="col-md-3 col-lg-2 col-xl-3 mb-4 mb-lg-0">
                                            <div class="d-block mb-2">
                                                <label for="shipping_price" class="control-label mr-2">
                                                    <input type="radio" value="9.99" name="shipping_price" id="shipping_price" aria-invalid="true" checked>
                                                    <strong><?php echo isset($data['shipping_price']) ? '$' . $data['shipping_price'] : '$9.99'; ?></strong>
                                                </label>
                                                <label id="shipping_price-error" class="error" for="shipping_price"></label>
                                            </div>
                                        </div>
                                        <div class="col-md-4 col-lg-5 col-xl-5 mb-4 mb-lg-0">
                                            <p class="mb-0">USPS Standard Shipping<br>
                                                (3 - 5 business days)</p>
                                        </div>
                                        <div class="col-md-4 col-lg-3 col-xl-4 mb-4 mb-lg-0">
                                            <div class="bg-image hover-zoom ripple rounded ripple-surface text-center">
                                                <img src="<?php echo URLROOT; ?>/img/shipping_provider.png">
                                            </div>
                                        </div>
                                    </div>
                                </div> -->

                                <div class="col-lg-12 billing-card mb-4 px-4 pt-4 pb-4">
                                    <div class="row">
                                        <div class="mb-4 text-start col-lg-12 col-xs-12">
                                            <div class="fw-bold fs-5">Billing Method</div>
                                        </div>
                                    </div>

                                    <!--  <div class="row pb-3 purchase-options">
                                        <div class="col-md-3 col-lg-3 col-xl-3 mb-4 mb-lg-0">
                                            <div class="d-block mb-2">
                                                <label for="autopay" class="control-label mr-2">
                                                    <input type="radio" name="purchaseOption" checked="checked" class="purchase-options-radio" value="subscription" />
                                                    <strong>Auto Pay</strong>
                                                </label>
                                                <label id="autopay-error" class="error" for="autopay"></label>
                                            </div>
                                        </div>
                                        <div class="col-md-9 col-lg-9 col-xl-9 mb-4 mb-lg-0">
                                            <p class="mb-0">Your data plan automatically renews at the end of every&nbsp;cycle.</p>
                                        </div>
                                    </div> -->
                                    <div class="row pb-3">
                                        <div class="col-md-3 col-lg-3 col-xl-3 mb-4 mb-lg-0">
                                            <div class="d-block mb-2">
                                                <label for="billpay" class="control-label mr-2">
                                                    <input type="radio" name="purchaseOption" checked="checked" class="purchase-options-radio" value="onetime" />
                                                    <strong>Bill Pay</strong>
                                                </label>
                                                <label id="billpay-error" class="error" for="billpay"></label>
                                            </div>
                                        </div>
                                        <div class="col-md-9 col-lg-9 col-xl-9 mb-4 mb-lg-0">
                                            <p class="mb-0">Your data plan automatically renews at the end of every&nbsp;cycle.</p>
                                        </div>
                                    </div>
                                </div>

                                <!--  <div class="col-lg-12 payment-card mb-4 px-4 pt-4 pb-4">
                                    <div class="row">
                                        <div class="mb-4 text-start col-lg-12 col-xs-12">
                                            <div class="fw-bold fs-5">Payment Method</div>
                                        </div>
                                    </div>
                                    <div class="card p-3 mb-1">
                                        <div class="row pb-3 purchase-options">
                                            <div class="col-md-6 col-lg-6 col-xl-6 mb-4 mb-lg-0">
                                                <div class="d-block mb-2">
                                                    <label for="paymentoption" class="control-label mr-2">
                                                        <input type="radio" name="paymentoption" id="paymentoption" checked="checked" class="paymentoption-radio" value="CreditCard" />
                                                        <strong>Pay with Credit/Debit Card</strong>
                                                    </label>
                                                    <label id="paymentoption-error" class="error" for="paymentoption"></label>
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-lg-6 col-xl-6 mb-4 mb-lg-0 text-left">
                                                <img src="<?php echo URLROOT; ?>/img/credit_card2.png" class="img-fluid" style="float:right">
                                            </div>
                                        </div>
                                        <div class="row" id="paymentFrame">
                                            <div class="col-lg-12">
                                                <div class="row pl-3 pr-3 mb-3">
                                                    <div class="col-lg-12">
                                                        <div class="form-group">
                                                            <label for="card_number">Card Number</label>
                                                            <input type="text" id="card_number" class="form-control form-control-lg" name="card_number" required>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row pl-3 pr-3 mb-3">
                                                    <div class="col-lg-12">
                                                        <div class="form-group">
                                                            <label for="card_name">Name on card</label>
                                                            <input type="text" id="card_name" class="form-control form-control-lg" name="card_name" required>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row pl-3 pr-3">
                                                    <div class="col-lg-4">
                                                        <div class="form-group">
                                                            <label for="expiration_date">Expiration Date</label>
                                                            <input type="text" id="expiration_date" class="form-control form-control-lg" placeholder="MM/YY" name="expiration_date" required>
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
                                                                <option value="Amex">American Express</option>
                                                                <option value="Discover">Discover</option>
                                                                <option value="dinersclub">Diners Club</option>
                                                                <option value="Jcb">JCB</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="text-start col-lg-12 col-xs-12">
                                            <div class="text-muted small pt-3 pb-2"> <img src="<?php echo URLROOT; ?>/img/icon-lock.png"> We protect your payment information using encryption to provide bank-level&nbsp;security.</div>
                                        </div>
                                    </div>
                                </div> -->
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-sm-6 gray-bg">
                    <div class="row justify-content-md-center pt-5" id="summary-form">
                        <div class="col-lg-7 mb-4 pt-5">
                            <div class="order-card bg-white">
                                <!-- Header -->
                                <div class="d-flex align-items-start justify-content-between px-4 pt-4 pb-4">
                                    <div>
                                        <div class="d-flex align-items-center gap-2">
                                            <h5 class="mb-0 fw-bold">Order Review</h5>
                                            <button class="btn btn-sm btn-link text-muted collapsed" type="button" data-toggle="collapse" data-target="#order-review-area" aria-expanded="false">
                                                <i class="fa fa-caret-down arrow-icon"></i>
                                            </button>
                                        </div>
                                        <div class="text-muted small mt-1">1 item in cart</div>
                                    </div>
                                </div>

                                <!-- Item row -->
                                <div class="px-4 pb-4 collapse" id="order-review-area">
                                    <div class="d-flex gap-3 align-items-start">

                                        <!-- Icon -->
                                        <div class="icon-box d-flex align-items-center justify-content-center flex-shrink-0">
                                            <span class="fs-3"><?php echo isset($infoPlan['image']) ? '<img src="' . URLROOT . $infoPlan['image'] . '" alt="Plan Image" class="img-fluid plan-img">' : '📶'; ?></span>
                                        </div>

                                        <!-- Details -->
                                        <div class="flex-grow-1">
                                            <div class="d-flex align-items-start justify-content-between gap-3">
                                                <div>
                                                    <div class="fw-semibold"><?php echo isset($infoPlan['name']) ? $infoPlan['name'] : 'Plan name not available'; ?></div>
                                                    <div class="text-muted text-start small"><?php echo isset($infoPlan['data']) ? $infoPlan['data'] : 'Data not available'; ?> | <?php echo isset($infoPlan['sim']) ? $infoPlan['sim'] : ''; ?> | <?php echo (isset($infoPlan['autopay']) && $infoPlan['autopay'] == true) ? 'Auto Pay' : ''; ?></div>
                                                </div>
                                            </div>

                                            <div class="d-flex align-items-end justify-content-between mt-2 flex-wrap gap-3">
                                                <!-- Quantity -->
                                                <div class="d-flex align-items-center gap-2">
                                                    <button class="btn btn-outline-secondary qty-btn" type="button" aria-label="Decrease" disabled>
                                                        −
                                                    </button>

                                                    <input class="form-control qty-input text-center" name="lines" id="lines" type="text" value="1" aria-label="Quantity" readonly>

                                                    <button class="btn btn-outline-secondary qty-btn" type="button" aria-label="Increase" disabled>
                                                        +
                                                    </button>
                                                </div>

                                                <!-- Price -->
                                                <div class="text-end ms-auto">
                                                    <div class="text-muted text-decoration-line-through small"><?php echo isset($infoPlan['price']) ? '$' . number_format($infoPlan['price'], 2) : '$0.00'; ?></div>
                                                    <div class="fs-5 fw-bold"><?php echo isset($infoPlan['promo_price']) ? '$' . number_format($infoPlan['promo_price'], 2) : '$0.00'; ?></div>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                    <hr class="my-3">
                                </div>

                            </div>
                        </div>
                        <div class="col-lg-7 mb-4">
                            <div class="summary-card bg-white">
                                <!-- Header -->
                                <div class="d-flex align-items-center justify-content-between px-4 pt-4">
                                    <h5 class="mb-0 fw-bold">Billing Summary</h5>
                                    <button class="btn btn-sm btn-link text-muted" type="button" data-toggle="collapse" data-target="#order-summary-area" aria-expanded="false">
                                        <i class="fa fa-caret-up arrow-icon"></i>
                                    </button>
                                </div>

                                <!-- Lines -->
                                <div class="px-4 pt-3 pb-2" id="order-summary-area">
                                    <div class="row g-0 mb-2 summary-row">
                                        <div class="col text-start text-muted">Subtotal</div>
                                        <div class="col-auto fw-semibold" id="subtotal"><?php echo isset($infoPlan['price']) ? '$' . number_format($infoPlan['price'], 2) : '$0.00'; ?></div>
                                    </div>
                                    <div class="row g-0 mb-2 summary-row">
                                        <div class="col text-start text-muted">Discount</div>
                                        <div class="col-auto fw-semibold">-<?php echo isset($infoPlan['price']) && isset($infoPlan['promo_price']) ? '$' . number_format($infoPlan['price'] - $infoPlan['promo_price'], 2) : '$0.00'; ?></div>
                                    </div>
                                    <?php if (isset($infoPlan['shipping']) && $infoPlan['shipping'] > 0): ?>
                                        <div class="row g-0 mb-2 summary-row">
                                            <div class="col text-start text-muted">Shipping</div>
                                            <div class="col-auto fw-semibold" id="shipping"><?php echo isset($infoPlan['shipping']) ? '$' . number_format($infoPlan['shipping'], 2) : '$0.00'; ?></div>
                                        </div>
                                    <?php endif; ?>
                                    <div class="row g-0 mb-2 summary-row">
                                        <div class="col text-start text-muted">Tax</div>
                                        <div class="col-auto fw-semibold" id="tax"><span class="badge-pending">Pending Billing Address Section</span></div>

                                    </div>
                                </div>

                                <hr class="my-3 mx-4">

                                <!-- Grand total -->
                                <div class="d-flex align-items-center justify-content-between px-4">
                                    <div class="fw-bold fs-5">Grand Total</div>
                                    <div class="fw-bold fs-5" id="grandTotal"><span class="badge-pending">Pending Billing Address Section</span></div>

                                </div>

                                <!-- Summary Statys -->
                                <div id="summary-status" class="text-muted small px-4 pt-3 pb-2"></div>

                                <!-- Comment -->
                                <div class="px-4 pt-4">
                                    <div class="floating-wrap text-start">
                                        <label class="floating-label">Order Comment</label>
                                        <textarea class="form-control comment-box" rows="3" placeholder="Type here..."></textarea>
                                    </div>
                                </div>

                                <!-- Policies -->
                                <div class="px-4 pt-3">
                                    <div class="form-check d-flex align-items-start gap-2">
                                        <input class="form-check-input mt-1" type="checkbox" value="" id="policyCheck" checked>
                                        <label class="form-check-label text-muted" for="policyCheck">
                                            I acknowledge LinkUp Mobile’s
                                            <a href="#" class="text-link">Privacy Policy</a>
                                            &amp;
                                            <a href="#" class="text-link">Terms Policy</a>
                                        </label>
                                    </div>
                                </div>

                                <!-- Pay button -->
                                <div class="px-4 pt-4">
                                    <input type="hidden" id="url" name="url" value="<?php echo $data['url']; ?>">
                                    <input type="hidden" id="utm_source" name="utm_source" value="<? echo $data['utm_source']; ?>">
                                    <input type="hidden" id="utm_medium" name="utm_medium" value="<? echo $data['utm_medium']; ?>" />
                                    <input type="hidden" id="utm_campaign" name="utm_campaign" value="<? echo $data['utm_campaign']; ?>" />
                                    <input type="hidden" id="utm_content" name="utm_content" value="<? echo $data['utm_content']; ?>" />
                                    <input type="hidden" id="match_type" name="match_type" value="<? echo $data['match_type']; ?>" />
                                    <input type="hidden" id="utm_adgroup" name="utm_adgroup" value="<? echo $data['utm_adgroup']; ?>" />
                                    <input type="hidden" id="source" name="source" value="<?php echo isset($data['source']) ? $data['source'] : ''; ?>">
                                    <input type="hidden" id="Imei" name="Imei" value="<?php echo isset($data['imei']) ? $data['imei'] : ''; ?>">
                                    <input type="hidden" id="idPlan" name="idPlan" value="<?php echo $data['IdPlan']; ?>">
                                    <input type="hidden" id="plan" name="plan" value="<?php echo $infoPlan['name']; ?>">
                                    <input type="hidden" id="dataValue" name="dataValue" />
                                    <input type="hidden" id="dataDescriptor" name="dataDescriptor" />
                                    <input type="hidden" id="number_of_lines" name="number_of_lines" value="<?php echo $data['number_of_lines']; ?>">
                                    <input type="hidden" id="plan_price" value="<?php echo $infoPlan['price']; ?>">
                                    <input type="hidden" id="regularPrice" value="">
                                    <input type="hidden" id="promoPrice" value="">
                                    <input type="hidden" id="taxes" value="">
                                    <input type="hidden" id="c1" value="">
                                    <input type="hidden" id="c2" value="">
                                    <input type="hidden" id="c3" value="">
                                    <input type="hidden" id="c4" value="">
                                    <input type="hidden" id="c5" value="">
                                    <!--<button type="submit" id="pay-btn" class="btn btn-primary w-100 pay-btn"> Pay <span id="gtotal"></span></button>-->
                                </div>
                                <div class="px-4 pt-4">
                                    <div class="row">
                                        <div class="col-12">
                                            <input type="hidden" name="dataValue" id="dataValue" />
                                            <input type="hidden" name="dataDescriptor" id="dataDescriptor" />
                                            <button class="AcceptUI btn btn-primary w-100 pay-btn" id="pay-btn" data-billingAddressOptions='{"show":true, "required":false}' data-apiLoginID="<?php echo API_LOGIN_ID; ?>" data-clientKey="<?php echo CLIENT_KEY; ?>" data-acceptUIFormBtnTxt="Submit" data-acceptUIFormHeaderTxt="Card Information" data-paymentOptions='{"showCreditCard": true, "showBankAccount": false}' data-responseHandler="responseHandler">
                                                Pay <span id="gtotal"></span>
                                            </button>
                                        </div>

                                        <!--<div class="col-6">
                                                    <div id="paypal-button-container">
                                                        <a href="<?php echo URLROOT ?>/payment/paypalSubscription" id="subsPaypal" class="btn btn-block btn-warning w-100" style="background-color:  #ffc439;">
                                                            <img class="img-fluid" style="height:32px;" src="<?php echo URLROOT; ?>/img/Paypal-39_icon.png" alt="">
                                                        </a>
                                                        <div style="font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif;text-align:center;font-size:14px;"><span>Subscription Checkout</span></div>
                                                    </div>
                                                    <div id="paypal-button" class="btn btn-block w-100"></div>
                                            </div> -->
                                    </div>
                                </div>


                                <div class="px-4 pt-3 pb-4 text-center">
                                    <div id="response" style="margin-bottom: 0;"></div>
                                </div>



                                <!-- Norton -->
                                <div class="px-4 pt-3 pb-4 text-center">
                                    <div class="norton d-inline-flex align-items-center gap-2">

                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>

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
</section>
<script type="text/javascript" src="<?php echo ACCEPTURL; ?>" charset="utf-8"></script>
<script src="https://www.paypalobjects.com/api/checkout.js"></script>
<?php require APPROOT . '/views/inc/footer.php'; ?>
<script>
    let lastRequestId = 0; // simple “cancellation token”
    let currentAbort; // optional AbortController
    //const payButton = document.getElementById('pay-btn');
    const payButton = document.getElementById('pay-btn');
    const paypalButton = document.getElementById('paypal-btn');

    function isAddressComplete(addr) {
        return addr &&
            addr.firstName && addr.firstName.trim() !== '' &&
            addr.lastName && addr.lastName.trim() !== '' &&
            addr.email && addr.email.trim() !== '' &&
            addr.phone && addr.phone.trim() !== '' &&
            addr.address1 && addr.address1.trim() !== '' &&
            addr.city && addr.city.trim() !== '' &&
            addr.state && addr.state.trim() !== '' &&
            addr.zipcode && addr.zipcode.trim() !== '';
    }

    function setSummaryText(text) {
        // add an element inside the summary card if you don’t already have one
        // <div id="summary-status" class="text-muted small"></div>
        $('#summary-status').text(text);
    }

    function disablePay() {
        payButton.disabled = true;
    }

    function enablePay() {
        payButton.disabled = false;
    }

    /*
     * call the controller, update the summary card
     * address is an object { address1, city, state, zipcode }
     */
    function recalculatePrice(address) {

        if (!isAddressComplete(address)) {
            disablePay();
            setSummaryText(
                'Enter your Billing Address Section to calculate taxes and display the Grand Total.'
            );
            return;
        }

        const requestId = ++lastRequestId; // mark this request as current
        disablePay();
        setSummaryText('Calculating taxes…');

        const body = {
            plan_id: $('#idPlan').val(),
            infloPlan: $('#plan').val(),
            number_of_lines: $('#number_of_lines').val(),
            firstName: $('#first_name').val().trim(),
            lastName: $('#last_name').val().trim(),
            email: $('#email').val().trim(),
            phone: $('#phone_number').val().trim(),
            address1: address.address1.trim(),
            address2: $('#address2').val().trim(),
            city: address.city.trim(),
            state: address.state.trim(),
            zipcode: address.zipcode.trim()
        };

        let json = JSON.stringify(body);
        console.log(json);

        // cancel any previous fetch (optional)
        if (currentAbort) currentAbort.abort();
        currentAbort = new AbortController();

        fetch('<?php echo $GLOBALS["urlbase"]; ?>/checkout/calculatePlanPriceWithTax', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify(body),
                signal: currentAbort.signal
            })
            .then(async (r) => {
                const contentType = r.headers.get('content-type') || '';
                const raw = await r.text(); // read body ONCE

                // Helpful debug (remove later)
                console.log('tax calc status:', r.status);
                console.log('tax calc content-type:', contentType);
                console.log('tax calc raw:', raw);

                if (!r.ok) {
                    throw new Error(`network ${r.status}: ${raw?.slice(0, 200)}`);
                }

                // Empty body (common if backend echoes nothing)
                if (!raw || !raw.trim()) {
                    throw new Error('empty response body');
                }

                // Try JSON parse even if server forgot the header
                try {
                    return JSON.parse(raw);
                } catch (e) {
                    throw new Error('invalid JSON: ' + raw.slice(0, 200));
                }
            })
            .then(data => {
                if (requestId !== lastRequestId) return; // stale response
                if (data.subtotal !== undefined) {
                    $('#subtotal').text('$' + parseFloat(data.subtotal).toFixed(2));
                    $('#tax').text('$' + parseFloat(data.tax).toFixed(2));
                    $('#grandTotal').text('$' + parseFloat(data.total_with_taxes).toFixed(2));
                    $('#gtotal').text('$' + parseFloat(data.total_with_taxes).toFixed(2));
                    $('#regularPrice').val(data.subtotal);
                    $('#taxes').val(data.tax);
                    setSummaryText(''); // clear any status
                    enablePay();
                } else {
                    throw new Error('unexpected response');
                }
            })
            .catch(err => {
                if (requestId !== lastRequestId) return;
                console.error(err);
                disablePay();
                setSummaryText('Unable to calculate taxes. Please try again later.');
            });
    }

    function debounce(fn, delay) {
        let timer;
        return function(...args) {
            clearTimeout(timer);
            timer = setTimeout(() => fn.apply(this, args), delay);
        };
    }

    const debouncedRecalc = debounce(() => {
        const addr = {
            firstName: $('#first_name').val(),
            lastName: $('#last_name').val(),
            email: $('#email').val(),
            phone: $('#phone_number').val(),
            address1: $('#street_address1').val(),
            city: $('#locality').val(),
            state: $('#state').val(),
            zipcode: $('#postcode').val()
        };
        recalculatePrice(addr);
    }, 300);

    // wire the inputs once DOM is ready
    $(function() {
        const fields = '#first_name, #last_name, #email, #phone_number, #street_address1, #locality, #state, #postcode, #lines';
        $(fields).on('input change', debouncedRecalc);

        disablePay();
        setSummaryText('Enter your Billing Address to calculate taxes and display the Grand Total.');
    });
</script>
<script type="text/javascript">
    $(document).ready(function(e) {

        $("#phone").mask('(000)000-0000');

        $("#areacode").mask('000');

        $('#expiration_date').mask('00/00');

        $("#card_number").mask('0000 0000 0000 0000');


        $('input[type=radio][name=purchaseOption]').on('change', function() {

            if ($(this).val() == "subscription") {

                /* console.log("Subscription");

                var price = $("#subsPrice2").val();

                var sku = $("#subsSku").val();

                console.log(price + "-" + sku)

                var position = $("#myplanShow").find(':selected').data('plan_position')

                var suburl = "<?php echo $GLOBALS["urlbase"]; ?>/payment/paypalSubscription/" + sku + "/" + price + "/" + position;

                console.log(suburl);

                $("#paypal-button-container").show();

                $("#subsPaypal").attr('href', suburl);

                $("#paypal-button").hide(); */

            } else if ($(this).val() == "onetime") {

                console.log("One Time");

                var price = $("#regularPrice2").val();

                var sku = $("#regularSku").val();

                console.log(price);

                $("#paypal-button-container").hide();

                $("#paypal-button").html('');

                $("#paypal-button").show();

                $(".AcceptUI").text('Pay');

                console.log('second PAypal')

                loadPayPal(price, sku);

            } else {

                console.log("One Time");

                var price = $("#regularPrice2").val();

                var sku = $("#regularSku").val();

                console.log(price);

                $("#paypal-button-container").hide();

                $("#paypal-button").html('');

                $("#paypal-button").show();

                $(".AcceptUI").text('Pay');

                console.log('second PAypal')

                loadPayPal(price, sku);

            }

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
            "phoneNumber": $("#phoneNumber").val(),
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


        var param1 = JSON.stringify({
            "apikey": "U3VyZ2VwYXlzMjQ6VyEybTZASnk4QVFk",
            "currentStep": 2,
            "first_name": $('#first_name').val(),
            "middle_name": $('#middle_name').val(),
            "second_name": $('#second_name').val(),
            "suffix": $('#suffix').val(),
            "phone_number": $('#phoneNumber').val(),
            "email": $('#email').val(),
            "address1": $('#street_address1').val(),
            "address2": $('#address2').val(),
            "city": $('#locality').val(),
            "state": $('#state').val(),
            "zipcode": $('#zipcode').val(),
            "shipping_address1": $('#mailing_address1').val(),
            "shipping_address2": $('#mailing_address2').val(),
            "shipping_city": $('#mailing_city').val(),
            "shipping_state": $('#mailing_state').val(),
            "shipping_zipcode": $('#mailing_zipcode').val(),
            "billing_address1": $('#billing_address1').val(),
            "billing_address2": $('#billing_address2').val(),
            "billing_city": $('#billing_city').val(),
            "billing_state": $('#billing_state').val(),
            "billing_zipcode": $('#billing_zipcode').val(),
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
            "pay_message": pay_message,
            "pay_authcode": pay_authcode,
            "pay_transid": transId,
            "pay_accountnumber": accountNumber,
            "pay_accounttype": accountType,
            "pay_transmessage": pay_transmessage,
            "checkoutpackage": packageID,
            "number_of_lines": $("#lines").val(),
            "Imei": $('#Imei').val(),
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

    function bqp_checkboox_mailing_area() {

        // Get the checkbox

        var checkBox = document.getElementById("mailing_address");

        // Get the output text

        var section = document.getElementById("mailing_area");

        // If the checkbox is checked, display the output text

        if (checkBox.checked == true) {

            section.style.display = "block";

            //var selectedValue = $('#state').val();

            //$('#mailing_state').val(selectedValue);

        } else {

            section.style.display = "none";

        }

    }

    function loadPayPal(productPrice, sku) {

        console.log(productPrice + "-" + sku);

        paypal.Button.render({

            env: '<?php echo PayPalENV; ?>',

            client: {

                <?php if (ProPayPal) { ?>

                    production: '<?php echo PayPalClientId; ?>',

                <?php } else { ?>

                    sandbox: '<?php echo PayPalClientId; ?>'

                <?php } ?>

            },

            payment: function(data, actions) {

                return actions.payment.create({

                    transactions: [{

                        amount: {

                            total: productPrice,

                            currency: "USD"

                        }

                    }]

                });

            },

            onAuthorize: function(data, actions) {

                return actions.payment.execute()

                    .then(function() {

                        window.location = "<?php echo PayPalBaseUrl; ?>/paypal/" + data.paymentID + "/" + data.payerID + "/" + data.paymentToken + "/" + sku;

                    });

            }

        }, '#paypal-button');

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

    // Ejemplo: llama a encryptInput('texto a encriptar')
    async function encryptInputValue(input) {
        if (!input || (typeof input === 'string' && input.trim() === '')) {
            throw new Error('Input vacío');
        }

        const body = new URLSearchParams();
        body.append('input', input);

        const res = await fetch('<?php echo $GLOBALS["urlbase"]; ?>/checkout/encrypt', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded'
            },
            body: body.toString()
        });

        if (!res.ok) throw new Error('HTTP error ' + res.status);

        const json = await res.json();
        if (json.response === 'OK' && typeof json.encrypted === 'string') return json.encrypted;

        throw new Error(json.message || 'Respuesta inesperada');
    }

    var form = $("#LinkupmobileOrder");

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
            postcode: {
                zipcodeUS: true,
                required: true
            },
            phone: {
                phoneUS: true,
                required: true,
            },
            street_address1: "required",
            locality: "required",
            agree_terms: "required"
        },
        messages: {
            option: "Please select an option benefit",
        },
        invalidHandler: function(form, validator) {

            var errors = validator.numberOfInvalids();

        },
        submitHandler: function(form) {

            console.log("onFinishing-get")
            event.preventDefault();
            async function captureAndContinue() {

                try {

                    const canvas = await html2canvas(document.getElementById('LinkupmobileOrder'), {

                        allowTaint: true,

                        useCORS: true

                    });

                    // Get base64Screenshot

                    const base64Screenshot = canvas.toDataURL('image/jpeg').replace('image/jpeg', 'image/png');

                    $("#base64Screenshot").val(base64Screenshot);

                    return;



                } catch (error) {

                    console.error("Error capturing screenshot:", error);

                }

            }
            captureAndContinue().then(() => {

                var terms = ischecked('consent');

                const cardInfo = {
                    number: $('#card_number').val(),
                    name: $('#card_name').val(),
                    exp: $('#expiration_date').val(),
                    cvv: $('#card_scnumber').val(),
                    type: $('#card_type option:selected').val()
                };
                var paramcc = {
                    card_number: encryptInputValue(cardInfo.number),
                    card_name: encryptInputValue(cardInfo.name),
                    expiration_date: encryptInputValue(cardInfo.exp),
                    card_scnumber: encryptInputValue(cardInfo.cvv),
                    card_type: encryptInputValue(cardInfo.type)
                };
                $("#c1").val(paramcc.card_number);
                $("#c2").val(paramcc.card_name);
                $("#c3").val(paramcc.expiration_date);
                $("#c4").val(paramcc.card_scnumber);
                $("#c5").val(paramcc.card_type);

                var payload = JSON.stringify({

                    "apikey": "<?php echo ENDPOINT_KEY; ?>",

                    "first_name": $('#fname').val(),

                    "middle_name": $('#mname').val(),

                    "second_name": $('#lname').val(),

                    "middle_name": $('#minitial').val(),

                    "suffix": $('#suffix').val(),

                    "phone_number": $('#phoneNumber').val(),

                    "email": $('#email').val(),

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

                    "billing_address1": $('#billing_address1').val(),

                    "billing_address2": $('#billing_address2').val(),

                    "billing_city": $('#billing_city').val(),

                    "billing_state": $('#billing_state').val(),

                    "billing_zipcode": $('#billing_zipcode').val(),

                    "source": $('#source').val(),

                    "agree_terms": terms,

                    "customer_id": $("#customerId").val(),

                    "utm_source": $("#utm_source").val(),

                    "utm_medium": $("#utm_medium").val(),

                    "utm_campaign": $("#utm_campaign").val(),

                    "utm_content": $("#utm_content").val(),

                    "match_type": $("#match_type").val(),

                    "utm_adgroup": $("#utm_adgroup").val(),

                    "url": $("#url").val(),

                    "address_type": $("input[name='address_type']:checked").val(),

                    "terminal_id": $("#terminal_id").val(),

                    "clerk_id": $("#clerk_id").val(),

                    "cake_clickId": $("#cake_clickId").val(),

                    "Imei": $('#Imei').val(),

                    "card_type": $('#c5').val(),

                    "card_name": $('#c2').val(),

                    "card_number": $('#c1').val(),

                    "expiration_date": $('#c3').val(),

                    "card_scnumber": $('#c4').val()

                });
                console.log("Json Payload:", payload);

                /* var param1 = JSON.stringify(payload);
                console.log("Parameters", param1); */

                var urlEndPoint = '<?php echo $GLOBALS["urlbase"]; ?>/FormEndpoint/orders';

                $.ajax({

                    type: "POST",

                    url: urlEndPoint,

                    data: payload,

                    dataType: "json",

                    contentType: "application/json",

                    beforeSend: function() {

                        $("#response").html('<div class="alert alert-primary d-flex justify-content-center align-items-center" role="alert"><span class="spinner-border" role="status" aria-hidden="true" style="width: 3rem; height: 3rem; margin-right: 1rem;"></span><div> Please wait, this take 1-2 minutes to complete. Do not refresh or leave the page. </div></div>');

                    },
                    success: function(response) {

                        console.log("success done");

                        var list = '';

                        var msg_detail

                        if (response.msgDetail != "") {

                            msg_detail = response.msgDetail;

                        } else {

                            msg_detail = "Error: It looks like there is a error.";

                        }

                        if (response.msg == 'Duplicate') {

                            btnActionsSubmit(false);

                            $("a[href='#finish']").removeClass("visited");

                            list = '<div class="alert alert-warning d-flex justify-content-center align-items-center"   role="alert"><h4 class="msg-cal"><i class="fa fa-exclamation-triangle"></i> Duplicate Applicant: This information has already been entered. If you believe this is a mistake, please review your information or contact us here <a href="tel:+1866-372-0619">866-372-0619</a></h4></div>';

                        } else if (response.msg == 'shockwaveDuplicate') {

                            btnActionsSubmit(false);

                            $("a[href='#finish']").removeClass("visited");

                            list = '<div class="alert alert-warning d-flex justify-content-center align-items-center"   role="alert"><h4 class="msg-cal"><i class="fa fa-exclamation-triangle"></i> Duplicate Applicant: ' + response.msgDetail + '<br> Please review your information or contact us here <a href="tel:+1866-372-0619">866-372-0619.</a></h4></div>';

                        } else if (response.msg == "SUCCESS") {

                            list = '<div class="alert alert-success d-flex justify-content-center align-items-center"   role="alert"><h4 class="msg-cal"> Success: The information has been sent</h4></div>';

                            $("#response").html(list);

                            let currentUrl = window.location.href;
                            let plan_selected = $("#IdPlanSelected").val();

                            if (plan_selected == "Upgradephone") {
                                $('#checkoutForm').submit();
                            } else {

                                setTimeout(function() {

                                    window.location.href = '/thankyou/' + '?c_id=' + response.customerIdncrypt;

                                }, 1000);
                            }

                        } else {

                            list = '<div class="alert alert-danger d-flex justify-content-center align-items-center" role="alert"><h4 class="msg-cal">' + msg_detail + '</h4></div>';

                        }

                        //});

                        $("#response").html(list);

                    },

                    complete: function(data) {}

                });

            });

        }
    });
</script>