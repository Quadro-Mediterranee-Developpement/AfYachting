<?php
if (basename(__FILE__) == basename($_SERVER["SCRIPT_FILENAME"])) {
    header('Location: ../index?p=404');
    exit();
} else {

    require_once 'mod/column.php';

    function contents($content_title, $content_col) {
        ?>
         <p1 class = "content_title"><?php echo $content_title ?></p1>

        <div class="container-fluid mt-4 mb-4">
            <div class="row ml-3">
                <div class="col d-flex flex-column ">
                    <img src="../pictures/bateaux_moteurs.jpeg" alt="" class="midPict"/>
                    <h5 class="text-center mt-3">INFORMATIONS</h5>
                    <p class="text-center">Ob haec et huius modi multa, quae cernebantur in paucis, omnibus timeri sunt coepta. et ne tot malisissimulatis paulatimque serpentibus acervi crescerent aerumnarum,nobilitatis decreto legati mittuntur: Praetextatus ex urbi praefecto et ex vicario Venustus et ex consulariMinervius oraturi, ne delictis supplicia sint grandiora, neve senator quisquam inusitato et inlicito more tormentis exponeretur.</p>
                    <button class="btn btn-outline-primary btn-lg align-self-center">Réserver</button>
                </div>

           

            <span class="content_sub">
                <?php
                foreach ($content_col as $i) {
                    column($i[0], $i[1], $i[2], $i[3], $i[4], $i[5]);
                }
                ?>
            </span>
        </article>
        <?php
    }

}