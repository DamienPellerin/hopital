<?php
require_once(__DIR__ . '/../config/config.php');
require_once(__DIR__ . '/../models/Patient.php');
require_once(__DIR__ . '/../models/Appointment.php');
require_once(__DIR__ . '/../helpers/dataBase.php');

try {

    //Récupération de tous les patients
    $patients = Patient::readAll();

    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        //===================== date : Nettoyage et validation =======================

        $idPatients = intval(filter_input(INPUT_POST, 'id', FILTER_SANITIZE_NUMBER_INT));
        if (empty($idPatients)) {
            $error["id"] = "Le nom du patient est obligatoire!";
        }

        $date = filter_input(INPUT_POST, 'date', FILTER_SANITIZE_NUMBER_INT);
        if (!empty($date)) {
            $isOk = filter_var($date, FILTER_VALIDATE_REGEXP, ['options' => ['regexp' => '/' . REGEX_DATE . '/']]);
            if (!$isOk) {
                $error["date"] = "La date entrée n'est pas valide!";
            }
        }

        $hour = filter_input(INPUT_POST, 'hour', FILTER_SANITIZE_SPECIAL_CHARS);
        //f (!empty($hour)) {
        //   $isOk = filter_var($hour, FILTER_VALIDATE_REGEXP, ['options' => ['regexp' => '/' . REGEX_HOURS . '/']]);
        //    if (!$isOk) {
        //        $error['hour'] = "L'heure entrée n'est pas valide!";
        //    }
        //}

        $dateHour = $date . ' ' . $hour;
        // Création d'un nouvel objet PDO.    
        $appointment = new Appointment($dateHour, $idPatients);
        // Appel de la méthode permettant d'ajouter les données dans la base de donnée.
        $isAddedAppointment = $appointment->appointment();

        if ($isAddedAppointment) {
            SessionFlash::set('Le rendez-vous à bien été enregistré');
            header('location: /liste-rendez-vous');
            exit;
        }
    }
} catch (PDOException $e) {
    die('ERREUR :' . $e->getMessage());
}


include(__DIR__ . './../views/templates/header.php');
include(__DIR__ . '/../views/addAppointment.php');
include(__DIR__ . '/../views/templates/footer.php');
