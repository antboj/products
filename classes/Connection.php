<?php

class Connection {

    public $conn;
    private static $instance;

    private function __construct(){
        $this->conn = new PDO("mysql:host=".DBHOST.";dbname=".DBNAME,DBUSER,DBPASS);
    }
    // Instantiate connection class only once
    public static function getInstance(){
        if(!self::$instance){
            self::$instance = new Connection();
        }
        return self::$instance;
    }
}