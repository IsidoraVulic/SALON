<?php

require "../dbBroker.php";
require "../model/appointment.php";
require "../model/service.php";
require "../model/user.php";

if (isset($_POST['idEdit']) && isset($_POST['dateEdit']) && isset($_POST['userEdit']) && isset($_POST['serviceEdit'])) {

    $user = User::getById($_POST['userEdit'], $conn);
    $service = Service::getById($_POST['serviceEdit'], $conn);
    $date_time = new DateTime($_POST['dateEdit']);

    $appointment = new Appointment($_POST['idEdit'], $user, $service, $date_time);
    $status = Appointment::update($appointment, $conn);

    if ($status) {
        echo "Success";
    } else {
        echo "Failed";
    }
}


?>