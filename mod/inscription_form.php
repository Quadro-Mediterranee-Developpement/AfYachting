<?php
if (basename(__FILE__) == basename($_SERVER["SCRIPT_FILENAME"])) {
    header('Location: ../index?p=404');
    exit();
} else {
    require_once 'utilityPhp/creationFormType.php';

    function inscription_form($mode = false) {
        ?>
        <div style="width: 100%;">
            <h5 class="card-title text-center">Inscription</h5>
            <form <?= ($mode) ? "onsubmit='inscription()'" : ''; ?> class="form-signin" action="traitementPOST/index.php?p=inscription" method="POST">

                <?php
                creationFormType::input_text("text", "inputUserame", "Nom", "userName", "Nom");

                creationFormType::input_text("email", "inputEmail", "Adresse Email", "mail", "Adresse Email");

                creationFormType::input_text("password", "inputPassword", "Mot de passe", "password", "Mot de passe");

                creationFormType::input_text("password", "inputConfirmPassword", "Confirmer mot de passe", "passwordVerif", "Confirmer mot de passe");
                ?>
                <button class="btn btn-lg btn-primary btn-block text-uppercase" type="submit" name="inscription" id="btnInscri">Inscription</button>
                <?php if (isset($_SESSION['erreur'])): ?>
                    <p id="errorform" class="form-control is-invalid"><?= $_SESSION['erreur']['desc']; ?></p>
                <?php endif; ?>
                <p id="errorform" class="form-control is-invalid" style="display: none"></p>
                <a class="d-block text-center mt-2 small" href="index?p=connexion">Connexion</a>


                <script src="ajaxUse/XHR.js" type="text/javascript"></script>
                <script type="text/javascript">
                    var action = window.document.getElementById("btnInscri");
                    action.addEventListener("click", inscription);
                    function inscription()
                    {
                        var pseudo = document.getElementById('inputUserame').value;
                        var mail = document.getElementById('inputEmail').value;
                        var pass = document.getElementById('inputPassword').value;
                        var passverif = document.getElementById('inputConfirmPassword').value;
                        ajaxMethode(log, [pseudo, mail, pass, passverif, 'inscription'], ['userName', 'mail', 'password', 'passwordVerif', 'type'], 'ajaxUse/traitement.php');
                    }

                    function log(data) {
                        if (data === "OK") {
                            document.location.search = "?p=<?= $_SESSION['activeBackPage']['url'] ?>";
                        } else {
                            document.getElementById("errorform").innerHTML = data;
                            document.getElementById("errorform").style.display = 'block';
                        }
                    }
                </script>
            </form>
        </div>

        <?php
    }

}

