<?php
if (basename(__FILE__) == basename($_SERVER["SCRIPT_FILENAME"])) {
    header('Location: ../index?p=404');
    exit();
} else {
    require_once 'type_form.php';
    function connexion_form() {
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
    }

}
