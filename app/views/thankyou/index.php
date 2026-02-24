<?php require APPROOT . '/views/inc/header.php'; ?>
<style>
    .button-login-myaccount {
        color: #fff;
        font-size: 2.2rem;
        font-weight: 700;
        border-radius: 40px !important;
        background-color: #E03829 !important;
        padding: 10px 27px 12px 27px;
    }

    .card {
        background-color: #F5F5F5;
        border: 0px;
    }

    .thank-text {
        font-size: 2.75rem;
    }

    .sub-thank-text {
        font-size: 1.75rem;
    }

    @media (max-width: 350px) {
        .thank-text {
            font-size: 1.8rem;
        }

        .sub-thank-text {
            font-size: 1.3rem;
        }

        .button-login-myaccount {
            font-size: 1.5rem;
        }
    }
</style>
<section class="position-relative py-4 py-xl-5" style="min-height:525px">
    <div class="container">
        
            <div class="row">
                <div class="col p-3">
                </div>
            </div>
            
            <div class="row">
                <div class="col-lg-3"></div>
                <div class="col-lg-6">
                    <div class="card car-wrapp">
                        <div class="row">
                            <div class="col-lg-12 text-center">
                                <div class="col-lg-12 text-center p-4">
                                    <img src="/img/mark_success.png" style="width: 75px;" class="img-fluid" width="" height="" alt="Complete">

                                    <?php if (@$_GET['pay'] == 'success') { ?>
                                        <h2 style="font-size: 1.5rem;">Congratulations! <br>The payment has been completed&nbsp;successfully </h2>
                                    <?php } else { ?>
                                        <h2 style="font-size: 1.5rem;">Congratulations! <br>Your application has been&nbsp;submitted! </h2>
                                    <?php } ?>

                                    <hr>
                                    <p style="text-align: left;font-size: 1.3rem;">We will contact you in the next 2 business days for an update on your enrollment. Please look for text messages and emails from&nbsp;us.</p>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        
            <div class="row">
                <div class="col-lg-12 text-center mt-3">
                </div>
            </div>
        
    </div>
</section>

<?php require APPROOT . '/views/inc/footer.php'; ?>

