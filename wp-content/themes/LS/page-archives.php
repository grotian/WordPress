<?php 
/*
Template Name: page-archives
*/
get_header(); 
?>

<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

<article <?php post_class('box'); ?>>

				<div class="archive-container">
				
					<h3><?php _e('最新发表','lifestyle') ?></h3>
										            
		            <ul class="posts-archive-list">
			            <?php $posts_archive = get_posts('numberposts=21');
			            foreach($posts_archive as $post) : ?>
			                <li>
			                	<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
			                		<?php the_title();?> 
			                	</a>
			                	<span><?php the_time(get_option('date_format')); ?></span>
			                </li> 
			            <?php endforeach; ?>
		            </ul>


	            </div>
			
        <div class="archives"><?php echo get_archive_by_category(true); ?></div>	
 
</article>
	
<?php endwhile; endif;?>
</div></div>
<?php get_footer(); ?>