<?php 
$langEN = URLROOT."/thankyou";
$langES = URLROOT."/thankyou/es";
require APPROOT . '/views/inc/header.php';
//print("<pre>" . print_r($data, true) . "</pre>");
$infoPlan = (isset($data['infoPlan']) && $data['infoPlan'] != NULL) ? $data['infoPlan'] : [];
$order = (isset($data['infoCustomerId']) && $data['infoCustomerId'] != NULL) ? $data['infoCustomerId'] : [];
$response = (isset($data['response']) && $data['response'] != NULL) ? $data['response'] : [];
$transId = isset($response['transactionResponse']['transId']) ? $response['transactionResponse']['transId'] : 'N/A';
$PGSTransId = isset($response['PGSTransId']) ? $response['PGSTransId'] : 'N/A';
$PhoneNumber = isset($response['PhoneNumber']) ? $response['PhoneNumber'] : 'N/A';
?>

<section class="position-relative py-4 py-xl-5" style="min-height:525px">
    <div class="container">

        <div class="row">
            <div class="col p-3">
            </div>
        </div>
        <div class="row justify-content-md-center pt-3">
            <div class="col-lg-6 mb-4">
                <div class="text-center">
                    <h1 class="thankyou-title fw-bold"><?php echo $data['thankyou_h1']; ?> #<?php echo isset($order['id_order']) ? $order['id_order'] : 'N/A'; ?></h1>
                    <h2 class="thankyou-title fw-bold"><?php echo $data['thankyou_h1_2']; ?></h2>
                    <strong class="lead mb-4"><?php echo $data['thankyou_desc']; ?></strong>
                </div>
            </div>
        </div>

        <div class="row justify-content-md-center pt-3" id="summary-thankyou">
            <div class="col-lg-6 mb-4">
                <div class="order-card bg-white">
                    <!-- Header -->
                    <div class="d-flex align-items-start justify-content-between px-4 pt-4 pb-0">
                        <div>
                            <div class="d-flex align-items-center gap-2">
                                <h5 class="mb-0 fw-bold"><?php echo $data['orderreview_label']; ?></h5>
                            </div>
                        </div>
                    </div>

                    <!-- Lines -->
                    <div class="px-4 pt-3 pb-4" id="order-summary-area">
                        <div class="row g-0 mb-2 summary-row">
                            <div class="col text-start text-muted"><?php echo $data['transid_label']; ?></div>
                            <div class="col-auto fw-semibold"><?php echo $transId; ?></div>
                        </div>
                        <div class="row g-0 mb-2 summary-row">
                            <div class="col text-start text-muted"><?php echo $data['transpgst_label']; ?></div>
                            <div class="col-auto fw-semibold"><?php echo $PGSTransId; ?></div>
                        </div>

                        <div class="row g-0 mb-2 summary-row">
                            <div class="col text-start text-muted"><?php echo $data['phone_number_label']; ?></div>
                            <div class="col-auto fw-semibold"><?php echo $PhoneNumber; ?></div>
                        </div>
                    </div>

                    <!-- Item row -->
                    <div class="px-4 pb-4" id="order-review-area">
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

                                <div class="d-flex justify-content-between mt-2 flex-wrap gap-3">
                                    <!-- Quantity -->
                                    <div class="text-muted text-start small">1 eSIM</div>


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
        </div>

        <div class="row justify-content-md-center pt-3">
            <div class="col-lg-3 col-md-4 text-center mt-3">
                <a class="btn w-100 gohome-btn pt-3 pb-3" href="<?php echo URLROOT; ?>"><?php echo $data['back_btn']; ?></a>
            </div>
        </div>

    </div>
</section>

<?php require APPROOT . '/views/inc/footer.php'; ?>