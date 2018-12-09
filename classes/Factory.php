<?php

class Factory{
    // Instance new class specified by $device param
    public static function getDevice($device){

        switch($device){
            case 'Computer':
            return new Computer();
            break;
            case 'Desktop':
            return new Desktop();
            break;
            case 'Laptop':
            return new Laptop();
            break;
            case 'Tablet':
            return new Tablet();
            break;
        }
    }
}