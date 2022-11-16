<?php

class Admin{

    public $id;
    public $username;
    public $password;
   

    public function __construct($id=null, $username=null, $password=null){
        $this->id = $id;
        $this->username = $username;
        $this->password = $password;
        
    }

    public static function loginAdmin($username, $password, mysqli $conn): ?Admin
    {
        $query = "SELECT * FROM admin WHERE username = '$username' AND password = '$password'";
        $result = $conn->query($query);

        if ($result->num_rows == 1) {
            return new Admin($result->fetch_assoc()["id"], $username, $password);
        }
        return null;
    }

    
}

?>