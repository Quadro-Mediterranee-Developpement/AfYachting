<?php
if (basename(__FILE__) == basename($_SERVER["SCRIPT_FILENAME"])) {
    header('Location: ../index?p=404');
    exit();
} else {
    require_once 'utilityPhp/creationFormType.php';
    //TEXT
    // un peu partout
    function bateau_creat_form($mode = false) {
        ?>
        <div style="width: 100%;">
            <form <?= ($mode) ? "onsubmit='return creatnewboat(logm)'" : 'action="traitementPOST/index.php?p=creatnewboat" method="POST"'; ?> class="form-signin" >
                <?php
                //ajoute d'image a cree
                //creationFormType::input_text("file", "file", "Nom du fichier...", "file", "Nom du fichier");
                //ajout d'option a cree

                creationFormType::input_text("text", "nom", "Nom du bateau", "nom", "Nom du bateau");
                creationFormType::input_text("text", "description", "description du bateau", "description", "modele du bateau");

                creationFormType::input_select("nomModele", "nomModele",["rigide"=>"Coque rigide", "semi"=>"Coque semi rigide", "prestige"=>"Gamme prestige"] ,"type de coque");
                creationFormType::input_text("text", "moteur", "moteur", "moteur", "moteur");
                creationFormType::input_text("number", "longueur", "longueur", "longueur", "longueur");
                creationFormType::input_text("number", "nombrePassager", "nombrePassager", "nombrePassager", "nombrePassager");
                creationFormType::input_text("text", "Equipement", "Equipement", "Equipement", "Equipement");
                creationFormType::input_text("text", "divers", "divers", "divers", "divers");
                ?>
                <button class="btn btn-lg btn-primary btn-block text-uppercase" type="submit" name='bat_loc_form'>Enregistrer</button>
                <?php if (isset($_SESSION['erreur'])): ?>
                    <p id="errorform" class="form-control is-invalid"><?= $_SESSION['erreur']['desc']; ?></p>
                <?php endif; ?>
                <p id="errorform" class="form-control is-invalid" style="display: none"></p>

                <script src="ajaxUse/XHR.js" type="text/javascript"></script>
            </form>
        </div>
        <?php
    }

}