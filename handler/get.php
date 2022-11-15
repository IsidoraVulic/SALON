<?php
require "../dbBroker.php";
require "../model/appointment.php";
require "../model/user.php";
require "../model/service.php";


if (isset($_POST['id'])) {
    $appointment = Appointment::getById($_POST['id'], $conn);
    echo json_encode($appointment);
}