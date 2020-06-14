<?php
if (basename(__FILE__) == basename($_SERVER["SCRIPT_FILENAME"])) {
    header('Location: ../index?p=404');
    exit();
} else {
    require_once 'utilityPhp/creationFormType.php';
    //TEXT
    // un peu partout
    function new_compte_form($mode = false) {
        ?>
        <div style="width: 100%;">
            <form <?= ($mode) ? "onsubmit='return inscriptionAll(logm)'" : 'action="traitementPOST/index.php?p=inscription" method="POST"'; ?> class="form-signin" >

                <?php
                creationFormType::input_text("text", "inputUserame", "Nom", "userName", "Nom");

                creationFormType::input_text("email", "inputEmail", "Adresse Email", "mail", "Adresse Email");

                creationFormType::input_text("password", "inputPassword", "Mot de passe", "password", "Mot de passe");

                creationFormType::input_text("password", "inputConfirmPassword", "Confirmer mot de passe", "passwordVerif", "Confirmer mot de passe");

                creationFormType::input_text("text", "inputPhone", "0600000000", "phone", "numéro de telephone");

                creationFormType::input_select('inputRole', 'role', ['client' => 'client', 'skipper' => 'skipper', 'admin' => 'admin'], 'role')
                ?>

                <button class="btn btn-lg btn-primary btn-block text-uppercase" type="submit" name="inscript">Inscription</button>
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

