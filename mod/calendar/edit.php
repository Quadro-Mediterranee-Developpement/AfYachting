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

require './src/initialisation.php';
require './src/Calendar/Events.php';
require './src/Calendar/Month.php';
require './src/Calendar/Event.php';
require './src/Calendar/EventValidator.php';


if (!isset($_GET['id']) || $_GET['id'] == null) {
    require '404calendar.php';
    exit();
} else {
    $bdd = get_pdo();
    $events = new Calendar\Events($bdd);
    $errors = [];
    $event = $events->find(intval($_GET['id']));
}

if ($event == null) {
    echo 'L evenement nexiste pas';
} else {

    $ename = $event->getName();
    $estart = $event->getStart();
    $eend = $event->getEnd();
    $edesc = $event->getDescription();
    $eidAdmin = $event->getIdAdmin();
    $eidSkipper = $event->getIdSkipper();
    $eidClient = $event->getIdClient();
    $eidboat = $event->getIdBoat();
    $eprix = $event->getPrix();
    $eidClientTemp = $event->getIdClientTemp();
    $eoption = $event->getOption();
    
    
    $data = [
        'name' => $ename,
        'date' => $estart->format('Y-m-d'),
        'start' => $estart->format('H:i'),
        'end' => $eend->format('H:i'),
        'description' => $edesc,
        'idAdmin' => $eidAdmin,
        'idSkipper' => $eidSkipper,
        'idClient' => $eidClient,
        'idBoat' => $eidboat,
        'prix' => $eprix,
        'idClientTemp' => $eidClientTemp,
        'option' => $eoption
    ];

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $data = $_POST;
        if ($data["mode"] === "modif") {
            $validator = new \Calendar\EventValidator();
            $errors = $validator->validatemin($data);
            if (!empty($errors)) {
                dd($errors);
            } else {
                $events->hydrate($event, $data);
                $events->update($event);
                header('Location: ./index?success=1');
                exit();
            }
        } else if ($data["mode"] === "suppr") {
            $events->suppr($event);
            header('Location: ./index?success=1');
            exit();
        }
    }
    ?> 
    <html>
        <head>
            <meta charset="UTF-8">
            <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
            <link rel="stylesheet" href="./src/css/calendar.css"/>
            <link rel="stylesheet" href="./src/css/add.css"/>
            <title><?= (isset($event)) ? $event->getName() : 'Mon calendrier'; ?></title>
        </head>
        <body>
            <div class="container">
                <h1>Editer l'évènement [<?= $ename ?>]</h1>
                <form action="" method="post" class="form">
                    <?php require './views/form.php'; ?>
                    <div clas="form-group">
                        <button class="btn btn-primary" name="mode" value="modif">Modifier l'évènement</button>
                        <button class="btn btn-danger float-right" name="mode" value="suppr">Supprimer</button>
                    </div>
                </form>
            </div>
        </body>
    </html>
    <?php
}

   
