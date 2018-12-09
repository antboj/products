<?php

class Desktop extends Computer{

    protected $type = 1;

    // Get one device specified by id
    public static function get($id){
        global $pdo;
        $query = "SELECT devices.id, devices.device_name, device_type.type_name, device_properties.OS, device_properties.processor, 
            device_properties.ram_memory, device_properties.screen_size, device_properties.touch_screen
        FROM devices 
        JOIN device_type ON device_type.id = devices.device_type_id
        JOIN device_properties ON device_properties.devices_id = devices.id 
        WHERE devices.id = :id";
        $st = $pdo->prepare($query);
        $st->execute([':id'=>$id]);
        return $response = $st->fetch(PDO::FETCH_OBJ);
    }

    // Get all devices
    public static function getAll($filter=''){ // $filter can be used for more specific search
        global $pdo;
        // Get name of the class that called method
        $cl = get_called_class();
        $query = "SELECT devices.id, devices.device_name, device_type.type_name, device_properties.OS, device_properties.processor, 
            device_properties.ram_memory, device_properties.screen_size, device_properties.touch_screen
            FROM devices
            JOIN device_type ON device_type.id = devices.device_type_id
            JOIN device_properties ON device_properties.devices_id = devices.id  WHERE device_type.type_name = '{$cl}' {$filter}";
            $res = $pdo->query($query);
            while($row = $res->fetch(PDO::FETCH_OBJ)){
                $response[] = $row;
            }
            return $response;
    }

    // Set properties
    public function set($device_name,$OS,$processor,$ram_memory){
        $this->device_name = $device_name;
        $this->OS = $OS;
        $this->processor = $processor;
        $this->ram_memory = $ram_memory;
    }

    // Insert new device
    public function insert(){
        global $pdo;
        // Insert device
        $st = $pdo->prepare("INSERT INTO devices (device_name, device_type_id) VALUES (:device_name, :type)");
        $st->execute([':device_name'=>$this->device_name,':type'=>$this->type]);
        // Take id from last inserted device
        $lid =  $pdo->lastInsertId();
        // Insert devices properties
        $st = $pdo->prepare("INSERT INTO device_properties (OS, processor, ram_memory,devices_id, device_type_id) VALUES (:OS, :processor, :ram_memory, :lid, :type)");
        $st->execute([':OS'=>$this->OS, ':processor'=>$this->processor, ':ram_memory'=>$this->ram_memory, ':lid'=>$lid, ':type'=>$this->type]);

    }

    // Update existing device
    public function update($id){
        global $pdo;
        // Update device
        $st = $pdo->prepare("UPDATE devices SET device_name=:device_name, device_type_id=:type WHERE id=:id");
        $st->execute([':device_name'=>$this->device_name,':type'=>$this->type,':id'=>$id]);
        // Update device properties
        $st = $pdo->prepare("UPDATE device_properties SET OS=:OS, processor=:processor, ram_memory=:ram_memory WHERE devices_id=:id");
        $st->execute([':OS'=>$this->OS, ':processor'=>$this->processor, ':ram_memory'=>$this->ram_memory, ':id'=>$id]);
    }

    // Delete device
    public function delete($id){
        global $pdo;
        // Delete device properties
        $st = $pdo->prepare("DELETE FROM device_properties WHERE device_properties.devices_id = :id");
        $st->execute([':id'=>$id]);
        // Delete device
        $st = $pdo->prepare("DELETE FROM devices WHERE devices.id = :id");
        $st->execute([':id'=>$id]);
    }
}