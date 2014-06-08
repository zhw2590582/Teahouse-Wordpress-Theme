        <div class="gallery">

            <ul class="rslides">

            <?php 
                
                // get the images , fix any double comma errors , convert it to array
                $images = explode(',' , str_replace(',,' , ',' , get_post_meta(get_the_ID()  , 'buzz_media_gallery' , true)));

                foreach ($images as $image) {
                    
                    if($image != ''){
                        // get the cropped version of the image
                        if(   (strpos($image , '.jpg') !== false)   ||  (strpos($image , '.png') !== false)  )
                        {
                                $fixedImage = str_replace('.jpg' , '-940x500.jpg' , $image);
                                $fixedImage = str_replace('.png' , '-940x500.png' , $image);
                                if(file_exists($fixedImage)) $image = $fixedImage;
                        }
                    ?>
                        <li><a href="<?php echo get_permalink(); ?>"><img class="attachment-large-image" src="<?php echo $image; ?>" alt="" /></a></li>
                    <?php
                    }
                }
            ?>

                </ul>

        </div>
        <!-- end gallery -->
					
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