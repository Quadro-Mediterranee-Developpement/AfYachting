<?php
if (basename(__FILE__) == basename($_SERVER["SCRIPT_FILENAME"])) {
    header('Location: ../index?p=404');
    exit();
} else {
    require_once 'utilityPhp/creationFormType.php';

    function connexion_form($mode = false) {
        ?>
        <div style="width: 100%;">
            <h5 class="card-title text-center">Connexion</h5>
            <form <?= ($mode) ? "onsubmit='connexion()'" : ''; ?> class="form-signin" method="POST" action="traitementPOST/index.php?p=connexion&g=<?= (isset($_GET['g'])) ? $_GET['g'] : 'accueil'; ?>">
                <?php
                creationFormType::input_text("text", "inputNameEmail", "Nom ou adresse Email", "userName", "Nom ou adresse Email");
                creationFormType::input_text("password", "inputPassword", "Mot de passe", "password", "Mot de passe");
                ?>
                <button class = "btn btn-lg btn-primary btn-block text-uppercase" type = "submit" name = "connect" id = "btnConn" >Se connecter</button>

                <script src = "ajaxUse/XHR.js" type = "text/javascript"></script>
                <script type="text/javascript">
                    function connexion()
                    {
                        var pseudo = document.getElementById('inputNameEmail').value;
                        var pass = document.getElementById('inputPassword').value;
                        ajaxMethode(log, [pseudo, pass, 'connexion'], ['userName', 'password', 'type'], 'ajaxUse/traitement.php');
                        return false;
                    }

                    function log(data) {
                        if (data === "OK") {
                            document.location.search = "?p=accueil";
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
                <a class="d-block text-center mt-2 small" href="index.php?p=inscription">inscription</a>
            </form>
        </div>

        <?php
    }

}
