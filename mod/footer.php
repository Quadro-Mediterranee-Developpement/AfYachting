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
            <div class="mt-4 pt-5 pb-5 footer">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-5 col-xs-12">
                            <h2>
                                Suivez-nous !
                            </h2>
                            <p class="pr-5 text-white-50">
                                Gardez contacte par être informé des dernieres actualité de AfYachting sur tous les réseaux sociaux.  
                            </p>
                            <ul class="social">
                                <li><a href="https://www.facebook.com/"><i class="fa fa-facebook"></i></a></li>
                                <li><a href="https://twitter.com/"><i class="fa fa-twitter"></i></a></li>
                                <li><a href="https://www.linkedin.com/"><i class="fa fa-linkedin"></i></a></li>
                            </ul>
                        </div>
                        <div class="col-lg-3 col-xs-12 links">
                            <h4 class="mt-lg-0 mt-sm-3">
                                Lien vers des partenaires
                            </h4>
                            <ul>
                                <li><a href="https://www.google.com/search?q=La+plage+de+Toulon+et+CO&oq=La+plage+de+Toulon+et+CO&aqs=chrome..69i57j33l7.956j0j7&sourceid=chrome&ie=UTF-8">La plage de Toulon et CO</a> </li>
                                <li><a href="https://www.google.com/search?q=Grillade+au+feu+de+bois&oq=Grillade+au+feu+de+bois&aqs=chrome..69i57j0l7.764j0j9&sourceid=chrome&ie=UTF-8">Grillade au feu de bois</a> </li>
                                <li><a href="https://www.google.com/search?q=Le+retour+de+la+momie+2+vf&oq=Le+retour+de+la+momie+2+vf&aqs=chrome..69i57.767j0j9&sourceid=chrome&ie=UTF-8">Le retour de la momie 2 vf</a> </li>
                                <li><a href="https://www.google.com/search?q=Maison+%C3%A0+vendre&oq=Maison+%C3%A0+vendre&aqs=chrome..69i57j0l7.450j0j9&sourceid=chrome&ie=UTF-8">Maison à vendre</a> </li>
                                <li><a href="https://www.google.com/search?q=Concurence+%26%238249%3BNE+PAS+Y+ALLER%3E&oq=Concurence+%26%238249%3BNE+PAS+Y+ALLER%3E&aqs=chrome..69i57.546j0j9&sourceid=chrome&ie=UTF-8">Concurence &#8249;NE PAS Y ALLER></a> </li>
                                
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

