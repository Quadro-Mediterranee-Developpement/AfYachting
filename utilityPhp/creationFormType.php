<?php

class creationFormType {

    public static function input_text($type, $id, $placeholder, $name, $label, $require = true, $value = '') {
        //https://developer.mozilla.org/fr/docs/Web/HTML/Element/Input
        ?>
        <div class="form-label-group">
            <input maxlength="32" minlength="1" type="<?= $type ?>" id="<?= $id ?>" class="form-control" placeholder="<?= $placeholder ?>" name='<?= $name ?>' <?= (isset($_GET[$name])) ? 'value="' . $_GET[$name] . '"' : 'value="' . $value . '"'; ?> <?= ($require) ? 'require' : ''; ?> autofocus>
            <label for="<?= $id ?>"><?= $label ?></label>
        </div>
        <?php
    }

    public static function input_select($id, $name, $tbl, $label, $require = true) {
        ?>
        <div class="form-label-group">
            <select name="<?= $name ?>" id="<?= $id ?>" <?= ($require) ? 'require' : ''; ?> autofocus>
                <?php foreach ($tbl as $k => $i): ?>
                    <option value="<?= $k ?>"><?= $i ?></option>
                <?php endforeach; ?>
            </select>
            <label for="<?= $id ?>"><?= $label ?></label>
        </div>
        <?php
    }

}
