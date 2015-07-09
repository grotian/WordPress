<?php

// Custom header
	$args = array(
		'width'         => 1920,
		'height'        => 440,
		'default-image' => get_template_directory_uri() . '/images/bg.jpg',
		'uploads'       => true,
		'header-text'  	=> false
		
	);
	add_theme_support( 'custom-header', $args );

// 引入缩略图
if ( function_exists( 'add_theme_support' ) ) {
	add_theme_support( 'post-thumbnails' );
}
	
function my_enqueue_scripts_frontpage() {
	//载入jquery库
	wp_enqueue_script( 'jquerylib', get_template_directory_uri() . '/js/jquery-1.10.2.min.js' , array(), '1.10.2', false);    
	wp_enqueue_script( 'jquerymigrate', get_template_directory_uri() . '/js/jquery-migrate-1.2.1.js' , array(), '1.2.1', false);    
	wp_enqueue_script( 'base', get_template_directory_uri() . '/js/global.js', array(), '1.00', true);
	wp_enqueue_script( 'slimbox', get_template_directory_uri() . '/js/slimbox2.min.js', array(), '1.00', true);
	if( dopt('d_ajax_b') != '' )
		wp_enqueue_script( 'ajax', get_template_directory_uri() . '/js/ajax.js', array(), '1.00', true);

	wp_localize_script('base', 'ajax', array(
		'ajax_url' => admin_url('admin-ajax.php'),
		'home' => home_url()
	));
}

add_action( 'wp_enqueue_scripts', 'my_enqueue_scripts_frontpage' );

include_once('inc/themeset.php');
include_once(get_template_directory() . '/gallery.php');//替代wordpress原生相册样式

//移除wp_head中的部分内容
remove_action('wp_head','wp_generator');//禁止在head泄露wordpress版本号
remove_action('wp_head','rsd_link');//移除head中的rel="EditURI"
remove_action('wp_head','wlwmanifest_link');//移除head中的rel="wlwmanifest"
remove_action('wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0 );//rel=pre
remove_action('wp_head', 'wp_shortlink_wp_head', 10, 0 );//rel=shortlink 

function hide_admin_bar($flag) {//隐藏admin Bar
	return false;
}
add_filter('show_admin_bar','hide_admin_bar'); 

remove_filter ('comment_text', 'wpautop');//remove_filter ('the_content', 'wpautop');

//注册菜单 
register_nav_menus(array('header-menu' => '顶部导航'));

add_theme_support( 'post-formats', array( 'status','video' ));

function dopt($e){
    return stripslashes(get_option($e));
}

function no_self_ping( &$links ) {
	$home = get_option( 'home' );
	foreach ( $links as $l => $link )
		if ( 0 === strpos( $link, $home ) )
	unset($links[$l]);
}
if(dopt('d_nopingback_b')){
	add_action( 'pre_ping', 'no_self_ping' );
}


//评论框架
function comment($comment, $args, $depth) {
   $GLOBALS['comment'] = $comment;
?>
   <li <?php comment_class(); ?><?php if( $depth > 2){ echo ' style="margin-left:-60px;"';} ?> id="li-comment-<?php comment_ID() ?>">	 

<article id="comment-<?php comment_ID(); ?>" class="comment-body">

	<div class="comment-meta ">
		<div class="comment-author vcard"><?php echo get_avatar( $comment, $size = '50'); ?></div>
	
	<div class="comment-chat">
	<div class="comment-metadata">
		<div class="fn"><?php printf(__('%s'), get_comment_author_link()) ?></div>
		<time datetime="<?php echo timeago( $comment->comment_date_gmt ); ?>"><?php echo timeago( $comment->comment_date_gmt ); ?></time>
		<div class="reply"><?php comment_reply_link(array_merge( $args, array('reply_text' => '回复','depth' => $depth, 'max_depth' => $args['max_depth']))); ?></div>
	</div>

	<div class="comment-content">
		<?php comment_text() ?>
	</div>
	</div>
	 
	</div>

</article>

<?php

}

//评论日期时间
function timeago( $ptime ) {
    $ptime = strtotime($ptime);
    $etime = time() - $ptime;
    if ($etime < 1) return 'seconds';
    $interval = array (
        12 * 30 * 24 * 60 * 60  =>  ' years ('.date('Y-m-d', $ptime).')',
        30 * 24 * 60 * 60       =>  ' months ('.date('m-d', $ptime).')',
        7 * 24 * 60 * 60        =>  ' weeks ('.date('m-d', $ptime).')',
        24 * 60 * 60            =>  ' days',
        60 * 60                 =>  ' hours',
        60                      =>  ' minutes',
        1                       =>  ' seconds'
    );
    foreach ($interval as $secs => $str) {
        $d = $etime / $secs;
        if ($d >= 1) {
            $r = round($d);
            return $r . $str;
        }
    };
}

// 新窗口打开评论链接
function hu_popuplinks($text) {
	$text = preg_replace('/<a (.+?)>/i', "<a $1 target='_blank'>", $text);
	return $text;
}
add_filter('get_comment_author_link', 'hu_popuplinks', 6);

function add_nofollow($link, $args, $comment, $post){
	return preg_replace( '/href=\'(.*(\?|&)replytocom=(\d+)#respond)/', 'href=\'#comment-$3', $link );
}
add_filter('comment_reply_link', 'add_nofollow', 420, 4);

function mzw_description() {
    global $s, $post;
    $description = '';
    $blog_name = get_bloginfo('name');
    if ( is_singular() ) {
        $ID = $post->ID;
        $title = $post->post_title;
        $author = $post->post_author;
        $user_info = get_userdata($author);
        $post_author = $user_info->display_name;
        if (!get_post_meta($ID, "meta-description", true)) {$description = $title.' - 作者: '.$post_author.',首发于'.$blog_name;}
        else {$description = get_post_meta($ID, "meta-description", true);}
    } elseif ( is_home () )    { $description = dopt('d_description');
    } elseif ( is_tag() )      { $description = single_tag_title('', false) . " - ". trim(strip_tags(tag_description()));
    } elseif ( is_category() ) { $description = single_cat_title('', false) . " - ". trim(strip_tags(category_description()));
    } elseif ( is_archive() )  { $description = $blog_name . "'" . trim( wp_title('', false) ) . "'";
    } elseif ( is_search() )   { $description = $blog_name . ": '" . esc_html( $s, 1 ) . "' 的搜索結果";
    } else { $description = $blog_name . "'" . trim( wp_title('', false) ) . "'";
    }
    $description = mb_substr( $description, 0, 220, 'utf-8' );
    echo "<meta name=\"description\" content=\"$description\">\n";
}
add_action('wp_head','mzw_description');



/*删除内容中的图片*/
function the_content_nopic($more_link_text = null, $stripteaser = false) {
	$content = get_the_content($more_link_text, $stripteaser);
	$content = apply_filters('the_content', $content);
	$content = str_replace(']]>', ']]&gt;', $content);
	$content = preg_replace('/<\s*img\s+[^>]*?src\s*=\s*(\'|\")(.*?)\\1[^>]*?\/?\s*>/i', "", $content);
	echo $content;
}

/*post_views*/

if ( ! function_exists( 'mzw_post_views' ) ) :
function record_visitors(){
	if (is_singular()) 
	{
	  global $post;
	  $post_ID = $post->ID;
	  if($post_ID) 
	  {
		  $post_views = (int)get_post_meta($post_ID, 'views', true);
		  if(!update_post_meta($post_ID, 'views', ($post_views+1))) 
		  {
			add_post_meta($post_ID, 'views', 1, true);
		  }
	  }
	}
}
add_action('wp_head', 'record_visitors');  

function mzw_post_views($after=''){
  global $post;
  $post_ID = $post->ID;
  $views = (int)get_post_meta($post_ID, 'views', true);
  echo $views, $after;
}
endif;

/*post-love*/

add_action('wp_ajax_nopriv_mzw_like', 'mzw_like');
add_action('wp_ajax_mzw_like', 'mzw_like');
function mzw_like(){
    global $wpdb,$post;
    $id = $_POST["um_id"];
    $action = $_POST["um_action"];
    if ( $action == 'ding'){
    $mzw_raters = get_post_meta($id,'mzw_ding',true);
    $expire = time() + 99999999;
    $domain = ($_SERVER['HTTP_HOST'] != 'localhost') ? $_SERVER['HTTP_HOST'] : false; // make cookies work with localhost
    setcookie('mzw_ding_'.$id,$id,$expire,'/',$domain,false);
    if (!$mzw_raters || !is_numeric($mzw_raters)) {
        update_post_meta($id, 'mzw_ding', 1);
    } 
    else {
            update_post_meta($id, 'mzw_ding', ($mzw_raters + 1));
        }
    echo get_post_meta($id,'mzw_ding',true);
    }
    die;
}



/*ajax comment submit*/
add_action('wp_ajax_nopriv_ajax_comment', 'ajax_comment');
add_action('wp_ajax_ajax_comment', 'ajax_comment');
function ajax_comment(){
    global $wpdb;
    //nocache_headers();
    $comment_post_ID = isset($_POST['comment_post_ID']) ? (int) $_POST['comment_post_ID'] : 0;
    $post = get_post($comment_post_ID);
    $post_author = $post->post_author;
    if ( empty($post->comment_status) ) {
        do_action('comment_id_not_found', $comment_post_ID);
        ajax_comment_err('Invalid comment status.');
    }
    $status = get_post_status($post);
    $status_obj = get_post_status_object($status);
    if ( !comments_open($comment_post_ID) ) {
        do_action('comment_closed', $comment_post_ID);
        ajax_comment_err('Sorry, comments are closed for this item.');
    } elseif ( 'trash' == $status ) {
        do_action('comment_on_trash', $comment_post_ID);
        ajax_comment_err('Invalid comment status.');
    } elseif ( !$status_obj->public && !$status_obj->private ) {
        do_action('comment_on_draft', $comment_post_ID);
        ajax_comment_err('Invalid comment status.');
    } elseif ( post_password_required($comment_post_ID) ) {
        do_action('comment_on_password_protected', $comment_post_ID);
        ajax_comment_err('Password Protected');
    } else {
        do_action('pre_comment_on_post', $comment_post_ID);
    }
    $comment_author       = ( isset($_POST['author']) )  ? trim(strip_tags($_POST['author'])) : null;
    $comment_author_email = ( isset($_POST['email']) )   ? trim($_POST['email']) : null;
    $comment_author_url   = ( isset($_POST['url']) )     ? trim($_POST['url']) : null;
    $comment_content      = ( isset($_POST['comment']) ) ? trim($_POST['comment']) : null;
	$edit_id              = ( isset($_POST['edit_id']) ) ? $_POST['edit_id'] : null; // 提取 edit_id
    $user = wp_get_current_user();
    if ( $user->exists() ) {
        if ( empty( $user->display_name ) )
            $user->display_name=$user->user_login;
        $comment_author       = $wpdb->escape($user->display_name);
        $comment_author_email = $wpdb->escape($user->user_email);
        $comment_author_url   = $wpdb->escape($user->user_url);
        $user_ID			  = $wpdb->escape($user->ID);
        if ( current_user_can('unfiltered_html') ) {
            if ( wp_create_nonce('unfiltered-html-comment_' . $comment_post_ID) != $_POST['_wp_unfiltered_html_comment'] ) {
                kses_remove_filters();
                kses_init_filters();
            }
        }
    } else {
        if ( get_option('comment_registration') || 'private' == $status )
            ajax_comment_err('Sorry, you must be logged in to post a comment.');
    }
    $comment_type = '';
    if ( get_option('require_name_email') && !$user->exists() ) {
        if ( 6 > strlen($comment_author_email) || '' == $comment_author )
            ajax_comment_err( 'Error: please fill the required fields (name, email).' );
        elseif ( !is_email($comment_author_email))
            ajax_comment_err( 'Error: please enter a valid email address.' );
    }
    if ( '' == $comment_content )
        ajax_comment_err( 'Error: please type a comment.' );
    $dupe = "SELECT comment_ID FROM $wpdb->comments WHERE comment_post_ID = '$comment_post_ID' AND ( comment_author = '$comment_author' ";
    if ( $comment_author_email ) $dupe .= "OR comment_author_email = '$comment_author_email' ";
    $dupe .= ") AND comment_content = '$comment_content' LIMIT 1";
    if ( $wpdb->get_var($dupe) ) {
        ajax_comment_err('Duplicate comment detected; it looks as though you&#8217;ve already said that!');
    }
    if ( $lasttime = $wpdb->get_var( $wpdb->prepare("SELECT comment_date_gmt FROM $wpdb->comments WHERE comment_author = %s ORDER BY comment_date DESC LIMIT 1", $comment_author) ) ) {
        $time_lastcomment = mysql2date('U', $lasttime, false);
        $time_newcomment  = mysql2date('U', current_time('mysql', 1), false);
        $flood_die = apply_filters('comment_flood_filter', false, $time_lastcomment, $time_newcomment);
        if ( $flood_die ) {
            ajax_comment_err('You are posting comments too quickly.  Slow down.');
        }
    }
    $comment_parent = isset($_POST['comment_parent']) ? absint($_POST['comment_parent']) : 0;
    $commentdata = compact('comment_post_ID', 'comment_author', 'comment_author_email', 'comment_author_url', 'comment_content', 'comment_type', 'comment_parent', 'user_ID');

    if ( $edit_id )
	{
		$comment_id = $commentdata['comment_ID'] = $edit_id;
		if( ihacklog_user_can_edit_comment($commentdata,$comment_id) )
		{  
			wp_update_comment( $commentdata );
		}
		else
		{
			ajax_comment_err( 'Cheatin&#8217; uh?' );
		}

	}
	else
	{
	$comment_id = wp_new_comment( $commentdata );
	}

    $comment = get_comment($comment_id);
    do_action('set_comment_cookies', $comment, $user);
    $comment_depth = 1;
    $tmp_c = $comment;
    while($tmp_c->comment_parent != 0){
        $comment_depth++;
        $tmp_c = get_comment($tmp_c->comment_parent);
    }
    $GLOBALS['comment'] = $comment;
    ?>
<li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>">

<article id="comment-<?php comment_ID(); ?>" class="comment-body">

	<div class="comment-meta ">
	
	<div class="comment-author vcard"><?php echo get_avatar( $comment, $size = '50'); ?></div>
	
	<div class="comment-chat">

	<div class="comment-metadata">
		<div class="fn"><?php printf(__('%s'), get_comment_author_link()) ?></div>
		<time datetime="<?php echo timeago( $comment->comment_date_gmt ); ?>"><?php echo timeago( $comment->comment_date_gmt ); ?></time>
	</div>
	
	<?php if ( '0' == $comment->comment_approved ) : ?>
		<p class="comment-awaiting-moderation">您的评论正在排队等待审核，请稍后再来！</p>
	<?php endif; ?>

	<div class="comment-content">
		<?php comment_text() ?>
	</div>
	
	</div>
	 
	</div>

</article>

    <?php die();

}

function ajax_comment_err($a) {
    header('HTTP/1.0 500 Internal Server Error');
    header('Content-Type: text/plain;charset=UTF-8');
    echo $a;
    exit;
}

function ihacklog_user_can_edit_comment($new_cmt_data,$comment_ID = 0) {
    if(current_user_can('edit_comment', $comment_ID)) {
        return true;
    }
    $comment = get_comment( $comment_ID );
    $old_timestamp = strtotime( $comment->comment_date);
    $new_timestamp = current_time('timestamp');
    // 不用get_comment_author_email($comment_ID) , get_comment_author_IP($comment_ID)
    $rs = $comment->comment_author_email === $new_cmt_data['comment_author_email']
            && $comment->comment_author_IP === $_SERVER['REMOTE_ADDR']
                && $new_timestamp - $old_timestamp < 3600;
    return $rs;
}

/*ajax_comment_page_nav*/

add_action('wp_ajax_nopriv_ajax_comment_page_nav', 'ajax_comment_page_nav');
add_action('wp_ajax_ajax_comment_page_nav', 'ajax_comment_page_nav');

function ajax_comment_page_nav(){
    global $post,$wp_query, $wp_rewrite;
    $postid = $_POST["um_post"];
    $pageid = $_POST["um_page"];
    $comments = get_comments('post_id='.$postid.'&status=approve');
    $post = get_post($postid);
    if( 'desc' != get_option('comment_order') ){
        $comments = array_reverse($comments);
    }
    $wp_query->is_singular = true;
    $baseLink = '';
    if ($wp_rewrite->using_permalinks()) {
        $baseLink = '&base=' . user_trailingslashit(get_permalink($postid) . 'comment-page-%#%', 'commentpaged');
    }
    echo '<ol class="comments-list">';
    wp_list_comments('type=comment&style=ol&callback=comment&page=' . $pageid . '&per_page=' . get_option('comments_per_page'), $comments);
    echo '</ol>';
    echo '<nav class="commentnav" data-postid="'.$postid.'">';
    paginate_comments_links('current=' . $pageid . '&prev_text=«&next_text=»');
    echo '</nav>';
    die;
}

//归档
function get_archive_by_category($hide_empty = false){
    $output = '<div class="archive-category-groups">';
    $cateargs = array(
        'hide_empty' => $hide_empty
    );
    $categories = get_categories($cateargs);
    foreach($categories as $category) {
        $output .= '<div class="archive-category-group"><h2 class="archive-category-title"><a href="' . get_category_link( $category->term_id ) . '" title="' . $category->name . '" ' . '>' . $category->name.'</a> </h2><h3 class="archive-category-description">'. $category->description . '</h3><div class="archive-category-postcount v-textAlignCenter">'. $category->count . '</div>';
        $args = array(
            'category' => $category->term_id,
            'numberposts' => -1
        );
        $output .= '<div class="archive-category-posts">';
        $posts = get_posts($args);
        foreach($posts as $post){
            $output .= '<div class="archive-category-post"><a class="archive-category-post-title" href="'.get_permalink($post->ID).'">'.$post->post_title.'</a></div>';
        }
        $output .= '</div></div>';
    }
    return $output;

}

function archive_by_category_shortcode($atts, $content=null){
    extract( shortcode_atts( array(
            'hide_empty' => false,
        ),
        $atts ) );
    return get_archive_by_category($hide_empty);
}
add_shortcode('archivebc','archive_by_category_shortcode');


function comment_mail_notify($comment_id) {
  $comment = get_comment($comment_id);
  $parent_id = $comment->comment_parent ? $comment->comment_parent : '';
  $spam_confirmed = $comment->comment_approved;
  if (($parent_id != '') && ($spam_confirmed != 'spam')) {
    $wp_email = 'no-reply@' . preg_replace('#^www\.#', '', strtolower($_SERVER['SERVER_NAME'])); //e-mail 发出点, no-reply 可改为可用的 e-mail.
    $to = trim(get_comment($parent_id)->comment_author_email);
    $subject = '您在 [' . get_option("blogname") . '] 的留言有了回复';
	$message = '
	<div style="background-color:#eef2fa; border:1px solid #d8e3e8; color:#111; padding:0 15px; -moz-border-radius:5px; -webkit-border-radius:5px; -khtml-border-radius:5px; border-radius:5px;">
	<p><strong>' . trim(get_comment($parent_id)->comment_author) . ', 你好!</strong></p>
	<p><strong>您曾在《' . get_the_title($comment->comment_post_ID) . '》的留言为:</strong><br />'
	. trim(get_comment($parent_id)->comment_content) . '</p>
	<p><strong>' . trim($comment->comment_author) . ' 给你的回复是:</strong><br />'
	. trim($comment->comment_content) . '<br /></p>
	<p>你可以点击此链接 <a href="' . htmlspecialchars(get_comment_link($parent_id)) . '">查看完整内容</a></p><br />
	<p>欢迎再次来访<a href="' . get_option('home') . '">' . get_option('blogname') . '</a></p>
	<p>(此邮件为系统自动发送，请勿直接回复.)</p>
	</div>';
    $from = "From: \"" . get_option('blogname') . "\" <$wp_email>";
    $headers = "$from\nContent-Type: text/html; charset=" . get_option('blog_charset') . "\n";
    wp_mail( $to, $subject, $message, $headers );
  }
}
add_action('comment_post','comment_mail_notify'); 


function xmmusic($atts, $content=null, $code=""){
    return '<div class="sb-xiami" songid="'.$content.'"><div class="sb-player"><div class="sb-cover"></div><div class="sb-info clearfix"><div class="sb-title left"></div><div class="play-timer right">--:--</div></div><div class="play-button"> </div><div class="play-prosess"><div class="play-prosess-bar"></div></div></div><div class="sb-jplayer"></div></div>';
}
add_shortcode('xiami','xmmusic');

add_filter('the_content', 'addhighslideclass_replace');
function addhighslideclass_replace ($content) {
	global $post;
	$pattern = "/<a(.*?)href=('|\")([^>]*).(bmp|gif|jpeg|jpg|png|swf)('|\")(.*?)>(.*?)<\/a>/i";
	$replacement = '<a$1href=$2$3.$4$5 class="slimbox2" $6>$7</a>';
	$content = preg_replace($pattern, $replacement, $content);
	return $content;
}


add_filter('pre_get_posts','search_filter');
function search_filter($query) {
	if ($query->is_search) {
		$query->set('post_type', 'post');
	}
	return $query;
}

/*
add_filter( 'author_link', 'my_author_link' );
 
function my_author_link() {
    return home_url( 'about' );
}*/

/*pagination*/

if ( ! function_exists( 'pagination' ) ) :

function pagination() {
	global $wp_query;

	if ( is_single() ) { ?>
		 <div class="backspace"></div>
	<?php } elseif ( $wp_query->max_num_pages > 1 && ( is_home() || is_archive() || is_search() ) ) { ?>
		<nav class="navi paged-nav" role="navigation">
			<span class="previous"><?php previous_posts_link( '' ); ?></span>
			<span class="next"><?php next_posts_link( '' ); ?></span>
		</nav>
	<?php }
}
endif;
	
/*get avatar*/
function get_ssl_avatar($avatar) {
   $avatar = preg_replace('/.*\/avatar\/(.*)\?s=([\d]+)&.*/','<img src="https://secure.gravatar.com/avatar/$1?s=$2" class="avatar avatar-$2" height="$2" width="$2">',$avatar);
   return $avatar;
}
add_filter('get_avatar', 'get_ssl_avatar');		

add_filter( 'pre_option_link_manager_enabled', '__return_true' );
?>
