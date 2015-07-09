<?php
/*
  Template Name: links
 */
?>

<?php get_header(); ?>

	<div class="page">
		
	<?php if(have_posts()):while(have_posts()):the_post(); ?>
      
		<div class="post-links">
             
			<?php

                 $bookmarks = get_bookmarks();

                 if ( !empty($bookmarks) ){
				 
                 echo '<ul class="link-content clearfix">';
				 
                 foreach ($bookmarks as $bookmark) {
				 
                 echo '
				 
				 <li>
				 
				 <a href="' . $bookmark->link_url . '" target="_blank" >'. get_avatar($bookmark->link_notes,120) . '</a>

				 <span class="sitename">'. $bookmark->link_name .'<p>'.$bookmark->link_description.'</p></span>

				 </li>'
				 
				 ;}
				 
                 echo '</ul>';}
            
			?>

        </div>		
	
    <?php endwhile; else: ?>
	
		<p><?php _e('非常抱歉，没有相关文章.'); ?></p>
				
	<?php endif; ?>
	
	</div>
	
	<div class="clearfix"></div>
	
<?php get_footer(); ?>