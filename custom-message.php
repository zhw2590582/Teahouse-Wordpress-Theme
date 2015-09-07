<?php 
/* 
Template Name: 留言页面
*/ $meta_data = get_post_meta( get_the_ID(), 'message_page', true );$featured = $meta_data['i_page_image'];
$wall = cs_get_option('i_comment_wall');
$num = cs_get_option('i_comment_num');

?>
<?php get_header(); ?>
		<!-- 留言页面 -->
		<div id="content">
			<div class="posts fade out">					<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>				<article <?php post_class('post'); ?>>								<div class="box-wrap">						<div class="box">							 <?php if (!empty($featured)) { ?>											<a class="featured-image" href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><img src="<?php echo $featured; ?>" class="attachment-large-image wp-post-image ajax_gif"></a>							 <?php } else { ?>								<?php if ( has_post_thumbnail()) { ?>									<a class="featured-image" href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_post_thumbnail( 'large-image' ); ?></a>								<?php } ?>							<?php } ?>										<div class="post-content">								<header>									<h2 class="entry-title"><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></h2>									<ul class="top_meta"></ul>								</header>								<div class="content">									<?php the_content(__( 'Read More','island')); ?>
									
									<!-- start 读者墙  Edited By iSayme-->
									<?php if ($wall == true) {
										$query="SELECT COUNT(comment_ID) AS cnt, comment_author, comment_author_url, comment_author_email FROM (SELECT * FROM $wpdb->comments LEFT OUTER JOIN $wpdb->posts ON ($wpdb->posts.ID=$wpdb->comments.comment_post_ID) WHERE comment_date > date_sub( NOW(), INTERVAL 24 MONTH ) AND user_id='0' AND comment_author_email != '改成你的邮箱账号' AND post_password='' AND comment_approved='1' AND comment_type='') AS tempcmt GROUP BY comment_author_email ORDER BY cnt DESC LIMIT ".$num."";//大家把管理员的邮箱改成你的,最后的这个39是选取多少个头像，大家可以按照自己的主题进行修改,来适合主题宽度
										$wall = $wpdb->get_results($query);
										$maxNum = $wall[0]->cnt;
										foreach ($wall as $comment)
										{
											$width = round(40 / ($maxNum / $comment->cnt),2);//此处是对应的血条的宽度
											if( $comment->comment_author_url )
											$url = $comment->comment_author_url;
											else $url="#";
											$avatar = get_avatar( $comment->comment_author_email, $size = '24', $default = get_bloginfo('wpurl').'/avatar/default.jpg' );
											$tmp = "<li><a class='with-tooltip' data-tooltip='".$comment->comment_author."' target=\"_blank\" href=\"".$comment->comment_author_url."\">".$avatar."</a><span class='cnt'>".$comment->cnt."</span></li>";
											$output .= $tmp;
										 }
										$output = "<ul class=\"readers-list\">".$output."<div class='clearfix'></div></ul>";
										echo $output ;
									}?>
									<!-- end 读者墙 -->	
																	</div>							</div>							<div class="clearfix"></div>						</div>					</div>					</article>					<?php endwhile; ?>				<?php endif; ?>		   </div>			<!-- 评论 -->			<?php if ('open' == $post->comment_status) { ?>			<div id="comment-jump" class="comments">				<?php comments_template(); ?>			</div>			<?php } ?>	
		</div>
		<?php get_footer(); ?>