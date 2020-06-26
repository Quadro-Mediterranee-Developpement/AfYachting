<div class="row">
    <div class="col-sm-6">
        <div class="form-group">
            <label for="name">Titre</label>
            <input id="name" type="text" required class="form-control" name="name" value="<?php echo isset($data['name']) ? h($data['name']) : ''; ?>">
            <?php if (isset($errors['name'])): ?>
                <p id="errorform" class="form-control is-invalid"><?= $errors['name']; ?></p>
            <?php endif; ?>
        </div>
    </div>
    <div class="col-sm-6">
        <div class="form-group">
            <label for="date">Date</label>

            <input id="date" type="date"  required class="form-control" name="date" value="<?php echo isset($data['date']) ? h($data['date']) : ''; ?>">
            <?php if (isset($errors['date'])): ?>

                <p id="errorform" class="form-control is-invalid"><?= $errors['date']; ?></p>
            <?php endif; ?>
        </div>
    </div>
</div> 

<div class="row">
    <div class="col-sm-6">
        <div class="form-group">
            <label for="start">Démarrage</label>
            <input id="start" type="time"  required class="form-control" name="start" placeholder="HH:mm" value="<?php echo isset($data['start']) ? h($data['end']) : ''; ?>">
            <?php if (isset($errors['start'])): ?>

                <p id="errorform" class="form-control is-invalid"><?= $errors['start']; ?></p>
            <?php endif; ?>
        </div>
    </div>
    <div class="col-sm-6">
        <div class="form-group">
            <label for="end">Fin</label>

            <input id="end" type="time" required class="form-control" name="end" placeholder="HH:mm" value="<?php echo isset($data['end']) ? h($data['end']) : ''; ?>">
            <?php if (isset($errors['end'])): ?>

                <p id="errorform" class="form-control is-invalid"><?= $errors['end']; ?></p>
            <?php endif; ?>
        </div>
    </div>


</div> 
<div class="form-group">
    <label for="description">Description</label>
    <textarea name="description" id="description" class="form-control" ><?php echo isset($data['description']) ? h($data['description']) : ''; ?></textarea>
</div>
<div class="row">
    <?php
    $acount = new Calendar\Events(get_pdo());
    foreach (['Admin' => ['idAdmin', 'admin'], 'Client' => ['idClient', 'client'], 'Skipper' => ['idSkipper', 'skipper'], 'ClientTemp' => ['idClientTemp', 'client_ponctuel']] as $k => $y) {
        ?>
        <div class="col-sm-6">
            <div class="form-group">
                <label for="<?= $y[0]; ?>"><?= $k; ?></label>
                <select class="form-control" name="<?= $y[0]; ?>" id="idAdmin">
                    <option value="">rien</option>
                    <?php
                    foreach ($acount->findCompte($y[1]) as $i) {
                        $yo = ($i['id'] == $data[$y[0]]) ? 'selected' : '';
                        echo "<option value='" . $i['id'] . "' $yo>" . $i['name'] . "</option>";
                    }
                    ?>
                </select>
            </div>
        </div>
<?php } ?>
    <div class="col-sm-6">
        <div class="form-group">
            <label for="idBoat">Boat</label>
            <select class="form-control" name="idBoat" id="idBoat">
                <option value="">rien</option>
                <?php
                foreach ($acount->findBoat() as $i) {
                    $yo = ($i['id'] == $data['idBoat']) ? 'selected' : '';
                    echo "<option value='" . $i['id'] . "' $yo>" . $i['name'] . "</option>";
                }
                ?>
            </select>
        </div>
    </div>
    <div class="col-sm-6">
        <div class="form-group">
            <label for="prix">prix</label>
            <input value="<?php echo isset($data['prix']) ? h($data['prix']) : ''; ?>" id="prix" type="number" class="form-control" name="prix">
        </div>
    </div>
</div>