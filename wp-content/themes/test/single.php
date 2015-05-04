<?php get_header();?>
    <div class="col-md-9 panel-left blog-main">
        <?php if (have_posts()) : the_post(); update_post_caches($posts); ?>
        <div class="page-header post-header">
            <h1><small><a href="<?php the_permalink();?>"><?php the_title();?></a></small></h1>
            <p class="alert alert-success post-meta" role="alert">
                <span class="post-meta-time">发布时间：<?php the_time('Y-m-d');?></span>
                <span class="post-meta-time">作者：<?php the_author();?></span>
                <span class="post-meta-time">阅读：<?php if(function_exists('the_views')) { the_views(); } ?></span>
            </p>
        </div>
        <div class="post-content">
            <?php the_content(); ?> 
        </div>
        <nav>
            <ul class="pager">
                <?php $prev_post = get_previous_post();?>
                <?php if ( ! empty( $prev_post )) :?>
                    <li style="float:left;">上一篇：<?php echo $prev_post->post_title;?> <a href="<?php echo get_permalink($prev_post->ID);?>">去看看</a></li>
                <?php endif;?>
                <?php $next_post = get_next_post();?>
                <?php if ( ! empty( $next_post )) :?>
                <li style="float:right;"><a href="<?php echo get_permalink($next_post->ID);?>">去看看</a> 下一篇：<?php echo $next_post->post_title;?></li>
                <?php endif;?>
            </ul>
        </nav>
    </div> 
    <?php else : ?>
    <div class="errorbox">
        没有文章！
    </div>
    <?php endif; ?>
    <?php get_sidebar();?> 
<?php get_footer();?>	
