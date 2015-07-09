<?php get_header(); ?>

<div class="box archive-meta">
	<span class="title-meta"><?php _e('Article Archive', 'Lifestyle')?></span>
</div>
<?php 

	if( have_posts() ){ 
		while ( have_posts() ){
			the_post(); 
			get_template_part( 'inc/post-format/content', get_post_format() );
		}
	}

?>

<?php if($wp_query->max_num_pages > 1 ) { ?>
    <div class="pagination clearfix">
       <?php pagenavi($range = 3);?>
    </div>
<?php } ?>
</div></div>

<?php get_footer(); ?>