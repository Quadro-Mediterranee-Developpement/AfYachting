<?php

class loaderBDD {
    protected static function connexionBDD()
    {
        try
        {
            $bdd = new PDO('mysql:host=localhost;dbname=afyachtingV2', 'root', '');
        }
        catch (Exception $e)
        {
            $bdd = new PDO('mysql:host=localhost:3308;dbname=afyachtingV2', 'root', '');
        }
        $bdd->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
        return $bdd;
    }
}

require_once "compteMANAGER.php";
require_once "evenementMANAGER.php";
require_once "bateauMANAGER.php";