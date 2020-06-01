<?php

if (basename(__FILE__) == basename($_SERVER["SCRIPT_FILENAME"])) {
    header('Location: ../index?p=404');
    exit();
} else {

    function footer() {
        ?>
        <footer>
            <div class="mt-4 pt-5 pb-5 footer">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-5 col-xs-12">
                            <h2>
                                Titre
                            </h2>
                            <p class="pr-5 text-white-50">
                                consumpsere poenales. nec enim quisquam facile meminit sub Constantio, ubi susurro tenus haec movebantur, quemquam absolutum.  
                            </p>
                            <ul class="social">
                                <li><a href=""><i class="fa fa-facebook"></i></a></li>
                                <li><a href=""><i class="fa fa-twitter"></i></a></li>
                                <li><a href=""><i class="fa fa-linkedin"></i></a></li>
                            </ul>
                        </div>
                        <div class="col-lg-3 col-xs-12 links">
                            <h4 class="mt-lg-0 mt-sm-3">
                                links
                            </h4>
                            <ul>
                                <li><a href="">Lien 1</a> </li>
                                <li><a href="">Lien 1</a> </li>
                                <li><a href="">Lien 1</a> </li>
                                <li><a href="">Lien 1</a> </li>
                                <li><a href="">Lien 1</a> </li>
                                
                            </ul>
                        </div>
                        <div class="col lg-4 col-xs-12 localisation">
                            <h4>contact Rapide</h4>
                            <p><i class="fa fa-map-marker">Nous localiser</i> </p>
                            <p><i class="fa fa-phone">0600000000</i> </p>
                            <p><i class="fa fa-enveloppe-o">info@mail.com</i> </p>
                        </div>
                    </div>
                    <div class="row mt-5">
                        <div class="col copyright text-center">
                            <p><small class="text-white-50">AfYachting all right reserved</small></p>
                        </div>
                    </div>
                </div>
            </div>
        </footer>
<?php
    }

}

