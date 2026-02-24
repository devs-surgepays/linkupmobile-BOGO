<?php require APPROOT . '/views/inc/header.php'; ?>

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

                            <div class="col-lg-12 text-center">

                                <img src="<?php echo URLROOT; ?>/img/mark_success.png" style="width: 75px;" class="img-fluid" width="" height="" alt="Complete">

                                <h2 style="font-size: 1.5rem;">Congratulations! <br>Your application has been submitted! </h2>

                                <hr>
                                <?php if(!empty($data['trans_id']) && !empty($data['phone_number'])){ ?>
                                
                                <p style="text-align: left;font-size: 1.3rem;"><strong>Transaction ID: </strong><?php echo $data['trans_id']; ?></p>

                                <p style="text-align: left;font-size: 1.3rem;"><strong>Phone Number: </strong><?php echo $data['phone_number']; ?></p>
                                
                                <?php } ?>    
                                <p style="text-align: left;font-size: 1.3rem;">We will contact you in the next 2 business days for an update on your enrollment. Please look for text messages and emails from us. </p>

                            </div>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>

</section>



<?php require APPROOT . '/views/inc/footer.php'; ?>