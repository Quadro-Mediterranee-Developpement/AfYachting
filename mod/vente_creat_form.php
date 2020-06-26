<?php
if (basename(__FILE__) == basename($_SERVER["SCRIPT_FILENAME"])) {
    header('Location: ../index?p=404');
    exit();
} else {
    require_once 'type_form.php';
    //TEXT
    // un peu partout
    function vente_creat_form() {
        ?>
        <h5 class="card-title text-center">Ajouter un skippeur</h5>
        <form method='POST' action='index.php' class="form-signin">


            <div class="form-label-group">
                <input type="number" id="age" class="form-control" placeholder="Année d'acquisition" name='age' required>
                <label for="age">Année d'acquisition</label>
            </div>

            <div class="form-label-group">
                <select class="form-control input" id="etat" name='etat'>
                    <option>Occasion</option>
                    <option>Neuf</option>
                </select>
                <label for="etat">Description du bateau</label>
            </div>

            <div class="form-label-group">
                <input type="text" id="categorie" class="form-control" placeholder="Catégorie" name='categorie' required>
                <label for="categorie">Catégorie</label>
            </div>


            <div class="form-label-group">
                <input type="number" id="longueur" class="form-control" placeholder="Longueur du bateau" name='longueur' required>
                <label for="longueur">Longueur du bateau</label>
            </div>

            <div class="form-label-group">
                <input type="number" id="prix" class="form-control" placeholder="prix" name='prix' required>
                <label for="prix">Prix du bateau</label>
            </div>

            <div class="form-label-group">
                <input type="text" id="modele" class="form-control" placeholder="Modèle du bateau" name='modele' required>
                <label for="modele">Modèle du bateau</label>
            </div>


            <button class="btn btn-lg btn-primary btn-block text-uppercase" type="submit" name='submit'>Enregistrer</button>
            <hr class="my-4">

        </form>
        <?php
    }

}