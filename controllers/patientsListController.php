<?php
require_once(__DIR__ . '/../helpers/dataBase.php');
require_once(__DIR__ . '/../models/Patient.php');
require_once(__DIR__ . '/../models/Appointment.php');

try {
    $id = trim(filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT));
    $deletePatientAppointment = Appointment::deletePatientAppointment($id);
    $patients = Patient::getTen();
    $howManyPages = Patient::nbPages();
    $whichPage = Patient::whichPage();
} catch (PDOException $e) {
    die('ERREUR :' . $e->getMessage());
}

include(__DIR__ . './../views/templates/header.php');
include(__DIR__ . './../views/patientsList.php');
include(__DIR__ . './../views/templates/footer.php');
