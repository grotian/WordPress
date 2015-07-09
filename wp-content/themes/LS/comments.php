<div class="comments clearfix box">

	<div id="comments-title"><i class="fa fa-comments"></i><span><?php echo count($comments); ?>条留言</span></div>
	<div class="commentshow">
		<ol class="comments-list">
			<?php wp_list_comments('type=comment&callback=comment&max_depth=1000&style=ol'); ?>
		</ol>
		<nav class="commentnav" data-postid="<?php echo $post->ID?>"><?php paginate_comments_links('prev_text=«&next_text=»');?></nav>
	</div>

	<div id="respond" class="comment-respond">
		<h5 id="replytitle" class="comment-reply-title"><small><a rel="nofollow" id="cancel-comment-reply-link" href="#respond" style="display:none;">取消</a></small></h5>
		<form action="#" method="post" id="commentform" class="clearfix">
			<?php if ( $user_ID ) { ?>
			<p style="margin-bottom:10px">欢迎<a href="<?php echo get_option('siteurl'); ?>/wp-admin/profile.php"><?php echo $user_identity; ?></a>&nbsp;|&nbsp;<a href="<?php echo wp_logout_url(get_permalink()); ?>" title="Log out of this account">注销？&raquo;</a></p>
			<?php } else { ?>
			<p class="input-row"><input type="text" name="author" class="text_input" id="author" size="22" tabindex="1" placeholder="昵称 *"/>
			</p>
			
			<p class="input-row"><input type="text" name="email" class="text_input" id="email" size="22" tabindex="2" placeholder="邮箱 *"/>
			</p>
			
			<p class="input-row"><input type="text" name="url" class="text_input" id="url" size="22" tabindex="3"  placeholder="网站"/>
			</p>
			
			<?php }?>
			
			<?php comment_id_fields(); do_action('comment_form', $post->ID); ?>

			<p class="input-row message-row"><textarea class="text_area" rows="3" cols="80" name="comment" id="comment" tabindex="4"  placeholder="留言内容……"></textarea></p>
			<p class="send"><input type="submit" name="submit" class="button" id="submit" tabindex="5" value="发送评论"/></p>
		
		</form>
	</div>

</div>