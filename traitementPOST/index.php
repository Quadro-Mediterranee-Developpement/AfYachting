<?php
session_start();


if (isset($_GET["p"])) {
    require_once '../BDDMANAGER/loaderBDD.php';
    $p = filter_input(INPUT_GET, "p");

    $page = $p . ".php";
    if (is_file($page)) {
        require $page;
    } else {
        header("Location: ../index.php?p=404");
    }
} else {
    header("Location: ../index.php?p=404");
}