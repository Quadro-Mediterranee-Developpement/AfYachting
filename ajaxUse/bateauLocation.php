<?php

session_start();
require_once '../BDDMANAGER/loaderBDD.php';
require_once '../utilityPhp/verificationType.php';

$tbl = [$_POST['type'], $_POST['ID'], $_POST['dure'], $_POST['date'], $_POST['skypper'], $_POST['option']];
if (verificationType::isseter($tbl)) {
    if (verificationType::emptyer($tbl)) {
        if ($_POST['type'] == 'boatLoc') {
            echo "http";
        } else {
            echo "pb";
        }
    } else {
        echo "pb";
    }
} else {
    echo "pb";
}