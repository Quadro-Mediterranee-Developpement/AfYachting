<?php

class creationFormType {

    public static function input_text($type, $id, $placeholder, $name, $label) {
        ?>
        <div class="form-label-group">
            <input type="<?= $type ?>" id="<?= $id ?>" class="form-control" placeholder="<?= $placeholder ?>" name='<?= $name ?>' <?= (isset($_GET[$name])) ? 'value="' . $_GET[$name] . '"' : ''; ?> required autofocus>
            <label for="<?= $id ?>"><?= $label ?></label>
        </div>
        <?php
    }

}
