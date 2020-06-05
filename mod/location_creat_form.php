<?php
if (basename(__FILE__) == basename($_SERVER["SCRIPT_FILENAME"])) {
    header('Location: ../index?p=404');
    exit();
} else {
    require_once 'type_form.php';

    function location_creat_form() {
        ?>
        <div class=" container-fluid d-flex justify-content-between mt-5 infoContainer ">
            <h5 class="card-title text-center">Ajouter un bateau a la location</h5>
            <form method='POST' enctype="multipart/form-data" action='traitementPOST/index.php?p=<?= (isset($_GET['p'])) ? $_GET['p'] : 'accueil'; ?>&g=<?= (isset($_GET['g'])) ? $_GET['g'] : 'accueil'; ?>' class="form-signin">
                <?php
                input_text("file", "file", "Nom du fichier...", "file", "Nom du fichier");
                input_text("text", "description", "description du bateau", "description", "description du bateau");
                input_text("text", "nom", "Nom du bateau", "nom", "Nom du bateau");
      
                input_text("text", "nomModele", "nom du model du bateau", "nomModele", "nom du model du bateau");
                input_text("text", "moteur", "moteur", "moteur", "moteur");
                input_text("text", "longueur", "longueur", "longueur", "longueur");
                input_text("number", "nombrePassager", "nombrePassager", "nombrePassager", "nombrePassager");
                input_text("text", "Equipement", "Equipement", "Equipement", "Equipement");
                input_text("text", "divers", "divers", "divers", "divers");
                ?>
                <button class="btn btn-lg btn-primary btn-block text-uppercase" type="submit" name='skippeur'>Enregistrer</button>
            </form>
        </div>
        <?php
    }

}