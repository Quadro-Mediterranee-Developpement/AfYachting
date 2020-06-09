<?php
if (basename(__FILE__) == basename($_SERVER["SCRIPT_FILENAME"])) {
    header('Location: ../index?p=404');
    exit();
} else {

    function identityCard($name, $email, $phone, $creation) {
        ?>
        <fieldset>
            <legend><?= $name ?></legend>

            <p><strong>email:</strong><?= $email ?></p>
            <p><strong>téléphone:</strong><?= $phone ?></p>
            <p><strong>date de création</strong><?= $creation ?></p>

        </fieldset>
        <?php
    }

}