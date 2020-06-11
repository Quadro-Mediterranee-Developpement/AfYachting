<?php
if (basename(__FILE__) == basename($_SERVER["SCRIPT_FILENAME"])) {
    header('Location: ../index?p=404');
    exit();
} else {

    function carousel($images) {
        static $numberCarousel = 1;
        ?>
        <div id="carousel<?php echo $numberCarousel ?>" class="carousel slide" data-ride="carousel">

            <!-- Indicators -->
            <ul class="carousel-indicators">
                <?php
                $Indicators = 0;
                foreach ($images as $i) {
                    ?>
                    <li data-target="#carousel<?php echo $numberCarousel ?>" data-slide-to="<?php echo $Indicators ?>" <?php echo ($Indicators === 0) ? "class='active'" : ""; ?>></li>
                    <?php
                    $Indicators++;
                }
                ?>
            </ul>

            <!-- The slideshow -->
            <div class="carousel-inner">
                <?php
                $slideshow = 0;
                foreach ($images as $i) {
                    ?>
                    <div class="carousel-item <?php echo ($slideshow === 0) ? "active" : ""; ?>">
                        <img src="img/<?php echo $i['Url'] ?>" alt="<?php echo $i['Alt_Description'] ?>" class="pictSize"/>
                    </div>
                    <?php
                    $slideshow++;
                }
                ?>
            </div>


            <a class="carousel-control-prev" href="#carousel<?php echo $numberCarousel ?>" data-slide="prev">
                <span class="carousel-control-prev-icon"></span>
            </a>
            <a class="carousel-control-next" href="#carousel<?php echo $numberCarousel ?>" data-slide="next">
                <span class="carousel-control-next-icon"></span>
            </a>
        </div>
        <?php
        $numberCarousel++;
    }

}