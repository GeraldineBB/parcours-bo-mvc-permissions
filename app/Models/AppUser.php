<?php

namespace App\Models;

use App\Utils\Database;
use PDO;

class AppUser extends CoreModel
{

    // PROPRIETES 

    private $email;
    private $name;
    private $password;
    private $role;


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
        //bonus
    }

    // -----------------------------------------------
    // C[R]UD
    // -----------------------------------------------

    static public function find($id)
    {
        // pas besoin 
    }

    static public function findAll()
    {
        // pas besoin 
    }

    /**
     * Récupérer les emails des admin et users
     * 
     */
    static public function findByEmail($email)
    {
        $pdo = Database::getPDO(); // connexion
        $sql = '
            SELECT *
            FROM app_user
            WHERE email = :email
        ';
        $pdoStatement = $pdo->prepare($sql); // prépare la requête
        $pdoStatement->execute([':email' => $email]);
        $result = $pdoStatement->fetchObject(self::class);
    
        return $result; // retourne un objet AppUser ou FALSE
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
     * Get the value of email
     */ 
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set the value of email
     *
     * @return  self
     */ 
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get the value of name
     */ 
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set the value of name
     *
     * @return  self
     */ 
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get the value of password
     */ 
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * Set the value of password
     *
     * @return  self
     */ 
    public function setPassword($password)
    {
        $this->password = $password;

        return $this;
    }

    /**
     * Get the value of role
     */ 
    public function getRole()
    {
        return $this->role;
    }

    /**
     * Set the value of role
     *
     * @return  self
     */ 
    public function setRole($role)
    {
        $this->role = $role;

        return $this;
    }
}
