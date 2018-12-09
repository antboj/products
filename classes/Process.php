<?php

class Process{

    public function __construct($requestMethod){
        
        // Check request method and call Factory class
        switch($requestMethod){
            case 'get':
                $response = [];
                if(isset($_GET['id'])){
                    $device = Factory::getDevice(device());
                    $response = $device::get($_GET['id']);
                }else{
                    $device = Factory::getDevice(device());
                    $response = $device::getAll();
                }
                // Output JSON
                echo json_encode($response);
            break;
            case'post':
                // Read body content 
                $body = file_get_contents('php://input');
                // Decode body content from JSON
                $body = json_decode($body);
                $device = Factory::getDevice(device());
                // Get values
                $device_name = $body->device_name;
                $OS = $body->OS;
                $processor = $body->processor;
                $ram_memory = $body->ram_memory;
                $screen_size = isset($body->screen_size) ? $body->screen_size : null;
                $touch_screen = isset($body->touch_screen) ? $body->touch_screen : null;
                // Setting properties
                $device->set($device_name,$OS,$processor,$ram_memory,$screen_size,$touch_screen);
                $res = $device->insert();
                // HTTP response
                if($res){
                    header("HTTP/1.1 200 OK");
                }else{
                    header("HTTP/1.1 400 Bad Request");
                }
            break;
            case'put':
                $body = file_get_contents('php://input');
                $body = json_decode($body);
                $device = Factory::getDevice(device());
                // Get values
                $id = $body->id;
                $device_name = $body->device_name;
                $OS = $body->OS;
                $processor = $body->processor;
                $ram_memory = $body->ram_memory;
                $screen_size = isset($body->screen_size) ? $body->screen_size : null;
                $touch_screen = isset($body->touch_screen) ? $body->touch_screen : null;
                // Setting properties
                $device->set($device_name,$OS,$processor,$ram_memory,$screen_size,$touch_screen);
                $res = $device->update($id);
                // HTTP response
                if($res){
                    header("HTTP/1.1 200 OK");
                }else{
                    header("HTTP/1.1 400 Bad Request");
                }
            break;
            case'delete':
            if(isset($_GET['id'])){
                $device = Factory::getDevice(device());
                if($device->delete($_GET['id'])){
                    header("HTTP/1.1 200 OK");
                }else{
                    header("HTTP/1.1 400 Bad Request");
                }
            }
            break;
        }
    }
}