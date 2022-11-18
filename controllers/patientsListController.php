<?php
require_once(__DIR__ . '/../config/config.php');
require_once(__DIR__ . '/../helpers/dataBase.php');
require_once(__DIR__ . '/../models/Patient.php');
require_once(__DIR__ . '/../models/Appointment.php');

try {

    //Nettoyage barre de recherche
    $search = trim((string)filter_input(INPUT_GET, 'search', FILTER_SANITIZE_SPECIAL_CHARS));
   if(!empty($search)){
    $isOk = filter_var($search, FILTER_VALIDATE_REGEXP, array("options"=>['regexp' => '/' . REGEX_DATE . '/']));
   }
    //Barre de recherche
    $patients = Patient::searchPatient($search);

    //Récupération de l'ID du patient
    $patientId = intval(filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT));

    //nombre de pages neccessaires
    $howManyPages = Patient::nbPages();

    //page actuelle
    $whichPage = Patient::whichPage();
 
} catch (PDOException $e) {
    die('ERREUR :' . $e->getMessage());
}

include(__DIR__ . './../views/templates/header.php');
include(__DIR__ . './../views/patientsList.php');
include(__DIR__ . './../views/templates/footer.php');
