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

    //nadji po ID-u

    public static function getById($id, mysqli $conn): ?Service
    {
        $query = "SELECT * FROM service WHERE id=$id";
        $result = $conn->query($query);
        if ($result) {
            $row = $result->fetch_array(1);
            return new Service($row["id"], $row["type"], $row["price"]);
        } else {
            return null;
        }
    }

    //prikazi sve usluge

    public static function getAll(mysqli $conn){
        $query = "select * from service";
        return $conn->query($query);
    }

    public static function getAllAsArray(mysqli $conn): ?array
    {
        $query = "SELECT * FROM service";
        $result = $conn->query($query);

        if (!$result) {
            echo "Error while retrieving data";
            return null;
        }
        if ($result->num_rows == 0) {
            echo "No services currently";
            return null;
        } else {
            $services = array();
            while ($row = $result->fetch_array()) {
                $service = new Service($row["id"], $row["type"], $row["price"]);
                array_push($services, $service);
            }
            return $services;
        }
    }

}

?>