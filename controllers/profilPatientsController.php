<?php

require_once(__DIR__ . '/../config/config.php');
require_once(__DIR__ . '/../models/Patient.php');
require_once(__DIR__ . '/../models/Appointment.php');
require_once(__DIR__ . '/../helpers/dataBase.php');
$error = [];

$id = trim(filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT));

$appointment = Appointment::readAppointmentProfilPatient($id);
var_dump($appointment);

$patient = Patient::displayPatient($id);
var_dump($patient);


include(__DIR__ . './../views/templates/header.php');
include(__DIR__ . './../views/profilPatients.php');
include(__DIR__ . './../views/templates/footer.php');

