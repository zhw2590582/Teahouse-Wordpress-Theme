<?php
/**
 * WordPress 內置嵌套評論專用 Ajax comments >> WordPress-jQuery-Ajax-Comments v1.3 by Willin Kan.
 *
 * 說明: 這個文件是由 WP 3.0 根目錄的 wp-comment-post.php 修改的, 修改的地方有注解. 當 WP 升級, 請注意可能有所不同.
 */

if ( 'POST' != $_SERVER['REQUEST_METHOD'] ) {
	header('Allow: POST');
	header('HTTP/1.1 405 Method Not Allowed');
	header('Content-Type: text/plain');
	exit;
}

/** Sets up the WordPress Environment. */
require( dirname(__FILE__) . '/../../../wp-load.php' ); // 此 comments-ajax.php 位於主題資料夾,所以位置已不同

nocache_headers();

$comment_post_ID = isset($_POST['comment_post_ID']) ? (int) $_POST['comment_post_ID'] : 0;

$post = get_post($comment_post_ID);

if ( empty($post->comment_status) ) {
	do_action('comment_id_not_found', $comment_post_ID);
	err(__('Invalid comment status.')); // 將 exit 改為錯誤提示
}

// get_post_status() will get the parent status for attachments.
$status = get_post_status($post);

$status_obj = get_post_status_object($status);

if ( !comments_open($comment_post_ID) ) {
	do_action('comment_closed', $comment_post_ID);
	err(__('Sorry, comments are closed for this item.')); // 將 wp_die 改為錯誤提示
} elseif ( 'trash' == $status ) {
	do_action('comment_on_trash', $comment_post_ID);
	err(__('Invalid comment status.')); // 將 exit 改為錯誤提示
} elseif ( !$status_obj->public && !$status_obj->private ) {
	do_action('comment_on_draft', $comment_post_ID);
	err(__('Invalid comment status.')); // 將 exit 改為錯誤提示
} elseif ( post_password_required($comment_post_ID) ) {
	do_action('comment_on_password_protected', $comment_post_ID);
	err(__('Password Protected')); // 將 exit 改為錯誤提示
} else {
	do_action('pre_comment_on_post', $comment_post_ID);
}

$comment_author       = ( isset($_POST['author']) )  ? trim(strip_tags($_POST['author'])) : null;
$comment_author_email = ( isset($_POST['email']) )   ? trim($_POST['email']) : null;
$comment_author_url   = ( isset($_POST['url']) )     ? trim($_POST['url']) : null;
$comment_content      = ( isset($_POST['comment']) ) ? trim($_POST['comment']) : null;
$edit_id              = ( isset($_POST['edit_id']) ) ? $_POST['edit_id'] : null; // 提取 edit_id

// If the user is logged in
$user = wp_get_current_user();
if ( $user->ID ) {
	if ( empty( $user->display_name ) )
		$user->display_name=$user->user_login;
	$comment_author       = $wpdb->escape($user->display_name);
	$comment_author_email = $wpdb->escape($user->user_email);
	$comment_author_url   = $wpdb->escape($user->user_url);
	if ( current_user_can('unfiltered_html') ) {
		if ( wp_create_nonce('unfiltered-html-comment_' . $comment_post_ID) != $_POST['_wp_unfiltered_html_comment'] ) {
			kses_remove_filters(); // start with a clean slate
			kses_init_filters(); // set up the filters
		}
	}
} else {
	if ( get_option('comment_registration') || 'private' == $status )
		err(__('Sorry, you must be logged in to post a comment.')); // 將 wp_die 改為錯誤提示
}

$comment_type = '';

if ( get_option('require_name_email') && !$user->ID ) {
	if ( 6 > strlen($comment_author_email) || '' == $comment_author )
		err( __('Error: please fill the required fields (name, email).') ); // 將 wp_die 改為錯誤提示
	elseif ( !is_email($comment_author_email))
		err( __('Error: please enter a valid email address.') ); // 將 wp_die 改為錯誤提示
}

if ( '' == $comment_content )
	err( __('Error: please type a comment.') ); // 將 wp_die 改為錯誤提示

// 增加: 錯誤提示功能
function err($ErrMsg) {
    header('HTTP/1.1 405 Method Not Allowed');
    echo $ErrMsg;
    exit;
}

// 增加: 檢查重覆評論功能
$dupe = "SELECT comment_ID FROM $wpdb->comments WHERE comment_post_ID = '$comment_post_ID' AND ( comment_author = '$comment_author' ";
if ( $comment_author_email ) $dupe .= "OR comment_author_email = '$comment_author_email' ";
$dupe .= ") AND comment_content = '$comment_content' LIMIT 1";
if ( $wpdb->get_var($dupe) ) {
    err(__('Duplicate comment detected; it looks as though you&#8217;ve already said that!'));
}

// 增加: 檢查評論太快功能
if ( $lasttime = $wpdb->get_var( $wpdb->prepare("SELECT comment_date_gmt FROM $wpdb->comments WHERE comment_author = %s ORDER BY comment_date DESC LIMIT 1", $comment_author) ) ) { 
$time_lastcomment = mysql2date('U', $lasttime, false);
$time_newcomment  = mysql2date('U', current_time('mysql', 1), false);
$flood_die = apply_filters('comment_flood_filter', false, $time_lastcomment, $time_newcomment);
if ( $flood_die ) {
    err(__('You are posting comments too quickly.  Slow down.'));
	}
}

$comment_parent = isset($_POST['comment_parent']) ? absint($_POST['comment_parent']) : 0;

$commentdata = compact('comment_post_ID', 'comment_author', 'comment_author_email', 'comment_author_url', 'comment_content', 'comment_type', 'comment_parent', 'user_ID');

// 增加: 檢查評論是否正被編輯, 更新或新建評論
if ( $edit_id ){
$comment_id = $commentdata['comment_ID'] = $edit_id;
wp_update_comment( $commentdata );
} else {
$comment_id = wp_new_comment( $commentdata );
}

$comment = get_comment($comment_id);
if ( !$user->ID ) {
	$comment_cookie_lifetime = apply_filters('comment_cookie_lifetime', 30000000);
	setcookie('comment_author_' . COOKIEHASH, $comment->comment_author, time() + $comment_cookie_lifetime, COOKIEPATH, COOKIE_DOMAIN);
	setcookie('comment_author_email_' . COOKIEHASH, $comment->comment_author_email, time() + $comment_cookie_lifetime, COOKIEPATH, COOKIE_DOMAIN);
	setcookie('comment_author_url_' . COOKIEHASH, esc_url($comment->comment_author_url), time() + $comment_cookie_lifetime, COOKIEPATH, COOKIE_DOMAIN);
}

//$location = empty($_POST['redirect_to']) ? get_comment_link($comment_id) : $_POST['redirect_to'] . '#comment-' . $comment_id; //取消原有的刷新重定向
//$location = apply_filters('comment_post_redirect', $location, $comment);

//wp_redirect($location);

$comment_depth = 1;   //为评论的 class 属性准备的
$tmp_c = $comment;
while($tmp_c->comment_parent != 0){
$comment_depth++;
$tmp_c = get_comment($tmp_c->comment_parent);
}

//以下是評論式樣, 不含 "回覆". 要用你模板的式樣 copy 覆蓋.
?>
	<li <?php comment_class('clearfix'); ?> id="li-comment-<?php comment_ID() ?>">
	<span class="commentcount"><?php echo $commentcountText; ?></span>	
		<div class="comment-block" id="comment-<?php comment_ID(); ?>">			<div class="author-img"><?php echo get_avatar($comment->comment_author_email, 50); ?></div>			<div class="comment-body">				<div class="comment-name"><?php printf(__('<cite class="fn">%s</cite>', 'island') , get_comment_author_link()) ?><?php comment_admin_title($comment->comment_author_email); ?></div>
				<div class="comment-text">					<?php comment_text() ?>							</div>				<div class="comment-info">					<span class="comment-date">							<a class="comment-time" href="<?php echo esc_url(get_comment_link($comment->comment_ID)) ?>">							<?php printf(__('%1$s - %2$s', 'island') , get_comment_date('m/d/Y') , get_comment_time()) ?></a>					</span>					<span class="comment-reply">						<?php comment_reply_link(array_merge((array)$args, array(							'depth' => $depth,							'max_depth' => $args['max_depth']						))) ?>					</span>							<span class="comment-edit">						<?php edit_comment_link(__('(Edit)', 'island') , '  ', '') ?>					</span>						<div class="clearfix"></div>				</div>								<?php if ($comment->comment_approved == '0'): ?>					<em class="comment-awaiting-moderation">					<?php _e('Your comment is awaiting moderation.', 'island') ?></em>				<?php endif; ?> 				<div class="clearfix"></div>			</div>		</div>