					<!-- Status Post Format -->
					<div class="box-wrap status-wrap">
						<div class="box">
							<div class="format-status">
								<header>
									<?php if(is_single() || is_page()) { ?>
										<h1 class="entry-title"><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></h1>
									<?php } else { ?>					
										<h2 class="entry-title"><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></h2>
									<?php } ?>
									
								</header>
								<div class="date-title"><?php echo get_the_date('d | m | Y'); ?></div>
								<div class="my-post">
								<?php the_content(__( 'Read More','teahouse')); ?>
								</div>
							</div>
						</div><!-- box -->
					</div><!-- box wrap -->
