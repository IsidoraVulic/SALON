<?php
require "../dbBroker.php";
require "../model/appointment.php";

if(isset($_POST['id'])){
    
    $status = Appointment::deleteById($_POST['id'], $conn);
    if($status){
        echo 'Success';
    }else{
        echo 'Failed';
    }
}