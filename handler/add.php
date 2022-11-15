<?php
require "../dbBroker.php";
require "../model/user.php";
require "../model/service.php";
require "../model/appointment.php";

if (isset($_POST['date']) && isset($_POST['user']) && isset($_POST['service'])) {

    $user = User::getById($_POST['user'], $conn);
    $service = Service::getById($_POST['service'], $conn);
    $date = new DateTime($_POST['date']);

    $appointment = new Appointment(null, $user, $service, $date);
    $status = Appointment::add($appointment, $conn);

    if ($status) {
        echo "Success";
    } else {
        echo "Failed";
    }
}