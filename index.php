<?php get_header(); ?>

		<div id="content">
			<div class="posts fade out">

				<!-- titles -->
				<?php if( is_search() ) { ?>
					<h2 class="archive-title"><i class="icon-search"></i> <?php printf( __( 'Search Results for: %s', 'teahouse' ), '<span>' . get_search_query() . '</span>' ); ?></h2>
				<?php } else if( is_tag() ) { ?>
					<h2 class="archive-title"><i class="icon-tag"></i> <?php single_tag_title(); ?></h2>
				<?php } else if( is_day() ) { ?>
					<h2 class="archive-title"><i class="icon-time"></i> <?php _e( 'Archive:', 'teahouse' ); ?> <?php echo get_the_date(); ?></h2>
				<?php } else if( is_month() ) { ?>
					<h2 class="archive-title"><i class="icon-time"></i> <?php echo get_the_date( 'F Y' ); ?></h2>
				<?php } else if( is_year() ) { ?>
					<h2 class="archive-title"><i class="icon-time"></i> <?php echo get_the_date( 'Y' ); ?></h2>
				<?php } else if( is_category() ) { ?>
					<h2 class="archive-title"><i class="icon-list-ul"></i> <?php single_cat_title(); ?></h2>
				<?php } else if( is_author() ) { ?>
					<h2 class="archive-title"><i class="icon-pencil"></i> <?php the_post(); printf( __( 'Author: %s', 'publisher' ), '' . get_the_author() . '' ); rewind_posts(); ?></h2>
				<?php } ?>

				<!-- grab the posts -->
				<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

				<article <?php post_class( 'post' ); ?>>
					<!-- grab the post format template -->
					<?php
						if( 'gallery' == get_post_format() ) {
							get_template_part( 'format', 'gallery' );
						} else if( 'status' == get_post_format() ) {
							get_template_part( 'format', 'status' );
						} else if( 'video' == get_post_format() ) {
							get_template_part( 'format', 'video' );
						} else {
							get_template_part( 'format', 'standard' );
						}
					?>
				</article><!-- post-->
				<article class="arrow"></article>
				<?php endwhile; ?>
				<?php endif; ?>
			</div>

			<!-- post navigation -->
			<?php if( teahouse_page_has_nav() ) : ?>
				<div class="post-nav <?php if ( get_option( 'teahouse_theme_customizer_infinite' ) == 'enabled' ) { echo 'infinite'; } ?>">
					<div class="post-nav-inside">
						<div class="post-nav-left"><?php previous_posts_link( __( '<i class="icon-arrow-left"></i> 上一页', 'teahouse' ) ) ?></div>
						<div class="post-nav-right"><?php next_posts_link( __( '下一页 <i class="icon-arrow-right"></i>', 'teahouse' ) ) ?></div>
					</div>
				</div>
			<?php endif; ?>

			<!-- comments -->
			<?php if( is_single () ) { ?>
				<?php if ( 'open' == $post->comment_status ) { ?>
				<div id="comment-jump" class="comments">
					<?php comments_template(); ?>
				</div>
				<?php } ?>
			<?php } ?>
		</div><!-- content -->
		<!-- footer -->
		<?php get_footer(); ?>