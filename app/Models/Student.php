<?php

namespace App\Models;

use App\Utils\Database;
use PDO;

class Student extends CoreModel
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

    public static function find($id)
    {
        // pas besoin
    }

    /**
     * Récupérer la liste des profs en BDD
     *
     */
    public static function findAll()
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
    
}