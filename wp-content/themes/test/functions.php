<?php

if ( ! function_exists('test_themesetup')) {
    function test_themesetup() {
		// Register theme menu's.
		register_nav_menu('header_menu', '导航菜单');
    }
}
add_action( 'after_setup_theme', 'test_themesetup' );

add_theme_support( 'post-thumbnails' );
function catch_that_image() {
    global $post, $posts;
    $first_img = '';
    ob_start();
    ob_end_clean();
    $output = preg_match_all('/<img.+src=[\'"]([^\'"]+)[\'"].*>/i', $post->post_content, $matches);
    if ($output) {
        $first_img = $matches[1][0];
    }
    return $first_img;
}
         
function mmimg($post_id = null) {
    $cti = catch_that_image();
    $showimg = $cti;
    if ( has_post_thumbnail($post_id) ) { 
        $thumbnail_image_url = wp_get_attachment_image_src( get_post_thumbnail_id($post_id), 'thumbnail');
        $shareimg = $thumbnail_image_url[0];
    } else { 
        $shareimg = $showimg;
    };
    return $shareimg;
} 

//禁用Open Sans
class Disable_Google_Fonts {
    public function __construct() {
        add_filter( 'gettext_with_context', array( $this, 'disable_open_sans' ), 888, 4 );
    }
    public function disable_open_sans( $translations, $text, $context, $domain ) {
        if ( 'Open Sans font: on or off' == $context && 'on' == $text ) {
                $translations = 'off';
        }
        return $translations;
    }
}
$disable_google_fonts = new Disable_Google_Fonts;
