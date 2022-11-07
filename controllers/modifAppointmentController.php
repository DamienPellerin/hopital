<?php
require_once(__DIR__ . '/../config/config.php');
require_once(__DIR__ . '/../models/Patient.php');
require_once(__DIR__ . '/../models/Appointment.php');
require_once(__DIR__ . '/../helpers/dataBase.php');

try {
    $id = intval(filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT));
    $appointment = Appointment::readAppointment($id);

    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        //===================== date : Nettoyage et validation =======================
        $idPatients = intval(filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT));
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

        if (empty($error)) {
            $dateHour = $date . ' ' . $hour;
            $updateAppointment = new Appointment($dateHour, $id);
            $updateAppointment->setDateHour($dateHour);
            $updateAppointment->setId($id);
            $isUpdateAppointment = $updateAppointment->updateAppointment();
            if ($isUpdateAppointment == true) {
                $updateMessage = 'Données mises à jour';
                $appointment = Appointment::readAppointment($id);
                var_dump($appointment);
            } else {
                $updateMessage = 'Une erreur est survenue';
            };
        }
    }
} catch (PDOException $e) {
    die('ERREUR :' . $e->getMessage());
}

include(__DIR__ . './../views/templates/header.php');
include(__DIR__ . '/../views/modifAppointment.php');
include(__DIR__ . '/../views/templates/footer.php');
