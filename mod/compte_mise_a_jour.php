<?php
if (basename(__FILE__) == basename($_SERVER["SCRIPT_FILENAME"])) {
    header('Location: ../index?p=404');
    exit();
} else {
    require_once 'utilityPhp/creationFormType.php';

    function compte_mise_a_jour($mode = false) {
        ?>
        <div style="width: 100%;">
            <form <?= ($mode) ? "onsubmit='return modification(logm)'" : 'action="traitementPOST/index.php?p=modification" method="POST"'; ?> class="form-signin" >

                <?php
                $info = compteMANAGER::recupINFORMATIONone($_SESSION['ID']);
                creationFormType::input_text("text", "inputUserame", $info['Username'], "userName", "Nom", false);

                creationFormType::input_text("email", "inputEmail", $info['Mail'], "mail", "Nouvelle adresse Email", false);

                creationFormType::input_text("password", "inputPassword", "Nouveau mot de passe", "password", "Nouveau mot de passe", false);

                creationFormType::input_text("password", "inputConfirmPassword", "Confirmer mot de passe", "passwordVerif", "Confirmer mot de passe", false);

                creationFormType::input_text("text", "inputTelephone", $info['Phone'], "phone", "Numéro de téléphone", false);
                ?>
                <button class = "btn btn-lg btn-primary btn-block text-uppercase" type = "submit" name = "modif"  >Modifier</button>

                <script src="ajaxUse/XHR.js" type="text/javascript"></script>
                <script type="text/javascript">
                    function logm(data) {
                        if (data === "OK") {
                            document.location.reload();
                        } else {
                            document.getElementById("errorform").innerHTML = data;
                            document.getElementById("errorform").style.display = 'block';
                        }
                    }
                </script>
                <?php if (isset($_SESSION['erreur'])): ?>
                    <p id="errorform" class="form-control is-invalid"><?= $_SESSION['erreur']['desc']; ?></p>
                <?php endif; ?>
                <p id="errorform" class="form-control is-invalid" style="display: none"></p>



            </form>
        </div>

        <?php
    }

}

