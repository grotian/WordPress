<div class="col-md-3 siderbar">
    <div class="page-header siderbar-music">
        <h5>音乐随心听</h5>
    </div>
    <div class="music-163">
        <!--
        <iframe frameborder="no" border="0" marginwidth="0" marginheight="0" width=330 height=110 src="http://music.163.com/outchain/player?type=0&id=70665568&auto=1&height=90"></iframe>
        -->
    </div>
    <div class="page-header">
        <h5>分类目录</h5>
    </div>
    <div class="siderbar-category">
    <?php $categories = get_categories('hide_empty=1&orderby=id&order=asc&pad_counts=1');?>
    <?php if ( $categories && $category_count = count($categories) ) :?>
    <ul class="list-group">
        <?php foreach ($categories as $_category) :?>
        <li class="list-group-item">
            <span class="siderbar-category-sep">&middot;</span><a href="<?php echo get_category_link($_category->term_id);?>"><?php echo $_category->name;?> ( <?php echo $_category->count;?> )</a>
        </li>
        <?php endforeach;?>
    </ul>
    <?php endif;?>
    </div>
    <div class="page-header">
        <h5>最新文章</h5>
    </div>
    <div class="siderbar-news">
        <ul class="list-group">
        <?php 
            $posts = get_posts('numberposts=6&orderby=post_date');
            foreach($posts as $post) {
                setup_postdata($post);
        ?>
            <li class="list-group-item">
                <span class="siderbar-news-sep">&middot;</span><a href="<?php echo get_permalink();?>" title="<?php echo get_the_title();?>"><?php echo get_the_title();?></a>
            </li>
        <?php 
            }
            wp_reset_postdata();
        ?>
        </ul>
    </div>
    <div class="page-header">
        <h5>点击排行</h5>
    </div>
    <div class="siderbar-tops">
        <ul class="list-group">
            <?php if ( function_exists( 'get_most_viewed' ) ) :?>
            <?php get_most_viewed();?> 
            <?php endif;?>
        </ul>
    </div>

    <div class="page-header">
        <h5>标签云</h5>
    </div>
    <div class="siderbar-tags">
        <?php wp_tag_cloud('smallest=10&number=50&orderby=count&order=DESC');?> 
    </div>
    <div class="page-header siderbar-interest">
        <h5>可能感兴趣</h5>
    </div>
</div>
