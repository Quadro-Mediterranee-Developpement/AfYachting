<?php
if (basename(__FILE__) == basename($_SERVER["SCRIPT_FILENAME"])) {
    header('Location: ../index?p=404');
    exit();
} else {

    function inscription_form() {
        ?>
        <div style="width: 100%;">
            <h5 class="card-title text-center">Inscription</h5>
            <form class="form-signin">
                <div class="form-label-group">
                    <input type="text" id="inputUserame" class="form-control" placeholder="Nom" required autofocus>
                    <label for="inputUserame">Nom</label>
                </div>

                <div class="form-label-group">
                    <input type="email" id="inputEmail" class="form-control" placeholder="Adresse Email" required>
                    <label for="inputEmail">Adresse Email</label>
                </div>

                <div class="form-label-group">
                    <input type="password" id="inputPassword" class="form-control" placeholder="Mot de passe" required>
                    <label for="inputPassword">Mot de passe</label>
                </div>

                <div class="form-label-group">
                    <input type="password" id="inputConfirmPassword" class="form-control" placeholder="Confirmer mot de passe" required>
                    <label for="inputConfirmPassword">Confirmer mot de passe</label>
                </div>

                <button class="btn btn-lg btn-primary btn-block text-uppercase" type="submit">Inscription</button>
                <a class="d-block text-center mt-2 small" href="index?p=connexion">Connexion</a>
            </form>
        </div>

        <?php
    }

}

