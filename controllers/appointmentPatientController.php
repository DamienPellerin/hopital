<?php
require_once(__DIR__ . '/../config/config.php');
require_once(__DIR__ . '/../models/Patient.php');
require_once(__DIR__ . '/../models/Appointment.php');
require_once(__DIR__ . '/../helpers/dataBase.php');

$id = trim(filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT));
$appointment = Appointment::readAppointmentPatient($id);
var_dump($appointment);

include(__DIR__ . './../views/templates/header.php');
include(__DIR__ . '/../views/appointmentPatient.php');
include(__DIR__ . '/../views/templates/footer.php');
