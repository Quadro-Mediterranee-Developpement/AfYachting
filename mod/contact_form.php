<?php
if (basename(__FILE__) == basename($_SERVER["SCRIPT_FILENAME"])) {
    header('Location: ../index?p=404');
    exit();
} else {
    //TEXT
    // un peu partout
    function contact_form() {
        ?>

        <div style="width: 100%;">
            <h5 class="card-title text-center">Nous contacter</h5>
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
                    <input type="tel" id="inputPhone" class="form-control" placeholder="Numéro de téléphone" required>
                    <label for="inputPhone">Numéro de téléphone</label>
                </div>

                <div class="form-label-group">
                    <input name = "sujet" type = "text" placeholder="Sujet" class="form-control" id='sujet'>
                    <label class="control-label" for='sujet'>Objet</label>
                </div>

                <div class="form-label-group">
                    <textarea name="message"  placeholder="Votre message" class="form-control"></textarea>
                </div>

                <button class="btn btn-lg btn-primary btn-block text-uppercase" type="submit">Envoyer</button>
            </form>
        </div>

        <?php
    }

}
