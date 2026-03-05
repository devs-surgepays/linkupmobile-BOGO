<?php

  class Pages extends Controller {

    public function __construct(){

     

    }

    

    public function index($lang=NULL){
      $lang = $lang ? $lang : 'en';
      $tid = ($_GET['tid'])?$_GET['tid']:"";
      $data = [
        
        'en'=>[
          'tid'=>$tid,
          'lang' => 'en',
          'title' => 'Welcome to LinkUp Mobile',
          'main_title' => '2X EVERYTHING',
          'blue_heading_1' => '2X&nbsp;THE&nbsp;COVERAGE. 2X&nbsp;THE&nbsp;DATA. 2X&nbsp;THE&nbsp;VALUE',
          'main_description' => '<span>Activate your line</span> with this <span>limited-time offer</span> and your second month is completely free! Don&apos;t miss out, get started&nbsp;today.',
          
          // Offer Countdown 
          'offer_msg'=>'OFFER ENDS SOON!',
          'offer_day'=>'DAYS',
          'offer_minutes' => 'MINUTES',
          'offer_hours' => 'HOURS',
          'offer_seconds' => 'SECONDS',
          // Promo Details Section
          'promo_bubble_text' => 'BUY 1 MONTH, <br> GET 1 MONTH FREE',
          'promo_bubble_text_2' => 'UNLIMITED TALK & TEXT + <br> ROAMING TO & WITHIN MEXICO',
          'promo_perks_description' => 'With your LinkUp data plan you get <span>additional perks</span> such as <span>unlimited talk & text</span> as well as roaming included to and within&nbsp;Mexico',
          
          // BOGO DEAL
          'bogo_deal_title'=>'BUY ONE MONTH. <span class="font-yellow">GET ONE MONTH FREE.</span>',
          'bogo_deal_plan' =>'YOU&apos;RE GETTING:',
          'bogo_deal_desc' => '+ 1 FREE MONTH',
          'bogo_deal_charges' => '(+ taxes & fees)*',
          // BOGO Section
          'bogo_heading' => 'BOGO DEAL',
          'bogo_subheading' => 'Limited time only!',
          'bogo_data_label' => 'Data:',
          'bogo_price' => '$30 / mo.',
          'bogo_data_amount' => '12GB',
          'bogo_see_details' => 'SEE PLAN DETAILS',
          'plan_feature_1' => '<span class="fw-demi">12 GB</span><span class="fw-medium">high-speed data</span>',
          'plan_feature_2' => '<span class="fw-demi">Unlimited talk & text</span><span class="fw-medium">to and within US, Canada, and Mexico</span>',
          'plan_feature_3' => '<span class="fw-medium">Unlimited calling to</span><span class="fw-demi">100+ international destinations</span>',
          'plan_feature_4' => '<span class="fw-demi">Mobile Hotspot</span>',
          'plan_feature_5' => '<span class="fw-demi">Global Roaming</span><span class="fw-medium">via Wi-Fi Calling</span>',
          'broadband_label' => 'Check broadband facts label',
          'broadband_premium' => 'PREMIUM',
          'broadband_plan_desc' => '12GB data plan',
          
          // International Section
          'intl_heading' => 'International built in. No extra&nbsp;cost.',
          'intl_description' => 'With LinkUp Mobile, you can enjoy <span>unlimited&nbsp;landline and mobile calls to 100+&nbsp;international&nbsp;destinations</span>',
          'intl_search_heading' => 'Search for unlimited<br>international destination:',
          'intl_select_destination' => 'Select a destination',
          'intl_cannot_find_imei' => 'Can\'t find your IMEI?',
          
          // Bubble Headings
          'bubble_heading_1' => 'UNLIMITED LANDLINE<br>AND MOBILE',
          'bubble_content_1' => 'With LinkUp Mobile, you have unlimited landline and mobile calls to the following destinations:',
          'bubble_heading_2' => 'UNLIMITED LANDLINE',
          'bubble_content_2' => 'With LinkUp Mobile, you have unlimited landline calls to the following destinations:',
          'bubble_heading_3' => 'UNLIMITED MOBILE',
          'bubble_content_3' => 'With LinkUp Mobile, you have unlimited mobile calls to the following destinations:',
          'view_full_list' => 'View our full list of international destinations',
          
          // Why LinkUp Section
          'why_linkup_heading' => 'WHY LINKUP?',
          'carousel_slide_1' => 'Unlimited<br>Talk and Text',
          'carousel_slide_2_col1' => 'ROAMING WITHIN THE US, MEXICO AND CANADA',
          'carousel_slide_2_col2' => '100+ UNLIMITED INTERNATIONAL&nbsp;DESTINATIONS',
          'carousel_slide_3_col1' => 'ROAMING WITHIN MEXICO&nbsp;INCLUDED',
          'carousel_slide_3_col2' => 'AFFORDABLE DATA ADD-ONS',
          'carousel_slide_4_col1' => 'NATIONWIDE HIGH-SPEED COVERAGE',
          'carousel_slide_4_col2' => '24/7 CUSTOMER SUPPORT',
          
          // Reviews Section
          'reviews_heading' => 'REVIEWS',
          'reviews_description' => 'Customers are talking, and we\'re listening.<br><span>Real time reviews</span> from users who have saved with&nbsp;LinkUp.',
          
          // Testimonials
          'review_1_heading' => 'Great customer service, even better&nbsp;value!',
          'review_1_text' => 'I was unsure at first, but customer support really helped me understand the plan. Everything works as promised, and the value for the price honestly surprised&nbsp;me.',
          'review_1_name' => 'Jasmine M.',
          'review_1_city' => 'Memphis, TN',
          
          'review_2_heading' => 'Unlimited talk and&nbsp;text',
          'review_2_text' => 'I use my phone all day, so having unlimited talk and text was important. Calls are clear, no dropped issues, and I never worry about overages&nbsp;anymore.',
          'review_2_name' => 'Tasha D.',
          'review_2_city' => 'Atlanta, GA',
          
          'review_3_heading' => 'Everything was&nbsp;clear',
          'review_3_text' => 'What I love most is that there are no hidden fees. Everything was clear from the start and the service is very reliable for my business&nbsp;needs.',
          'review_3_name' => 'Robert S.',
          'review_3_city' => 'Dallas, TX',
          
          // Support Section
          'support_heading' => '24/7 Human Support',
          'support_description' => 'Questions or need help? Our bilingual customer support team is ready to step in, answer your questions, and support you every step.',
          'support_link_text' => 'VISIT HELP CENTER',
          
          // Modal/IMEI Section
          'modal_heading' => 'KEEP YOUR PHONE AND&nbsp;NUMBER',
          'modal_imei_explanation' => 'Check your IMEI code to make sure they are LinkUp eSIM compatible',
          'modal_imei_description' => 'Your <b>IMEI</b> (International Mobile Equipment Identity) is a unique number that identifies your phone and lets us check if it\'s compatible with LinkUp Mobile\'s eSIM&nbsp;service.',
          'modal_imei_label' => 'IMEI:',
          'modal_imei_placeholder' => 'Enter your 15 - 17 digit IMEI',
          'modal_check_btn' => 'Check Compatibility',
          
          'modal_locate_heading' => 'LOCATE YOUR IMEI',
          'modal_android_heading' => 'Android Users:',
          'modal_android_option_1' => '<b>Option 1:</b> Dial *#06#',
          'modal_android_option_2' => '<b>Option 2:</b> Go to Settings > About Phone',
          'modal_android_option_3' => '<b>Option 3:</b> Visit <a href="http://www.android.com/find" target="_blank" rel="noopener noreferrer">www.android.com/find</a>',
          
          'modal_iphone_heading' => 'iPhone Users:',
          'modal_iphone_step_1' => '<b>Step 1:</b> Go to Settings > General > About',
          'modal_iphone_step_2' => '<b>Step 2:</b> Scroll to the bottom',
          'modal_iphone_step_3' => '<b>Step 3:</b> You will find your 15 - 17 IMEI<br>number under "Available&nbsp;SIM"',
          
          'modal_still_need_help' => 'Still need help?',
          'modal_broadband_facts' => 'Broadband Facts',
          'review_offer_btn' => 'REVIEW OFFER',
          'claim_offer_btn' => 'CLAIM OFFER',

        ],
        'es'=>[
          'tid'=>$tid,
          'lang' => 'es',
          'title' => 'Bienvenido a LinkUp Mobile',
          'main_title' => 'DUPLICA TU PLAN',
          'blue_heading_1' => 'DOBLE&nbsp;COBERTURA. DOBLE&nbsp;DE&nbsp;DATOS. DOBLE&nbsp;VALOR',
          'main_description' => '<span>Activa una linea</span> con esta oferta por <span>tiempo limitado</span> y disfruta del segundo mes completamente gratis. ¡No te la pierdas, empieza hoy&nbsp;mismo!',
          
          // Offer Countdown 
          'offer_msg'=>'¡LA OFERTA TERMINA PRONTO!',
          'offer_day'=>'DIAS',
          'offer_minutes' => 'MINUTOS',
          'offer_hours' => 'HORAS',
          'offer_seconds' => 'SEGUNDOS',
          // Promo Details Section
          'promo_bubble_text' => 'COMPRA 1 MES, <br> TE REGALAMOS 1 MES',
          'promo_bubble_text_2' => 'LLAMADAS Y TEXTOS ILIMITADOS + <br> ROAMING HACIA Y DENTRO DE MEXICO',
          'promo_perks_description' => 'Con tu plan de datos LinkUp obtienes <span>beneficios adicionales</span> como <span>llamadas y mensajes de texto ilimitados</span>, así como roaming incluido hacia y dentro de México.',
          
          // BOGO DEAL
          'bogo_deal_title'=>'COMPRA 1 MES, <span class="font-yellow">TE REGALAMOS 1 MES</span>',
          'bogo_deal_plan' =>'OBTIENES',
          'bogo_deal_desc' => '+ 1 MES GRATIS',
          'bogo_deal_charges' => '(+ impuestos y cargos)*',
          // BOGO Section
          'bogo_heading' => 'OFERTA ESPECIAL',
          'bogo_subheading' => 'Disponible por tiempo imitado!',
          'bogo_data_label' => 'Tu Plan:',
          'bogo_price' => '$30 / mo.',
          'bogo_data_amount' => '12GB',
          'bogo_see_details' => 'DETALES DEL PLAN',
          'plan_feature_1' => '<span class="fw-demi">12 GB</span><span class="fw-medium"> de datos alta velocidad</span>',
          'plan_feature_2' => '<span class="fw-demi">Llamadas y SMS ilimitados</span><span class="fw-medium"> hacia y dentro de Estados Unidos, Canadá, y México</span>',
          'plan_feature_3' => '<span class="fw-medium">Llamadas ilimitadas a </span><span class="fw-demi">más de 100 destinos internacionales</span>',
          'plan_feature_4' => '<span class="fw-demi">Punto de acceso hotspot</span>',
          'plan_feature_5' => '<span class="fw-demi">Roaming Global </span><span class="fw-medium">mediante llamadas Wi-Fi</span>',
          'broadband_label' => 'Consultar información de banda ancha',
          'broadband_premium' => 'PREMIUM',
          'broadband_plan_desc' => '12GB data plan',
          
          // International Section
          'intl_heading' => 'Llamadas Internacionales Incluidas<br>sin costo&nbsp;adicional.',
          'intl_description' => 'Con LinkUp Mobile, puedes disfrutar de <span>llamadas ilimitadas a más de 100 destinos internacionales</span> completamente gratis',
          'intl_search_heading' => 'Búsqueda de destinos<br>internacionales ilimitados:',
          'intl_select_destination' => 'Selecciona tu destino',
          
          
          // Bubble Headings
          'bubble_heading_1' => 'LLAMADAS FIJAS Y<br>MÓVILES ILIMITADAS',
          'bubble_content_1' => 'con LinkUp Mobile, tienes llamadas fijas y móviles ilimitadas en los siguientes&nbsp;destinos:',
          'bubble_heading_2' => 'LLAMADAS FIJAS ILIMITADAS',
          'bubble_content_2' => 'con LinkUp Mobile, tienes llamadas fijas ilimitadas en los siguientes&nbsp;destinos:',
          'bubble_heading_3' => 'LLAMADAS MÓVILES ILIMITADAS',
          'bubble_content_3' => 'con LinkUp Mobile, tienes llamadas móviles ilimitadas en los siguientes&nbsp;destinos',
          'view_full_list' => 'Mira nuestra lista completa de destinos&nbsp;internacionales',
          
          // Why LinkUp Section
          'why_linkup_heading' => '¿POR QUÉ LINKUP MOBILE?',
          'carousel_slide_1' => 'LLAMADAS Y MENSAJES DE TEXTO&nbsp;ILIMITADOS',
          'carousel_slide_2_col1' => 'ROAMING DENTRO DE EE. UU., MÉXICO Y&nbsp;CANADA',
          'carousel_slide_2_col2' => 'MÁS DE 100 DESTINOS INTERNACIONALES&nbsp;ILIMITADOS',
          'carousel_slide_3_col1' => 'ROAMING A MÉXICO&nbsp;INCLUIDO',
          'carousel_slide_3_col2' => 'DATOS ADICIONALES&nbsp;ACCESIBLES',
          'carousel_slide_4_col1' => 'COBERTURA DE ALTA VELOCIDAD A NIVEL&nbsp;NACIONAL',
          'carousel_slide_4_col2' => 'SERVICIO DE ATENCIÓN AL CLIENTE&nbsp;24/7',
          
          // Reviews Section
          'reviews_heading' => 'RESEÑAS',
          'reviews_description' => 'Descubre por qué tantos de nuestro usuarios aman el servicio de LinkUp&nbsp;Mobile',
          
          // Testimonials
          'review_1_heading' => 'Excelente servicio al cliente, ¡y aún mejor&nbsp;precio!',
          'review_1_text' => 'Al principio tenía dudas, pero el servicio de atención al cliente me ayudó mucho a entender el plan. Todo funciona según lo prometido y, sinceramente, la relación calidad-precio me&nbsp;sorprendió.',
          'review_1_name' => 'Jasmine M.',
          'review_1_city' => 'Memphis, TN',
          
          'review_2_heading' => 'Llamadas y mensajes&nbsp;ilimitados',
          'review_2_text' => 'Uso mi teléfono todo el día, así que tener llamadas y mensajes ilimitados era importante. Las llamadas son claras, no se cortan y ya no me preocupa el&nbsp;sobrecosto.',
          'review_2_name' => 'Tasha D.',
          'review_2_city' => 'Atlanta, GA',
          
          'review_3_heading' => 'Todo estaba&nbsp;claro',
          'review_3_text' => 'Lo que más me gusta es que no hay cargos ocultos. Todo estuvo claro desde el principio y el servicio es muy confiable para las necesidades de mi&nbsp;negocio.',
          'review_3_name' => 'Robert S.',
          'review_3_city' => 'Dallas, TX',
          
          // Support Section
          'support_heading' => 'SERVICIO AL CLIENTE&nbsp;BILINGÜE',
          'support_description' => '¿Tienes preguntas o necesitas ayuda? Nuestro equipo bilingüe de servicio al cliente está listo para ayudarte, responder tus preguntas y acompañarte en cada&nbsp;paso.',
          'support_link_text' => 'IR AL CENTRO DE&nbsp;SOPORTE',
          
          // Modal/IMEI Section
          'modal_heading' => 'CONSERVA TU NÚMERO Y&nbsp;TELÉFONO',
          'modal_imei_explanation' => 'Verifique su código IMEI para asegurarse de que sean compatibles con LinkUp&nbsp;eSIM',
          'modal_imei_description' => 'Tu IMEI (Identidad internacional de equipo móvil) es un número único que identifica su teléfono y nos permite verificar si es compatible con el servicio eSIM de LinkUp&nbsp;Mobile.',
          'modal_imei_label' => 'IMEI:',
          'modal_imei_placeholder' => 'Ingresa to codigo IMEI',
          'modal_check_btn' => 'Revisar Compatibilidad',
          'intl_cannot_find_imei' => '¿No encuentras tu IMEI?',
          
          'modal_locate_heading' => 'LOCALIZA TU&nbsp;IMEI',
          'modal_android_heading' => 'Usuarios de&nbsp;Android:',
          'modal_android_option_1' => '<b>Opción 1:</b> Marca *#06#',
          'modal_android_option_2' => '<b>Opción 2:</b> Ve a Ajustes > Acerca del&nbsp;Teléfono',
          'modal_android_option_3' => '<b>Opción 3:</b> Visita <a href="http://www.android.com/find" target="_blank" rel="noopener noreferrer">www.android.com/find</a>',
          
          'modal_iphone_heading' => 'Usuarios de&nbsp;iPhone:',
          'modal_iphone_step_1' => '<b>Paso 1:</b> Ve a Ajustes > General > Acerca&nbsp;de',
          'modal_iphone_step_2' => '<b>Paso 2:</b> Ve al final del&nbsp;menú',
          'modal_iphone_step_3' => '<b>Paso 3:</b> Encontrarás tu número IMEI 15-17 en "SIM&nbsp;disponible"',
          
          'modal_still_need_help' => '¿Aún necesitas ayuda?',
          'modal_broadband_facts' => 'Broadband Facts',
          'review_offer_btn' => 'VER OFERTA',
          'claim_offer_btn' => 'OBTENER OFERTA',
        ]

      ];

     

      $this->view('pages/index', $data[$lang]);

    }



    public function about(){

      $data = [

        'title' => 'About Us',

        'description' => 'App to share posts with other users'

      ];



      $this->view('pages/about', $data);

    }



    public function contact(){

      $data = [

          'title' => 'Contact Us',

          'description' => 'You can contact us through this medium',

          'info' => 'You can contact me with the following details below if you like my program and willing to offer me a contract and work on your project',

          'name' => 'Omonzebaguan Emmanuel',

          'location' => 'Nigeria, Edo State',

          'contact' => '+2348147534847',

          'mail' => 'emmizy2015@gmail.com'

      ];



      $this->view('pages/contact', $data);

    }

    public function check_imei($imei){
      //if($_SERVER['REQUEST_METHOD'] == 'POST') {
        //$imei = $_POST['imei'];
        $data = [
          'imei' => trim($imei)
        ];

        $curl = curl_init();

        $request = '<Request>
  <CellularRtrPurchase sku="8033">
    <ApiUsername>AHWS</ApiUsername>
    <ApiPassword>a4Wh0!3a13!</ApiPassword>
    <TerminalType>1</TerminalType>
    <TerminalId>3695974391</TerminalId>
    <ClerkId>1</ClerkId>
    <IMEI>' . $data['imei']. '</IMEI>
    <Amount>0.00</Amount>
    <PIN/>
  </CellularRtrPurchase>
  </Request>';
        curl_setopt_array($curl, array(
          CURLOPT_URL => 'https://www.ecsprepaid.com/api/',
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_ENCODING => '',
          CURLOPT_MAXREDIRS => 10,
          CURLOPT_TIMEOUT => 0,
          CURLOPT_FOLLOWLOCATION => true,
          CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
          CURLOPT_CUSTOMREQUEST => 'POST',
          CURLOPT_SSL_VERIFYPEER => false,
          CURLOPT_POSTFIELDS =>"request=" . urlencode($request),
          CURLOPT_HTTPHEADER => array(
            "cache-control: no-cache",
            "content-type: application/x-www-form-urlencoded",
          ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        $xml = simplexml_load_string($response);
        $json = json_encode($xml);
        $array = json_decode($json, TRUE);

        $data['response'] = $array;

        //$this->view('pages/checkimei', $data);
        echo json_encode($data);
      // } else {
      //   echo json_encode(['error' => 'Invalid request method']);
      // }
    }

    public function checkout(){
      if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $imei = $_POST['imei'];
        $tid = $_POST['tid'];
        $data = [
          'imei' => trim($imei),
          'tid' => $tid
        ];
        $this->view('pages/checkout', $data);
      } else {
        echo "Invalid request method.";
      }
    }

    public function thankyou()
    {
      if ($_SERVER['REQUEST_METHOD'] == 'GET') {

        $utm_source = isset($_GET['utm_source']) ? $_GET['utm_source'] : null;
        $utm_medium = isset($_GET['utm_medium']) ? $_GET['utm_medium '] : null;
        $utm_campaign = isset($_GET['utm_campaign']) ? $_GET['utm_campaign'] : null;
        $utm_content = isset($_GET['utm_content']) ? $_GET['utm_content '] : null;
        $match_type = isset($_GET['match_type']) ? $_GET['match_type'] : null;
        $utm_adgroup = isset($_GET['utm_adgroup']) ? $_GET['utm_adgroup'] : null;
        $transaction_info = isset($_GET['ti']) ? $_GET['ti'] : null;
      }
      $exTransID= explode('|',$transaction_info);
      $phone= base64_decode($exTransID[0]);
      $transId = base64_decode($exTransID[1]);
      $data = [
          'title' => "About US",
          'logo' => '/img/USAPhone_WhitePNG.png',
          'description' => "App to share posts to other users",
          'phone_number' => $phone,
          'trans_id' => $transId
        ];
      $this->view('pages/thankyou', $data);
    }  

  }