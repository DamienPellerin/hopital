<?php
require_once(__DIR__ . '/../models/Patient.php');

//Récupération de l'ID du patient
$patientId = intval(filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT));

//Supression du patient
$deletePatient = Patient::deletePatient($patientId);

if ($deletePatient) {
    SessionFlash::set('Le patient à bien été supprimé');
} else {
    SessionFlash::set('Une erreur est survenue');
};

header('location: /liste-patients');
exit;
