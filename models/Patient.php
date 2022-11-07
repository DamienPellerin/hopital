<?php
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
        try {
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
        } catch (PDOException $ex) {
            echo $ex->getMessage();
        }
    }

    /**
     * création patient
     * @return [type]
     */
    public function addPatient()
    {
        try {
            $sql = 'INSERT INTO `patients`(`lastname`, `firstname`, `mail`, `phone`, `birthdate`) VALUES (:lastname, :firstname, :mail, :phone, :birthdate );';
            $pdo = Database::getInstance();
            $sth = $pdo->prepare($sql);
            $sth->bindValue(':lastname', $this->getLastname());
            $sth->bindValue(':firstname', $this->getFirstname());
            $sth->bindValue(':mail', $this->getMail());
            $sth->bindValue(':phone', $this->getPhone());
            $sth->bindValue(':birthdate', $this->getBirthdate());
            return $sth->execute();
        } catch (PDOException $ex) {
            echo $ex->getMessage();
        }
    }

    /**
     * afficher tous les patients
     * @return array
     */
    public static function readAll(): array
    {
        try {
            $pdo = Database::getInstance();
            $sql = 'SELECT `id`, `lastname`, `firstname` FROM `patients`;';
            $sth = $pdo->query($sql);
            return $sth->fetchAll();
        } catch (PDOException $ex) {
            echo $ex->getMessage();
        }
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
            var_dump($result);
            return ($result >= 1) ? true : false;
        };
    }

    /**
     * @param mixed $id
     * 
     * @return [type]
     */
    public static function displayPatient($id)
    {
        try {
            $pdo = Database::getInstance();
            $req = $pdo->query('SELECT * FROM patients WHERE id =' . $id . ';');
            $post = $req->fetch(PDO::FETCH_OBJ);
            return $post;
        } catch (PDOException $ex) {
            echo $ex->getMessage();
        }
    }

    /**
     * supression patient
     * @param mixed $id
     * 
     * @return [type]
     */
    public static function deletePatient($id): int
    {
        try {
            $pdo = Database::getInstance();
            $sql = 'DELETE * FROM `patients` WHERE `patient``id` =' . $id . ';';
            $sth = $pdo->prepare($sql);
            return $sth->execute($id);
        } catch (PDOException $ex) {
            echo $ex->getMessage();
        }
    }
}
