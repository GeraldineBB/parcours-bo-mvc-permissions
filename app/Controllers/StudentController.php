<?php

// le présent controller sera rangé dans ce namespace :
namespace App\Controllers;

// ne pas oublier ↓↓↓
// on charge le Model approprié
use App\Models\Student;
use App\Models\Teacher;



class StudentController extends CoreController
{

  /**
   * Liste des profs
   * 
   */
  public function studentsList()
  {

    // on récupère tous les profs
    $students = Student::findAll();

    dump($students);

    $this->show('student/list', [
      "students" => $students,
    ]);
  }

  /**
   * Formulaire d'ajout d'un nouvel étudiant
   * 
   */
  public function add()
  {

    // on récupère tous les profs pour les afficher dans la liste déroulante
    $teachers = Teacher::findAll();

    $this->show('student/add', [
      "teachers" => $teachers,
    ]);
  }

  /**
   * (POST) Création d'un nouvel étudiant
   * à partir des données envoyées par le formulaire
   * 
   */

  public function addSave()
  {
    // dump($_POST);

    // On récupère les données
    $firstname = filter_input(INPUT_POST, 'firstname');
    $lastname = filter_input(INPUT_POST, 'lastname');
    $teacherId = filter_input(INPUT_POST, 'teacher');
    $status = filter_input(INPUT_POST, 'status', FILTER_VALIDATE_INT);

    // On crée un nouveau Model
    $student = new Student();

    // On renseigne les propriétés
    $student->setFirstname($firstname);
    $student->setLastname($lastname);
    $student->setTeacherId($teacherId);
    $student->setStatus($status);

    // On sauvegarde en DB
    if ($student->save()) {
      header('Location: /students');
      exit;
    } else {
      echo "erreur lors de l'ajout de cette nouvelle catégorie dans la BDD 😩";
    }
  }
}
