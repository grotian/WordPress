<?php 
get_header(); 
?>
<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

<article <?php post_class('box'); ?>>
    <div class="entry-header">
		<h2 class="entry-name">
			<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>" rel="bookmark"><?php the_title(); ?></a>
		</h2>
    </div>
	
    <div class="entry-content" itemprop="description">
        <?php the_content();; ?>
    </div>

</article>

<?php comments_template('', true); ?>
	
<?php endwhile; endif;?>

</div></div>

<?php get_footer(); ?>