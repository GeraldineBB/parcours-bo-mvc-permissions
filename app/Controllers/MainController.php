<?php

namespace App\Controllers;

// ne pas oublier ↓↓↓
// on charge les Models appropriés
use App\Models\Category;

class MainController extends CoreController
{

    /**
     * Méthode s'occupant de la page d'accueil
     *
     * @return void
     */
    public function home()
    {

    
        // On appelle la méthode show() de l'objet courant
        // En argument, on fournit le fichier de Vue
        // Par convention, chaque fichier de vue sera dans un sous-dossier du nom du Controller
        $this->show('main/home');
    }

    /**
     * Méthode s'occupant de la page de connexion
     *
     * @return void
     */
    public function signin()
    {
        $this->show('connexion/signin');
    }
}
