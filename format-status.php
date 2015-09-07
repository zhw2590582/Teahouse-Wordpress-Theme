<?php
// 获取选项
$excerpt = cs_get_option( 'i_post_readmore' ); 
?> 		
	<!-- 状态 -->
	
	<div class="box-wrap">
		<div class="box">
			<div class="post-content">
			<div class="status-top"></div>
				<header>				
					<h2 class="entry-title"><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></h2>			
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
			
				</div>
			<div class="status-bottom"></div>
			</div><!-- post content -->	
			<div class="clearfix"></div>

