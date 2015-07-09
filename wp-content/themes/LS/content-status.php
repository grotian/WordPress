
<article <?php post_class(); ?>>

<div class="format-status post-content" itemprop="articleBody">	

	<div class="status-avatar"><?php echo get_avatar( get_the_author_email(), 100 ); ?>
		   <div class="more"><a href="<?php the_permalink() ?>" title="<?php the_title(); ?>"><i class="fa fa-plus"></i> </a></div>
		   <div class="msg-count"><?php comments_popup_link('0', '1', '%'); ?></div>
    </div>
    
	 <p><?php echo mb_strimwidth(strip_tags(apply_filters('the_content', $post->post_content)), 0, 80," ~"); ?></p>
 

</div>

</article>