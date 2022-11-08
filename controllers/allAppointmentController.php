<?php
require_once(__DIR__ . '/../helpers/dataBase.php');
require_once(__DIR__ . '/../models/Patient.php');
require_once(__DIR__ . '/../models/Appointment.php');

try {
    $id = intval(filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT));
    $patients = Appointment::readAllAppointment();
    $deleteAppointment = Appointment::deleteAppointment($id);

} catch (PDOException $e) {
    die('Erreur : ' . $e->getMessage());
}

include(__DIR__ . './../views/templates/header.php');
include(__DIR__ . '/../views/allAppointment.php');
include(__DIR__ . '/../views/templates/footer.php');
