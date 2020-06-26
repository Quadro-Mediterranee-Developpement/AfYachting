<?php
if (basename(__FILE__) == basename($_SERVER["SCRIPT_FILENAME"])) {
    header('Location: ../index?p=404');
    exit();
} else {
    require_once 'utilityPhp/creationFormType.php';
    //TEXT
    // un peu partout
    function location_creat_form($mode = false) {
        ?>
        <div class=" container-fluid d-flex justify-content-between mt-5 infoContainer ">
            <h5 class="card-title text-center">Ajouter un bateau a la location</h5>
            <form <?= ($mode) ? "onsubmit='return modificationAll(logm)'" : 'action="traitementPOST/index.php?p=modification" method="POST"'; ?> class="form-signin" >
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
                <button class="btn btn-lg btn-primary btn-block text-uppercase" type="submit" name='bat_loc_form'>Enregistrer</button>
            </form>
        </div>
        <?php
    }

}