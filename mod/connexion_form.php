<?php
if (basename(__FILE__) == basename($_SERVER["SCRIPT_FILENAME"])) {
    header('Location: ../index?p=404');
    exit();
} else {
    require_once 'utilityPhp/creationFormType.php';
    //TEXT
    // un peu partout
    function connexion_form($mode = false,$action = "") {
        ?>
        <div style="width: 100%;">
            <h5 class="card-title text-center">Connexion</h5>
            <form <?= ($mode) ? "onsubmit='return connexion($action)'" : 'method="POST" action="traitementPOST/index.php?p=connexion"'; ?> class="form-signin" >
                <?php
                creationFormType::formconnect("text", "inputNameEmail", "Nom ou adresse Email", "userName", "Nom ou adresse Email");
                creationFormType::formconnect("password", "inputPassword", "Mot-de-passe", "password", "Mot de passe");
                ?>
                <button class = "btn btn-lg btn-primary btn-block text-uppercase" type = "submit" name = "connect"  >Se connecter</button>

                <script src = "ajaxUse/XHR.js" type = "text/javascript"></script>

                <?php if (isset($_SESSION['erreur'])): ?>
                    <p id="errorform" class="form-control is-invalid"><?= $_SESSION['erreur']['desc']; ?></p>
                <?php endif; ?>
                <p id="errorform" class="form-control is-invalid" style="display: none"></p>
                <a class="d-block text-center mt-2 small" href="index.php?p=inscription">inscription</a>
                <a class="d-block text-center mt-2 small" href="index.php?p=recuperation">mot de passe oublié</a>
            </form>
        </div>

        <?php
    }

}
