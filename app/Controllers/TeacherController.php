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
  public function teachersList()
  {

    // on récupère tous les profs
    $teachers = Teacher::findAll();

    dump($teachers);

    $this->show('teacher/list', [
      "teachers" => $teachers,
    ]);
  }

  /**
   * Formulaire d'ajout d'un nouveau prof
   *
   */
  public function add()
  {
    $this->show('teacher/add');
  }

  /**
   * (POST) Création d'un nouveau prof
   * à partir des données envoyées par le formulaire
   *
   */

  public function addSave()
  {
    // dump($_POST);

    // On récupère les données
    $firstname = filter_input(INPUT_POST, 'firstname');
    $lastname = filter_input(INPUT_POST, 'lastname');
    $job = filter_input(INPUT_POST, 'job');
    $status = filter_input(INPUT_POST, 'status', FILTER_VALIDATE_INT);

    // On crée un nouveau Model
    $teacher = new Teacher();

    // On renseigne les propriétés
    $teacher->setFirstname($firstname);
    $teacher->setLastname($lastname);
    $teacher->setJob($job);
    $teacher->setStatus($status);

    // On sauvegarde en DB
    if ($teacher->save()) {
      header('Location: /teachers');
      exit;
    } else {
      echo "erreur lors de l'ajout de ce nouveau prof dans la BDD 😩";
    }
  }

  /**
   * Formulaire de modification d'un prof
   *
   * @param int $teacherId ID du prof, fournie par AltoDispatcher
   * @return void
   */
  public function edit($teacherId)
  {

    // on rapatrie le Model correspondant
    $teachers = Teacher::find($teacherId);

    // on affiche la vue
    // à qui on transmet le Model, et son ID
    $this->show(
      'teacher/edit',
      [
        'teachers' => $teachers,
        'teacherId' => $teacherId
      ]
    );
  }

  /**
   * (POST) Sauvegarde d'un prof
   * à partir des données envoyées par le formulaire
   *
   * @return void
   */
  public function editSave($teacherId)
  {
    // On récupère les données
    $firstname = filter_input(INPUT_POST, 'firstname');
    $lastname = filter_input(INPUT_POST, 'lastname');
    $job = filter_input(INPUT_POST, 'job');
    $status = filter_input(INPUT_POST, 'status', FILTER_VALIDATE_INT);

    // On récup notre prof à mettre à jour
    $teacher = Teacher::find($teacherId);

    // On met à jour les propriétés
    $teacher->setFirstname($firstname);
    $teacher->setLastname($lastname);
    $teacher->setJob($job);
    $teacher->setStatus($status);

    // On sauvegarde en DB
    $updated = $teacher->save();

    if ($updated) {

      // tout c'est bien passé

      // on redirige
      header('Location: /teachers');
      exit;
      // un exit pour s'assurer que la suite du code ne soit pas exécutée une fois la redirection effectuée

    } else {

      // flûte
      echo "erreur lors de l'édition de ce produit dans la BDD 😩";
    }
  }

  public function delete($teacherId)
  {

    // on rapatrie le Model correspondant
    $teacher = Teacher::find($teacherId);

    if ($teacher) {

      // cette catégorie existe
      $deleted = $teacher->delete();

      if ($deleted) {
        header('Location: /teachers'); // redirection
        exit; // toujours arrêter l'execution du code actuel lors d'une redirection
      } else {
        echo "erreur lors de la suppression de cette catégorie dans la BDD 😩";
      }
    } else {
      // cette catégorie n'existe pas
      $this->show('error/err404');
    }
  }
}
