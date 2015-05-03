<?php get_header();?>
    <div class="banner-top">
    </div>
    <div class="container content">    
        <div class="row">
            <div class="col-md-8">
                <div class="page-header">
                    <h1><small>最新文章</small></h1>
                </div>
                <?php if ( have_posts() ) :?>
                    <?php while ( have_posts() ) : the_post();?>
                <article id="post-<?php the_ID(); ?>" <?php post_class('blog-article'); ?>>
                    <header class="entry-header"></header> 
                    <div class="entry-content">
                        <h2 class="blog-title">
                            <a href="<?php the_permalink();?>" title="<?php the_title();?>"><?php the_title();?></a>
                        </h2>
                        <div class="entry-meta">
                            <!--
                            <span class="author">
                                <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>By <a href="<?php the_author_meta('url');?>" rel="author"><?php the_author();?></a>
                            </span>
                            -->
                            <span class="date">
                                <span class="glyphicon glyphicon-time" aria-hidden="true"></span><time datetime="<?php the_time();?>"><?php the_time('Y年m月d日');?></time>
                            </span>
                            <span class="comment">
                                <span class="glyphicon glyphicon-comment" aria-hidden="true"></span><?php comments_popup_link('0 条评论', '1 条评论', '% 条评论', '', '评论已关闭'); ?>
                            </span>
                            <?php if ( has_category() ) :?>
                            <span class="category">
                                <span class="glyphicon glyphicon-folder-open" aria-hidden="true"></span><?php the_category(', ');?>
                            </span>
                            <?php endif;?>
                            <?php if ( has_tag() ) :?>
                            <span class="tags">
                                <span class="glyphicon glyphicon-tags" aria-hidden="true"></span><?php the_tags('', ', ', ''); ?>
                            </span>
                            <?php endif;?>
                        </div>
                        <div class="article">
                            <?php if ( $article_img = mmimg() ) :?>     
                            <div class="article-img">  
                                <img src="<?php echo $article_img;?>" class="img-responsive img-thumbnail">
                            </div>
                            <?php endif;?>
                            <?php the_excerpt();?>
                        </div>
                    </div>
                    <a class="btn btn-default read-more" href="<?php the_permalink();?>">阅读全文</a>
                    <div class="clearboth"></div>
                </article> 
                    <?php endwhile; ?>
                <?php else : ?>
                <h3 class="title"><a href="#" rel="bookmark">未找到</a></h3>
                <p>没有找到任何文章！</p>
                <?php endif; ?>
            </div> 
            <div class="col-md-4"></div> 
        </div>      
        <div></div>
    </div>
<?php get_footer();?>
