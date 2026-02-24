<?php require APPROOT . '/views/inc/header.php'; ?>
<?php
//ini_set('display_errors', 1);
//ini_set('display_startup_errors', 1);
//error_reporting(E_ALL);
//print("<pre>" . print_r($data, true) . "</pre>");
$single_plan = isset($data['plan']) ? $data['plan']: [];
$c_id = isset($_GET['c_id']) ? '?c_id='.$_GET['c_id'] : null;
?>
<?php if (isset($data['plan']) && !empty($data['plan'])): ?>
<div class="container main-container mb-4">
  <div class="row">
    <div class="col-lg-12 col-xs-12 mt-3 mb-3"></div>
  </div>
  <div class="row">
    <div class="col-lg-6 col-xs-12 mb-2">
      <div class="sp-card p-3">
        <p class="card-li-title"><?php echo preg_replace('/(?<!^)([A-Z])/', ' $1', $single_plan['name']); ?></p>
        <p class="card-li-gb"><?php echo $single_plan['data']; ?> a month</p>
        <p class="card-li-desc"><?php echo $single_plan['description']; ?></p>
        <p class="card-li-disclosure">*To activate the program, you must purchase 3 months of service upfront. <strong>The 4th month of service is included at no cost.</strong> After that, you will be billed $40 a month for 30GB of data. </p>
        <!-- <p class="card-li-price"><?php echo $single_plan['price']; ?></p> -->
        <span class="card-li3-data"> <img src="<?php echo URLROOT; ?>/img/national-coverage.png" class="img-fluid"
            alt="5G National Coverage"></span>
      </div>
    </div>
    <div class="col-lg-6 col-xs-12 mb-2">
      <h1 class="plan-title mb-0"><?php echo $single_plan['data']; ?> a month*</span> </h1>
      <hr>
      <p><strong class="price-tag">Price:</strong> <span class="plan-price">$<?php echo $single_plan['promo_price']; ?> (Taxes not included)</p>
      <div class="single-form">
        <form class="form" id="add_to_cart_form" action="/checkout/" method="POST">
          <div class="form-group mb-3">
            <select name="selectLine" class="form-control form-control-lg broadband_selectline" id="select_line" plan_id="100" required="">
              <option value="">-Select Line-</option>
              <option value="1">1</option>
              <option value="2">2</option>
              <option value="3">3</option>
              <option value="4">4</option>
              <option value="5">5</option>
              <option value="6">6</option>
            </select>
          </div>
          <div class="form-group mb-3">
            <input type="hidden" name="plan_id" id="plan_id" value="<?php echo $single_plan['plan_id']; ?>">
            <input type="hidden" name="c_id" id="c_id" value="<?php echo (isset($data['c_id'])) ? $data['c_id'] : '';  ?>" />
            <button type="submit" style="color: white" class="custom_btn multicontinue" id="plan_continue">Continue→
            </button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
<section class="section4">
  <div class="container mb-4" id="form-container">
    <div class="row justify-content-center">
      <div class="col-lg-12 col-xs-12 mt-2">
        <div id="second_section-container">
          <div class="mb-2">
            <p class="sbt-lightblue mb-1"><strong>America's most reliable&nbsp;Network</strong></p>
            <span class="sp_text">99% of the US population is covered. Get access to s award-winning, reliable 5G and 4G LTE networks.</span>
          </div>
          <div class="mb-2">
            <p class="sbt-lightblue mb-1"><strong>24/7 customer&nbsp;service</strong></p>
            <span class="sp_text"> Easy to use customer portal, and 24/7 customer support with REAL LinkUp Mobile&nbsp;representatives</span>
          </div>
          <div class="mb-2">
            <p class="sbt-lightblue mb-1"><strong>Global Roaming Via WiFi-Calling</strong></p>
            <span class="sp_text">Stay connected anywhere in the world by making calls and sending texts over any WiFi network—no roaming fees, no&nbsp;surprises.</span>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<section class="section3">
  <div class="container">
    <div class="row">
      <div class="boxes-container">
        <div class="box-wrapper">
          <div class="box b-yellow">
            <img src="<?php echo URLROOT; ?>/img/object-1.png" alt="Image" class="box-image">
            <h2 class="box-title">Seamless Connectivity</h2>
            <p class="box-text">Unlimited talk and text across the USA, Canada, and&nbsp;Mexico.</p>
          </div>
        </div>
        <div class="box-wrapper">
          <div class="box b-blue">
            <img src="https://linkuptest.wpenginepowered.com/wp-content/uploads/2025/10/turn.png" alt="Image" class="box-image">
            <h2 class="box-title">Simple Activation</h2>
            <p class="box-text">Quick and hassle-free with nationwide&nbsp;coverage</p>
          </div>
        </div>
        <div class="box-wrapper">
          <div class="box b-yellow">
            <img src="https://linkuptest.wpenginepowered.com/wp-content/uploads/2025/10/transparent.png" alt="Image" class="box-image">
            <h2 class="box-title">Transparent Pricing</h2>
            <p class="box-text">No hidden fees. Taxes and fees included. No&nbsp;surprises.</p>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<section class="section section--tight mt-5" data-section-id="template--17882193658072__text_with_icons_XrNjED" data-section-type="text-with-icons">
  <div class="container">
    <div class="text-with-icons ">
      <div class="text-with-icons__item" data-block-index="0">
        <div class="text-with-icons__icon-wrapper"><svg focusable="false" viewBox="0 0 24 24" role="presentation">
            <g stroke-width="1.5" fill="none" fill-rule="evenodd">
              <path d="M6.5 3.25l12 6" stroke="#0675d6"></path>
              <path stroke="#000000" d="M23 7l-10 5L1 6M13 12v11"></path>
              <path stroke="#000000" stroke-linecap="square" d="M23 7v10l-10 6-12-6V6l10-5z"></path>
            </g>
          </svg></div>
        <div class="text-with-icons__content-wrapper">
          <p class="text-with-icons__title text--strong">Quick Delivery</p>
          <div class="text-with-icons__content rte">
            <p>Get your SIM card delivered to your doorstep. Enjoy our service no matter where you&nbsp;are.</p>
          </div>
        </div>
      </div>
      <div class="text-with-icons__item" data-block-index="1">
        <div class="text-with-icons__icon-wrapper"><svg focusable="false" viewBox="0 0 24 24" role="presentation">
            <g transform="translate(1 1)" fill="none" fill-rule="evenodd">
              <circle fill="#000000" fill-rule="nonzero" cx="6.5" cy="17.5" r="1.5"></circle>
              <path d="M13 16v4c0 1.1-.9 2-2 2H2c-1.1 0-2-.9-2-2V4c0-1.1.9-2 2-2h4" stroke="#000000" stroke-width="1.5" stroke-linecap="square"></path>
              <path stroke="#0675d6" stroke-width="1.5" stroke-linecap="square" d="M22 12H6V0h16zM6 4h16M12 8h-2"></path>
            </g>
          </svg></div>
        <div class="text-with-icons__content-wrapper">
          <p class="text-with-icons__title text--strong">Flexible Plans</p>
          <div class="text-with-icons__content rte">
            <p>Choose from a variety of plans that fit your needs and budget, without being locked into long-term&nbsp;commitments.</p>
          </div>
        </div>
      </div>
      <div class="text-with-icons__item" data-block-index="2">
        <div class="text-with-icons__icon-wrapper"><svg focusable="false" viewBox="0 0 24 23" role="presentation">
            <g stroke-width="1.5" fill="none" fill-rule="evenodd">
              <path d="M17 1c-2.1 0-3.9 1.1-5 2.7C10.9 2.1 9.1 1 7 1 3.7 1 1 3.7 1 7c0 6 11 15 11 15s11-9 11-15c0-3.3-2.7-6-6-6z" stroke="#000000" stroke-linecap="square"></path>
              <path d="M16 5c1.65 0 3 1.35 3 3" stroke="#0675d6" stroke-linecap="round"></path>
            </g>
          </svg></div>
        <div class="text-with-icons__content-wrapper">
          <p class="text-with-icons__title text--strong">Customer Satisfaction Guarantee</p>
          <div class="text-with-icons__content rte">
            <p>We are committed to providing you with the best service. Enjoy 24/7 customer support for any issues you may&nbsp;have.</p>
          </div>
        </div>
      </div>
      <div class="text-with-icons__item" data-block-index="3">
        <div class="text-with-icons__icon-wrapper"><svg focusable="false" viewBox="0 0 24 24" role="presentation">
            <g stroke-width="1.5" fill="none" fill-rule="evenodd" stroke-linecap="square">
              <path d="M1 5h22M1 9h22M9 17H3c-1.105 0-2-.895-2-2V3c0-1.105.895-2 2-2h18c1.105 0 2 .895 2 2v10M5 13h5" stroke="#000000"></path>
              <path stroke="#0675d6" d="M13 16h8v7h-8zM15 16v-2c0-1.1.9-2 2-2s2 .9 2 2v2M17 19v1"></path>
            </g>
          </svg></div>
        <div class="text-with-icons__content-wrapper">
          <p class="text-with-icons__title text--strong">Secure Transactions</p>
          <div class="text-with-icons__content rte">
            <p>Enjoy peace of mind with our secure payment options. Your personal and financial information is always&nbsp;protected.</p>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
<?php else: ?>
  <?php require APPROOT . '/views/inc/plans.php'; 
        ?>
<?php endif; ?>
<?php
$productName = "Producto Demostracion";

$currency = "USD";

$productPrice = 25;

$productId = "";

$orderNumber = "";
?>
<?php require APPROOT . '/views/inc/footer.php'; ?>
<script>
  function getGeoCode(zip) {
    if (!zip) {
      console.error("No ZIP code provided.");
      return;
    }

    const geocoder = new google.maps.Geocoder();
    geocoder.geocode({
      address: zip
    }, function(results, status) {
      if (status === google.maps.GeocoderStatus.OK && results.length > 0) {
        const addressComponents = results[0].address_components;

        // Find locality (city)
        const locality = addressComponents.find(component =>
          component.types.includes("locality")
        )?.long_name;

        // Find state
        const state = addressComponents.find(component =>
          component.types.includes("administrative_area_level_1")
        )?.short_name;

        // Update form inputs
        if (locality) $("#locality").val(locality);
        if (state) {
          $("#state").val(state).change(); // Ensure proper state selection
        }

      } else {
        console.error("Geocoding failed:", status);
      }
    });
  }
  var form = $("#add_to_cart_form");
  form.validate({
    rules: {
      select_line: "required",
    },
    messages: {
      select_line: "Please select the number of lines",
    },
    invalidHandler: function(form, validator) {
      var errors = validator.numberOfInvalids();
    },
    submitHandler: function(form) {

      event.preventDefault();

      $("#response").html('<div class="mt-3 text-center"><img src="<?php echo URLROOT; ?>/img/loading-buffering.gif" style="width: 40px;"></div>');
      $(".btn-form").addClass("visited");

      /* const customUrl = '<?php echo URLROOT; ?>Checkout/';
      $('#select_line')
        .attr('action', customUrl)
        .submit(); */
    }
  });

  $(document).ready(function(e) {

    $("#phone").mask('(000)000-0000');

    $("#areacode").mask('000');

    $('#expiration_date').mask('00/00');


    $(document.body).on('change', '#phone', function() {
      for (var i = 1; i <= 9; i++) {
        updateInitials('initial_' + i);
      }
    });

    $(document).on('change', '#street_address1,#address2', function(e) {
      var id_field = $(this).attr('id');
      checkPoBox(id_field);
    });

    $(document).on('change', '#postcode', function(e) {
      var zip = $(this).val();
      getGeoCode(zip);
    });


  });