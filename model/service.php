<?php

class Service{
    public $id;
    public $type;
    public $price;

    public function __construct($id=null, $type=null, $price=null){
        $this->id = $id;
        $this->type = $type;
        $this->price = $price;
    }

    //prikazi sve usluge

    public static function getAll(mysqli $conn){
        $query = "select * from service";
        return $conn->query($query);
    }
}

?>