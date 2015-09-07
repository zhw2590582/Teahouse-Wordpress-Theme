<?php
 // 获取选项
$excerpt = cs_get_option( 'i_post_readmore' ); 
$next = cs_get_option( 'i_post_next' ); 
$author = cs_get_option( 'i_post_author' ); 
$link = cs_get_option( 'i_post_link' ); 
$related = cs_get_option( 'i_post_related' ); 
$mbx = cs_get_option( 'i_post_mbx' ); 
$like = cs_get_option( 'i_post_like' );?> 

<?php get_header(); ?>
		<div id="content">
			<div class="posts fade out">	
				<!-- single -->
				<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
				<?php setPostViews(get_the_ID());?>
				<article <?php post_class('post'); ?>>
					<!-- 文章格式循环 -->
					<?php
						if(!get_post_format()) {
						   get_template_part('format', 'standard');
						} else {
						   get_template_part('format', get_post_format());
						};
					?>
						
					<!-- 转载原创 -->	
					<?php if ($link == true && !is_mobile()) { ?>
					<div class="post-copyright">
						转载原创文章请注明，转载自： <a href="<?php bloginfo('url'); ?>" title="<?php bloginfo('name'); ?>"><?php bloginfo('name'); ?></a> » <a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a>
					</div>
					<?php } ?>				
						
					<!-- 相关文章 -->
					<?php if ($related == true && !is_mobile()) { ?>			
					<h3 class="related_title">相关文章</h3>
					<ul class="related_img">
						<?php
						$post_num = 4;
						$exclude_id = $post->ID;
						$posttags = get_the_tags(); $i = 0;
						if ( $posttags ) {
							$tags = ''; foreach ( $posttags as $tag ) $tags .= $tag->term_id . ',';
							$args = array(
								'post_status' => 'publish',
								'tag__in' => explode(',', $tags),
								'post__not_in' => explode(',', $exclude_id),
								'caller_get_posts' => 1,
								'orderby' => 'comment_date',
								'posts_per_page' => $post_num
							);
							query_posts($args);
							while( have_posts() ) { the_post(); ?>
								<li class="related_box"  >
								<div class="r_pic">
								<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>" >
								<img src="<?php echo post_thumbnail_src(); ?>" alt="<?php the_title(); ?>" class="thumbnail" />
								</a>
								</div>
								<div class="r_title"><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"  rel="bookmark"><?php the_title(); ?></a></div>
								</li>
							<?php
								$exclude_id .= ',' . $post->ID; $i ++;
							} wp_reset_query();
						}
						if ( $i < $post_num ) {
							$cats = ''; foreach ( get_the_category() as $cat ) $cats .= $cat->cat_ID . ',';
							$args = array(
								'category__in' => explode(',', $cats),
								'post__not_in' => explode(',', $exclude_id),
								'caller_get_posts' => 1,
								'orderby' => 'comment_date',
								'posts_per_page' => $post_num - $i
							);
							query_posts($args);
							while( have_posts() ) { the_post(); ?>
							<li class="related_box"  >
								<div class="r_pic">
								<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>" >
								<img src="<?php echo post_thumbnail_src(); ?>" alt="<?php the_title(); ?>" class="thumbnail" />
								</a>
								</div>
								<div class="r_title"><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"  rel="bookmark"><?php the_title(); ?></a></div>
							</li>
							<?php $i++;
							} wp_reset_query();
						}
						if ( $i  == 0 )  echo '<div class="r_title">没有相关文章!</div>';
						?>
					</ul>
					<?php } ?>
							
						</div>	<!-- box -->										
					<?php if(is_page()) {} else { ?>
					<!-- 文章mate -->	
					<ul class="bottom_meta">
						<?php $posttags = get_the_tags(); if ($posttags) { ?>
							<li class="meta_tabs"><?php the_tags('', ' ', ''); ?></li>
						<?php } ?>
						<?php if ($like == true) { ?>
						<!-- 喜欢按钮 -->	
						<li id="like_btn">
							<?php echo getPostLikeLink( get_the_ID() ); ?>
						</li>	
						<?php } ?>
						<div class="clearfix"></div>
					</ul>	
					<?php } ?>				
				
					</div>	<!-- box-wrap -->				
				</article><!--article-->
				<!-- 上一篇/下一篇 -->					
				<?php if ($next == true) { ?>
				<?php echo '<div class="post-nav"><div class="post-nav-inside">';?>	
				<?php if (get_previous_post()) { previous_post_link('<div class="post-nav-left">%link</div>');
				} else {
					echo '<div class="post-nav-left"><a>没有了，已经是最后文章</a></div>';}
 				if (get_next_post()) { next_post_link('<div class="post-nav-right">%link</div>');
				} else {
					echo '<div class="post-nav-right"><a>没有了，已经是最新文章</a></div>';}?>
					<?php echo '</div></div>';?>
				<?php }?>					
				<?php endwhile; ?>
				<?php endif; ?>
			</div><!--posts-->

					
			<!-- 评论 -->
			<?php if( is_single () ) { ?>
				<?php if ('open' == $post->comment_status) { ?>
				<div id="comment-jump" class="comments">
					<?php comments_template(); ?>
				</div>
				<?php } ?>
			<?php } ?>
		</div><!-- content -->	
	
		<!-- 页脚 -->
		<?php get_footer(); ?>