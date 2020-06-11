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

require'./src/initialisation.php';
require'./src/Calendar/Events.php';
require'./src/Calendar/EventValidator.php';
require'./src/Calendar/Event.php';

$data = [
    'date' => $_GET['date'] ?? \date('Y-m-d'),
    'start' => \date('H:i'),
    'end' => \date('H:i')
];

$validator = new \Calendar\EventValidator($data);
if (!$validator->validatemin(array('date' => 'date'))) {
    $data['date'] = \date('Y-m-d');
}

$errors = [];
$event = new \Calendar\Event();
$event->setName("Ajouter un evenement");
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = $_POST;
    $event->setName($data['name']);
    $validator = new Calendar\EventValidator();
    $errors = $validator->validatemin($data);
    if (!empty($errors)) {
        dd($errors);
    } else {
        $events = new \Calendar\Events(get_pdo());
        $event = $events->hydrate(new \Calendar\Event(), $data);
        $events->create($event);
        header('Location: ./index?success=1');
        exit();
    }
}
?>
<html>
    <body>
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
        <link rel="stylesheet" href="./src/css/calendar.css"/>
        <link rel="stylesheet" href="./src/css/add.css"/>

        <title><?= (isset($event)) ? $event->getName() : 'Mon calendrier'; ?></title>
    </head>

    <div class="container">
        <?php if (!empty($errors)): ?>
            <div class="alert alert-danger">
                Merci de corriger les erreurs dans le formulaire
            </div>
        <?php endif; ?>
        <h1>Ajouter un évènement</h1>
        <form action="" method="post" class="form">
            <?php require './views/form.php'; ?>
            <div clas="form-group">
                <button class="btn btn-primary">Ajouter l'évènement</button>
            </div>
        </form>
    </div>
    <a  id="retour" class="calendar__button" onclick="history.back()">x</a>
</body>
</html>


