<?php
require_once(__DIR__ . '/../config/config.php');
require_once(__DIR__ . '/../models/Patient.php');
require_once(__DIR__ . '/../helpers/dataBase.php');

try {
    $id = intval(filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT));
    var_dump($id);
    $patient = Patient::displayPatient($id);
    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        //===================== Lastname : Nettoyage et validation =======================
        $lastname = trim(filter_input(INPUT_POST, 'lastname', FILTER_SANITIZE_SPECIAL_CHARS));
        // On vérifie que ce n'est pas vide
        if (empty($lastname)) {
            $error["lastname"] = "Vous devez entrer un nom!!";
        } else { // Pour les champs obligatoires, on retourne une erreur
            $isOk = filter_var($lastname, FILTER_VALIDATE_REGEXP, array("options" => array("regexp" => '/' . REGEX_NO_NUMBER . '/')));
            // Avec une regex (constante déclarée plus haut), on vérifie si c'est le format attendu 
            if (!$isOk) {
                $error["lastname"] = "Le nom n'est pas au bon format!!";
            } else {
                // Dans ce cas précis, on vérifie aussi la longueur de chaine (on aurait pu le faire aussi direct dans la regex)
                if (strlen($lastname) <= 1 || strlen($lastname) >= 70) {
                    $error["lastname"] = "La longueur du nom n'est pas bon";
                }
            }
        }

        //===================== Firstname : Nettoyage et validation =======================
        $firstname = trim(filter_input(INPUT_POST, 'firstname', FILTER_SANITIZE_SPECIAL_CHARS));
        // On vérifie que ce n'est pas vide
        if (empty($firstname)) {
            $error["firstname"] = "Vous devez entrer un nom!!";
        } else { // Pour les champs obligatoires, on retourne une erreur
            $isOk = filter_var($firstname, FILTER_VALIDATE_REGEXP, array("options" => array("regexp" => '/' . REGEX_NO_NUMBER . '/')));
            // Avec une regex (constante déclarée plus haut), on vérifie si c'est le format attendu 
            if (!$isOk) {
                $error["firstname"] = "Le nom n'est pas au bon format!!";
            } else {
                // Dans ce cas précis, on vérifie aussi la longueur de chaine (on aurait pu le faire aussi direct dans la regex)
                if (strlen($firstname) <= 1 || strlen($firstname) >= 70) {
                    $error["firstname"] = "La longueur du nom n'est pas bon";
                }
            }
        }

        //===================== email : Nettoyage et validation =======================
        $mail = trim(filter_input(INPUT_POST, 'mail', FILTER_SANITIZE_EMAIL));

        if (!empty($mail)) {
            $testMail = filter_var($mail, FILTER_VALIDATE_EMAIL);
            if (!$testMail) {
                $error["mail"] = "L'adresse email n'est pas au bon format!!";
            }
        } else {
            $error["mail"] = "L'adresse mail est obligatoire!!";
        }

        //===================== phone : Nettoyage et validation =======================
        $phone = filter_input(INPUT_POST, 'phone', FILTER_SANITIZE_NUMBER_INT);
        if (!empty($phone)) {
            $isOk = filter_var($phone, FILTER_VALIDATE_REGEXP, array("options" => array("regexp" => '/' . PHONE_REGEX . '/')));
            if ($isOk == false) {
                $error['phone'] =  'Le numéro de téléphone n\'est pas valide';
            }
        }
        
        //===================== birthdate : Nettoyage et validation =======================
        $birthdate = filter_input(INPUT_POST, 'birthdate', FILTER_SANITIZE_NUMBER_INT);
        if (!empty($birthdate)) {
            $isOk = filter_var($birthdate, FILTER_VALIDATE_REGEXP, ['options' => ['regexp' => '/' . REGEX_DATE . '/']]);
            if (!$isOk) {
                $error["birthdate"] = "La date entrée n'est pas valide!";
            } else {
                $birthdateObj = new DateTime($birthdate);
                // Calcul de l'age de l'utilisateur (année courante - année de naissance)
                $age = date('Y') - $birthdateObj->format('Y');

                if ($age > 120 || $age < 18) {
                    $error["birthdate"] = "Votre age n'est pas conforme!";
                }
            }
        }

        if (empty($error)) {
            $updatedPatient = new Patient();
            $updatedPatient->setLastname($lastname);
            $updatedPatient->setFirstname($firstname);
            $updatedPatient->setBirthdate($birthdate);
            $updatedPatient->setPhone($phone);
            $updatedPatient->setMail($mail);
            $updatedPatient->setId($id);
            $isUpdatedPatient = $updatedPatient->update();

            if ($isUpdatedPatient == true) {
                $updateMessage = 'Données mises à jour';
                $patient = Patient::displayPatient($id);
            } else {
                $updateMessage = 'Une erreur est survenue';
            };
            var_dump($isUpdatedPatient);
        }
    }
} catch (PDOException $e) {
    die('ERREUR :' . $e->getMessage());
}

include(__DIR__ . './../views/templates/header.php');
include(__DIR__ . '/../views/modificationPatient.php');
include(__DIR__ . '/../views/templates/footer.php');
