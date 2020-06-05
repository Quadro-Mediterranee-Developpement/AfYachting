<?php
if (basename(__FILE__) == basename($_SERVER["SCRIPT_FILENAME"])) {
    header('Location: ../index?p=404');
    exit();
} else {

    function bateau_form() {
        ?>
        <div class="formBox mt-4">
            <form class="form" action="index.php?p=bateau" method="get">
                <?php creatListDeroulante($nombre = [], 'nombre', 'Nombre de personne maximum'); ?>
                <?php creatListDeroulante($categorie = [], 'categorie', 'Recherche par catégorie'); ?>
                <?php creatListDeroulante($marque = [], 'marque', 'Recherche par marques'); ?>
                <div class="form-group">
                    <label for="date" class="text-center label">Recherche par date</label>
                    <input type="date" id="date" name="date" value="<?= date('Y-m-d'); ?>" min="<?= date('Y-m-d'); ?>" max="<?= date('Y-m-d',strtotime('+1 year')); ?>" class="form-control input">
                </div>
                <div class="form-group">
                    <label for="prix" class="text-center label">Recherche par prix</label>
                    <input type="number" class="form-control input" id="prix" name="prix" min="1" max="9999999" placeholder="Entrez un prix minimum">
                </div>
                <button type="submit" class="btn btn-primary button">afficher les résultats</button>
            </form>
        </div>
        <?php
    }

}

function creatListDeroulante($tbl, $id, $title) {
    ?>
    <div class = "form-group">
        <label for = "<?= $id ?>" class = "text-center label"><?= $title ?></label>
        <select class = "form-control input" name="<?= $id ?>" id = "<?= $id ?>">
            <option value='null'>vide</option>
            <?php
            foreach ($tbl as $i) {
                echo "<option value='$i'>$i</option>";
            }
            ?>
        </select>
    </div>
    <?php
}
