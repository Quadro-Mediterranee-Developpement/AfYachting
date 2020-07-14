<?php
if (basename(__FILE__) == basename($_SERVER["SCRIPT_FILENAME"])) {
    header('Location: ../index?p=404');
    exit();
} else {
    //TEXT
    // un peu partout
    function identityCardBoat($info) {
        ?>
        <fieldset>
            <legend><?= $info['Nom'] ?></legend>
            <h6>Partie information</h6>
            <p><strong>modele:</strong><?= $info['Modele'] ?></p>
            <p><strong>description:</strong><?= $info['Description'] ?></p>
            <p><strong>nombre de passager maximum:</strong><?= $info['Passagers'] ?></p>
            <p><strong>moteur:</strong><?= $info['Moteur'] ?></p>
            <p><strong>longueur:</strong><?= $info['Longueur'] ?></p>
            <p><strong>equipement:</strong><?= $info['Equipement'] ?></p>
            <p><strong>divers:</strong><?= $info['Divers'] ?></p>
            <p><strong>images:</strong></p>
            <div class="cubeForm">
                <?php
                require_once 'carousel.php';
                $images = bateauMANAGER::image($info['ID_images']);
                carousel($images);
                ?>
            </div>
            <p><strong>option:</strong></p>
            <div class="cubeForm">
                <?php
                require_once 'carousel.php';
                $option = bateauMANAGER::recupOPTION($info['Option']);
                foreach ($option as $i)
                {
                    ?>
               
                    <p><strong>Nom:</strong><?= $i['name'] ?></p>
                    <p><strong>description:</strong><?= $i['description'] ?></p>
                    <p><strong>prix:</strong><?= $i['prix'] ?></p>
                    <?php
                }
                ?>
            </div>
            <h6>Partie location</h6>
            <p><strong>haute saison:</strong><?= $info['HS'] ?></p>
   
            <p><strong>reste de la saison:</strong><?= $info['MS'] ?></p>
            <p><strong>caution:</strong><?= $info['Caution'] ?></p>

            <h6>Partie vente</h6>
            <p><strong>age:</strong><?= $info['Age'] ?></p>
            <p><strong>state:</strong><?= $info['State'] ?></p>
            <p><strong>lageur:</strong><?= $info['Largeur'] ?></p>
            <p><strong>prix:</strong><?= $info['Prix'] ?></p>
        </fieldset>
        <?php
    }

}