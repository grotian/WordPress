<?php get_header(); ?>
    <div id="content-wrapper">
        <section class="content">
<?php 
	if( have_posts() ){ 
		while ( have_posts() ){
			the_post(); 
			get_template_part( 'content', get_post_format() );
		}
	}
?>
        </section>
    </div>
	<?php pagination(); ?>
<?php get_footer(); ?>
