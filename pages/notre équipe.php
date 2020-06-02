<?php
if (basename(__FILE__) == basename($_SERVER["SCRIPT_FILENAME"])) {
    header('Location: ../index?p=404');
    exit();
} else {
$included = ["head","header","equipe_form","footer","foot"];
 
    foreach ($included as $i) {
        require_once "mod/$i.php";
    }

    head($included, "Description de la page contact adaptée au référencement", "Titre de la page contact adaptée au référencement");
    ?>

    <body>

        <?php
        bloc_header(["Accueil","Bateau","Connexion","Contact","Inscription","Location","Ventes"]);

        equipe_form("Vertical timeLine",[["salu toi","dfrgthyt ergdfk tyfugyjyt","20/03/2000"],["salu toi","dfrgthyt ergdfk tyfugyjyt","20/03/2000"],["salu toi","dfrgthyt ergdfk tyfugyjyt","20/03/2000"]]);

        
        foot($included);
        ?>

    </body>

<?php
}
