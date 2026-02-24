<?php

/**
 * Envfiles Class
 *
 * 
 *
 */

class Envfiles
{
    public function __construct()
    {
        // log_message('Debug', 'Envfiles class is loaded.');
    }


    public function load()
    {
     
        require_once APPROOT . '/libraries/phpdotenv/Dotenv/Dotenv.php';

        $dotenv = Dotenv\Dotenv::createMutable(__DIR__);
        echo $dotenv->load();
        return $dotenv;
    }
}
