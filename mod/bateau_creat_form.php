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
                creationFormType::input_text("text", "description", "Modèle du bateau", "description", "Modèle du bateau");

                creationFormType::input_select("nomModele", "nomModele",["rigide"=>"Coque rigide", "semi"=>"Coque semi rigide", "prestige"=>"Gamme prestige"] ,"type de coque");
                creationFormType::input_text("text", "moteur", "Moteur", "moteur", "Moteur");
                creationFormType::input_text("number", "longueur", "Longueur", "longueur", "Longueur");
                creationFormType::input_text("number", "nombrePassager", "Nombre de passagers", "nombrePassager", "Nombre de passagers");
                echo '<p>Pour ajouter des options, merci de coller les équipements avec des ";" sans espace, tout accroché. <b>Ex: "Equipement Numéro 1;Equipement Numéro 2;...;Equipement Numéro n"</b></p>';
                creationFormType::input_text("text", "Equipement", "Equipement(s)", "Equipement", "Equipement(s)");
                creationFormType::input_text("text", "divers", "Divers", "divers", "Divers");
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