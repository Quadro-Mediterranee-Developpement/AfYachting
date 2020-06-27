<?php
if (basename(__FILE__) == basename($_SERVER["SCRIPT_FILENAME"])) {
    header('Location: ../index?p=404');
    exit();
} else {
    require_once 'utilityPhp/creationFormType.php';

    //TEXT
    // un peu partout
    function bateau_form($id, $mode = false) {
        
        $date = evenementMANAGER::recupAllHoraireByBateau($id);
        //$esdate = evenementMANAGER::giveRefDate($date);
        $options = bateauMANAGER::recupOPTION($id);
        
        
        ?>
        <div>
            <div id="setLocation" class="formBox mt-4">
                <p class="commentaire">
                    Pour la haute saison : Du 1er juillet au 31 Aout inclus et pendant les voiles de saint Tropez du 28 septembre au 15 octobre<br>
                    Pour la basse saison : du 1er mars au 30 juin et du 16 octobre au 31 octobre.<br>
                    La cale sèche est le reste de l’année, c’est-à-dire du 1er novembre au dernier jour de février.<br>
                </p>
                <form <?= ($mode) ? "onsubmit='return bateauLocation()'" : 'action="traitementPOST/index.php?p=bateauLocation" method="POST"'; ?> class="form" >

                    <div class="form-group">
                        <label for="reserveduraction" class="text-center label">Durée de réservation</label>
                        <select id="reserveduraction" name="reserveduraction" class="form-control input" required>
                            <option value="rien">pas de selection</option>
                            <option value="matin">1 matinée</option>
                            <option value="apresmidi">1 après-midi</option>
                            <option value="jour">1 journée</option>
                            <option value="jours">plusieurs journées</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="date">date</label>
                        <div id="date" class="noValide"></div>
                    </div>
                    <div class="form-group">
                        <input type="checkbox" id="skipper" name="skipper" checked>
                        <label for="skipper">skipper</label>
                    </div>


                    <script type="text/javascript">
                        document.getElementById('reserveduraction').onchange = function (e) {
                            $('#date').datepicker('destroy');
                            document.getElementById('date').className = "noValide";
                            switch (this.value)
                            {
                                case 'matin':
                                    $('#date').datepicker({
                                        startDate: "today",
                                        endDate: "+1y",
                                        maxViewMode: 0,
                                        language: "fr",
                                        datesDisabled: getDatesDisabledMatin(<?= $id ?>)
                                    });
                                    $('#date').datepicker()
                                            .on("changeDate", function (e) {
                                                document.getElementById('date').className = e["dates"][0] ? "Valide" : "noValide";
                                            });
                                    break;
                                case 'apresmidi':
                                    $('#date').datepicker({
                                        startDate: "today",
                                        endDate: "+1y",
                                        maxViewMode: 0,
                                        language: "fr",
                                        datesDisabled: getDatesDisabledMidi(<?= $id ?>)
                                    });
                                    $('#date').datepicker()
                                            .on("changeDate", function (e) {
                                                document.getElementById('date').className = e["dates"][0] ? "Valide" : "noValide";
                                            });
                                    break;
                                case 'jour':
                                    $('#date').datepicker({
                                        startDate: "today",
                                        endDate: "+1y",
                                        maxViewMode: 0,
                                        language: "fr",
                                        datesDisabled: getDatesDisabled(<?= $id ?>)
                                    });
                                    $('#date').datepicker()
                                            .on("changeDate", function (e) {
                                                document.getElementById('date').className = e["dates"][0] ? "Valide" : "noValide";
                                            });
                                    break;
                                case 'jours':
                                    $('#date').datepicker({
                                        startDate: "today",
                                        endDate: "+1y",
                                        maxViewMode: 0,
                                        language: "fr",
                                        multidate: 2,
                                        multidateSeparator: ",",
                                        datesDisabled: getDatesDisabled(<?= $id ?>)
                                    });

                                    $('#date').datepicker()
                                            .on("changeDate", function (e) {
                                                var sauv = e["dates"];
                                                if (sauv[0])
                                                {
                                                    var actual = new Date(sauv[0]);
                                                    var date = findMaxDate(actual);


                                                    if (sauv[1])
                                                    {
                                                        if (date > sauv[1])
                                                        {
                                                            document.getElementById('date').className = "Valide";
                                                        } else
                                                        {
                                                            $('#date').datepicker("setDates", actual);
                                                            document.getElementById('date').className = "inValide";
                                                        }
                                                    } else
                                                    {
                                                        document.getElementById('date').className = "noValide";
                                                    }
                                                } else
                                                {
                                                    document.getElementById('date').className = "noValide";
                                                }
                                            });
                                    break;
                                default:
                                    document.getElementById('date').className = "";
                                    break;
                            }
                            function findMaxDate(debut)
                            {
                                var fin = new Date(debut);
                                fin.setDate(debut.getDate() + 7);
                                for (var i in getDatesDisabled(<?= $id ?>))
                                {
                                    if (i > debut && i < fin)
                                    {
                                        return i;
                                        break;
                                    }
                                }
                                return fin;
                            }

                            function getDatesDisabled(id)
                            {
                                return [];
                            }
                            function getDatesDisabledMatin(id)
                            {
                                return [];
                            }
                            function getDatesDisabledMidi(id)
                            {
                                return [];
                            }
                        };

                    </script>
                    <div class="manyOption">
                        <?php 
                        foreach ($options as $option)
                        {
                        ?>
                        <div class="input-group mb-3">
                            <div  class="form-control" ><?= $option["name"] ?><span class="price"><?= $option["prix"] ?></span></div>
                            <div class="input-group-prepend">                 
                                <div class="input-group-text">
                                    <input type="checkbox" value="<?= $option["ID"] ?>">
                                </div>
                            </div>
                        </div>
                        <?php } ?>
                    </div>



                    <button type="submit" class="btn btn-primary button" name="calcul" value="<?= $id ?>">Valider</button>

                </form>
            </div>
            <div id="getLocation" class="formBox mt-4" style="display: none">

            </div>
        </div>
        <?php
    }

}
