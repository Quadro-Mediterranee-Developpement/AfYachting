<?php
session_start();
if(!isset($_SESSION['ID']))
{
    header('Location: 404calendar.php');
    exit;
}
if($_SESSION['ID']['ROLE'] != 'admin')
{
    header('Location: 404calendar.php');
    exit;
}

if (!isset($_GET['id']) || $_GET['id'] == null) {
    require '404.php';
} else {
    require './src/initialisation.php';
    require './src/Calendar/Events.php';
    require './src/Calendar/Month.php';

    $bdd = get_pdo();
    $events = new Calendar\Events($bdd);

    $event = $events->find(intval($_GET['id']));

    if ($event == null) {
        echo 'L evenement nexiste pas';
    } else {
        dd($event);
        $ename = $event['name'];
        $estart = $event['start'];
        $eend = $event['end'];
        $edesc = $event['description'];
        ?> 
        <html>
            <?php require './views/header.php'; ?>
            <body>
                <h1><?= $ename ?></h1>
                <ul>
                    <li>Date : <?= (new \DateTime($estart))->format('d/m/Y'); ?></li>
                    <li>Heure de démarage : <?= (new \DateTime($estart))->format('H:i'); ?></li>
                    <li>Heure de fin : <?= (new \DateTime($eend))->format('H:i'); ?></li>
                    <li>Description :<br>
                        <?= h($edesc); ?>
                    </li>
                </ul>
            </body>
        </html>
        <?php
    }
}