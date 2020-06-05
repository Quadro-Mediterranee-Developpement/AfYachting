<?php
if (basename(__FILE__) == basename($_SERVER["SCRIPT_FILENAME"])) {
    header('Location: ../index?p=404');
    exit();
} else {
    require_once 'type_form.php';

    function inscription_form($mode = false) {
        if ($mode):
            ?>
            <div style="width: 100%;">
                <h5 class="card-title text-center">Inscription</h5>
                <script type="text/javascript">
                    function testAJAX(callback) {
                        var xhr = getXMLHttpRequest();
                        xhr.onreadystatechange = function () {
                            if (xhr.readyState === 4 && (xhr.status === 200 || xhr.status === 0)) {
                                callback(xhr.responseText);
                            }
                        };

                        var pseudo = document.getElementById('inputUserame').value;
                        var mail = document.getElementById('inputEmail').value;
                        var pass = document.getElementById('inputPassword').value;
                        var verifpass = document.getElementById('inputConfirmPassword').value;
                        xhr.open("POST", "ajaxUse/inscription.php", true); // POST
                        xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
                        xhr.send("userName=" + pseudo + "&mail=" + mail+"&password=" +pass + "&passwordVerif=" +verifpass+ "&inscription=");
                    }

                    function log(data) {
                        if (data === "OK") {
                            document.location.search="?p=accueil&g=inscription";
                        } else {
                            document.getElementById("errorform").innerHTML = data;
                            document.getElementById("errorform").style.display = 'block';
                        }
                    }
                </script>
                    <?php
                    input_text("text", "inputUserame", "Nom", "userName", "Nom");

                    input_text("email", "inputEmail", "Adresse Email", "mail", "Adresse Email");

                    input_text("password", "inputPassword", "Mot de passe", "password", "Mot de passe");

                    input_text("password", "inputConfirmPassword", "Confirmer mot de passe", "passwordVerif", "Confirmer mot de passe");
                    ?>
                <button class="btn btn-lg btn-primary btn-block text-uppercase" type="submit" name="inscription" onclick="testAJAX(log)">Inscription</button>
                <p id="errorform" class="form-control is-invalid" style="display: none"></p>
                <a class="d-block text-center mt-2 small" href="index?p=connexion&g=<?= (isset($_GET['g'])) ? $_GET['g'] : 'accueil'; ?>">Connexion</a>
                <script src="ajaxUse/XHR.js" type="text/javascript"></script>
            </div>

            <?php
        else:
            ?>
            <div style="width: 100%;">
                <h5 class="card-title text-center">Inscription</h5>
                <form class="form-signin" action="traitementPOST/index.php?p=inscription&g=<?= (isset($_GET['g'])) ? $_GET['g'] : 'accueil'; ?>" method="POST">
                    <?php
                    input_text("text", "inputUserame", "Nom", "userName", "Nom");

                    input_text("email", "inputEmail", "Adresse Email", "mail", "Adresse Email");

                    input_text("password", "inputPassword", "Mot de passe", "password", "Mot de passe");

                    input_text("password", "inputConfirmPassword", "Confirmer mot de passe", "passwordVerif", "Confirmer mot de passe");
                    ?>
                    <button class="btn btn-lg btn-primary btn-block text-uppercase" type="submit" name="inscription">Inscription</button>
                    <?php if (isset($_SESSION['erreur'])): ?>
                        <p id="errorform" class="form-control is-invalid"><?= $_SESSION['erreur']['desc']; ?></p>
                    <?php endif; ?>
                    <a class="d-block text-center mt-2 small" href="index?p=connexion&g=<?= (isset($_GET['g'])) ? $_GET['g'] : 'accueil'; ?>">Connexion</a>
                </form>
            </div>

        <?php
        endif;
    }

}

