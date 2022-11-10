<?php

class Appointment{

    public $id;
    public $user;
    public $service;
    public $date;

    public function __construct($id=null, $user=null, $service=null, $date=null){
        $this->id = $id;
        $this->user = $user;
        $this->service = $service;
        $this->date = $date;
    }

    

    //prikazi sve termine od jednog klijenta

    public static function getAll(mysqli $conn){
        $query = "select * from appointment";
        return $conn->query($query);
    }

    //dodaj termin

    public static function add(Appointment $a, Service $s, User $u, date $d, mysqli $conn){
        $query = "INSERT INTO appointment(id, user, service, date) VALUES(null, '$u', '$s', '$d')";
        return $conn->query($query);
    }

    //izbrisi termin

    public static function deleteById(mysqli $conn){
        $query = "DELETE FROM appointment WHERE id='$this->id'";
        return $conn->query($query);
    }

    //azuriraj termin

    public static function update(Appointment $a, User $u, Service $s, date $d, mysqli $conn){
        $query = "UPDATE appointment SET service=$this->service, user=$this->user";
        return $conn->query($query);
    }
}

?>