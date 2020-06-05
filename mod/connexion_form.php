<?php
if (basename(__FILE__) == basename($_SERVER["SCRIPT_FILENAME"])) {
    header('Location: ../index?p=404');
    exit();
} else {

    function connexion_form() {
        ?>
        <div style="width: 100%;">
            <h5 class="card-title text-center">Connexion</h5>
            <form class="form-signin" method="POST" action="index.php">

                <div class="form-label-group">
                    <input type="text" id="inputNameEmail" class="form-control" placeholder="Nom ou adresse Email" name="userName" required>
                    <label for="inputNameEmail">Nom ou adresse Email</label>

                </div>

                <div class="form-label-group">
                    <input type="password" id="inputPassword" class="form-control" placeholder="Mot de passe" name="password" required>
                    <label for="inputPassword">Mot de passe</label>
                </div>

                <button class="btn btn-lg btn-primary btn-block text-uppercase" type="submit" name="connect">Se connecter</button>
               <?php if (isset($_SESSION['erreur'])): ?>
                    <p id="errorform" class="form-control is-invalid"><?= $_SESSION['erreur']['desc']; ?></p>
                <?php endif; ?>
                <a class="d-block text-center mt-2 small" href="index?p=inscription&g=<?= (isset($_GET['g']))?$_GET['g']:'accueil'; ?>">inscription</a>
            </form>
        </div>

        <?php
    }

}
