<?php

namespace App\Models;

use App\Utils\Database;
use PDO;

class Teacher extends CoreModel
{

    // PROPRIETES

    private $firstname;
    private $lastname;
    private $job;



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
        INSERT INTO `teacher` (firstname, lastname, job, status)
        VALUES (:firstname, :lastname, :job, :status)
        ";

        // préparation de la requête 
        $preparation = $pdo->prepare($sql);

        // execution de la requête
        $inserted = $preparation->execute([
            ":firstname" => $this->firstname,
            ":lastname" => $this->lastname,
            ":job" => $this->job,
            ":status" => $this->status,
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
    static public function findAll()
    {
        $pdo = Database::getPDO();
        $sql = 'SELECT * FROM `teacher`';
        $pdoStatement = $pdo->query($sql);
        $results = $pdoStatement->fetchAll(PDO::FETCH_CLASS, 'App\Models\Teacher');

        return $results;
    }

    // -----------------------------------------------
    // CR[U]D
    // -----------------------------------------------

    public function update()
    {
        // se connecter à la BDD
        $pdo = Database::getPDO();

        // écriture de la requête 
        $sql = " UPDATE `teacher` 
        SET 
            firstname = :firstname, 
            lastname = :lastname, 
            job = :job, 
            status = :status, 
            updated_at = NOW()
        WHERE id = :id
        ";

        // préparation de la requête 
        $preparation = $pdo->prepare($sql);

        $preparation->bindValue(':firstname', $this->firstname, PDO::PARAM_STR);
        $preparation->bindValue(':lastname', $this->lastname, PDO::PARAM_STR);
        $preparation->bindValue(':job', $this->job, PDO::PARAM_STR);
        $preparation->bindValue(':status', $this->status, PDO::PARAM_INT);
        $preparation->bindValue(':id', $this->id, PDO::PARAM_INT);


        // execution de la requête
        $inserted = $preparation->execute();

        if ($inserted) {
            $this->id = $pdo->lastInsertId();
            return true;
        } else {
            return false;
        }
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
     * Get the value of job
     */
    public function getJob()
    {
        return $this->job;
    }

    /**
     * Set the value of job
     *
     * @return  self
     */
    public function setJob($job)
    {
        $this->job = $job;

        return $this;
    }
}
