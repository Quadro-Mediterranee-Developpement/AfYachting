<?php
if (basename(__FILE__) == basename($_SERVER["SCRIPT_FILENAME"])) {
    header('Location: ../index?p=404');
    exit();
} else {
    require_once 'utilityPhp/creationFormType.php';

    function location_creat_form() {
        ?>
        <div class=" container-fluid d-flex justify-content-between mt-5 infoContainer ">
            <h5 class="card-title text-center">Ajouter un bateau a la location</h5>
            <form method='POST' enctype="multipart/form-data" action='traitementPOST/index.php?p=<?= (isset($_GET['p'])) ? $_GET['p'] : 'accueil'; ?>&g=<?= (isset($_GET['g'])) ? $_GET['g'] : 'accueil'; ?>' class="form-signin">
                <?php
                creationFormType::input_text("file", "file", "Nom du fichier...", "file", "Nom du fichier");
                creationFormType::input_text("text", "description", "description du bateau", "description", "description du bateau");
                creationFormType::input_text("text", "nom", "Nom du bateau", "nom", "Nom du bateau");
      
                creationFormType::input_text("text", "nomModele", "nom du model du bateau", "nomModele", "nom du model du bateau");
                creationFormType::input_text("text", "moteur", "moteur", "moteur", "moteur");
                creationFormType::input_text("text", "longueur", "longueur", "longueur", "longueur");
                creationFormType::input_text("number", "nombrePassager", "nombrePassager", "nombrePassager", "nombrePassager");
                creationFormType::input_text("text", "Equipement", "Equipement", "Equipement", "Equipement");
                creationFormType::input_text("text", "divers", "divers", "divers", "divers");
                ?>
                <button class="btn btn-lg btn-primary btn-block text-uppercase" type="submit" name='skippeur'>Enregistrer</button>
            </form>
        </div>
        <?php
    }

}