<?php

require_once(__DIR__.'/../config/config.php');

class Database{
    private PDO $_pdo ;
    public static function getInstance(){
       $pdo = new PDO(
        DSN,
        USER,
        PWD
       );
       $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
        return $pdo;
    }
}