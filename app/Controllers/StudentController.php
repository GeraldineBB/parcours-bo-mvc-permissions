<?php

// le présent controller sera rangé dans ce namespace :
namespace App\Controllers;

// ne pas oublier ↓↓↓
// on charge le Model approprié
use App\Models\Student;


class StudentController extends CoreController
{

    /**
     * Liste des profs
     * 
     */
    public function studentsList() {

         // on récupère tous les profs
         $students = Student::findAll();

         dump($students); 
 
         $this->show('student/list', [
           "students" => $students, 
         ]);
 
    }

}