<?php
if (basename(__FILE__) == basename($_SERVER["SCRIPT_FILENAME"])) {
    header('Location: ../index?p=404');
    exit();
} else {

    function input_text($type,$id, $placeholder, $name, $label) {
        ?>
        <div class="form-label-group">
            <input type="<?= $type ?>" id="<?= $id ?>" class="form-control" placeholder="<?= $placeholder ?>" name='<?= $name ?>' required autofocus>
            <label for="<?= $id ?>"><?= $label ?></label>
        </div>
        <?php
    }

}


