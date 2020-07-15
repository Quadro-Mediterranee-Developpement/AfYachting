<?php
if (basename(__FILE__) == basename($_SERVER["SCRIPT_FILENAME"])) {
    header('Location: ../index?p=404');
    exit();
} else {
    //TEXT
    // un peu partout
    function iframe($src,$otherclass='',$openNewTab = false) {
        ?>
        <div>
            <iframe src="<?php echo $src ?>" class="concated <?php echo $otherclass ?>" frameborder="0" style="border:0; " allowfullscreen="TRUE" aria-hidden="false" tabindex="0"></iframe>
            <?php if($openNewTab) { ?><a href="<?php echo $src ?>" target="_blank">Ouvrir le calendrier dans un nouvel onglet</a><?php } ?>
        </div>
        <?php
    }

}