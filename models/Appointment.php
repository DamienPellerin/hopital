<?php
require_once(__DIR__ . '/../config/config.php');
require_once(__DIR__ . '/../helpers/dataBase.php');

class Appointment
{
    private  $_pdo;
    private string $_dateHour;
    private int $_idPatients;

    /**
     */
    public function __construct(string $_dateHour, int $_idPatients)
    {
        $this->_pdo = Database::getInstance();
        $this->_dateHour = $_dateHour;
        $this->_idPatients = $_idPatients;
    }

    /**
     * @return int
     */
    public function getId(): string
    {
        return $this->_id;
    }

    /**
     * @param int $valueId
     * 
     * @return void
     */
    public function setId(int $valueId): void
    {
        $this->_id = $valueId;
    }


    /**
     * @return string
     */
    public function getDateHour(): string
    {
        return $this->_dateHour;
    }


    /**
     * @param string $valueDateHour
     * 
     * @return void
     */
    public function setDateHour(string $valueDateHour): void
    {
        $this->_dateHour = $valueDateHour;
    }


    /**
     * @return int
     */
    public function getIdPatients(): int
    {
        return $this->_idPatients;
    }


    /**
     * @param string $valueIdPatients
     * 
     * @return void
     */
    public function setIdPatients(string $valueIdPatients): void
    {
        $this->_idPatients = $valueIdPatients;
    }

    /**
     * Ajout d'un rendez-vous
     * @return [type]
     */
    public function appointment()
    {
        $sql = 'INSERT INTO `appointments`(`dateHour`, `idPatients`) VALUES (:dateHour, :idPatients);';
        $sth = $this->_pdo->prepare($sql);
        $sth->bindValue(':dateHour', $this->getDateHour());
        $sth->bindValue(':idPatients', $this->getIdPatients(), PDO::PARAM_INT);
        if ($sth->execute()) {
            return ($sth->rowCount() >= 1) ? true : false;
        }
    }

    /**
     * afficher tous les rendez-vous
     * @return array
     */
    public static function readAllAppointment()
    {
        try {
            $pdo = Database::getInstance();
            $sql = 'SELECT `patients`.`firstname`, `patients`.`lastname`, `appointments`.`id`    FROM `appointments` INNER JOIN `patients` ON `appointments`.`idPatients` = `patients`.`id`;';
            $sth = $pdo->query($sql);
            return $sth->fetchAll();
        } catch (PDOException $ex) {
            echo $ex->getMessage();
        }
    }

    /**
     * @param int $id
     * 
     * @return object
     */
    public static function readAppointment(int $id)
    {
        try {
            $pdo = Database::getInstance();
            $sql = 'SELECT * FROM appointments WHERE id = :id';
            $sth = $pdo->prepare($sql);
            $sth->bindValue(':id', $id, PDO::PARAM_INT);
            $sth->execute();
            return $sth->fetch();
        } catch (PDOException $ex) {
            echo $ex->getMessage();
        }
    }

    // modifier le rendez-vous du patient.
    public function updateAppointment()
    {
        $modifyAppointment = 'UPDATE `appointments` SET `dateHour` = :dateHour WHERE `id`= :id';
        $sth = Database::getInstance()->prepare($modifyAppointment);
        $sth->bindValue(':dateHour', $this->getDateHour());
        $sth->bindValue(':id', $this->getId());
        if ($sth->execute()) {
            $result = $sth->rowCount();
            var_dump($result);
            return ($result >= 1) ? true : false;
        };
    }

    public static function readPatientAppointment(int $id)
    {
        try {
            $pdo = Database::getInstance();
            $sql = 'SELECT patients.lastname, patients.firstname, appointments.datehour FROM patients INNER JOIN appointments ON patients.id = appointments.idPatients WHERE `appointments`.`id` = :id';
            $sth = $pdo->prepare($sql);
            $sth->bindValue(':id', $id, PDO::PARAM_INT);
            $sth->execute();
            return $sth->fetch();
        } catch (PDOException $ex) {
            echo $ex->getMessage();
        }
    }

    public static function readAppointmentPatient(int $id)
    {
        try {
            $pdo = Database::getInstance();
            $sql = 'SELECT * FROM appointments WHERE id = :id';
            $sth = $pdo->prepare($sql);
            $sth->bindValue(':id', $id, PDO::PARAM_INT);
            $sth->execute();
            return $sth->fetch();
        } catch (PDOException $ex) {
            echo $ex->getMessage();
        }
    }

    public static function readAppointmentProfilPatient(int $id)
    {
        try {
            $pdo = Database::getInstance();
            $sql = 'SELECT * FROM appointments WHERE idPatients = :id';
            $sth = $pdo->prepare($sql);
            $sth->bindValue(':id', $id, PDO::PARAM_INT);
            $sth->execute();
            return $sth->fetch();
        } catch (PDOException $ex) {
            echo $ex->getMessage();
        }
    }
}
