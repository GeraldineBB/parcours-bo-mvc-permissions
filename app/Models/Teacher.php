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

        if($inserted){
            $this->id = $pdo->lastInsertId();
            return true;

        } else {
            return false; 
        }
    
    }

    // -----------------------------------------------
    // C[R]UD
    // -----------------------------------------------

    static public function find($id)
    {
        // pas besoin 
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
