<?php
require_once(__DIR__ . '/../helpers/dataBase.php');
require_once(__DIR__ . '/../models/Patient.php');
require_once(__DIR__ . '/../models/Appointment.php');


$patients = Appointment::readAllAppointment();

include(__DIR__ . './../views/templates/header.php');
include(__DIR__ . '/../views/allAppointment.php');
include(__DIR__ . '/../views/templates/footer.php');
