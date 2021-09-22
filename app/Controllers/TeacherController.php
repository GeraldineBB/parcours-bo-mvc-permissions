<?php

// le présent controller sera rangé dans ce namespace :
namespace App\Controllers;

// ne pas oublier ↓↓↓
// on charge le Model approprié
use App\Models\Teacher;


class TeacherController extends CoreController
{

    /**
     * Liste des profs
     * 
     */
    public function teachersList() {

         // on récupère tous les profs
         $teachers = Teacher::findAll();

         dump($teachers); 
 
         $this->show('teacher/list', [
           "teachers" => $teachers, 
         ]);
 
    }

}