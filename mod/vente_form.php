<?php
if (basename(__FILE__) == basename($_SERVER["SCRIPT_FILENAME"])) {
    header('Location: ../index?p=404');
    exit();
} else {
    //TEXT
    // un peu partout
    function vente_form($options, $input, $inputinput) {
        ?>
        <div class=" container-fluid d-flex justify-content-between mt-5 infoContainer ">
            <?php $input($inputinput); ?>
            <div class="formBox mt-4">
                <form class="form" onchange="tri()">
                    <div class="form-group">
                        <label for="categorie" class="text-center label">Type de coque</label>
                        <select class="form-control input" id="typeCoque">
                            <option></option>
                            <option>Rigide</option>
                            <option>Semi-rigide</option>
                            <option>Prestige</option>
                        </select>
                    </div>
                    
                    <div class="form-group">
                        <label for="prix" class="text-center label">Prix maximum</label>
                        <input type="number" step="10000" class="form-control input" id="prix" placeholder="Entrez un prix maximum">
                    </div>
                    
                    <div class="manyOption" id="boxTB">
                        <label for="marque" class="text-center label">Options</label>
                        <?php
                        foreach ($options as $option) {
                            ?>
                            <div class="input-group mb-3">
                                <div  class="form-control" ><?= $option?></div>
                                <div class="input-group-prepend">                 
                                    <div class="input-group-text">
                                        <input type="checkbox" class="options_vente" name="option[]" value="<?= $option ?>">
                                    </div>
                                </div>
                            </div>
                        <?php } ?>
                    </div>
                </form>
            </div>
        </div>
        <?php
    }

}
