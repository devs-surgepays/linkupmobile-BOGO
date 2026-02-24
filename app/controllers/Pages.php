<?php

  class Pages extends Controller {

    public function __construct(){

     

    }

    

    public function index(){

      if(isLoggedIn()){

        redirect('posts');

      }

      $data = [

        'title' => 'SharePosts',

        'description' => 'Simple social network built on the Emmizy MVC framework',

        'info' => 'You can contact me with the following details below if you like my program and willing to offer me a contract and work on your project',

        'name' => 'Omonzebaguan Emmanuel',

        'location' => 'Nigeria, Edo State',

        'contact' => '+2348147534847',

        'mail' => 'emmizy2015@gmail.com'

      ];

     

      $this->view('pages/index', $data);

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