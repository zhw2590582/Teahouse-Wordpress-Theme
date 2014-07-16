<?php 
/* 
Template Name: Custom Archive
*/ 
?>

<?php get_header(); ?>
		
		<div id="content">
			<div class="posts">
	
				<!-- grab the posts -->
				<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
				
				<article <?php post_class('post'); ?>>

					<!-- grab the music -->
					<?php if ( get_post_meta($post->ID, 'music', true) ) { ?>
					
					<div class="post-image audio post-format-audio">
						<!-- grab the featured image -->
					<?php if ( get_post_meta($post->ID, 'picture', true) ) { ?>
							<a class="featured-image" href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
							<img src="<?php echo get_post_meta( $post->ID, 'picture', true ); ?>" class="attachment-large-image wp-post-image">					
							</a>
					<?php } else { ?>
						<?php if ( has_post_thumbnail() ) { ?>
							<a class="featured-image" href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
							<?php the_post_thumbnail( 'large-image' ); ?>
							</a>
						<?php } ?>
					<?php } ?>
						
						<div class="audio-wrapper">
							<div class="me-wrap">
							<audio class="wp-audio-shortcode" preload="none" style="width: 100%">
							<source type="audio/mpeg" src="<?php echo get_post_meta( $post->ID, 'music', true ); ?>">
							</audio>
							</div>
						</div>						
					</div>
					<?php } else { ?>
					
						<!-- grab the featured image -->
					<?php if ( get_post_meta($post->ID, 'picture', true) ) { ?>
							<a class="featured-image" href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
							<img src="<?php echo get_post_meta( $post->ID, 'picture', true ); ?>" class="attachment-large-image wp-post-image">				
							</a>
					<?php } else { ?>
						<?php if ( has_post_thumbnail() ) { ?>
							<a class="featured-image" href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
							<?php the_post_thumbnail( 'large-image' ); ?>
							</a>
						<?php } ?>
					<?php } ?>
					
					<?php } ?>
					
					<div class="box-wrap">
						<div class="box">
							<header>
								<div class="date-title"><?php echo get_the_date(); ?></div>
								
								<?php if(is_single() || is_page()) { ?>
									<h1 class="entry-title"><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></h1>
								<?php } else { ?>					
									<h2 class="entry-title"><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></h2>
								<?php } ?>
							</header>
							
							<!-- post content -->
							<div class="post-content">
								<?php the_content(__( 'Read More','teahouse')); ?>
								<div id="archive">
										<?php zww_archives_list(); ?>
								</div><!-- archive -->
							</div><!-- post content -->
						</div><!-- box -->
					</div><!-- box wrap -->
				</article><!-- post-->	
				
				<?php endwhile; ?>
				<?php endif; ?>
			</div>

		</div><!-- content -->
	
		<!-- footer -->
		<?php get_footer(); ?>