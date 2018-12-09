<?php
require_once 'config.php';

try{
    $pdo = Connection::getInstance()->conn;
}catch(PDOException $e){
    die($e->getMessage());
}
try{
$process = new Process($requestMethod);
}catch(Exception $e){
    die($e->getMessage());
}
