<?php

require_once(__DIR__ . '/../config/config.php');
require_once(__DIR__ . '/../models/Patient.php');
require_once(__DIR__ . '/../models/Appointment.php');

try { 
    $id = trim(filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT));
    $patient = Patient::displayPatient($id);
    $appointment = Appointment::readProfilAppointment($id); 
} catch (PDOException $e) {
    die('ERREUR :' . $e->getMessage());
}


include(__DIR__ . './../views/templates/header.php');
include(__DIR__ . './../views/profilPatients.php');
include(__DIR__ . './../views/templates/footer.php');
