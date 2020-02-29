
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
<<<<<<< HEAD
        <title><?php echo $Title ?></title>
=======
        <title>AfYachting: location/vente de batteaux à St Tropez</title><!-- A améliorer -->
>>>>>>> 8ea563ad6ef5bb0535b7045bce3421e659b8a1c6
        
        
        <!-- Meta pour les liens facebook -->
        <meta property="og:image" content=""><!-- A remplir -->
        <meta property="og:description" content=""><!-- A remplir -->
        <meta property="og:title" content="AfYachting">
        
        
        <!-- Meta pour les liens twitter -->
        <meta name="twitter:title" content="AfYachting">
        
        
        <!-- Inclusion auto des js et css -->
        <?php foreach ($required as $i){
            
            if(is_file('css/'.$i.'.css')){
            echo '<link rel="stylesheet" href="css/'.$i.'.css">';
            }
            
            if(is_file('js/'.$i.'.js')){
            echo '<script src="js/'.$i.'.js"></script>';
            }
        }
        ?>
    </head>
