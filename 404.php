<?php get_header(); ?>
		
		<div id="content">
			<div class="posts">
				
				<!-- grab the posts -->
				<article class="post">
					<div class="box-wrap">
						<div class="box">
							<header>
								<div class="date-title"><?php echo get_the_date(); ?></div>
								<h1 class="entry-title"><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php _e('404 - Page Not Found','teahouse'); ?></a></h1>
							</header>
							
							<!-- post content -->
							<div class="post-content">
								<p><?php _e('Sorry, but the page you are looking for has moved or no longer exists. Please use the search or the archives below to try and locate the page you were looking for.','teahouse'); ?></p>
								
								<?php get_search_form();?>
								
								<div id="archive">
									<div class="archive-col">
										<div class="archive-box">
											<ul>
												<?php wp_get_archives('type=postbypost&limit=100'); ?>
											</ul>
										</div>
									</div><!-- column -->
								</div><!-- archive -->
							</div><!-- post content -->
						</div><!-- box -->
					</div><!-- box wrap -->
				</article><!-- post-->	
			</div>
		</div><!-- content -->
	
		<!-- footer -->
		<?php get_footer(); ?>