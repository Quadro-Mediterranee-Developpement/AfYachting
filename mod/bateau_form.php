<?php
if (basename(__FILE__) == basename($_SERVER["SCRIPT_FILENAME"])) {
    header('Location: ../index?p=404');
    exit();
} else {

    function bateau_form() {
        ?>
        <div class="formBox mt-4">
            <form class="form" action="traitementPOST/index.php?p=bateauLocation" method="POST">
                <div class="form-group">
                    <label for="date" class="text-center label">date</label>
                    <input type="date" id="date" name="date" value="<?= date('Y-m-d'); ?>" min="<?= date('Y-m-d'); ?>" max="<?= date('Y-m-d', strtotime('+1 year')); ?>" class="form-control input" required>
                </div>
                <div class="form-group">
                    <label for="heureD" class="text-center label">heure debut</label>
                    <input type="time" min="08:00" max="20:00" id="heureD" name="heureD" value="<?= date('Y-m-d'); ?>" min="<?= date('Y-m-d'); ?>" max="<?= date('Y-m-d', strtotime('+1 year')); ?>" class="form-control input" required>
                </div>
                <div class="form-group">
                    <label for="heureF" class="text-center label">heure fin</label>
                    <input type="time" min="08:00" max="20:00" id="heureF" name="heureF" value="<?= date('Y-m-d'); ?>" min="<?= date('Y-m-d'); ?>" max="<?= date('Y-m-d', strtotime('+1 year')); ?>" class="form-control input" required>
                </div>
                <div class="form-group">
                    <input type="checkbox" id="skipper" name="skipper" checked>
                    <label for="skipper">skipper</label>
                </div>
                <button type="submit" class="btn btn-primary button" name="calcul" value="<?= (isset($_GET["batID"]))?$_GET["batID"]:"-1"; ?>">Calculer le prix</button>
                <?php if(isset($_GET['price'])): ?>
                <div class="form-group">
                    <label for="prix" class="text-center label">prix</label>
                    <input type="text"  id="prix" name="prix" value="<?= $_GET['price'] ?>€" class="form-control input" disabled="disabled">
                </div>
                <button type="submit" class="btn btn-primary button" name="payer" >Payer</button>
                <?php endif; ?>
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
