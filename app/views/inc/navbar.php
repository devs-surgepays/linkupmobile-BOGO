
<header>
<div class="container-fluid bg-primary text-white py-3" style="background-color: #0877BC !important;">
    <div class="container-fluid">
        <div class="row align-items-center">
            
            <div class="col-12 col-md-4 d-flex align-items-center justify-content-center small franklin-family">
                <?php if($currentPage!="checkout"): ?>
                  <div class="me-2">
                    <a href="<?php echo $langEN; ?>" class="<?php echo ($data['lang']=="en")?"font-yellow":"text-white"; ?> text-decoration-none fw-bold d-flex align-items-center me-2" style="font-size: 24px;">
                      <img src="https://flagcdn.com/24x18/us.png" alt="US" class="me-1">EN</a>
                </div>
                <span class="mx-2">|</span>
                <div>
                    <a href="<?php echo $langES; ?>" class="<?php echo ($data['lang']=="es")?"font-yellow":"text-white"; ?> text-decoration-none fw-bold d-flex align-items-center ms-2" style="font-size: 24px;">
                      <img src="https://flagcdn.com/24x18/mx.png" alt="MX" class="me-1">ES</a>
                </div>
                <?php endif; ?>
            </div>

            <div class="col-6 col-md-4 text-center">
                <img src="<?php echo URLROOT; ?>/img/linkup-white.png" class="img-fluid header-logo" style="" />
            </div>

            <div class="col-6 col-md-4 d-flex flex-column align-items-center justify-content-md-end">
                <p class="mb-1 fw-bold font-yellow franklin-family" style="font-size: 24px; letter-spacing: 0.5px;">
        <?php echo $data['offer_msg']; ?>
      </p>
      
      <div class="d-flex gap-3 text-center franklin-family">
        <div class="px-lg-3 px-md-2">
          <div id="days" class="h4 fw-bolder mb-0">3</div>
          <small class="d-block" style="font-size: 12px;"><?php echo $data['offer_day']; ?></small>
        </div>
        <div class="px-lg-3 px-md-2">
          <div id="hours" class="h4 fw-bolder mb-0">12</div>
          <small class="d-block" style="font-size: 12px;"><?php echo $data['offer_hours']; ?></small>
        </div>
        <div class="px-lg-3 px-md-2">
          <div id="minutes" class="h4 fw-bolder mb-0">59</div>
          <small class="d-block" style="font-size: 12px;"><?php echo $data['offer_minutes']; ?></small>
        </div>
        <div class="px-lg-3 px-md-2">
          <div id="seconds" class="h4 fw-bolder mb-0">00</div>
          <small class="d-block" style="font-size: 12px;"><?php echo $data['offer_seconds']; ?></small>
        </div>
      </div>
            </div>

        </div>
    </div>
</div>
</header>

