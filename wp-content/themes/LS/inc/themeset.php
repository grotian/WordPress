<?php
$themename = '主题';

$options = array (

	//基本设置
	array( "name" => "基本设置","type" => "section","desc" => "主题的基本设置，包括模块是否开启等"),
	
	array( "name" => "网站描述","type" => "tit"),
	array( "id" => "d_description","type" => "text","std" => "输入你的网站描述，一般不超过200个字符"),	
	
	array( "name" => "底部公告","type" => "tit"),
	array( "id" => "d_notice_bottom","type" => "textarea"),
	
	array( "name" => "禁止站内pingback","type" => "tit"),
	array( "id" => "d_nopingback_b","type" => "checkbox" ),

	array( "name" => "开启全站 Ajax","type" => "tit"),
	array( "id" => "d_ajax_b","type" => "checkbox" ),
	

	array( "type" => "endtag"),
	


	//SNS设置
	array( "name" => "SNS设置","type" => "section" ),
	
    array( "name" => "开启","type" => "tit"),
	array( "id" => "d_sns_open","type" => "checkbox" ),
	
	array( "name" => "邮箱地址","type" => "tit"),
	array( "id" => "d_mail_b","type" => "checkbox" ),
	array( "id" => "d_mail","type" => "text","class" => "d_inp_short","std" => "315133458@qq.com"),
	
    array( "name" => "新浪微博","type" => "tit"),
	array( "id" => "d_rss_sina_b","type" => "checkbox" ),
	array( "id" => "d_rss_sina","type" => "text","class" => "d_inp_short","std" => "http://weibo.com/"),
	
	array( "name" => "twitter","type" => "tit"),
	array( "id" => "d_rss_twitter_b","type" => "checkbox" ),
	array( "id" => "d_rss_twitter","type" => "text","class" => "d_inp_short","std" => "http://twitter.com"),
	
	array( "name" => "Google+","type" => "tit"),
	array( "id" => "d_rss_google_b","type" => "checkbox" ),
	array( "id" => "d_rss_google","type" => "text","class" => "d_inp_short","std" => "https://plus.google.com "),
	
	array( "name" => "Github","type" => "tit"),
	array( "id" => "d_rss_github_b","type" => "checkbox" ),
	array( "id" => "d_rss_github","type" => "text","class" => "d_inp_short","std" => "https://github.com/mastermay"),
	
	array( "name" => "facebook","type" => "tit"),
	array( "id" => "d_rss_facebook_b","type" => "checkbox" ),
	array( "id" => "d_rss_facebook","type" => "text","class" => "d_inp_short","std" => "http://facebook.com"),
	
	array( "name" => "instagram","type" => "tit"),
	array( "id" => "d_rss_instagram_b","type" => "checkbox" ),
	array( "id" => "d_rss_instagram","type" => "text","class" => "d_inp_short","std" => "http://instagram.com"),
	
	array( "name" => "腾讯微博","type" => "tit"),
	array( "id" => "d_rss_tencent_b","type" => "checkbox" ),
	array( "id" => "d_rss_tencent","type" => "text","class" => "d_inp_short","std" => "http://t.qq.com"),

	array( "name" => "RSS订阅地址","type" => "tit"),
	array( "id" => "d_rss_b","type" => "checkbox" ),
	array( "id" => "d_rss","type" => "text","class" => "d_inp_short","std" => "http://jjlin.net/feed"),

	array( "type" => "endtag"),


);

function mytheme_add_admin() {
	global $themename, $options;
	if ( $_GET['page'] == basename(__FILE__) ) {
		if ( 'save' == $_REQUEST['action'] ) {
			foreach ($options as $value) {
				update_option( $value['id'], $_REQUEST[ $value['id'] ] ); 
			}
			/*
			foreach ($options as $value) {
				if( isset( $_REQUEST[ $value['id'] ] ) ) { update_option( $value['id'], $_REQUEST[ $value['id'] ]  ); }
				else { delete_option( $value['id'] ); } 
			}
			*/
			header("Location: admin.php?page=themeset.php&saved=true");
			die;
		}
		else if( 'reset' == $_REQUEST['action'] ) {
			foreach ($options as $value) {delete_option( $value['id'] ); }
			header("Location: admin.php?page=themeset.php&reset=true");
			die;
		}
	}
	add_theme_page($themename." Options", $themename."设置", 'edit_themes', basename(__FILE__), 'mytheme_admin');
}

function mytheme_admin() {
	global $themename, $options;
	$i=0;
	if ( $_REQUEST['saved'] ) echo '<div class="d_message">'.$themename.'修改已保存</div>';
	if ( $_REQUEST['reset'] ) echo '<div class="d_message">'.$themename.'已恢复设置</div>';
?>

 
 <style type="text/css">
a,input,button,select,textarea{outline:0}.d_wrap{position:relative;font-family:'microsoft yahei'}.d_wrap h2{font-family:'microsoft yahei';border-bottom:double 3px #e1e1e1;padding-bottom:25px}.d_message{position:absolute;top:5px;right:5px;background-color:#fdebae;padding:6px 20px 8px 20px;color:#333;border:1px solid #e6c555}.d_themedesc{font-size:12px;margin-left:20px}.d_desc:after{content:".";display:block;height:0;clear:both;visibility:hidden}.d_desc{height:1%}.d_formwrap{padding-left:140px;position:relative;border-radius:3px}.d_tab{width:140px;text-align:right;position:absolute;top:0;left:0;border-right:solid 1px #ddd;height:100%;box-shadow:inset -2px 0 0 #f9f9f9}.d_tab ul{margin:7px 0}.d_tab ul li{padding:8px 25px 8px 0;cursor:pointer;color:#444}.d_tab ul li:hover{color:#777}.d_tab ul li.d_tab_on{background:#fafafa;color:#777;font-weight:bold}.d_mainbox{display:none}.d_desc{margin:10px 5px 0 25px}.d_inner{padding:0 0 10px 25px}.d_inner h4{font-size:12px;color:#333;position:relative;margin:0 0 10px;padding-top:15px}.d_line{background:#e4e4e4;height:1px;overflow:hidden;display:block;clear:both;margin:15px 15px 20px -115px}#wpcontent .d_inner select{border:#bed1dd 1px solid;padding:4px;height:29px;line-height:24px;border-radius:2px;width:100px;margin-right:5px;color:#444}.d_tip{display:none}.d_tips{color:#bbb}.d_inner input[type="text"]{border:solid 1px #dadada;border-left-color:#ccc;border-top-color:#ccc;box-shadow:inset 0 1px 0 #eee;background-color:#fff;padding:4px 6px;height:30px;line-height:20px;color:#888;font-size:12px;margin-bottom:6px;margin-right:5px;width:50%;border-radius:1px;font-family:'microsoft yahei'}.d_inner input[type="text"].d_inp_short{width:360px;display:inline}.d_inner input[type="text"].d_inp_four{width:100px;display:inline}.d_check{padding:4px 6px;display:inline-block;width:50px;margin:0 20px -2px 1px;color:#666}.d_check input{vertical-align:-3px;margin-right:3px}.d_number{color:#444}.d_num{width:60px;border-color:#bed1dd}.d_tarea{width:50%;min-height:64px;border:solid 1px #dadada;border-left-color:#ccc;border-top-color:#ccc;box-shadow:inset 0 1px 0 #eee;background-color:#fff;padding:5px 6px;border-radius:2px;line-height:18px;color:#444;display:block;font-family:microsoft yahei;font-size:12px}.d_inner input,.d_inner textarea{color:#888}.d_inner input:focus,.d_inner textarea:focus{border-color:#95c8f1;box-shadow:0 0 4px #95c8f1;color:#444}.d_inner .d_inp,.d_inner .d_tarea{display:block}#d_quicker{height:600px;position:;margin:20px 0 -10px 0;font-family:"Courier New",Courier,monospace;color:#444;clear:both}#d_quicker:focus{border-color:#bed1dd;color:#333}.d_quicker_menu{color:#666;text-align:center}.d_quicker_menu li{background:none repeat scroll 0 0 #ff6543;border:1px solid #d44b29;box-shadow:0 1px 0 rgba(255,255,255,0.25) inset,0 2px 0 #af2300,0 3px 3px rgba(0,0,0,0.5);color:#fff;cursor:pointer;font-size:12px;padding:4px 12px 3px;text-decoration:none;text-shadow:0 -1px 0 rgba(0,0,0,0.3);float:left;margin-right:20px}.d_quicker_menu li:hover{background:none repeat scroll 0 0 #ff6543;border-color:#c92b00;box-shadow:0 -1px 3px #c92b00 inset,0 1px 0 rgba(255,255,255,0.25) inset,0 -1px 0 rgba(0,0,0,0.05) inset,0 1px 0 rgba(255,255,255,0.75),0 -1px 0 rgba(0,0,0,0.15);margin-top:0}.d_port_btn{font-size:12px;font-weight:normal;display:inline-block}.d_port_btn a{margin-left:12px;cursor:pointer}.d_popup_mask{width:100%;height:100%;background:#000;opacity:.3;position:fixed;top:0;left:0;z-index:99998}.d_popup{position:fixed;top:50%;left:50%;margin:-200px 0 0 -300px;width:600px;height:400px;border:#4e7d9a 1px solid;background:#fff;padding:12px;display:none;z-index:99999;box-shadow:0 0 10px #666}.d_popup h3{border-bottom:#d1e5ee 1px solid;box-shadow:inset 1px 1px 1px #298cba;background:#23769d;height:32px;font:bold 14px/32px microsoft yahei;margin:-12px -12px 0;color:#fff;position:relative;padding-left:12px;text-shadow:0 0 2px #195571}.d_popup h3 input{float:right;margin:4px 12px 0 0}.d_popup h4{margin:10px 0;font-weight:normal;font-size:12px}.d_popup textarea{width:50%;min-height:330px;border:#d1e5ee 1px solid;border-left-color:#bed1dd;border-top-color:#bed1dd;background:#fff;padding:8px 10px;border-radius:2px;line-height:18px;color:#444}.d_popup textarea:focus{border:#edc97f 2px solid;background:#fff;padding:7px 9px}.d_btn_this{text-align:center}.d_the_desc{background:#eff8ff;border:#bed1dd 1px solid;border-bottom-color:#d1e5ee;border-top-left-radius:3px;border-bottom-left-radius:3px;padding:5px 8px;color:#21759b;margin-right:-3px;position:relative;z-index:10;vertical-align:middle;top:-2px}.d_adviewcon{width:96%;padding-top:5px;overflow:hidden}
</style>


<script type="text/javascript">
jQuery(document).ready(function($){$('.d_mainbox:eq(0)').show();$('.d_tab ul li').each(function(i){$(this).click(function(){$(this).addClass('d_tab_on').siblings().removeClass('d_tab_on');$($('.d_mainbox')[i]).show().siblings('.d_mainbox').hide()})});$.fn.extend({insertAtCaret:function(myValue){var $t=$(this)[0];if(document.selection){this.focus();sel = document.selection.createRange();sel.text = myValue;this.focus()}else if($t.selectionStart || $t.selectionStart == '0'){var startPos = $t.selectionStart;var endPos = $t.selectionEnd;var scrollTop = $t.scrollTop;$t.value = $t.value.substring(0,startPos)+myValue+$t.value.substring(endPos,$t.value.length);this.focus();$t.selectionStart = startPos+myValue.length;$t.selectionEnd = startPos+myValue.length;$t.scrollTop = scrollTop}else{this.value+= myValue;this.focus()}}})})
</script>



<div class="wrap d_wrap">
	
	<h2><?php echo $themename; ?>设置
		
	</h2>
	
	<form method="post" class="d_formwrap">
		<div class="d_tab">
			<ul>
				<li class="d_tab_on">基本设置</li>
				<li>SNS设置</li>
			</ul>
		</div>
		<?php foreach ($options as $value) { switch ( $value['type'] ) { case "": ?>
			<?php break; case "tit": ?>
			</li><li class="d_li">
			<h4><?php echo $value['name']; ?>：</h4>
			<div class="d_tip"><?php echo $value['tip']; ?></div>
			
			<?php break; case 'text': ?>
			<input class="d_inp <?php echo $value['class']; ?>" name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>" type="<?php echo $value['type']; ?>" value="<?php if ( get_settings( $value['id'] ) != "") { echo stripslashes(get_settings( $value['id'])  ); } else { echo $value['std']; } ?>" />

			<?php break; case 'number': ?>
			<label class="d_number"><?php echo $value['txt']; ?><input class="d_num <?php echo $value['class']; ?>" name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>" type="<?php echo $value['type']; ?>" value="<?php if ( get_settings( $value['id'] ) != "") { echo stripslashes(get_settings( $value['id'])  ); } else { echo $value['std']; } ?>" /></label>
			
			<?php break; case 'textarea': ?>
			<textarea class="d_tarea" name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>" type="<?php echo $value['type']; ?>" cols="" rows=""><?php if ( get_settings( $value['id'] ) != "") { echo stripslashes(get_settings( $value['id']) ); } else { echo $value['std']; } ?></textarea>
			
			<?php break; case 'select': ?>
			<?php if ( $value['desc'] != "") { ?><span class="d_the_desc" id="<?php echo $value['id']; ?>_desc"><?php echo $value['desc']; ?></span><?php } ?><select class="d_sel" name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>">
				<?php foreach ($value['options'] as $option) { ?>
				<option <?php if (get_settings( $value['id'] ) == $option) { echo 'selected="selected" class="d_sel_opt"'; } ?>><?php echo $option; ?></option>
				<?php } ?>
			</select>
			
			<?php break; case "checkbox": ?>
			<?php if(get_settings($value['id']) != ""){ $checked = "checked=\"checked\""; }else{ $checked = "";} ?>
			<label class="d_check"><input type="checkbox" id="<?php echo $value['id']; ?>" name="<?php echo $value['id']; ?>" <?php echo $checked; ?> />开启</label>
			
			<?php break; case "section": $i++; ?>
			<div class="d_mainbox" id="d_mainbox_<?php echo $i; ?>">
				<ul class="d_inner">
					<li class="d_li">
				
			<?php break; case "endtag": ?>
			</li></ul>
			<div class="d_desc"><input class="button-primary" name="save<?php echo $i; ?>" type="submit" value="保存设置" /></div>
			</div>
			
		<?php break; }} ?>
				
		<input type="hidden" name="action" value="save" />

	</form>

</div>
<script src="<?php bloginfo('template_url') ?>/js/jquery-1.7.2.min.js"></script> 
<?php } ?>
<?php add_action('admin_menu', 'mytheme_add_admin');?>