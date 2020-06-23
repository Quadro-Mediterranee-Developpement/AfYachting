
<?php
session_start();
if (!isset($_SESSION['ID'])) {
    header('Location: 404calendar.php');
    exit;
}
$modif = false;
switch ($_SESSION['ID']['ROLE']) {
    case 'admin':
        $modif = true;
    case 'skipper':
    case 'client':
        $mode = $_SESSION['ID'];

        break;
    default:

        header('Location: 404calendar.php');
        exit;
        break;
}

require './src/initialisation.php';
require './src/Calendar/Events.php';
require './src/Calendar/Month.php';



try {
    $month = new Calendar\Month(intval($_GET['month'] ?? null) ?? null, intval($_GET['year'] ?? null) ?? null);
} catch (\Exception $e) {
    $month = new Calendar\Month(null, null);
}


$bdd = get_pdo();
$eventss = new Calendar\Events($bdd);
$starts = $month->getStartingDay();
$start = $starts->format('N') === '1' ? $starts : $month->getStartingDay()->modify('last monday');
$weeks = $month->getWeeks();
$end = (clone $start)->modify('+' . (6 + 7 * ($weeks - 1)) . 'days');
$events = [];
if ($modif == true) {
    $events = $eventss->getEventsBetweenByDay($start, $end);
} else {
    $events = $eventss->getEventsBetweenByDayAndID($start, $end, $mode);
}
?>

<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
        <link rel="stylesheet" href="./src/css/calendar.css"/>
        <link rel="stylesheet" href="./src/css/add.css"/>

        <title><?= (isset($event)) ? $event->getName() : 'Mon calendrier'; ?></title>
    </head>
    <body>

        <?php if (isset($_GET['day'])): ?>
        <div class="">
                <?php
                $date = new \DateTime();
                $date->setDate($month->getYear(), $month->getMonth(), $_GET['day']);
                $eventsForDay = $events[$date->format('Y-m-d')] ?? [];
                ?>
                <nav class="navbar   nb-3">
                    <div class="calendar__weekday"><?= $month->days[$date->format('N') - 1]; ?> <?= $date->format('d'); ?> <?= $month->toString(); ?></div> 
                    <div>
                        <?php if ($modif == true): ?><a href="add.php?date=<?= $date->format('Y-m-d'); ?>" class="btn btn-primary">Ajouter un evenement</a><?php endif; ?>
                        <a href="./index.php?month=<?= $date->format('m'); ?>&year=<?= $date->format('Y'); ?>&day=<?= $date->format('d') - 1; ?>" class="btn btn-primary">&lt;</a>
                        <a href="./index.php?month=<?= $date->format('m'); ?>&year=<?= $date->format('Y'); ?>&day=<?= $date->format('d') + 1; ?>" class="btn btn-primary">&gt;</a>
                        <a href="./index.php?month=<?= $date->format('m'); ?>&year=<?= $date->format('Y'); ?>" class="btn btn-primary">retour</a>
                    </div>
                </nav>
                <span class="block_note">
                    <?php foreach ($eventsForDay as $event): ?>
                        <fieldset class="scheduler-border">
                            <legend><?= (new \DateTime($event['start']))->format('H:i') ?> - <?= (new \DateTime($event['end']))->format('H:i') ?></legend> 

                            <a <?php if ($modif == true): ?>href="./edit.php?id=<?= $event['id']; ?>"<?php endif; ?>><h4><?= $event['name']; ?></h4></a>
                            <p>
                                <?= $event['description'] ?>
                                <?php
                                foreach (["Admin" => ["admin", "idAdmin"], "Client" => ["client", "idClient"], "Skipper" => ["skipper", "idSkipper"], "Client ponctuel" => ["client_ponctuel", "idClientTemp"]] as $k => $i) {
                                    $name = $eventss->findOneCompte($event[$i[1]], $i[0]);
                                    echo "<div><strong>$k:</strong>$name</div>";
                                }
                                $name = $eventss->findOneBoat($event['idBoat']);
                                echo "<div><strong>Bateau:</strong>$name</div>";
                                echo "<div><strong>Prix:</strong>" . $event['prix'] . "</div>";
                                $option = $eventss->findOption($event['option']);
                                foreach ($option as $i) {
                                    echo "<div><strong>Nom de l'option:</strong>" . $i['name'] . "</div>";
                                    echo "<div><strong>Description de l'option:</strong>" . $i['description'] . "</div>";
                                    echo "<div><strong>Prix de l'option:</strong>" . $i['prix'] . "</div>";
                                }
                                ?>

                            </p>
                        </fieldset>
                    <?php endforeach; ?>
                </span>

            </div>

        <?php else: ?>

            <div class="container">
                <?php if (isset($_GET['success'])): ?>
                    <div class="alert alert-success">
                        L'évènement a bien été enregistré
                    </div>
                <?php endif; ?>
            </div>
            <nav class="navbar   nb-3">
                <h1><?= $month->toString(); ?></h1>

                <div class="calendar">  



                    <div>
                        <a href="./index.php?month=<?= $month->previousMonth()->month; ?>&year=<?= $month->previousMonth()->year; ?>" class="btn btn-primary">&lt;</a>
                        <a href="" class="btn btn-primary">mois</a>
                        <a href="./index.php?month=<?= $month->nextMonth()->month; ?>&year=<?= $month->nextMonth()->year; ?>" class="btn btn-primary">&gt;</a>

                        <a href="./index.php?month=<?= $month->month; ?>&year=<?= $month->year - 1; ?>" class="btn btn-primary">&lt;</a>
                        <a href="" class="btn btn-primary">années</a>
                        <a href="./index.php?month=<?= $month->month; ?>&year=<?= $month->year + 1; ?>" class="btn btn-primary">&gt;</a>
                    </div>
                </div>
            </nav>
            <div class="d-flex flex-row align-items-center justify-content-between mx-sm-5">
                <table class="calendar__table calendar__table--<?= $month->getWeeks(); ?>weeks">

                    <?php for ($i = 0; $i < $weeks; $i++): ?>
                        <tr>
                            <?php
                            foreach ($month->days as $k => $day):
                                $date = (clone $start)->modify("+" . ($k + $i * 7) . " days");
                                $eventsForDay = $events[$date->format('Y-m-d')] ?? [];
                                $isToday = \date('Y-m-d') === $date->format('Y-m-d');
                                ?>


                                <td class="<?= $month->withinMonth($date) ? '' : "calendar__othermonth"; ?> <?= $eventsForDay ? 'is-event' : ''; ?> <?= $isToday ? 'is-today' : ''; ?>">
                                    <?php if ($i === 0): ?>
                                        <div class="calendar__weekday"><?= $day; ?></div> 
                                    <?php endif; ?>
                                    <a <?php if ($modif == true): ?> href="add.php?date=<?= $date->format('Y-m-d'); ?>"<?php endif; ?> class="calendar__day"><?= $date->format('d'); ?></a>
                                    <?php
                                    $nbr = 0;
                                    foreach ($eventsForDay as $event):
                                        ?>
                                        <div class="calendar__event">
                                            <?= (new \DateTime($event['start']))->format('H:i') ?> - <?= (new \DateTime($event['end']))->format('H:i') ?>  
                                            <a <?php if ($modif == true): ?>href="./edit.php?id=<?= $event['id']; ?>"<?php endif; ?>><?= $event['name']; ?></a>
                                        </div>
                                        <?php
                                        $nbr++;
                                        if ($nbr > 1):
                                            break;
                                        endif;
                                    endforeach;
                                    ?>
                                    <?php if ($nbr > 0): ?>
                                        <a href="./index.php?month=<?= $month->month; ?>&year=<?= $month->year; ?>&day=<?= $date->format('d'); ?>" class="calendar_day_more">voir plus</a>
                                    <?php endif; ?>
                                </td>
                            <?php endforeach ?>
                        </tr>
                    <?php endfor; ?>
                </table>
                <?php if ($modif == true): ?><a href="./add.php" class="calendar__button">+</a><?php endif; ?>
            <?php endif; ?>
        </div> 
    </body>
</html>
