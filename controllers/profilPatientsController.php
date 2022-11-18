<?php

require_once(__DIR__ . '/../config/config.php');
require_once(__DIR__ . '/../models/Patient.php');
require_once(__DIR__ . '/../models/Appointment.php');

try {

    //Récupération de l'ID patient
    $patientId = intval(filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT));

    //Récupération des données patient
    $patient = Patient::displayPatient($patientId);

    //Récupération du ou des rendez-vous patient
    $appointments = Appointment::readProfilAppointment($patientId);
   
} catch (PDOException $e) {
    die('ERREUR :' . $e->getMessage());
}

include(__DIR__ . './../views/templates/header.php');
include(__DIR__ . './../views/profilPatients.php');
include(__DIR__ . './../views/templates/footer.php');
