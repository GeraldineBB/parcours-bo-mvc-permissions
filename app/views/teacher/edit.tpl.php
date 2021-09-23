<div class="container my-4"> <a href="../teacher/list.html" class="btn btn-success float-right">Retour</a>
        <h2>Mettre à jour un prof</h2>

    <form action="" method="POST" class="mt-5">
        <div class="form-group">
            <label for="firstname">Prénom</label>
            <input type="text" class="form-control" name="firstname" id="firstname" placeholder="" value="<?= $teachers->getFirstname() ?>">
        </div>
        <div class="form-group">
            <label for="lastname">Nom</label>
            <input type="text" class="form-control" name="lastname" id="lastname" placeholder="" value="<?= $teachers->getLastname() ?>">
        </div>
        <div class="form-group">
                <label for="job">Titre</label>
                <input type="text" class="form-control" name="job" id="job" placeholder="" value="<?= $teachers->getJob() ?>">
            </div>
        <div class="form-group">
            <label for="status">Statut</label>
            <select name="status" id="status" class="form-control">
                <option value="1" <?php if ($teachers->getStatus() == 1) : ?> selected<?php endif ?>>actif</option>
                <option value="2" <?php if ($teachers->getStatus() == 2) : ?> selected<?php endif ?>>désactivé</option>
            </select>
        </div>
        <button type="submit" class="btn btn-primary btn-block mt-5">Valider</button>
    </form>
</div>