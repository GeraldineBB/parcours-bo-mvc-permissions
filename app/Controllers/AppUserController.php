<?php

// le présent controller sera rangé dans ce namespace :
namespace App\Controllers;

// ne pas oublier ↓↓↓
// on charge le Model approprié
use App\Models\AppUser;

class AppUserController extends CoreController
{


    /**
     * Méthode qui affiche le formulaire de connexion
     *
     * @return void
     */
    public function login()
    {
        $this->show('connexion/signin');
    }

    /**
     * Méthode qui récupère (et qui traite) les données
     * envoyées depuis le formulaire de connexion
     *
     * @return void
     */
    public function signinPost()
    {
        // on récupère les données postées
        $email = filter_input(INPUT_POST, 'email');
        $password = filter_input(INPUT_POST, 'password');

        // on va essayer de trouver l'utilisateur correspondant à cette adresse email
        $appUser = AppUser::findByEmail($email);

        // si cette adresse email correspond à un utilisateur
        // on vérifie que le mot de passe soit valide
        if ($appUser !== false) {

            $goodPassword = password_verify($password, $appUser->getPassword()); // retourne TRUE ou FALSE

        } else {

            $goodPassword = false;

        }

        if ( $appUser !== false AND $goodPassword === true ) {

            
            // on ajoute des informations dans notre tableau associatif $_SESSION
            $_SESSION['userId']     = $appUser->getId();
            $_SESSION['userObject'] = $appUser;
      
            // on redirige vers la page d'accueil
            global $router;
            header('Location: ' . $router->generate('main-home'));
            exit; 
      
          } else {

            // on redirige vers la connexion
            global $router;
            header('Location: ' . $router->generate('signin'));
            exit;
      
          }


    }
}
