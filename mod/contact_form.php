<?php

if (basename(__FILE__) == basename($_SERVER["SCRIPT_FILENAME"])) {
    header('Location: ../index?p=404');
    exit();
} else {

    function contact_form($cible) {
        ?>
               <div class="col-md-6 mt-5 mb-5 contact-widget-section2 wow animated fadeInLeft d-flex justify-content-between" data-wow-delay=".2s">
           
            <!-- SECTION FORMULAIRE -->
            <div class="col-md-6 wow animated fadeInRight mt-5" data-wow-delay=".2s">

                <form action="<?php echo $cible; ?>" method="POST" class="shake">
                    <div class="form-group label-floating">
                        <input name="nom" type="text" placeholder="Nom Prenom" id='name' class="form-control">
                        <label class="control-label" for="name">Name</label>
                    </div>

                    <div class="form-group label-floating">

                        <input name="y_mail" type="email" placeholder="Email" id='email' class="form-control">
                        <label class="control-label" for="email">Email</label>

                    </div>

                    <div class="form-group label-floating">
                        <input name = "sujet" type = "text" placeholder="Sujet" class="form-control" id='sujet'>
                        <label class="control-label" for='sujet'>Subject</label>
                    </div>

                    <div class="form-group label-floating">

                        <textarea name="message"  placeholder="Votre message" class="form-control"></textarea>
                        <label for="message" class="control-label">Message</label>
                    </div>

                    <div class="form-submit mt-5">
                        <button type="submit" style="vertical-align:middle" class="btn btn-success"><span>Envoyer</span> </button>
                    </div>
                </form>
            </div>
            
            <!-- SECTION LOCALISATION-->
            <div class="map mt-5 align-self-center ml-5">
                <p>map a mettre ici</p>
            </div>
        </div>
<?php
    }

}
