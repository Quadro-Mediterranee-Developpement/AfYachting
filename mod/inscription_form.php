<?php
if (basename(__FILE__) == basename($_SERVER["SCRIPT_FILENAME"])) {
    header('Location: ../index?p=404');
    exit();
} else {
    require_once 'utilityPhp/creationFormType.php';
    //TEXT
    // un peu partout
    function inscription_form($mode = false) {
        ?>
        <div style="width: 100%;">
            <h5 class="card-title text-center">Inscription</h5>
            <form <?= ($mode) ? "onsubmit='return inscription()'" : 'action="traitementPOST/index.php?p=inscription" method="POST"'; ?> class="form-signin" >

                <?php
                creationFormType::input_text("text", "inputUserame", "Identifiant", "userName", "Identifiant");

                creationFormType::input_text("email", "inputEmail", "Adresse Email", "mail", "Adresse Email");

                creationFormType::input_text("password", "inputPassword", "Mot de passe", "password", "Mot de passe");

                creationFormType::input_text("password", "inputConfirmPassword", "Confirmation", "passwordVerif", "Confirmation");
                ?>
                <button class="btn btn-lg btn-primary btn-block text-uppercase" type="submit" name="inscript">Inscription</button>
                <?php if (isset($_SESSION['erreur'])): ?>
                    <p id="errorform" class="form-control is-invalid"><?= $_SESSION['erreur']['desc']; ?></p>
                <?php endif; ?>
                <p id="errorform" class="form-control is-invalid" style="display: none"></p>
                <div class="alert alert-primary" role="alert">Votre mot de passe doit contenir au moins 8 caractères dont une majuscule, une minuscule et un caractère spécial</div>
                <a class="d-block text-center mt-2 small" href="index?p=connexion">Vous avez déjà un compte ?</a>
                
                

                <script src="ajaxUse/XHR.js" type="text/javascript"></script>
            </form>
        </div>

        <?php
    }

}

