<article <?php post_class(); ?>>
    <div class="post-time">
        <span class="fa fa-circle-o"></span>
    </div>
    <div class="entry-desc">
        <p class="entry-desc-time"><?php the_time('Y/m/d');?></p>
        <?php if (has_category()) :?>
        <p class="entry-desc-category"><?php the_category(',');?></p>
        <?php endif;?>
        <!--
        <?php if ( has_tag() ) :?>
        <p class="entry-desc-tags"><?php the_tags('', ',', ''); ?></p>
        <?php endif;?>
        -->
        <?php if(function_exists('the_views')) :?>
        <p class="entry-desc-views">有 <?php the_views();?> 人看过</p>
        <?php endif;?>
        <p class="entry-desc-comments"><?php comments_popup_link('0 条评论', '1 条评论', '% 条评论', '', '评论已关闭'); ?></p>
    </div>
    <div class="entry">
        <h3><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>" rel="bookmark"><?php the_title(); ?></a></h3>
        <div class="entry-meta">
            <span></span>
        </div>	
        <p><?php the_content( __( '阅读更多', 'Lifestyle' ) ) ; ?></p>
    </div>
</article>
<div class="clearfix"></div> 
