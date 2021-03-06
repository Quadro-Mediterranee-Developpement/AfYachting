<?php
if (basename(__FILE__) == basename($_SERVER["SCRIPT_FILENAME"])) {
    header('Location: ../index?p=404');
    exit();
} else {

    function head($required, $description, $Title) {
        ?>


        <head>
            <meta charset="UTF-8">
            <meta name="author" content="QMD">


            <!-- troisième-génération iPad avec haute-résolution Retina display: -->
            <link rel="apple-touch-icon-precomposed" sizes="144x144" href="">
            <!-- iPhone avec haute-résolution Retina display: -->
            <link rel="apple-touch-icon-precomposed" sizes="114x114" href="">
            <!-- iPad de première et deuxième génération : -->
            <link rel="apple-touch-icon-precomposed" sizes="72x72" href="">
            <!-- iPhone non-Retina, iPod Touch et appareils Android 2.1+: -->
            <link rel="apple-touch-icon-precomposed" href="">
            <!-- favicône de base -->
            <link rel="shortcut icon" href="img/favicon.ico" type="image/x-icon">


            <!-- Meta pour le référencement google -->
            <meta name="description" content="<?php echo $description ?>">
            <title><?php echo $Title ?></title>


            <!-- Meta pour les liens facebook -->
            <meta property="og:image" content=""><!-- A remplir -->
            <meta property="og:description" content=""><!-- A remplir -->
            <meta property="og:title" content="AfYachting">


            <!-- Meta pour les liens twitter -->
            <meta name="twitter:title" content="AfYachting">
            
            <!-- bootstrap -->            
            
            <link href="css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
            <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
            <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
            <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
            <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
            
            <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
            <script src="bootstrap-datepicker-1.9.0-dist/js/bootstrap-datepicker.js" type="text/javascript"></script>
            <link href="bootstrap-datepicker-1.9.0-dist/css/bootstrap-datepicker.css" rel="stylesheet" type="text/css"/>
            <script src="js/bootstrap.min.js" type="text/javascript"></script>
            
            <!-- Inclusion auto des js et css -->
            <link href="css/default.css" rel="stylesheet" type="text/css"/>
            
            <?php
            foreach ($required as $i) {
                if (is_file('css/' . $i . '.css')) {
                    echo '<link rel="stylesheet" href="css/' . $i . '.css" type="text/css"/>';
                }
            }
            ?>
        </head>
        
        <?php
    }

}