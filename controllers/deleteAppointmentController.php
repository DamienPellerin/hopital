<?php

require_once(__DIR__ . '/../models/Appointment.php');
try {
    
    ///Récupération de l'ID du rendez-vous
    $id = intval(filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT));

    //Supression du rendez-vous
    $isdeleteAppointment = Appointment::deleteAppointment($id);

    if ($isdeleteAppointment) {
        SessionFlash::set('Le rendez-vous à bien été supprimé'); 
    } else {
        SessionFlash::set('Erreur'); 
    }

    header('location: /liste-rendez-vous');
    exit;

} catch (PDOException $e) {
    die('Erreur : ' . $e->getMessage());
}

