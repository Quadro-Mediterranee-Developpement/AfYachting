<?php
if (basename(__FILE__) == basename($_SERVER["SCRIPT_FILENAME"])) {
    header('Location: ../index?p=404');
    exit();
} else {
    require_once 'type_form.php';

    function connexion_form($mode = false) {
        if ($mode):
            ?>
            <div style="width: 100%;">
                <h5 class="card-title text-center">Connexion</h5>
                <script type="text/javascript">
                    function testAJAX(callback) {
                        var xhr = getXMLHttpRequest();
                        xhr.onreadystatechange = function () {
                            if (xhr.readyState === 4 && (xhr.status === 200 || xhr.status === 0)) {
                                callback(xhr.responseText);
                            }
                        };

                        var pseudo = document.getElementById('inputNameEmail').value;
                        var pass = document.getElementById('inputPassword').value;

                        xhr.open("POST", "ajaxUse/connexion.php", true); // POST
                        xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
                        xhr.send("userName=" + pseudo + "&password=" + pass+"&connect=");
                    }

                    function log(data) {
                        if (data === "OK") {
                            document.location.search="?p=accueil&g=connexion";
                        } else {
                            document.getElementById("errorform").innerHTML = data;
                            document.getElementById("errorform").style.display = 'block';
                        }
                    }
                </script>
                    <?php
                    input_text("text", "inputNameEmail", "Nom ou adresse Email", "userName", "Nom ou adresse Email");
                    input_text("password", "inputPassword", "Mot de passe", "password", "Mot de passe");
                    ?>
                <button class="btn btn-lg btn-primary btn-block text-uppercase" type="submit" name="connect" onclick="testAJAX(log)">Se connecter</button>
                <p id="errorform" class="form-control is-invalid" style="display: none"></p>
                <a class="d-block text-center mt-2 small" href="index.php?p=inscription&g=<?= (isset($_GET['g'])) ? $_GET['g'] : 'accueil'; ?>">inscription</a>
                <script src="ajaxUse/XHR.js" type="text/javascript"></script>
            </div>

            <?php
        else:
            ?>
            <div style="width: 100%;">
                <h5 class="card-title text-center">Connexion</h5>
                <form class="form-signin" method="POST" action="traitementPOST/index.php?p=connexion&g=<?= (isset($_GET['g'])) ? $_GET['g'] : 'accueil'; ?>">
                    <?php
                    input_text("text", "inputNameEmail", "Nom ou adresse Email", "userName", "Nom ou adresse Email");

                    input_text("password", "inputPassword", "Mot de passe", "password", "Mot de passe");
                    ?>
                    <button class="btn btn-lg btn-primary btn-block text-uppercase" type="submit" name="connect">Se connecter</button>
                    <?php if (isset($_SESSION['erreur'])): ?>
                        <p id="errorform" class="form-control is-invalid"><?= $_SESSION['erreur']['desc']; ?></p>
                    <?php endif; ?>
                    <a class="d-block text-center mt-2 small" href="index.php?p=inscription&g=<?= (isset($_GET['g'])) ? $_GET['g'] : 'accueil'; ?>">inscription</a>
                </form>
            </div>

        <?php
        endif;
    }

}
