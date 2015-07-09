<article <?php post_class(); ?>>
    <div class="entry-header">
		<h3 class="entry-name">
			<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>" rel="bookmark"><?php the_title(); ?></a>
		</h3>
        
		<div class="entry-meta">
			<span><?php the_time('Y,m,d');?></span>
		           <span><?php the_category(','); ?></span>
			       <span><?php comments_popup_link('no reply', '1 reply', '% replies'); ?></span>
			       <span><?php mzw_post_views(' reads');?></span>
            </div>	
    </div>
	   
    <div class="entry-content" itemprop="description">
        <?php the_content(); ?>
    </div>
	
	 <div class="clearfix"></div>
	 
	<footer class="entry-footer clearfix">
		<div class="post-share">
			<a href="javascript:;"><i class="fa fa-share-alt"></i></a>
			<ul>
				<li><a href="http://sns.qzone.qq.com/cgi-bin/qzshare/cgi_qzshare_onekey?url=<?php the_permalink(); ?>&title=<?php the_title(); ?>" target="_blank"><i class="fa fa-qq"></i></a></li>
				<li><a href="http://service.weibo.com/share/share.php?title=<?php the_title(); ?>&url=<?php the_permalink(); ?>" target="_blank"><i class="fa fa-weibo"></i></a></li>
				<li><a href="http://share.renren.com/share/buttonshare?link=<?php the_permalink(); ?>&title=<?php the_title(); ?>" target="_blank"><i class="fa fa-renren"></i></a></li>
				<li><a href="http://twitter.com/share?url=<?php the_permalink(); ?>&text=<?php the_title(); ?>" target="_blank"><i class="fa fa-twitter"></i></a></li>
			</ul>
		</div>
		<div class="post-love">
			<a href="javascript:;" data-action="ding" data-id="<?php the_ID(); ?>" class="favorite post-love-link <?php if(isset($_COOKIE['mzw_ding_'.$post->ID])) echo ' done';?>" title="Love this"><i class="fa fa-heart-o"></i> 
			<span class="love-count">
				<?php if( get_post_meta($post->ID,'mzw_ding',true) ){            
                    echo get_post_meta($post->ID,'mzw_ding',true);
                 } else {
                    echo '0';
                 }?>
			</span></a>
		</div>
		<div class="post-tags">
			<?php if ( get_the_tags() ) {the_tags('', '', ' ');}?>
		</div>
	</footer>
	<div  class="nav-post">
								
		<?php $prev_post = get_previous_post();
			   if (!empty( $prev_post )): ?>
			<a class="prev" title="" href="<?php echo get_permalink( $prev_post->ID ); ?>">
						<span class="icon-wrap"></span>
						<h3><?php  echo ' ' . esc_attr( get_the_title($prev_post) ); ?></h3>
			</a>
					
		<?php endif; ?>
						
		<?php $next_post = get_next_post();
			  if (!empty( $next_post )): ?>
			 <a class="next" title="" href="<?php echo get_permalink( $next_post->ID ); ?>">
						<span class="icon-wrap"></span>
						<h3><?php  echo ' ' . esc_attr( get_the_title($next_post) ); ?></h3>
			 </a>
					
		 <?php endif; ?>

		 <div class="clearfix"></div>
					
	</div>
	
</article>


<?php comments_template('', true); ?>