<?php
if (basename(__FILE__) == basename($_SERVER["SCRIPT_FILENAME"])) {
    header('Location: ../index?p=404');
    exit();
} else {

    function connexion_form() {
        ?>

        <h5 class="card-title text-center">Register</h5>
        <form class="form-signin">
            <div class="form-label-group">
                <input type="text" id="inputUserame" class="form-control" placeholder="Username" required autofocus>
                <label for="inputUserame">Username</label>
            </div>

            <div class="form-label-group">
                <input type="email" id="inputEmail" class="form-control" placeholder="Email address" required>
                <label for="inputEmail">Email address</label>
            </div>

            <div class="form-label-group">
                <input type="password" id="inputPassword" class="form-control" placeholder="Password" required>
                <label for="inputPassword">Password</label>
            </div>

            <div class="form-label-group">
                <input type="password" id="inputConfirmPassword" class="form-control" placeholder="Password" required>
                <label for="inputConfirmPassword">Confirm password</label>
            </div>

            <button class="btn btn-lg btn-primary btn-block text-uppercase" type="submit">Register</button>
            <a class="d-block text-center mt-2 small" href="#">Sign In</a>
        </form>


        <?php
    }

}
