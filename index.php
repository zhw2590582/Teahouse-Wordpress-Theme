<?php
// 获取选项
$pagination = cs_get_option('i_pagination'); 
$like = cs_get_option( 'i_post_like' );
?> 

<?php get_header(); ?>	
		<!-- 文章内容 -->		
		<div id="content">
				<!-- 标题 -->
				<?php if(is_search()) { ?>
					<h2 class="archive-title"><i class="fa fa-search"></i> <?php printf( __( 'Search Results for: %s', 'island' ), '<span>' . get_search_query() . '</span>' ); ?></h2>
				<?php } else if(is_tag()) { ?>
					<h2 class="archive-title"><i class="fa fa-tags"></i> <?php single_tag_title(); ?></h2>
				<?php } else if(is_day()) { ?>
					<h2 class="archive-title"><i class="icon-time"></i> <?php _e('Archive:','island'); ?> <?php echo get_the_date(); ?></h2>
				<?php } else if(is_month()) { ?>
					<h2 class="archive-title"><i class="fa fa-calendar"></i> <?php echo get_the_date('F Y'); ?></h2>
				<?php } else if(is_year()) { ?>
					<h2 class="archive-title"><i class="fa fa-calendar"></i> <?php echo get_the_date('Y'); ?></h2>	
				<?php } else if(is_category()) { ?>
					<h2 class="archive-title"><i class="fa fa-list-ul"></i> <?php single_cat_title(); ?></h2>
				<?php } else if(is_author()) { ?>
					<h2 class="archive-title"><i class="fa fa-user"></i> <?php
					$curauth = (isset($_GET['author_name'])) ? get_user_by('slug', $author_name) : get_userdata(intval($author)); echo $curauth->display_name; ?></h2>
				<?php } ?>
			<div class="posts <?php if (!is_mobile()) { ?> fadeInDown animated<?php }?>">
				
				<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
				<?php setPostViews(get_the_ID());?>
				<article <?php post_class('post'); ?>>
				
					<?php
						if(!get_post_format()) {
						   get_template_part('format', 'standard');
						} else {
						   get_template_part('format', get_post_format());
						};
					?>									
					<div class="clearfix"></div>
						</div><!-- box -->

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
					<div class="clearfix"></div>
					</div><!-- box wrap -->
				</article><!-- article-->	
				<?php endwhile; ?>
				<?php endif; ?>
			</div>
			
			<!-- 分页 -->
			<?php if ( $pagination == 'i_ajax' || $pagination == 'i_next') { ?>
				<?php if( island_page_has_nav() ) : ?>	
					<div class="post-nav">
						<div class="post-nav-inside">
							<div class="post-nav-left"><?php previous_posts_link(__('上一页', 'island')) ?></div>
							<div class="post-nav-right"><?php next_posts_link(__('下一页', 'island')) ?></div>	
						</div>
					</div>
				<?php endif; ?>
			<?php } else { ?>
			
				<div class="posts-nav">
					<div class="nav-inside">
					<?php echo paginate_links(array(
						'prev_next'          => 0,
						'before_page_number' => '',
						'mid_size'           => 2,
					));?>
					</div>
				</div>
				
				<?php // pagination($query_string); ?>
				
			<?php } ?>			
			
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