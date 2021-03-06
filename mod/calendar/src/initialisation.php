<?php

require './vendor/autoload.php';

function dd(...$vars) {
    foreach ($vars as $var) {
        echo '<pre>';
        print_r($var);
        echo '</pre>';
    }
}

function get_pdo(): \PDO {
    try {
        $bdd = new \PDO('mysql:host=localhost:3308;dbname=afyachtingV2', 'root', '');
    } catch (\Exception $ex) {
        $bdd = new \PDO('mysql:host=localhost;dbname=afyachtingV2', 'root', '');
    }
    return $bdd;
}

/**
 * Fonction de sécurité
 * @param string $value
 * @return string
 */
function h(?string $value): string {
    if ($value === null) {
        return'';
    }
    return htmlentities($value);
}
