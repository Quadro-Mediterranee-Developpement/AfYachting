<?php
if (basename(__FILE__) == basename($_SERVER["SCRIPT_FILENAME"])) {
    header('Location: ../index?p=404');
    exit();
} else {

    function connexion_form() {
        ?>
        <div style="width: 100%;">
            <h5 class="card-title text-center">Connexion</h5>
            <form class="form-signin">

                <div class="form-label-group">
                    <input type="text" id="inputNameEmail" class="form-control" placeholder="Nom ou adresse Email" required>
                    <label for="inputNameEmail">Nom ou adresse Email</label>
                </div>

                <div class="form-label-group">
                    <input type="password" id="inputPassword" class="form-control" placeholder="Mot de passe" required>
                    <label for="inputPassword">Mot de passe</label>
                </div>

                <button class="btn btn-lg btn-primary btn-block text-uppercase" type="submit">Se connecter</button>
                <a class="d-block text-center mt-2 small" href="index?p=inscription">inscription</a>
            </form>
        </div>

        <?php
    }

}
