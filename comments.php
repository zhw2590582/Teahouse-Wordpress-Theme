<?php
/**
* The template for displaying Comments.
*
* The area of the page that contains both current comments
* and the comment form. The actual display of comments is
* handled by a callback to island_comment() which is
* located in the functions.php file.*
* @package WordPress
* @subpackage island
* @since island 1.0
*/
if (!empty($_SERVER['SCRIPT_FILENAME']) && 'comments.php' == basename($_SERVER['SCRIPT_FILENAME']))
	die ('Please do not load this page directly. Thanks!');
if ( post_password_required() ) { ?>
	<p class="nocomments"><?php _e('This post is password protected. Enter the password to view comments.', 'island'); ?></p>
<?php
	return;
}
?>
<div id="comments">
	<h3 id="comments-title">
		<?php comments_number(__('Leave A Comment','island'),__('1 Comment','island'),__( '% Comments','island') );?>
	</h3>	<div id="loading-comments"><span><i class="fa fa-spinner fa-pulse"></i> Loading...</span></div>
		<ol class="commentlist">
			<?php wp_list_comments("callback=island_comment"); ?>
		</ol>
		<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : // are there comments to navigate through ?>
		<nav id="comment-nav-below" role="navigation">			<div class="nav-inside">
			<?php paginate_comments_links('prev_next=0');?>			</div>
		</nav>
		<?php endif; // check for comment navigation ?>
		<?php comment_form(); ?>	<div class="clearfix"></div>
</div><!-- #comments -->