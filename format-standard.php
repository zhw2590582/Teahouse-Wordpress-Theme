<?php
// 获取选项
$excerpt = cs_get_option( 'i_post_readmore' ); 
$qrcodes = cs_get_option( 'i_code_qrcodes' ); 
$qrcodes_img = cs_get_option( 'i_qrcodes_img' ); 
$font = cs_get_option( 'i_post_font' );
$view = cs_get_option( 'i_post_view' );
$featured = cs_get_option( 'i_post_featured' );
$author = cs_get_option( 'i_post_author' );
?> 		
	<!-- 标准 -->
	
	<div class="box-wrap">
		<div class="box">
		<?php if(!is_single() || $featured == true) { ?>
			<?php if ( has_post_thumbnail()) { ?>
				<a class="featured-image" href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_post_thumbnail( 'large-image' ); ?></a>
			<?php } ?>	
		<?php } ?>		
			<div class="post-content">
				<header>
					<?php if(is_single() || is_page()) { ?>
						<h1 class="entry-title"><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></h1>
					<?php } else { ?>					
						<h2 class="entry-title"><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></h2>
					<?php } ?>
				
					<?php if(is_page()) { ?>
					<ul class="top_meta"></ul>
					<?php } else { ?>
					<ul class="top_meta">
						<li class="mate-cat"><i class="fa fa-folder-open-o"></i><?php the_category(' '); ?></li>
						<li class="mate-time"><i class="fa fa-clock-o"></i><?php echo '发表于 '.timeago( get_gmt_from_date(get_the_time('Y-m-d G:i:s')) ); ?></li>
						<?php if ($view == true) { ?>
						<li class="mate-view"><i class="fa fa-eye"></i><?php echo getPostViews(get_the_ID()); ?>次浏览</li>
						<?php } ?>
						<li class="mate-com"><i class="fa fa-comments-o"></i><a href="<?php the_permalink(); ?>#comments-title" title="comments"><?php comments_number(__('暂无评论','island'),__('1条评论','island'),__( '%条评论','island') );?></a></li>
						<?php if ($author == true) { ?>
						<li class="mate-author"><i class="fa fa-eye"></i><?php the_author_posts_link(); ?></li>
						<?php } ?>						
						<li><?php edit_post_link( __( '<i class="fa fa-edit"></i>编辑', 'island' ), '<div class="edit-link" alt="编辑文章"  title="编辑文章">', '</div>' ); ?></li>
						<div class="clearfix"></div>
					</ul>				
					<?php } ?>			
				</header>
				
				<div class="content">
				<?php if(is_search() || is_archive()) { ?>
					<div class="excerpt-more">
						<?php the_excerpt(__( 'Read More','island')); ?>
					</div>
				<?php } else { ?>
						
					<?php if(is_home()) { ?>
						<?php if ($excerpt == true) {
							the_excerpt(__( 'Read More','island'));
						}else{
							the_content(__( 'Read More','island'));
						}?>										
					<?php } else { ?>	
						<?php the_content(__( 'Read More','island')); ?>
					<?php } ?>			
					
				<?php } ?>	

				<?php wp_link_pages('before=<div class="article-nav">&after=</div>&next_or_number=next&previouspagelink=上一页&nextpagelink=下一页'); ?> 										
				
				</div>
			</div><!-- post content -->	
			