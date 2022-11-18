<?php
require_once(__DIR__ . '/../config/config.php');
require_once(__DIR__ . '/../helpers/dataBase.php');
require_once(__DIR__ . '/../models/Patient.php');
require_once(__DIR__ . '/../models/Appointment.php');

try {
    
    //Récupération de l'ID du rendez-vous
    $appointmentId = intval(filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT));
    
    //Récupération de toutes les données rendez-vous
    $patients = Appointment::readAllAppointment(); 

} catch (PDOException $e) {
    die('Erreur : ' . $e->getMessage());
}

include(__DIR__ . './../views/templates/header.php');
include(__DIR__ . '/../views/allAppointment.php');
include(__DIR__ . '/../views/templates/footer.php');
