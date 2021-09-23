<?php

namespace App\Controllers;

class CoreController {

    /**
     * El Constructor !!
     * 
     */
    // public function __construct()
    // {

    //     // la variable $match contient les infos sur la route courante
    //     global $match;

    //     // On aurait une erreur ci-dessous si $match vaut false car on ne peut pas lui demander une clé
    //     // Donc si $match est un booléen, on laisse ErrorController s'occuper de la route et il n'y a pas de droit à tester
    //     if (is_bool($match)) {
    //         // On sort de l'exécution du constructeur grace à return
    //         return ;
    //     }

    //     // On récupère le nom de la route courante
    //     // On va se servir du nom de la route demandée pour la faire coïncider avec les ACL
    //     $routeName = $match['name'];

    //     // -----------------------------------
	// 	// ACL
	// 	// -----------------------------------

    //     // On définit la liste des permissions pour les routes nécessitant une connexion utilisateur
    //     $acl = [
    //         // 'main-home' =>              ['admin', 'catalog-manager'],

    //     ];

    //     // On vérifie que la route demandée est dans les ACL
    //     // On utilise array_key_exists() qui vérifie la présence d'une clé dans un tableau associatif
    //     // https://www.php.net/manual/fr/function.array-key-exists.php
    //     // C'est un peu comme in_array mais avec les clés et pas les valeurs

    //     // si la route actuelle est présente dans les clés du tableau $acl
    //     if (array_key_exists($routeName, $acl)) {
            
    //         // Alors on récupère le tableau des roles autorisés
    //         $authorizedRoles = $acl[$routeName];
    //         // exemple : ['admin', 'catalog-manager']

    //         // on execute checkAuthorization ici
    //         // au lieu de l'exécuter dans chacune des méthodes !
    //         $this->checkAuthorization($authorizedRoles);
    //     }

    //     // Sinon, on ne fait rien, on laisse la suite du script se faire (afficher)




    // }

    /**
     * Méthode permettant de vérifier les droits d'un utilisateur
     * - selon qu'il soit connecté, ou non
     * - selon son rôle
     * 
     * 
    */
    // public function checkAuthorization($roles=[]) {
    
    //     // si l'utilisateur est connecté
    //     if (isset($_SESSION['userObject'])) {
    
    //         // alors on récupère l'utilisateur connecté (dans $_SESSION)
    //         $appUser = $_SESSION['userObject'];
    
    //         // puis on récupère son role
    //         $roleUser = $appUser->getRole();
            
    //         // est-ce que le rôle fait partie des rôles autorisées (fournis en paramètres) ?
    //         if (in_array($roleUser, $roles)) {
    
    //             // ce rôle fait partie des rôles autorisées
    
    //             // on retourne vrai
    //             return true;
    
    //         } else {
                
    //             // ce rôle NE FAIT PAS partie des rôles autorisées
    //             // l'utilisateur connecté n'a pas la permission d'accéder à la page
                
    //             // envoie le header "403 Forbidden"
    //             // https://www.php.net/manual/fr/function.http-response-code.php
    //             http_response_code(403);
    
    //             // puis on affiche la page d'erreur 403
    //             $this->show('error/err403');
    
    //             // enfin, on arrête le script pour que la page demandée ne s'affiche pas
    //             exit;
    //         }
        
    //     } else {
        
    //         // l'internaute n'est pas connecté à un compte
    //         // on le redirige vers la page de connexion
    //         global $router;
    //         header('Location: ' . $router->generate('signin'));
    //         exit;
            
    //     }
    // }


    /**
     * Méthode permettant d'afficher du code HTML en se basant sur les views
     *
     * @param string $viewName Nom du fichier de vue
     * @param array $viewData Tableau des données à transmettre aux vues
     * @return void
     */
    protected function show(string $viewName, $viewData = []) {
        // On globalise $router car on ne sait pas faire mieux pour l'instant
        global $router;

        dump($_SESSION); 

        // Comme $viewData est déclarée comme paramètre de la méthode show()
        // les vues y ont accès
        // ici une valeur dont on a besoin sur TOUTES les vues
        // donc on la définit dans show()
        $viewData['currentPage'] = $viewName; 

        // définir l'url absolue pour nos assets
        $viewData['assetsBaseUri'] = $_SERVER['BASE_URI'] . 'assets/';
        // définir l'url absolue pour la racine du site
        // /!\ != racine projet, ici on parle du répertoire public/
        $viewData['baseUri'] = $_SERVER['BASE_URI'];

        // On veut désormais accéder aux données de $viewData, mais sans accéder au tableau
        // La fonction extract permet de créer une variable pour chaque élément du tableau passé en argument
        extract($viewData);
        // => la variable $currentPage existe désormais, et sa valeur est $viewName
        // => la variable $assetsBaseUri existe désormais, et sa valeur est $_SERVER['BASE_URI'] . '/assets/'
        // => la variable $baseUri existe désormais, et sa valeur est $_SERVER['BASE_URI']
        // => il en va de même pour chaque élément du tableau

        // $viewData est disponible dans chaque fichier de vue
        require_once __DIR__.'/../views/layout/nav.tpl.php';
        require_once __DIR__.'/../views/'.$viewName.'.tpl.php';
        require_once __DIR__.'/../views/layout/footer.tpl.php';
    }
}
