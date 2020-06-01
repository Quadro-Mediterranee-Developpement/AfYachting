<?php
if (basename(__FILE__) == basename($_SERVER["SCRIPT_FILENAME"])) {
    header('Location: ../index?p=404');
    exit();
} else {

//$col_title, $col_img, $col_subtitle, $col_data, $col_button, $col_button_link
    function column($information) {

      
        ?> <div class="container-fluid mt-4 mb-4 imgBgBoat infoContainer">
            <div class="row ml-3 "> <?php
        foreach ($information as $i) {
  
                    ?>
                
                <div class="col d-flex flex-column mt-3 mb-3">
                    <img src="img/<?php echo $i[1]; ?>.png" alt="" class="midPict "/>
                    <h5 class="text-center mt-3"><?php echo $i[0]; ?></h5>
                    <p class="text-center"><?php echo $i[3]; ?></p>
                    <a class="btn btn-outline-primary btn-lg align-self-center" href="?p=<?php echo $i[5]; ?>"><?php echo $i[4]; ?></a>
                </div>
                    <?php 
                }
                ?> </div></div> <?php
        }

    }