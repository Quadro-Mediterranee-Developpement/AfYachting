<?php
if (basename(__FILE__) == basename($_SERVER["SCRIPT_FILENAME"])) {
    header('Location: ../index?p=404');
    exit();
} else {
    require_once 'utilityPhp/creationFormType.php';

    //TEXT
    // un peu partout
    function bateau_form() {
        ?>
        <div class="formBox mt-4">
            <form class="form" action="traitementPOST/index.php?p=bateauLocation" method="POST">
                <p class="commentaire">
                    Pour la haute saison : Du 1er juillet au 31 Aout inclus et pendant les voiles de saint Tropez du 28 septembre au 15 octobre<br>
                    Pour la basse saison : du 1er mars au 30 juin et du 16 octobre au 31 octobre.<br>
                    La cale sèche est le reste de l’année, c’est-à-dire du 1er novembre au dernier jour de février.<br>
                </p>
                <div class="form-group">
                    <label for="reserveduraction" class="text-center label">Durée de réservation</label>
                    <select id="reserveduraction" name="reserveduraction" class="form-control input" required>
                        <option value="1">1 matinée</option>
                        <option value="2">1 après-midi</option>
                        <option value="3">1 journée</option>
                        <option value="4">plusieurs journées</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="date">date</label>
                    <div id="date" class="noValide"></div>
                </div>
                <div class="form-group">
                    <input type="checkbox" id="skipper" name="skipper" value="<?= (isset($_GET['skipper'])) ? $_GET['skipper'] : ''; ?>" checked>
                    <label for="skipper">skipper</label>
                </div>
                

                <script type="text/javascript">
                    $('#date').datepicker({
                        startDate: "today",
                        endDate: "+1y",
                        maxViewMode: 0,
                        language: "fr",
                        multidate: 2,
                        multidateSeparator: ",",
                        datesDisabled: ['06/06/2020', '06/21/2020']
                    });
                    $('#date').datepicker()
                            .on("changeDate", function (e) {
                                var sauv = e["dates"];
                                if (sauv[0])
                                {
                                    var actual = new Date(sauv[0]);
                                    var date = new Date(actual);
                                    date.setDate(actual.getDate() + 7);
                                    if(sauv[1])
                                    {
                                        if(date > sauv[1])
                                        {
                                            document.getElementById('date').class = "Valide";
                                        }
                                        else
                                        {
                                            $('#date').datepicker("setDates",actual);
                                            document.getElementById('date').class = "inValide"
                                        }
                                    }
                                }
                            });
                </script>
                <button type="submit" class="btn btn-primary button" name="calcul" value="<?= (isset($_GET["batID"])) ? $_GET["batID"] : "-1"; ?>">Calculer le prix</button>

                <?php if (isset($_GET['price'])): ?>
                    <?php if (!isset($_SESSION['ID'])): ?>
                        <div class="form-group mt-2">
                            <?php
                            creationFormType::input_text("text", "inputUserame", "Nom", "userName", "Nom");

                            creationFormType::input_text("email", "inputEmail", "Adresse Email", "mail", "Adresse Email");
                            ?>
                            <a class="btn btn-primary button" href="index?p=inscription&g=location">inscription</a>
                            <a class="btn btn-primary button" href="index?p=connexion&g=location">connexion</a>
                        </div>
                    <?php endif; ?>

                    <div class="form-group">
                        <label for="prix" class="text-center label">prix</label>
                        <input type="text"  id="prix" name="prix" value="<?= $_GET['price'] ?>€" class="form-control input" disabled="disabled">
                    </div>
                    <button type="submit" class="btn btn-primary button" name="payer" >Payer</button>
                <?php endif; ?>
                <?php if (isset($_SESSION['erreur'])): ?>
                    <p id="errorform" class="form-control is-invalid"><?= $_SESSION['erreur']['desc']; ?></p>
                <?php endif; ?>
            </form>
        </div>
        <?php
    }

}

function creatListDeroulante($tbl, $id, $title) {
    ?>
    <div class = "form-group">
        <label for = "<?= $id ?>" class = "text-center label"><?= $title ?></label>
        <select class = "form-control input" name="<?= $id ?>" id = "<?= $id ?>">
            <option value='null'>vide</option>
            <?php
            foreach ($tbl as $i) {
                echo "<option value='$i'>$i</option>";
            }
            ?>
        </select>
    </div>
    <?php
}
