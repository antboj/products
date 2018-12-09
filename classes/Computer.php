<?php

class Computer{

    protected $type;
    protected $device_name;
    protected $OS;
    protected $ram_memory;
    protected $processor;

    // Get one device type specified by id
    public static function get($id){
        global $pdo;
        $st = $pdo->prepare("SELECT * FROM device_type WHERE id = :id");
        $st->execute([':id'=>$id]);
        return $response = $st->fetch(PDO::FETCH_OBJ);
    }

    // Get all types of devices
    public static function getAll(){
        global $pdo;
        $q = "SELECT * FROM device_type";
        $res = $pdo->query($q);
        while($row = $res->fetch(PDO::FETCH_OBJ)){
            $response[] = $row;
        }
        return $response;
    }

    // Delete device type if no device of that type exists
    public function delete($id){
        global $pdo;
        // Select all devices IDs from one type specified by id
        $q = "SELECT device_properties.device_type_id FROM device_properties WHERE device_properties.device_type_id = {$id}";
        $allDevices = $pdo->query($q);
        // Count devices of that type
        $deviceCount = $allDevices->rowCount();
        // Delete if no devices of that type exists
        if($deviceCount === 0){
        $st = $pdo->prepare("DELETE FROM device_type WHERE id = :id");
        $st->execute([':id'=>$id]);
        }
    }
}