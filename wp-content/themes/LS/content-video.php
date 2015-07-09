
<article <?php post_class(); ?>>
                                <div class="entry entry-video">
                                    <h3><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>" rel="bookmark"><?php the_title(); ?></a></h3>
                                    <div class="entry-meta"><span><i class="fa fa-video-camera"></i> - <?php the_time('Y.m.d - (H:s)');?></span></div>	
                                    <p><?php the_content( __( 'Read more', 'aquarius' ) ) ; ?></p>
								</div>
</article>