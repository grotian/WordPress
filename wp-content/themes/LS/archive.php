<?php get_header(); ?>
<div class="box archive-meta">
	<span class="title-meta"><?php _e('Article Archive', 'Lifestyle')?></span>
</div>
<div id="content-wrapper">
    <section class="content">
<?php 
	if( have_posts() ){ 
		while ( have_posts() ){
			the_post(); 
			get_template_part( 'inc/archive', get_post_format() );
		}
	}
?>
    </section>
</div>
<?php if($wp_query->max_num_pages > 1 ) { ?>
    <div class="pagination clearfix">
       <?php pagenavi($range = 3);?>
    </div>
<?php } ?>
<?php get_footer(); ?>
