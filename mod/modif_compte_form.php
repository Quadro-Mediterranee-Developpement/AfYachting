<?php
if (basename(__FILE__) == basename($_SERVER["SCRIPT_FILENAME"])) {
    header('Location: ../index?p=404');
    exit();
} else {
    require_once 'utilityPhp/creationFormType.php';
    //TEXT
    // un peu partout
    function modif_compte_form($mode = false) {
        ?>
        <div style="width: 100%;">
            <form <?= ($mode) ? "onsubmit='return modificationAll(logm)'" : 'action="traitementPOST/index.php?p=modification" method="POST"'; ?> class="form-signin" >

                <?php
                creationFormType::input_text("text", "inputUserameModif", "Nom", "userName", "Nom");

                creationFormType::input_text("email", "inputEmailModif", "Adresse Email", "mail", "Adresse Email");

                creationFormType::input_text("password", "inputPasswordModif", "Mot de passe", "password", "Mot de passe");

                creationFormType::input_text("password", "inputConfirmPasswordModif", "Confirmer mot de passe", "passwordVerif", "Confirmer mot de passe");

                creationFormType::input_text("text", "inputPhoneModif", "0600000000", "phone", "numéro de telephone");

                creationFormType::input_text("number", "inputIDModif", "0", "id", "l'id du compte");

                creationFormType::input_select('inputRoleModif', 'role', ['client' => 'client', 'skipper' => 'skipper', 'admin' => 'admin'], 'role')
                ?>

                <button class="btn btn-lg btn-primary btn-block text-uppercase" type="submit" name="modifier">modifier</button>

                <?php if (isset($_SESSION['erreur'])): ?>
                    <p id="errorform" class="form-control is-invalid"><?= $_SESSION['erreur']['desc']; ?></p>
                <?php endif; ?>
                <p id="errorform" class="form-control is-invalid" style="display: none"></p>

                <script src="ajaxUse/XHR.js" type="text/javascript"></script>
                <script type="text/javascript">
                    window.addEventListener('hashchange', function () {
                        var hash = window.location.hash.toString().substr(1).split('&');
                        window.document.getElementById('inputUserameModif').placeholder = hash[2];
                        window.document.getElementById('inputEmailModif').placeholder = hash[3];
                        window.document.getElementById('inputPhoneModif').placeholder = hash[4];
                        window.document.getElementById('inputIDModif').value = hash[0];
                        window.document.getElementById('inputRoleModif').value = hash[1];
                    }, false);

                </script>
            </form>
        </div>

        <?php
    }

}

