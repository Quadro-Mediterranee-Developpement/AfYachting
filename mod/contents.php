<?php require 'mod/column.php';

function contents($content_title,$content_col)
{?>

<article class="content">
    
    <p1 class = "content_title"><?php echo $content_title ?></p1>
    
    <span class="content_sub">
    <?php foreach ($content_col as $i){
        
        $col_title = $i[0];
        $col_img = $i[1];
        $col_subtitle = $i[2];
        $col_data = $i[3];
        $col_button = $i[4];
        $col_button_link = $i[5];
        
        
        
    }
    colum($col_title,$col_img,$col_subtitle,$col_data,$col_button,$col_button_link)
    ?>
    </span>
</article>
<?php } 