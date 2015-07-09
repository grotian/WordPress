<div class="entry">
     
	 <h3><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>" rel="bookmark"><?php the_title(); ?></a></h3>
         
		 <div class="entry-meta"><span><i class="fa fa-calendar"></i> - <?php the_time('Y.m.d - (H:s)');?> - <?php the_category(','); ?></span></div>	
         
		 <p><?php echo mb_strimwidth(strip_tags(apply_filters('the_content', $post->post_content)), 0, 200,"..."); ?></p>

</div>