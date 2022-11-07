<?php

define('DSN', 'mysql:host=localhost;dbname=hopital');
define('USER', 'Damien');
define('PWD', '_DEa70CcM[LmjRzp');

define('REGEX_NO_NUMBER',"^[A-Za-z-éèêëàâäôöûüç' ]+$");
define('REGEX_ZIPCODE','^[0-9]{5}$');
define('REGEX_DATE','^([0-9]{4})[\/\-]?([0-9]{2})[\/\-]?([0-9]{2})$');
define('PHONE_REGEX', '^[0-9]{2}-?[0-9]{2}-?[0-9]{2}-?[0-9]{2}-?[0-9]{2}$');
define('AUTHORIZED_IMAGE_FORMAT', ['image/jpeg', 'image/png']);
define('ARRAY_COUNTRIES', ['France', 'Suisse', 'Allemagne', 'Italie']);
define('REGEX_HOURS', '^[0-1]?[0-9]|2[0-3])[0-5][0-9]$');

$days = ['Lundi','Mardi', 'Mercredi', 'Jeudi', 'Vendredi'];
$hours = ['09:00', '9:30','10:00', '10:30', '11:00', '11:30', '12:00','12:30', '13:00', '13:30', '14:00','14:30', '15:00', '15:30', '16:00', '16:30', '17:00', '17:30', '18:00', '18:30', '19:00'];       
        
            
            
            
            
            
            
            
             
             
            
           
           
            
            
            