<?php
if (basename(__FILE__) == basename($_SERVER["SCRIPT_FILENAME"])) {
    header('Location: ../index?p=404');
    exit();
} else {
    require_once 'utilityPhp/creationFormType.php';

    //TEXT
    // un peu partout
    function recup_form($mode = false, $action = "") {
        ?>
        <div style="width: 100%;">
            <h5 class="card-title text-center">Code</h5>
            <form <?= ($mode) ? "onsubmit='return inspect($action)'" : 'method="POST" action="traitementPOST/index.php?p=inspect"'; ?> class="form-signin" >
                <?php
                creationFormType::input_text("text", "code", "code", "code", "code");
                ?>
                <button class = "btn btn-lg btn-primary btn-block text-uppercase" type = "submit" name = "oublie"  >valider le code</button>

                <script src = "ajaxUse/XHR.js" type = "text/javascript"></script>

                <?php if (isset($_SESSION['erreur'])): ?>
                    <p id="errorform" class="form-control is-invalid"><?= $_SESSION['erreur']['desc']; ?></p>
                <?php endif; ?>
                <p id="errorform" class="form-control is-invalid" style="display: none"></p>
                <a class="d-block text-center mt-2 small" href="index.php?p=inscription">inscription</a>
                <a class="d-block text-center mt-2 small" href="index.php?p=connexion">connexion</a>
                <a class="d-block text-center mt-2 small" href="index.php?p=recuperation">mot de passe oublié</a>
            </form>
            <form <?= ($mode) ? "onsubmit='return modifMDP($action)'" : 'method="POST" action="traitementPOST/index.php?p=modifMDP"'; ?> class="form-signin" id='modifMDP' style="display:none">
                <input type='hidden' id='stockCode'>
                <?php
                creationFormType::input_text("password", "inputPassword", "Mot-de-passe", "password", "Mot de passe");
                creationFormType::input_text("password", "inputVerifPassword", "Mot-de-passe", "password", "verification");
                ?>
                <button class = "btn btn-lg btn-primary btn-block text-uppercase" type = "submit" name = "oublie"  >valider le code</button>

                <script src = "ajaxUse/XHR.js" type = "text/javascript"></script>

                <?php if (isset($_SESSION['erreur'])): ?>
                    <p id="errorform" class="form-control is-invalid"><?= $_SESSION['erreur']['desc']; ?></p>
                <?php endif; ?>
                <p id="errorform" class="form-control is-invalid" style="display: none"></p>
            </form>
        </div>

        <?php
    }

}
