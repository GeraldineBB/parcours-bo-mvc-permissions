<?php

namespace App\Models;

use App\Utils\Database;
use PDO;

class Student extends CoreModel
{

    // PROPRIETES

    private $firstname;
    private $lastname;
    private $teacher_id;

    // METHODES


    // -----------------------------------------------
    // [C]RUD
    // -----------------------------------------------

    /**
     * Insérer un nouveau prof dans la BDD
     *
     */
    public function insert()
    {
        // se connecter à la BDD
        $pdo = Database::getPDO();

        // écriture de la requête
        $sql = "
        INSERT INTO `student` (firstname, lastname, status, teacher_id)
        VALUES (:firstname, :lastname, :status, :teacher_id)
        ";

        // préparation de la requête
        $preparation = $pdo->prepare($sql);

        // execution de la requête
        $inserted = $preparation->execute([
            ":firstname" => $this->firstname,
            ":lastname" => $this->lastname,
            ":status" => $this->status,
            ":teacher_id" => $this->teacher_id,
        ]);

        if ($inserted) {
            $this->id = $pdo->lastInsertId();
            return true;
        } else {
            return false;
        }
    }

    // -----------------------------------------------
    // C[R]UD
    // -----------------------------------------------

    /**
     * Méthode permettant de récupérer un enregistrement de la table teacher en fonction d'un id donné
     * 
     * @param int $teacherId ID du prof
     * @return Teacher
     */
    public static function find($teacherId)
    {
        // se connecter à la BDD
        $pdo = Database::getPDO();

        // écrire notre requête
        $sql = 'SELECT * FROM `teacher` WHERE `id` =' . $teacherId;

        // exécuter notre requête
        $pdoStatement = $pdo->query($sql);

        // un seul résultat => fetchObject
        $teacher = $pdoStatement->fetchObject('App\Models\Teacher');

        // retourner le résultat
        return $teacher;
    }

    /**
     * Récupérer la liste des profs en BDD
     *
     */
    public static function findAll()
    {
        $pdo = Database::getPDO();
        $sql = 'SELECT * FROM `student`';
        $pdoStatement = $pdo->query($sql);
        $results = $pdoStatement->fetchAll(PDO::FETCH_CLASS, 'App\Models\Teacher');

        return $results;
    }

    // -----------------------------------------------
    // CR[U]D
    // -----------------------------------------------

    public function update()
    {
        // pas besoin
    }

    // -----------------------------------------------
    // CRU[D]
    // -----------------------------------------------

    public function delete()
    {
        // pas besoin
    }

    // GETTER AND SETTER


    /**
     * Get the value of firstname
     */
    public function getFirstname()
    {
        return $this->firstname;
    }

    /**
     * Set the value of firstname
     *
     * @return  self
     */
    public function setFirstname($firstname)
    {
        $this->firstname = $firstname;

        return $this;
    }

    /**
     * Get the value of lastname
     */
    public function getLastname()
    {
        return $this->lastname;
    }

    /**
     * Set the value of lastname
     *
     * @return  self
     */
    public function setLastname($lastname)
    {
        $this->lastname = $lastname;

        return $this;
    }

    /**
     * Get the value of teacher_id
     */
    public function getTeacherId()
    {
        return $this->teacher_id;
    }

    /**
     * Set the value of teacher_id
     *
     * @return  self
     */
    public function setTeacherId($teacher_id)
    {
        $this->teacher_id = $teacher_id;

        return $this;
    }
}
