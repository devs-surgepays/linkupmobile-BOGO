<footer class="text-white pt-5" style="background-color: #0076bd;">
    <div class="container pb-4">
        <div class="row g-4 d-none d-md-flex">

            <div class="col-md-4">
                <div class="mb-3">
                    <img src="<?php echo URLROOT; ?>/img/linkup-white.png" class="img-fluid" style="max-height: 93px;" />
                </div>
                <p class="mb-3 roboto-family" style="font-size: 18px;">© <?php echo date('Y') ?> LinkUp Mobile</p>
                <!-- <div class="d-flex align-items-center small">
                    <img src="https://flagcdn.com/w20/us.png" alt="EN" class="me-1">
                    <span class="font-yellow fw-bold">EN</span>
                    <span class="mx-2">|</span>
                    <img src="https://flagcdn.com/w20/mx.png" alt="ES" class="me-1">
                    <span>ES</span>
                </div> -->
                <div class="d-flex align-items-center franklin-family px-2">
                    <div class="me-2">
                        <a href="<?php echo $langEN; ?>" class="<?php echo ($data['lang']=="en")?"font-yellow":"text-white"; ?> text-decoration-none fw-bold d-flex align-items-center me-2" style="font-size: 24px;">
                      <img src="https://flagcdn.com/24x18/us.png" alt="US" class="me-1">EN</a>
                    </div>
                    <span class="mx-2">|</span>
                    <div>
                        <a href="<?php echo $langES; ?>" class="<?php echo ($data['lang']=="es")?"font-yellow":"text-white"; ?> text-decoration-none fw-bold d-flex align-items-center ms-2" style="font-size: 24px;">
                      <img src="https://flagcdn.com/24x18/mx.png" alt="MX" class="me-1">ES</a>
                    </div>
                </div>
            </div>

            <!-- <div class="col-6 col-md-3">
                <h6 class="font-yellow fw-bold text-uppercase mb-3">Home</h6>
                </div> -->

            <div class="col-md-4">
                <h6 class="font-yellow fw-bold text-uppercase mb-5"><?php echo $data['home']; ?></h6>
                <h6 class="font-yellow fw-bold text-uppercase mb-3"><?php echo $data['help']; ?></h6>
                <ul class="list-unstyled small">
                    <li class="mb-2"><a href="#" class="text-white text-decoration-none fw-bold"><?php echo $data['livechat']; ?></a></li>
                    <li class="mb-2"><a href="#" class="text-white text-decoration-none fw-bold"><?php echo $data['phonecall']; ?></a></li>
                    <li class="mb-2"><a href="#" class="text-white text-decoration-none fw-bold"><?php echo $data['email_footer']; ?></a></li>
                    <li class="mb-2"><a href="#" class="text-white text-decoration-none fw-bold"><?php echo $data['message']; ?></a></li>
                </ul>
            </div>

            <div class="col-md-4">
                <h6 class="font-yellow fw-bold text-uppercase mb-3"><?php echo $data['account']; ?></h6>
                <ul class="list-unstyled small mb-4">
                    <li class="mb-2"><a href="https://enroll.linkupmobile.com/SignIn.php" target="_blank" class="text-white text-decoration-none fw-bold"><?php echo $data['login']; ?></a></li>
                    <li class="mb-2"><a href="#" class="text-white text-decoration-none fw-bold"><?php echo $data['register']; ?></a></li>
                    <li class="mb-2"><a href="https://enroll.linkupmobile.com/forget-password.php" target="_blank" class="text-white text-decoration-none fw-bold"><?php echo $data['forgot']; ?></a></li>
                </ul>
                <div class="d-inline-flex align-items-center rounded shadow-sm" style="background-color: #004d7c;">
                    <img src="<?php echo URLROOT; ?>/img/BBB_Logo.png" alt="BBB" height="75" class="img-fluid">

                </div>
            </div>

        </div>
        <div class="row gap-4 d-md-none">
            <div class="col text-center">
                <img src="<?php echo URLROOT; ?>/img/LinkUpMobile.png" alt="LinkUp Mobile"  class="img-fluid">
            </div>
        </div>
        <div class="row mt-3 d-md-none">
            <div class="col-4 text-center">
                <a  href="<?php echo URLROOT; ?>" class="font-yellow fw-bold text-uppercase mb-3 franklin-family" style="font-size: 16px;"><?php echo $data['home']; ?></a>
            </div>
            <div class="col-4 text-center">
                <a href="https://linkupmobile.com/support/" target="_blank" class="font-yellow fw-bold text-uppercase mb-3 franklin-family" style="font-size: 16px;"><?php echo $data['help']; ?></a>
            </div>
            <div class="col-4 text-center">
                <a href="https://enroll.linkupmobile.com/SignIn.php" target="_blank" class="font-yellow fw-bold text-uppercase mb-3 franklin-family" style="font-size: 16px;"><?php echo $data['account']; ?></a>
            </div>
        </div>
        
    </div>

    <div class="py-3 text-center" style="background-color: #005a8e;">
        <div class="container">
            <div class="row">
                <div class="col-6 col-md-3 offset-md-3"><a href="https://linkupmobile.com/privacy-policy/" target="_blank" class="text-decoration-underline mx-3 franklin-family" style="font-size:20px;color:#FCFCFC;"><?php echo $data['privacy']; ?></a></div>
                <div class="col-6 col-md-3"><a href="https://linkupmobile.com/terms-of-service/" target="_blank" class="text-decoration-underline mx-3 franklin-family" style="font-size:20px;color:#FCFCFC;"><?php echo $data['terms']; ?></a></div>
            </div>


        </div>
    </div>
</footer>

<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=<?php echo GOOGLE_MAPS_API_KEY; ?>&libraries=places&callback=initAutocomplete" async defer></script>

<!-- <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAF9ytcfyWi2RoHTr_bKnUTUrFvmyKKjb4&libraries=places&callback=initAutocomplete"> </script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.js"
    integrity="sha512-sn/GHTj+FCxK5wam7k9w4gPPm6zss4Zwl/X9wgrvGMFbnedR8lTUSLdsolDRBRzsX6N+YgG6OWyvn9qaFVXH9w=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous">
</script> -->
  <!-- <script type="text/javascript" src="<?php //echo URLROOT; ?>/js/jquery.min.js?<?php echo rand(0, 999); ?>"></script> -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
  <script type="text/javascript" src="<?php echo URLROOT; ?>/js/index.js"></script>
  <script type="text/javascript" src="<?php echo URLROOT; ?>/js/functions_validation.js?<?php echo rand(9, 9999); ?>"></script>
  <script type="text/javascript" src="<?php echo URLROOT; ?>/js/dist/jquery.validate.js"></script>
  <script type="text/javascript" src="<?php echo URLROOT; ?>/js/dist/additional-methods.js"></script>
  <script type="text/javascript" src="<?php echo URLROOT; ?>/js/bootstrap.bundle.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous">
</script>

<script src="<?php echo URLROOT; ?>/js/main.js"></script>
<script src="<?php echo URLROOT; ?>/js/jquery.mask.js"></script>
<!-- <script src="<?php //echo URLROOT; ?>/js/swiper-bundle.min.js"></script> -->

<script src="https://app.reply.cx/chat-widget/7ZqxdodvfQJL201427298704riBAR5tP.js" data-embed-metadata="{'bot_publish_key': '4f9XNmhUMQUz191300284458aLMpZ2Mq', display_header': 'true'}" defer="defer"></script>
<script>
     // Configura la fecha de finalización (ejemplo: 3 días a partir de ahora)
    const countdownDate = new Date();
    countdownDate.setDate(countdownDate.getDate() + 3);

    const updateCountdown = () => {
        const now = new Date().getTime();
        const distance = countdownDate - now;

        // Cálculos de tiempo
        const d = Math.floor(distance / (1000 * 60 * 60 * 24));
        const h = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
        const m = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
        const s = Math.floor((distance % (1000 * 60)) / 1000);

        // Inyectar en el HTML
        document.getElementById("days").innerText = d;
        document.getElementById("hours").innerText = h < 10 ? "0" + h : h;
        document.getElementById("minutes").innerText = m < 10 ? "0" + m : m;
        document.getElementById("seconds").innerText = s < 10 ? "0" + s : s;

        // Si la oferta termina
        if (distance < 0) {
            clearInterval(interval);
            document.querySelector(".text-warning").innerText = "OFFER EXPIRED";
        }
    };

    // Ejecutar cada segundo
    const interval = setInterval(updateCountdown, 1000);
    updateCountdown(); // Ejecución inicial para evitar el salto de 1s
</script>