<?php


class Appointment{

    public $id;
    public ?User $user;
    public ?Service $service;
    public DateTime $date;

    public function __construct($id=null, ?User $user=null, ?Service $service=null, DateTime $date=null){
        $this->id = $id;
        $this->user = $user;
        $this->service = $service;
        $this->date = $date;
    }

    //prikazi sve termine od jednog klijenta

    public static function getAll(mysqli $conn): ?array{
        $query = "SELECT * FROM appointment as a JOIN user as u ON a.user = u.id JOIN service s ON s.id = a.service";

        $result = mysqli_query($conn, $query);
        if (!$result) {
            echo 'Error while retrieving data';
            return null;
        }
        if ($result->num_rows == 0) {
            echo 'No appointments currently';
            return null;
        } else {
            $appointments = array();
            while ($row = mysqli_fetch_array($result)) {
                $user = new User($row['user'], $row['username'], $row['password'],$row['contact'], $row['firstname'], $row['lastname']);
                $service = new Service($row['service'], $row['type'], $row['price']);
                $date = new DateTime($row['date']);
                $appointment = new Appointment($row['id'], $user, $service, $date);
                array_push($appointments, $appointment);
            }
            return $appointments;
        }
    }

    //azuriraj termin

    public static function update(Appointment $appointment, mysqli $conn){
        $user_id = $appointment->user->id;
        $service_id = $appointment->service->id;
        $date = $appointment->date->format("Y-m-d H:i:s");

        $query = "UPDATE appointment SET date = '$date', user = $user_id, service = $service_id WHERE id=$appointment->id";

        return $conn->query($query);
    }

    //izbrisi termin

    public static function deleteById($id, mysqli $conn){
        $query = "DELETE FROM appointment WHERE id=$id";
        return $conn->query($query);
    }

    //dodaj termin

    public static function add(Appointment $appointment, mysqli $conn)
    {
        $user = $appointment->user->id;
        $service = $appointment->service->id;
        $date = $appointment->date->format("Y-m-d H:i:s");
        $query = "INSERT INTO appointment (user, service, date) VALUES ($user,$service, '$date')";

        return $conn->query($query);
    }

    //nadji termin po ID-u

    public static function getById($id, mysqli $conn): ?Appointment
    {
        $query = "SELECT * FROM appointment a JOIN user u ON a.user = u.id 
        JOIN service s ON a.service=s.id";

        $result = $conn->query($query);

        if ($result) {
            $row = $result->fetch_array(1);
            $user = new User($row["user"], $row["username"], $row["password"], $row["contact"], $row["firstname"], $row["lastname"]);
            $service = new Service($row["service"], $row["type"], $row["price"]);
            $date = new DateTime($row["date"]);
            return new Appointment($row["id"], $user, $service, $date);
        } else {
            return null;
        }
    }
   
}

