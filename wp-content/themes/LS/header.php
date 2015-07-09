<!DOCTYPE html>
<html>
<head>
	<title>		<?php if ( is_home() && !is_paged() ){ bloginfo('name'); ?> | <?php bloginfo('description'); } ?>
				<?php if (is_single() || is_page()) { ?><?php wp_title('',true); ?> | <?php bloginfo('name'); } ?>
				<?php if ( is_paged() ){ ?><?php printf( __('第%1$s页', ''), intval( get_query_var('paged')), $wp_query->max_num_pages); ?> | <?php bloginfo('name'); } ?>
				<?php if(is_category()) { $category = get_the_category(); echo '分类'.$category[0]->cat_name.'下的文章';  ?> | <?php bloginfo('name');  } ?>
				<?php if(is_search()) { echo '包含关键字 '.$s.' 的文章';  ?> | <?php bloginfo('name'); } ?>
			    <?php if(is_tag()) { echo '标签'.single_tag_title("", true).'下的文章';  ?> | <?php bloginfo('name'); } ?>
			    <?php if(is_author()) { echo wp_title().'发布的文章';  ?> | <?php bloginfo('name'); } ?> 
	</title>
    <meta charset="utf-8">
    <link href="<?php bloginfo('stylesheet_url'); ?>" rel="stylesheet" media="screen">
    <link href="<?php bloginfo('template_directory');?>/css/font-awesome.min.css" rel="stylesheet" media="screen">
    <link rel="stylesheet" href="<?php bloginfo('template_directory');?>/css/gallery.css" type="text/css" media="all" />
	<?php if( dopt('d_headcode_b') != '' ) echo dopt('d_headcode');?>
	<?php wp_head(); ?>
	
</head>

<body <?php body_class(); ?>>

<div id="player">
     
	 <span id="playback" class="fa fa-play fa-lg"></span>
    
	 <audio><source id="sourceMp3" type="audio/mpeg" /></audio>
	 
</div>

<div class="headerimg" style="background-image: url(<?php if (get_header_image() != '') : ?><?php header_image(); ?><?php else : ?><?php echo get_template_directory_uri() . '/images/bg.jpg'; ?><?php endif; ?>);"></div>

<header id="header" >

  <div class='in'>
  
    <h1><a href="<?php echo esc_url( home_url() ); ?>"><?php echo bloginfo('title'); ?></a></h1>
	
    <p><?php bloginfo('description'); ?></p>
	 
	 <div class="sns">
			
			<?php if( dopt('d_sns_open') ) {
			echo '<div class="social" >';
			if( dopt('d_mail_b') ) echo '<a class="mail" href="'.dopt('d_mail').'"><i class="fa fa-envelope"></i></a>';
			if( dopt('d_rss_sina_b') ) echo '<a class="weibo" href="'.dopt('d_rss_sina').'"><i class="fa fa-weibo"></i></a>';
			if( dopt('d_rss_twitter_b') ) echo '<a class="twitter" href="'.dopt('d_rss_twitter').'"><i class="fa fa-twitter"></i></a>';
			if( dopt('d_rss_google_b') ) echo '<a class="google" href="'.dopt('d_rss_google').'"><i class="fa fa-google-plus "></i></a>';
			if( dopt('d_rss_facebook_b') ) echo '<a class="facebook" href="'.dopt('d_rss_facebook').'"><i class="fa fa-facebook"></i></a>';
			if( dopt('d_rss_github_b') ) echo '<a class="github" href="'.dopt('d_rss_github').'"><i class="fa fa-github"></i></a>';
			if( dopt('d_rss_tencent_b') ) echo '<a class="tweibo" href="'.dopt('d_rss_tencent').'"><i class="fa fa-tencent-weibo"></i></a>';
			if( dopt('d_rss_instagram_b') ) echo '<a class="instagram" href="'.dopt('d_rss_instagram').'"><i class="fa fa-instagram"></i></a>';
			if( dopt('d_rss_b') ) echo '<a class="rss" href="'.dopt('d_rss').'"><i class="fa fa-rss"></i></a>';
			//if( dopt('d_rss_b') ) echo '<a class="weixin" href="'.dopt('d_rss').'"><i class="fa fa-weixin"></i></a>';
			echo '</div>'; }
	       	?>
		
	 </div>

  </div>
  
  <nav class="main-nav">
  
        <?php wp_nav_menu(array( 'theme_location' => 'header-menu','container' => 'ul', 'menu_class' => 'nav')); ?> 
  
        <div class="form-search">
		
             <a href="#" class="search-icon openpre close" data-tooltip="轻击以弹出搜索栏" data-placement="left"><i class="fa fa-search"></i></a>
			 
        </div>
		
  </nav>
		 
			 
</header>

<div id="topsearch">

<form id="searchform" class="searchform" action="<?php echo get_bloginfo ('url'); ?>" method="GET">
	<input type="text" name="s" class="searchbar" placeholder="Type then press enter to search ..." />
	<input type="hidden" class="searchsubmit" value="Search" />
</form>

</div>

 <div class="clearfix"></div> 
 
 	<div id="wrap"><!-- wrap start here -->
	
        <div id="container" class="clearfix">
		
            <div id="content">
			
				
				
