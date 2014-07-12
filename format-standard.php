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
							<!-- post content -->
							<div class="post-content">
								<header>
									<?php if(is_single() || is_page()) { ?>
										<h1 class="entry-title"><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></h1>
									<?php } else { ?>					
										<h2 class="entry-title"><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></h2>
									<?php } ?>
								</header>
								<div class="date-title">
								<div class="date-year"><?php echo get_the_date('d | m | Y'); ?></div>
								</div>
								<div class="my-post">
								<?php if(is_search() || is_archive()) { ?>
									<div class="excerpt-more">
										<?php the_excerpt(__( 'Read More','teahouse')); ?>
									</div>
								<?php } else { ?>
									<?php the_content(__( 'Read More','teahouse')); ?>
									
									<?php if(is_single() || is_page()) { ?>
										<div class="pagelink">
											<?php wp_link_pages(); ?>
										</div>
									<?php } ?>
								<?php } ?>
								</div>
							</div><!-- post content -->
							
							<?php if(is_page()) {} else { ?>
								<ul class="meta">
									<li class="post-category"><i class="icon-list-ul"></i><?php the_category(' '); ?></li>
									<ul class="my-meta">
									<li class="post-comments"><i class="icon-comments "></i><a href="<?php the_permalink(); ?>#comments-title" title="comments"><?php comments_number(__('0','teahouse'),__('1','teahouse'),__( '%','teahouse') );?></a></li>
									<?php
										if ( function_exists('zilla_likes')) {
										echo '<li class="likes-botton">'.PHP_EOL;
										zilla_likes();
										echo '</li>'.PHP_EOL;
										} 
									?>		
									</ul>
								</ul>
							<?php } ?>
							
						</div><!-- box -->
					</div><!-- box wrap -->
