<div class="container my-4"> <a href="../student/list.html" class="btn btn-success float-right">Retour</a>
    <h2>Mettre à jour un étudiant</h2>

    <form action="" method="POST" class="mt-5">
        <div class="form-group">
            <label for="firstname">Prénom</label>
            <input type="text" class="form-control" name="firstname" id="firstname" placeholder="" value="<?= $students->getFirstname() ?>">
        </div>
        <div class="form-group">
            <label for="lastname">Nom</label>
            <input type="text" class="form-control" name="lastname" id="lastname" placeholder="" value="<?= $students->getLastname() ?>">
        </div>
        <div class="form-group">
            <label for="teacher">Prof</label>
            <select name="teacher" id="teacher" class="form-control">
                <option value="0">-</option>
                <option value="1" selected>Prénom Prof - Formateur PHP/MySQL</option>
                <option value="2">Prénom2 Prof2 - Formateur PHP/MySQL</option>
                <option value="5">sgsg fsgfsg - sg</option>
            </select>
        </div>
        <div class="form-group">
            <label for="status">Statut</label>
            <select name="status" id="status" class="form-control">
                <option value="1" <?php if ($students->getStatus() == 1) : ?> selected<?php endif ?>>actif</option>
                <option value="2" <?php if ($students->getStatus() == 2) : ?> selected<?php endif ?>>désactivé</option>
            </select>
        </div>
        <button type="submit" class="btn btn-primary btn-block mt-5">Valider</button>
    </form>
</div>