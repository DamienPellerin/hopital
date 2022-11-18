<?php

require_once(__DIR__ . '/../config/config.php');

class Database
{
    private static $_instance;
    public static function getInstance()
    {
        if (is_null(self::$_instance)) {
            self::$_instance = new PDO(
                DSN,
                USER,
                PWD
            );
            self::$_instance->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
            return self::$_instance;
        }

        return self::$_instance;
    }
}
