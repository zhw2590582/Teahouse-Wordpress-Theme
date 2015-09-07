<?php
 // 获取选项
$like = cs_get_option( 'i_post_like' );
$qrcodes = cs_get_option( 'i_code_qrcodes' ); 
$qrcodes_img = cs_get_option( 'i_qrcodes_img' ); 
$view = cs_get_option( 'i_post_view' );
$meta_data = get_post_meta( get_the_ID(), 'work_options', true );
$comment = $meta_data['i_work_comment'];
$work_bg = $meta_data['i_work_bg'];
$bg_scr = $meta_data['i_work_bg_scr'];
$featured = $meta_data['i_work_featured'];
$workscom = cs_get_option( 'i_works_comment' ); 
?> 

<?php get_header(); ?>

		<div id="content">
			<div class="posts fadeInDown animated">	
				<!-- single -->
				<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
				<?php setPostViews(get_the_ID());?>
				<article <?php post_class('post'); ?>>
	
	<div class="box-wrap">
		<div class="box">
		<?php if( $featured == 'i_featured') { ?>
			<?php if ( has_post_thumbnail()) { ?>
				<a class="featured-image" href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_post_thumbnail( 'large-image' ); ?></a>
			<?php } ?>	
		<?php } else { ?>		
		<div class="slider">
			<?php	
				$my_sliders = $meta_data['i_work_custom'];
				echo '<ul class="WorkSlider">';
				if( ! empty( $my_sliders ) ) {
				  foreach ( $my_sliders as $slider ) {
					echo '<li>';
				    if( ! empty( $slider['i_work_link'] ) ){ echo '<a href="'. $slider['i_work_link'] .'"';}
					if ( ! empty( $slider['i_work_link'] ) && $slider['i_work_newtab'] == true) { echo 'target="_black">';}else{ if ( ! empty( $slider['i_work_link'] )){ echo '>';}}
					echo '<img class=" " src="'. $slider['i_work_image'] .'" />';
				    if( ! empty( $slider['i_work_link'] ) ){ echo '</a>';}				    
					echo '</li>';
				  }
				}		
				echo '</ul>';
			?>	
		</div>
		<script>
			jQuery(document).ready(function($) {
				$('.WorkSlider').lightSlider({
					mode: "fade",
					auto: true,
					loop: true,
					item:1,
					pager: false,
					pause: 4000,
					slideMargin:0,
					currentPagerPosition:'left',
					adaptiveHeight:true,
				});  	
			});
		</script>
		<?php } ?>
		
			<div class="post-content">
				<header>
					<?php if(is_single() || is_page()) { ?>
						<h1 class="entry-title"><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></h1>
					<?php } else { ?>					
						<h2 class="entry-title"><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></h2>
					<?php } ?>
				
					<ul class="top_meta">
						<li class="mate-cat"><i class="fa fa-folder-open-o"></i><?php the_category(' '); ?></li>
						<li class="mate-time"><i class="fa fa-clock-o"></i><?php echo '发表于 '.timeago( get_gmt_from_date(get_the_time('Y-m-d G:i:s')) ); ?></li>
						<?php if ($view == true) { ?>
						<li class="mate-view"><i class="fa fa-eye"></i><?php echo getPostViews(get_the_ID()); ?>次浏览</li>
						<?php } ?>
						<li class="mate-com"><i class="fa fa-comments-o"></i><a href="<?php the_permalink(); ?>#comments-title" title="comments"><?php comments_number(__('暂无评论','island'),__('1条评论','island'),__( '%条评论','island') );?></a></li>
						<li><?php edit_post_link( __( '<i class="fa fa-edit"></i>编辑', 'island' ), '<div class="edit-link" alt="编辑文章"  title="编辑文章">', '</div>' ); ?></li>
						<div class="clearfix"></div>
					</ul>				
				</header>
				
				<div class="content">
					<?php the_content(__( 'Read More','island')); ?>					
				</div>
			</div><!-- post content -->	
							
						</div>	<!-- box -->										
					<?php if(is_page()) {} else { ?>
					<!-- 文章mate -->	
					<ul class="bottom_meta">
					<li class="work_tabs"><?php $terms_as_text = get_the_term_list( $post->ID, 'genre', '', ', ', '' ) ; echo strip_tags($terms_as_text); ?></li>
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
					
				<?php endwhile; ?>
				<?php endif; ?>
			</div><!--posts-->

					
			<!-- 评论 -->
			<?php if ($comment == true && $workscom == false ) { ?>
				<div id="comment-jump" class="comments">
					<?php comments_template(); ?>
				</div>
			<?php }?>					
		</div><!-- content -->	
	
			<?php if ($work_bg == true) { ?>	
				<script src="<?php echo get_template_directory_uri(); ?>/js/backstretch.js"></script>	
				<script>
				jQuery(document).ready(function($) {
				   $.backstretch([
					  "<?php echo $bg_scr ?>"
					  ], {
						fade: 750,
						duration: 4000
					});	});	
				</script>	
				<style>
					.wrapper_bg{
						opacity:0;
					}
				</style>
			<?php }?>					
				<script>
					jQuery(window).load(function() { 
						jQuery("#loader").delay(300).fadeOut("slow");
					});
				</script>	
	
		<!-- 页脚 -->
		<?php get_footer(); ?>