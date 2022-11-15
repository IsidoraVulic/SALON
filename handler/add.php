<?php
require "../dbBroker.php";
require "../model/user.php";
require "../model/service.php";
require "../model/appointment.php";

if (isset($_POST['appointmentDate']) && isset($_POST['user']) && isset($_POST['service'])) {

    $user = User::getById($_POST['user'], $conn);
    $service = Location::getById($_POST['service'], $conn);
    $date_time = new DateTime($_POST['appointmentDate']);

    $appointment = new Appointment(null, $user, $service, $date_time);
    $status = Appointment::add($appointment, $conn);

    if ($status) {
        echo "Success";
    } else {
        echo "Failed";
    }
}