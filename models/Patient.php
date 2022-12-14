<?php

use LDAP\Result;

require_once(__DIR__ . '/../config/config.php');
require_once(__DIR__ . '/../helpers/dataBase.php');

class Patient
{
    private int    $_id;
    private string $_lastname;
    private string $_firstname;
    private string $_mail;
    private string $_phone;
    private string $_birthdate;

    /**
     */
    public function __construct()
    {
    }

    /**
     * @return int
     */
    public function getId(): string
    {
        return $this->_id;
    }

    /**
     * @param string $valueId
     * 
     * @return void
     */
    public function setId(string $valueId): void
    {
        $this->_id = $valueId;
    }

    /**
     * @return string
     */
    public function getLastname(): string
    {
        return $this->_lastname;
    }


    /**
     * @param string $valueLastname
     * 
     * @return void
     */
    public function setLastname(string $valueLastname): void
    {
        $this->_lastname = $valueLastname;
    }

    /**
     * @return string
     */
    public function getFirstname(): string
    {
        return $this->_firstname;
    }

    /**
     * @param string $valueFirstname
     * 
     * @return void
     */
    public function setFirstname(string $valueFirstname): void
    {
        $this->_firstname = $valueFirstname;
    }

    /**
     * @return string
     */
    public function getMail(): string
    {
        return $this->_mail;
    }

    /**
     * @param string $valueMail
     * 
     * @return void
     */
    public function setMail(string $valueMail): void
    {
        $this->_mail = $valueMail;
    }

    /**
     * @return string
     */
    public function getPhone(): string
    {
        return $this->_phone;
    }

    /**
     * @param string $valuePhone
     * 
     * @return void
     */
    public function setPhone(string $valuePhone): void
    {
        $this->_phone = $valuePhone;
    }

    /**
     * @return string
     */
    public function getBirthdate(): string
    {
        return $this->_birthdate;
    }

    /**
     * @param string $valueBirthdate
     * 
     * @return void
     */
    public function setBirthdate(string $valueBirthdate): void
    {
        $this->_birthdate = $valueBirthdate;
    }

    /**
     * @param string $mail
     * 
     * @return bool
     */
    public static function mailExist(string $mail): bool
    {
        $pdo = Database::getInstance();
        $sql = 'SELECT patients.id FROM patients WHERE mail = :mail;';
        $sth = $pdo->prepare($sql);
        $sth->bindValue(':mail', $mail);
        $succes = $sth->execute();
        if ($succes) {
            if (empty($sth->fetch())) {
                return false;
            } else {
                return true;
            }
        }
    }

    /**
     * cr??ation patient
     * @return [type]
     */
    public function addPatient()
    {
        $sql = 'INSERT INTO `patients`(`lastname`, `firstname`, `mail`, `phone`, `birthdate`) VALUES (:lastname, :firstname, :mail, :phone, :birthdate );';
        $pdo = Database::getInstance();
        $sth = $pdo->prepare($sql);
        $sth->bindValue(':lastname', $this->getLastname());
        $sth->bindValue(':firstname', $this->getFirstname());
        $sth->bindValue(':mail', $this->getMail());
        $sth->bindValue(':phone', $this->getPhone());
        $sth->bindValue(':birthdate', $this->getBirthdate());
        return $sth->execute();
    }

    /**
     * afficher tous les patients
     * @return array
     */
    public static function readAll(): array
    {
        $pdo = Database::getInstance();
        $sql = 'SELECT `id`, `lastname`, `firstname` FROM `patients`;';
        $sth = $pdo->query($sql);
        return $sth->fetchAll();
    }

    // modifier le profil du patient.
    public function update()
    {
        $modifyPatient = 'UPDATE `patients` SET `lastname`=:lastname, `firstname`=:firstname,`birthdate`=:birthdate, `phone`=:phone, `mail`=:mail WHERE `id`= :id';
        $sth = Database::getInstance()->prepare($modifyPatient);
        $sth->bindValue(':lastname', $this->getLastname());
        $sth->bindValue(':firstname', $this->getFirstname());
        $sth->bindValue(':birthdate', $this->getBirthdate());
        $sth->bindValue(':phone', $this->getPhone());
        $sth->bindValue(':mail', $this->getMail());
        $sth->bindValue(':id', $this->getId(), PDO::PARAM_INT);

        if ($sth->execute()) {
            $result = $sth->rowCount();
            return ($result >= 1) ? true : false;
        }
        return false;
    }

    /**
     * R??cup??ration des donn??es patient
     * @param mixed $id
     * 
     * @return [type]
     */
    public static function displayPatient(int $id)
    {
        $pdo = Database::getInstance();
        $sth = $pdo->query('SELECT * FROM patients WHERE id =' . $id . ';');
        $post = $sth->fetch(PDO::FETCH_OBJ);
        return $post;
    }

    /**
     * nombre de pages neccessaires
     * @return [type]
     */
    public static function nbPages()
    {
        $pdo = Database::getInstance();
        // On d??termine le nombre total de patients
        $sql = 'SELECT COUNT(`id`) AS total FROM `patients`;';
        // On pr??pare la requ??te
        $query = $pdo->prepare($sql);
        // On ex??cute
        $query->execute();
        // On r??cup??re le nombre d'articles
        $result = $query->fetch(PDO::FETCH_OBJ);
        $nbPages = intdiv($result->total, 10);
        // Voir si il y a un reste
        return ($result->total % 10 > 0) ? $nbPages++ : $nbPages;
    }

    /**
     * page en actuelle
     * @return [type]
     */
    public static function whichPage(): int
    {
        if (isset($_GET['page'])) {
            $input = filter_input(INPUT_GET, 'page', FILTER_SANITIZE_NUMBER_INT);
            $page = $input;
        } else {
            $page = 1;
        }
        return $page;
    }

    /**
     * nb de patients par page
     * @return [type]
     */
    public static function getTen()
    {
        $pdo = Database::getInstance();
        $sql = 'SELECT `patients`.`lastname`, `patients`.`firstname`, `patients`.`id`
                FROM `patients`  ORDER BY `lastname` LIMIT :nbPerPage OFFSET :offset';
        $sth = $pdo->prepare($sql);
        $sth->bindValue(':nbPerPage', 10, PDO::PARAM_INT);
        $sth->bindValue(':offset', (Patient::whichPage() - 1) * 10, PDO::PARAM_INT);
        $sth->execute();
        $result = $sth->fetchAll(PDO::FETCH_OBJ);
        return $result;
    }

    /**
     * supprimer le patient s??lectionner et ses rendez-vous
     * @param mixed $id
     * 
     * @return [type]
     */
    public static function deletePatient(int $id): bool
    {
        $pdo = Database::getInstance(); 
        $sql = 'DELETE   
                FROM `patients`
                WHERE `id` = :id';
        $sth = $pdo->prepare($sql);
        $sth->bindValue(':id', $id, PDO::PARAM_INT);
        if ($sth->execute()) {
            $result = $sth->rowCount();
            return ($result >= 1) ? true : false;
        }
        return false;
    }

    /**
     * Barre de recherche
     * @param string $search
     * 
     * @return array
     */
    public static function searchPatient(string $search = ''): array
    {
        if ($search == '') {

            $pdo = Database::getInstance();
        $sql = 'SELECT `patients`.`lastname`, `patients`.`firstname`, `patients`.`id`
                FROM `patients`  ORDER BY `lastname` LIMIT :nbPerPage OFFSET :offset';
        $sth = $pdo->prepare($sql);
        $sth->bindValue(':nbPerPage', 10, PDO::PARAM_INT);
        $sth->bindValue(':offset', (Patient::whichPage() - 1) * 10, PDO::PARAM_INT);
        $sth->execute();
        $result = $sth->fetchAll(PDO::FETCH_OBJ);
        return $result;

        } else {
            $pdo = Database::getInstance();
            $sql = 'SELECT `lastname`, `firstname`, `id` FROM `patients` WHERE `lastname` LIKE CONCAT(:search, "%")';
            $sth = $pdo->prepare($sql);
            $sth->bindValue(':search', $search);
            $sth->execute();
            $result = $sth->fetchAll();
            return $result;
        }
        
    }
}
