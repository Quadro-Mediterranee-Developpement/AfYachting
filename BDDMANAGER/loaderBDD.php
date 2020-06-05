<?php

class loaderBDD {
    protected static function connexionBDD()
    {
        $bdd = new PDO('mysql:host=localhost;dbname=afyachting', 'root', '');
        return $bdd;
    }
}

require_once "compteMANAGER.php";
require_once "evenementMANAGER.php";
require_once "bateauMANAGER.php";