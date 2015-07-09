
<?php get_header(); ?>

<?php 

	if( have_posts() ){ 
		while ( have_posts() ){
			the_post(); 
			get_template_part( 'asingle', get_post_format() );
		}
	}

?>

</div></div>


<?php get_footer(); ?>