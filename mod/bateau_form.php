<?php
if (basename(__FILE__) == basename($_SERVER["SCRIPT_FILENAME"])) {
    header('Location: ../index?p=404');
    exit();
} else {
    require_once 'utilityPhp/creationFormType.php';
    require_once 'mod/connexion_form.php';

    //TEXT
    // un peu partout
    function bateau_form($id, $mode = false) {

        $date = evenementMANAGER::recupAllHoraireByBateau($id);
        $esdate = evenementMANAGER::giveRefDate($date);
        $options = bateauMANAGER::recupOPTION($id);
        ?>
        <div>
            <div id="setLocation" class="formBox mt-4" style="display:block;">
                <form <?= ($mode) ? "onsubmit='return bateauLocation()'" : 'action="traitementPOST/index.php?p=bateauLocation" method="POST"'; ?> class="form" >

                    <input type="hidden" value="<?= $id ?>" id="inputID">
                    <div class="form-group">
                        <label for="reserveduraction" class="text-center label">Duréee de réservation</label>
                        <select id="reserveduraction" name="reserveduraction" class="form-control input" required>
                            <option value="" disabled selected></option>
                            <option value="matin">1 matinÃ©e</option>
                            <option value="apresmidi">1 aprÃ¨s-midi</option>
                            <option value="jour">1 journÃ©e</option>
                            <option value="jours">plusieurs journÃ©es</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <div id="date" name="date" class="noValide"></div>
                    </div>
                    <div class="form-group">
                        <input type="checkbox" id="skipper" name="skipper" checked>
                        <label for="skipper">Engager un skipper pour piloter le bateau</label>
                    </div>


                    <script type="text/javascript">
                        document.getElementById('reserveduraction').onchange = function (e) {
                            $('#date').datepicker('destroy');
                            document.getElementById('date').className = "noValide";
                            document.getElementById('date').value = "";
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
                                                document.getElementById('date').value = [toPhp($('#date').datepicker('getDates')[0])];
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
                                                document.getElementById('date').value = [toPhp($('#date').datepicker('getDates')[0])];
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
                                                document.getElementById('date').value = [toPhp($('#date').datepicker('getDates')[0])];
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
                                                            document.getElementById('date').value = [toPhp($('#date').datepicker('getDates')[0]), toPhp($('#date').datepicker('getDates')[1])];
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
                                var tbl = getDatesDisabled(<?= $id ?>);
                                for (var i in tbl)
                                {
                                    var act = new Date(tbl[i]);
                                    if (act > debut && act < fin)
                                    {
                                        return act;
                                        break;
                                    }
                                }
                                return fin;
                            }

                            function getDatesDisabled(id)
                            {
                                var allElementDate = <?= json_encode($esdate); ?>;
                                return Object.keys(allElementDate);
                            }
                            function getDatesDisabledMatin(id)
                            {
                                var allElementDate = <?= json_encode($esdate); ?>;
                                var key = Object.keys(allElementDate);

                                var retour = [];
                                for (var i = 0; i < key.length; i++)
                                {
                                    if (allElementDate[key[i]] === 1)
                                    {
                                        retour.push(key[i]);
                                    }
                                }
                                return retour;
                            }
                            function getDatesDisabledMidi(id)
                            {
                                var allElementDate = <?= json_encode($esdate); ?>;
                                var key = Object.keys(allElementDate);

                                var retour = [];
                                for (var i = 0; i < key.length; i++)
                                {
                                    if (allElementDate[key[i]] === 2)
                                    {
                                        retour.push(key[i]);
                                    }
                                }
                                return retour;
                            }

                            function toPhp(date)
                            {
                                var retour = date.getDate() + '-' + (date.getMonth() + 1) + '-' + date.getFullYear();
                                return retour;
                            }
                        };

                    </script>
                    <div class="manyOption" id="boxTB">
                        <?php
                        foreach ($options as $option) {
                            ?>
                            <div class="input-group mb-3">
                                <div  class="form-control" ><?= $option["name"] ?><span class="price"><?= $option["prix"] ?></span></div>
                                <div class="input-group-prepend">                 
                                    <div class="input-group-text">
                                        <input type="checkbox" name="option[]" value="<?= $option["ID"] ?>">
                                    </div>
                                </div>
                            </div>
                        <?php } ?>
                    </div>



                    <button type="submit" class="btn btn-primary button" name="calcul" >Valider</button>
                    <h4 id="error"></h4>
                </form>
            </div>
            <div id="getLocation" class="formBox mt-4" style="display: none">
                <div>
                    <h3>Récapitulatif</h3>
                    <p>Bateau : <span id="nom"></span></p>
                    <p>Type : <span id="type"></span></p>
                    <p>Date : <span id="datage"></span></p>
                    <p>Skipper : <span id="skip"></span></p>
                    <p>Option : <span id="opt"></span></p>
                    <p>Prix total: <span id="prixTotal"></span></p>
                </div>

                <form action="traitementPOST/index.php?p=bateau" method="post" enctype="multipart/form-data" id="toutBon" style="display: block" class="form">
                    <div class="input-group classinputfile">
                        <div class="custom-file">
                            <input type="file" required class="custom-file-input" id="IDcard1"
                                   aria-describedby="IDcard1" name="IDcard1">
                            <label class="custom-file-label identitypaper" for="IDcard1">Merci d'entrer une pièce d'identité</label>
                        </div>
                    </div>
                    
                    
                    <div class="input-group classinputfile">
                        <div class="custom-file">
                            <input type="file" required class="custom-file-input" id="IDcard2"
                                   aria-describedby="IDcard2" name="IDcard2">
                            <label class="custom-file-label identitypaper" for="IDcard2">Merci d'entrer une seconde P.I.</label>
                        </div>
                    </div>
                    
                    <div id="optionSansSkypper" class="input-group classinputfile">
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" id="permis"
                                   aria-describedby="permis" name="permis">
                            <label class="custom-file-label identitypaper" for="permis">Merci d'entrer votre permis bateau</label>
                        </div>
                    </div>



                
                    <label><a href="index?p=cgu" class="text-white">Pourquoi avons-nous besoin de ces pièces d'identité ?</a></label>
                    <label id="paperwatchout">Pour des raisons de sécurité, si vous ne remplissez pas toutes les informations correctement vous serez redirigé sur la page d'accueil</label>

                    <div class="form-check">
                        <input type="checkbox" required class="form-check-input">
                        <label class="form-check-label" for="exampleCheck1">En cochant cette case vous certifiez avoir pris connaissance et accepté les <a href="index?p=cgu" class="text-white">CGU</a> et les <a href="index?p=cgu" class="text-white">CGV</a></label>
                    </div>

                    <button type="submit" class="btn btn-primary button" name="validation" >envoyer la demande</button>
                </form>

                <div id="Nco" style="display: none">
                    <?php
                    connexion_form(true, "loc");
                    ?>
                </div>
                <a class="btn btn-primary" onClick="closeform()" >Retour</a>
                <script type="text/javascript">
                    function closeform()
                    {
                        document.getElementById('getLocation').style.display = 'none';
                        document.getElementById('setLocation').style.display = 'block';
                    }
                </script>
            </div>
            <script src="ajaxUse/XHR.js" type="text/javascript"></script>
        </div>
        <?php
    }

}
