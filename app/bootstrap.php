<?php

  // Load Config

  require_once 'config/config.php';

  require_once 'helpers/url_helpers.php';

  require_once 'helpers/session_helper.php';

  require_once 'helpers/ecs_api.php';

  require_once 'helpers/coverage.php';

  require_once("helpers/encrypt_decrypt.php");
  
  require_once("helpers/suretax_api.php");

  require_once("helpers/notifications.php");

  require_once("helpers/sendEmailByCurl.php");



// Autoload Core Libraries
spl_autoload_register(function ($className) {

  require_once('libraries/' . $className . '.php');
});				  	





