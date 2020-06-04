<?php
if (basename(__FILE__) == basename($_SERVER["SCRIPT_FILENAME"])) {
    header('Location: ../index?p=404');
    exit();
} else {
    require_once 'type_form.php';

    function inscription_form() {
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
    }

}

