<!DOCTYPE html>
<html lang="zh-CN">
    <head>
        <meta charset="utf-8">
        <title>
            <?php if ( is_home() ) :?>
                <?php bloginfo('name'); echo ' - '; bloginfo('description');?>
            <?php elseif ( is_category() ) :?>
                <?php single_cat_title(); echo ' - '; bloginfo('name');?>
            <?php elseif ( is_single() || is_page() ) :?>
                <?php single_post_title(); echo ' - '; bloginfo('name');?>
            <?php elseif ( is_tag() ) :?>
                <?php single_tag_title(); echo ' - '; bloginfo('name');?>
            <?php elseif ( is_search() ) :?>
                <?php echo '搜索结果'; echo ' - '; bloginfo('name');?>
            <?php elseif ( is_404() ) :?>
                <?php echo '页面未找到'; echo ' - '; bloginfo('name');?>
            <?php else :?>
                <?php wp_title(' - ', true);?>
            <?php endif;?>
        </title>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="keywords" content="艾叶，PHP，技术，个人博客"/>
        <meta name="description" content="艾叶，是一个热爱生活，喜欢运动的后端程序员的个人网站，记录并分享生活和技术的个人原创网站。" />

        <link href="<?php bloginfo('template_url');?>/bootstrap/css/bootstrap.min.css" rel="stylesheet">
        <link rel="stylesheet" href="<?php bloginfo('stylesheet_url');?>" type="text/css" media="screen" />
        <link rel="alternate" type="application/rss+xml" title="RSS 2.0 - 所有文章" href="<?php bloginfo('rss2_url'); ?>" />
        <link rel="alternate" type="application/rss+xml" title="RSS 2.0 - 所有评论" href="<?php bloginfo('comments_rss2_url'); ?>" />
        <?php wp_head(); ?>
        <?php flush();?>
    </head>
    <body>
    <nav class="navbar navbar-default blog-header">
        <div class="container-fluid blog-header-container">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand blog-name" href="<?php echo esc_url( home_url( '/' ) );?>"><?php bloginfo('name');?></a>
                <p class="navbar-text blog-desc"><?php bloginfo('description');?></p>
            </div>
            <div class="collapse navbar-collapse header-menu" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav header-menu-ul">
                <?php wp_nav_menu(array('container' => false, 'theme_location' => 'header_menu', 'items_wrap' => '%3$s')); ?>  
                </ul>
            </div>
        </div>
    </nav>
    <!--
    <?php if ( is_home() ) :?>
    <div class="banner-top">
    </div>
    <?php endif;?>
    -->
    <div class="container content">    
        <div class="row">
