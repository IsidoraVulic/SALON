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

    public static function getAll(mysqli $conn): ?array{
        $query = "SELECT * FROM appointment a JOIN user u ON a.user = u.id 
        JOIN service s ON s.id = a.service;

        $result = $conn->query($query);
        if (!$result) {
            echo 'Error while retrieving data';
            return null;
        }
        if ($result->num_rows == 0) {
            echo 'No appointments currently';
            return null;
        } else {
            $appointments = array();
            while ($row = $result->fetch_array()) {
                $user = new User($row->user, $row->username, $row->password, $row->contact);
                $service = new Service($row->service, $row->type, $row->price);
                $date = $row->date;
                $appointment = new Appointment($row->id, $user, $service, $date);
                array_push($appointments, $appointment);
            }
            return $appointments;
        }
    }

    public static function getById(mysqli $conn){
            $query = "SELECT FROM appointment where id=$appointment->id";
             return $conn->query($query);
    }

    //dodaj termin

   public static function add(Appointment $appointment, mysqli $conn){

        $query = "INSERT INTO appointment (user, service, date) VALUES ('$appointment->user->id', '$appointment->service_id', '$prijava->date')";
        return $conn->query($query);
    }

    //izbrisi termin

    public static function deleteById(mysqli $conn){
        $query = "DELETE FROM appointment WHERE id='$this->id'";
        return $conn->query($query);
    }

    //azuriraj termin

    public static function update(Appointment $appointment, mysqli $conn){
        $user_id = $appointment->user->id;
        $service_id = $appointment->service->id;
        $date = $appointment->date->format("Y-m-d H:i:s");

        $query = "UPDATE appointment SET date = ' $date', user = $user_id, service = $service_id WHERE id=$appointment->id";

        return $conn->query($query);
    }
}

?>