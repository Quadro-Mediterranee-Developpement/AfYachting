<div  >
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
    <link rel="stylesheet" href="calendar.css"/>
    <?php
    $impossibleListe = ["2020-06-09" => 1, "2020-06-10" => 2];
    require 'Month.php';
    $mois = null;
    $annee = null;
    for ($id = 0; $id < 12; $id++):
        $month = new Month($mois, $annee);
        $starts = $month->getStartingDay();
        $start = $starts->format('N') === '1' ? $starts : $month->getStartingDay()->modify('last monday');
        $weeks = $month->getWeeks();
        $end = (clone $start)->modify('+' . (6 + 7 * ($weeks - 1)) . 'days');
        ?>
        <div id="<?= $id ?>" style="display:<?= ($id == 0) ? 'block' : 'none'; ?>" class="taille-max taille-min">
            <h4><a href="#" class="btn btn-primary" onclick="return prevMonth()">&lt;</a><a href="#" class="btn btn-primary btndate" onclick="return todayMonth()"><?= $month->toString(); ?></a><a href="#" class="btn btn-primary" onclick="return nextMonth()">&gt;</a></h4>
            <table class="calendar__table calendar__table--<?= $month->getWeeks(); ?>weeks">
                <?php for ($i = 0; $i < $weeks; $i++): ?>
                    <tr>
                        <?php
                        foreach ($month->days as $k => $day):
                            $date = (clone $start)->modify("+" . ($k + $i * 7) . " days");
                            $isToday = \date('Y-m-d') === $date->format('Y-m-d');
                            if($month->withinMonth($date) && $date >= new DateTime()):
                            ?>
                            <td>
                                <?php if ($i === 0): ?>
                                    <div class="calendar__weekday"><?= $day; ?></div> 
                                <?php endif; ?>
                                <input <?php            
     
                                if(isset($impossibleListe[$date->format('Y-m-d')])) {
                                    if($impossibleListe[$date->format('Y-m-d')] == 1)
                                    {
                                        echo "class='half-day'";
                                    }
                                    else if ($impossibleListe[$date->format('Y-m-d')] == 2) {
                                        echo "class='half-day'";
                                    } else {
                                        echo 'disabled';
                                    }
                                }
                                ?> 
                                    type="radio" name="date" value="<?= $date->format('Y-m-d'); ?>" id="<?= $date->format('Y-m-d'); ?>"><label class="calendar__day" for="<?= $date->format('Y-m-d'); ?>"><?= $date->format('d'); ?></label>        
                            </td>
                        <?php 
                        elseif($i === 0):?>
                            <td>
                              
                                    <div class="calendar__weekday"><?= $day; ?></div> 
                                
            </td><?php
                        else:
                            ?>
                            <td class="calendar__othermonth"></td>
                            
                            
                            <?php
                          endif;   endforeach ?>
                    </tr>
                <?php endfor; ?>
            </table>
        </div>
        <?php
        $mois = $month->nextMonth()->month;
        $annee = $month->nextMonth()->year;
    endfor;
    ?>
</div>
<script type="text/javascript">
    id = 0;
    function nextMonth()
    {
        if (id < 11)
        {
            window.document.getElementById(id).style.display = 'none';
            id++;
            window.document.getElementById(id).style.display = 'block';
        }
        return false;
    }
    function prevMonth()
    {
        if (id > 0)
        {
            window.document.getElementById(id).style.display = 'none';
            id--;
            window.document.getElementById(id).style.display = 'block';
        }
        return false;
    }
    function todayMonth()
    {
        window.document.getElementById(id).style.display = 'none';
        id = 0;
        window.document.getElementById(id).style.display = 'block';

        return false;
    }
</script>
