<?php
function display($displayer_img_1,$displayer_img_2,$displayer_input)
{ ?>
<article class="displayer">
    
    <span class="displayer_sub">
        <img src="<?php echo $displayer_img_1 ?>">
        
        <img src="<?php echo $displayer_img_2 ?>">
        
        <?php $displayer_input(); ?>
        
    </span>
    
    
</article>
<?php }