<?php

class User{

    public $id;
    public $username;
    public $password;
    public $firstname;
    public $lastname;
    public $contact;

    public function __construct($id=null, $username=null, $password=null, $contact=null, $firstname=null, $lastname=null){
        $this->id = $id;
        $this->username = $username;
        $this->password = $password;
        $this->contact = $contact;
        $this->firstname = $firstname;
        $this->lastname = $lastname;
        
    }

    public static function loginUser($username, $password, mysqli $conn): ?User
    {
        $query = "SELECT * FROM user WHERE username = '$username' AND password = '$password'";
        $result = $conn->query($query);

        if ($result->num_rows == 1) {
            return new User($result->fetch_assoc()["id"], $username, $password);
        }
        return null;
    }

    public static function getById($id, mysqli $conn): ?User
    {
        $query = "SELECT * FROM user WHERE id=$id";
        $result = $conn->query($query);
        if ($result) {
            $row = $result->fetch_array(1);
            return new User($row["id"], $row["username"], $row["password"], $row["contact"], $row["firstname"], $row["lastname"]);
        } else {
            return null;
        }
    }

    public static function getAllAsArray(mysqli $conn): ?array
    {
        $query = "SELECT * FROM user";
        $result = $conn->query($query);

        if (!$result) {
            echo "Error while retrieving data";
            return null;
        }
        if ($result->num_rows == 0) {
            echo "No services currently";
            return null;
        } else {
            $users = array();
            while ($row = $result->fetch_array()) {
                $user = new User($row["id"], $row["username"], $row["password"], $row["contact"], $row["firstname"], $row["lastname"]);
                array_push($users, $user);
            }
            return $users;
        }
    }
}

?>
