<?php

if (basename(__FILE__) == basename($_SERVER["SCRIPT_FILENAME"])) {
    header('Location: ../index?p=404');
    exit();
} else {
    //TEXT
    // un peu partout
    function footer() {
        ?>
        <footer>
            <div class="mt-4 pb-5 footer">
                
                <div class="container">
                    <div class="row">
                        <img style="align-self: center;" src="img/Logo-AFYACHTING.png" height="200px" width="200px" alt="Logo de l'entreprise AfYachting"/>
                        <div>
                            
                            
                            <h2>
                                Suivez-nous !
                            </h2>
                            <p class="text-white-50">
                                Suivez notre activité en cliquant sur les liens ci-dessous  
                            </p>
                            <ul class="social">
                                <li><a href="https://www.facebook.com/"><i class="fa fa-facebook"></i></a></li>
                                <li><a href="https://twitter.com/"><i class="fa fa-twitter"></i></a></li>
                                <li><a href="https://www.instagram.com/"><i class="fa fa-instagram"></i></a></li>
                            </ul>
                            
                        </div>
                        <div class="localisation">
                            <h4 class="mt-lg-0 mt-sm-3">
                                Nos partenaires :
                            </h4>
                            <p><a href="https://www.medyacht-group.com/"class="text-white">Medyacht</a></p>
                        </div>
                        <div class="localisation">
                            
                            <h4>Navigation :</h4>
                           
                            <p><a href="index?p=contact"class="text-white">Contact</a></p>
                            <p><a href="index" class="text-white">Accueil</a></p>
                            <p><a href="index?p=location" class="text-white">Location</a></p>
                            <p><a href="index?p=vente" class="text-white">Vente</a></p>
                            <p><a href="index?p=cgu" class="text-white">Les Conditions Générales d'utilisation</a></p>
                            <p><a href="index?p=cgv" class="text-white">Les Conditions Générales de Vente</a></p>
                        </div>
                    </div>
                    <div class="row mt-2">
                        <div class="copyright text-center">
                            <p><small class="text-white-50">© 2020 Copyright: AfYachting all right reserved</small></p>
                        </div>
                    </div>
                </div>
            </div>
        </footer>
<?php
    }

}

