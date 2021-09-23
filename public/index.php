<?php

require_once '../vendor/autoload.php';

session_start();

/* ------------
--- ROUTAGE ---
-------------*/


// création de l'objet router
// Cet objet va gérer les routes pour nous, et surtout il va 
$router = new AltoRouter();

// le répertoire (après le nom de domaine) dans lequel on travaille est celui-ci
// Mais on pourrait travailler sans sous-répertoire
// Si il y a un sous-répertoire
if (array_key_exists('BASE_URI', $_SERVER)) {
    // Alors on définit le basePath d'AltoRouter
    $router->setBasePath($_SERVER['BASE_URI']);
    // ainsi, nos routes correspondront à l'URL, après la suite de sous-répertoire
}
// sinon
else {
    // On donne une valeur par défaut à $_SERVER['BASE_URI'] car c'est utilisé dans le CoreController
    $_SERVER['BASE_URI'] = '/';
}

// On doit déclarer toutes les "routes" à AltoRouter, afin qu'il puisse nous donner LA "route" correspondante à l'URL courante

// MAIN ROUTES

$router->map(
    'GET',
    '/',
    [
        'method' => 'home',
        'controller' => '\App\Controllers\MainController'
    ],
    'main-home'
);

// route login en GET et POST

$router->map(
    'GET',
    '/signin',
    [
        'method' => 'signin',
        'controller' => '\App\Controllers\AppUserController'
    ],
    'main-connexion'
);

$router->map(
    'POST',
    '/signin',
    [
        'method' => 'signinPost',
        'controller' => '\App\Controllers\AppUserController'
    ],
    'main-connexion-post'
);

// route pour se déconnecter


$router->map(
    'GET',
    '/logout',
    [
        'method' => 'logout',
        'controller' => '\App\Controllers\AppUserController'
    ],
    'logout'
);

// TEACHERS

// -----------------------------------------------
// [C]RUD
// -----------------------------------------------

// route pour afficher le formulaire de création d'un prof GET

$router->map(
    'GET',
    '/teachers/add',
    [
        'method' => 'add',
        'controller' => '\App\Controllers\TeacherController'
    ],
    'teacher-add'
);

// route pour créer un prof en DB POST

$router->map(
    'POST',
    '/teachers/add',
    [
        'method' => 'addSave',
        'controller' => '\App\Controllers\TeacherController'
    ],
    'teacher-addsave'
);


// -----------------------------------------------
// C[R]UD
// -----------------------------------------------

// route pour voir la liste des profs

$router->map(
    'GET',
    '/teachers',
    [
        'method' => 'teachersList',
        'controller' => '\App\Controllers\TeacherController'
    ],
    'teacher-list'
);

// -----------------------------------------------
// CR[U]D
// -----------------------------------------------

// Affichage du formulaire de modification d'un prof existant
$router->map(
    'GET',
    '/teachers/[i:id]',
    [
        'method' => 'edit',
        'controller' => '\App\Controllers\TeacherController'
    ],
    'teacher-edit'
);

// Sauvegarde d'un prof existant
$router->map(
    'POST',
    '/teachers/[i:id]',
    [
        'method' => 'editSave',
        'controller' => '\App\Controllers\TeacherController'
    ],
    'teacher-editsave'
);


// -----------------------------------------------
// CRU[D]
// -----------------------------------------------


// STUDENT

// -----------------------------------------------
// [C]RUD
// -----------------------------------------------

$router->map(
    'GET',
    '/students/add',
    [
        'method' => 'add',
        'controller' => '\App\Controllers\StudentController'
    ],
    'student-add'
);

// route pour créer un prof en DB POST

$router->map(
    'POST',
    '/students/add',
    [
        'method' => 'addSave',
        'controller' => '\App\Controllers\StudentController'
    ],
    'student-addsave'
);


// -----------------------------------------------
// C[R]UD
// -----------------------------------------------

// route pour voir la liste des profs

$router->map(
    'GET',
    '/students',
    [
        'method' => 'studentsList',
        'controller' => '\App\Controllers\StudentController'
    ],
    'student-list'
);

// -----------------------------------------------
// CR[U]D
// -----------------------------------------------

// Affichage du formulaire de modification d'un etuddiant existant
$router->map(
    'GET',
    '/students/[i:id]',
    [
        'method' => 'edit',
        'controller' => '\App\Controllers\StudentController'
    ],
    'student-edit'
);

// Sauvegarde d'un etuddiant existant
$router->map(
    'POST',
    '/students/[i:id]',
    [
        'method' => 'editSave',
        'controller' => '\App\Controllers\StudentController'
    ],
    'student-editsave'
);
// -----------------------------------------------
// CRU[D]
// -----------------------------------------------







/* -------------
--- DISPATCH ---
--------------*/

// on demande à (alto)$router
// s'il trouve ($match) la route de notre URL actuelle
$match = $router->match(); // return false, si aucune route correspondante
// on envoie le résultat du $match au dispatcher
// accompagné d'un plan B (fallback) : une belle erreur 404
$dispatcher = new Dispatcher($match, '\App\Controllers\ErrorController::err404');
// puis on lance le dispatcher
$dispatcher->dispatch();
