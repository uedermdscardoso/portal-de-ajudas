<?php

class ConnectionFactory {
    
    public static $instance;
    
    private function __construct() { }
    
    public static function getInstance() {
        if (!isset(self::$instance)) {
           self::$instance = new PDO ('mysql:host=localhost;dbname=tcc;charset=utf8','root', '');
           self::$instance->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }
        return self::$instance;
    }   

}
