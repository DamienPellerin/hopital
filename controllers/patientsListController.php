<?php
require_once(__DIR__.'/../helpers/dataBase.php');
require_once(__DIR__.'/../models/Patient.php');

$patients = Patient::readAll();
    

//if(isset($_GET['page']) && !empty($_GET['page'])){
//    $currentPage = (int) strip_tags($_GET['page']);
//}else{
//    $currentPage = 1;
//}

//$sql = 'SELECT COUNT(*) AS nb_patients FROM `patients`;';
//
//$pdo= $pdo->prepare($sql);
//
//$query->execute();
//
//$result = $query->fetch();
//
//$nbPatients = (int) $result['nb_patients'];
//
//$parPage = 50;
//
//$pages = ceil($nbPatients / $parPage);
//
//$premier = ($currentPage * $parPage) - $parPage;
//
//$sql = 'SELECT * FROM `patients` ORDER BY `lastname` DESC LIMIT :premier, :parpage;';
//
//$query = $pdo->prepare($sql);
//
//$query->bindValue(':premier', $premier, PDO::PARAM_INT);
//$query->bindValue(':parpage', $parPage, PDO::PARAM_INT);
//
//$query->execute();
//
//$patients = $query->fetchAll(PDO::FETCH_OBJ);
//
//$patients = Patient::readAll();
    
include(__DIR__ . './../views/templates/header.php');
include(__DIR__ . './../views/patientsList.php');
include(__DIR__ . './../views/templates/footer.php');