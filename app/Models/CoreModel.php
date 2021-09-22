<?php

namespace App\Models;

// Classe mère de tous les Models
// On centralise ici toutes les propriétés et méthodes utiles pour TOUS les Models

// ↓↓↓↓↓ coucou toi
abstract class CoreModel {
    /**
     * @var int
     */
    protected $id;
    /**
     * @var string
     */
    protected $created_at;
    /**
     * @var string
     */
    protected $updated_at;


    /**
     * Get the value of id
     *
     * @return  int
     */ 
    public function getId() : ?int
    {
        return $this->id;
    }

    /**
     * Get the value of created_at
     *
     * @return  string
     */ 
    public function getCreatedAt() : string
    {
        return $this->created_at;
    }

    /**
     * Get the value of updated_at
     *
     * @return  string
     */ 
    public function getUpdatedAt() : string
    {
        return $this->updated_at;
    }

    /**
     * On déclare les méthodes abstraites : 
     * Il sera obligatoire de les créer dans les classes enfant
     */
    abstract static public function find($id);
    abstract static public function findAll();
    abstract public function insert();
    abstract public function update();
    abstract public function delete();

    /**
     * Méthode permettant de sauvegarder le modèle courant dans la BDD
     * - soit en le mettant à jour, s'il existe
     * - soit en créant un nouvel enregistrement, s'il n'existe pas encore
     * 
     * Il faut savoir que cette méthode save() n'est pas ouf en soit
     * mais que vous, les apprenants, la croiserez de nouveau, en saison prochaine ;)
     * 
     * @return void
     */

     public function save()
     {

        // si l'instance courante du modèle ($this) a bien une propriété "id"
        if ($this->getId() > 0) {

            // alors le modèle existe déjà
            // et on le met à jour
            return $this->update();

        } else {

            // sinon c'est qu'il n'existe pas
            // et on le créé
            return $this->insert();

        }

     }

}
