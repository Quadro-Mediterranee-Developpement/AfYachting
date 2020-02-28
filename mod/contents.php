<article class="content">
    
    <p1 class = "content_title"><?php echo $content_title ?></p1>
    
    <span class="content_sub">
    <?php for($i = 0;$i<$content_index;$i++){
        
        $col_title = $content_col[$i][0];
        $col_img = $content_col[$i][1];
        $col_subtitle = $content_col[$i][2];
        $col_data = $content_col[$i][3];
        $col_button = $content_col[$i][4];
        $col_button_link = $content_col[$i][5];
        
        require 'mod/column.php';
        
    }?>
    </span>
</article>