<?php
if (basename(__FILE__) == basename($_SERVER["SCRIPT_FILENAME"])) {
    header('Location: ../index?p=404');
    exit();
} else {

    function vente_form($cible, $categorie, $marque, $bateau) {
        ?>

        <div class=" container-fluid d-flex justify-content-between mt-5 color infoContainer ">
            <div class="row boxSize">
                <div>

                    <?php
                    foreach ($bateau as $i) {
                        ?>
                        <img src="img/<?php echo $i[0]; ?>" alt="img/<?php echo $i[1]; ?>" class="img-fluid pictSizeVente"/>

                        <?php
                    }
                    ?>

                </div>

            </div>
            <div class="formBox mt-4">
                <form class="form" action="<?php echo $cible; ?>" method="get">
                    <div class="form-group">
                        <label for="categorie" class="text-center label">Recherche par catégories</label>
                        <select class="form-control input" id="typeModele">
                            <?php
                            foreach ($categorie as $i) {
                                echo "<option>$i</option>";
                            }
                            ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="marque" class="text-center label">Recherche par marques</label>
                        <select class="form-control input" id="typeModele">
                            <?php
                            foreach ($marque as $i) {
                                echo "<option>$i</option>";
                            }
                            ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="prix" class="text-center label">Recherche par prix</label>
                        <input type="number" class="form-control input" id="prix" placeholder="Entrez un prix minimum">
                    </div>

                    <button type="submit" class="btn btn-primary button">afficher les résultats</button>
                </form>
            </div>
        </div>
        <?php
    }

}
