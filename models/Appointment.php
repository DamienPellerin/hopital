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
        $sql = 'INSERT INTO `appointments`(`dateHour`, `idPatients`) 
                VALUES (:dateHour, :idPatients);';
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
            $pdo = Database::getInstance();
            $sql = 'SELECT `patients`.`firstname`, `patients`.`lastname`, `appointments`.`id`   
                    FROM `appointments` 
                    INNER JOIN `patients` 
                    ON `appointments`.`idPatients` = `patients`.`id`;';
            $sth = $pdo->query($sql);
            return $sth->fetchAll();
    }

    /**
     * Afficher le rendez-vous du patient
     * @param int $id
     * 
     * @return object
     */
    public static function readAppointment(int $id)
    {
        $pdo = Database::getInstance();
        $sql = 'SELECT * FROM appointments WHERE id = :id';
        $sth = $pdo->prepare($sql);
        $sth->bindValue(':id', $id, PDO::PARAM_INT);
        if ($sth->execute()) {
            return $sth->fetch();
        }
    }

    /**
     * Affichage du rendez-vous dans profile du patient
     * @return [type]
     */
    public static function readProfilAppointment(int $id)
    {
        $pdo = Database::getInstance();
        $sql = 'SELECT `dateHour`   
                FROM `appointments` 
                INNER JOIN `patients` 
                ON `appointments`.`idPatients` = `patients`.`id`
                WHERE `appointments`.`idPatients` = :id;';
                
        $sth = $pdo->prepare($sql);
        $sth->bindValue(':id', $id, PDO::PARAM_INT);
        $sth->execute();
        return $sth->fetchAll();
    }

    /**
     * modifier le rendez-vous du patient.
     * @return [type]
     */
    public function updateAppointment()
    {
        $modifyAppointment = 'UPDATE `appointments` 
                            SET `dateHour` = :dateHour 
                            WHERE `id`= :id';
        $sth = Database::getInstance()->prepare($modifyAppointment);
        $sth->bindValue(':dateHour', $this->getDateHour());
        $sth->bindValue(':id', $this->getId());
        if ($sth->execute()) {
            $result = $sth->rowCount();
            return ($result >= 1) ? true : false;
        };
    }

    /**
     * supprimer un rendez-vous
     * @param mixed $id
     * 
     * @return [type]
     */
    public static function deleteAppointment($id)
    {
        $pdo = Database::getInstance();
        $sql = 'DELETE   
                FROM `appointments` 
                WHERE `id` = :id';
        $sth = $pdo->prepare($sql);
        $sth->bindValue(':id', $id, PDO::PARAM_INT);
        return $sth->execute();
    }

    /**
     * suprimer le patient et ses rendez-vous
     * @param mixed $id
     * 
     * @return [type]
     */
    public static function deletePatientAppointment($id)
    {
        $pdo = Database::getInstance();
        $sql = 'DELETE   
                FROM `patients`
                WHERE `id` = :id';
        $sth = $pdo->prepare($sql);
        $sth->bindValue(':id', $id, PDO::PARAM_INT);
        return $sth->execute();
    }
}
