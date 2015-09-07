<?php 
/* 
Template Name: 作品页面
*/ 
$pagination = cs_get_option('i_pagination'); 	
$loadmore = cs_get_option( 'i_ajax_loading' );  
$loadend = cs_get_option( 'i_ajax_end' ); 
$loadnum = cs_get_option( 'i_ajax_num' ); 
$worksnum = cs_get_option( 'i_works_num' ); 
?>


<?php get_header(); ?>
		<div id="content"><div class="posts grid">
<?php 
  $temp = $wp_query; 
  $wp_query = null; 
  $wp_query = new WP_Query(); 
  $show_posts = $worksnum;  //How many post you want on per page
  $permalink = 'Post name'; // Default, Post name
  $post_type = 'work';

  //Know the current URI
  $req_uri =  $_SERVER['REQUEST_URI'];  

  //Permalink set to default
  if($permalink == 'Default') {
  $req_uri = explode('paged=', $req_uri);

  if($_GET['paged']) {
  $uri = $req_uri[0] . 'paged='; 
  } else {
  $uri = $req_uri[0] . '&paged=';
  }
  //Permalink is set to Post name
  } elseif ($permalink == 'Post name') {
  if (strpos($req_uri,'page/') !== false) {
  $req_uri = explode('page/',$req_uri);
  $req_uri = $req_uri[0] ;
  }
  $uri = $req_uri . 'page/';

  }

  //Query
  $wp_query->query('showposts='.$show_posts.'&post_type='. $post_type .'&paged='.$paged); 
  //count posts in the custom post type
 $count_posts = wp_count_posts('projects');

  while ($wp_query->have_posts()) : $wp_query->the_post(); 
  ?>

			<article <?php post_class('grid-item'); ?>><div class="work-wrap">
			<?php if ( has_post_thumbnail()) { ?>
				<a class="featured-image" href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_post_thumbnail('thumbnail'); ?></a>
			<?php } ?>				
			<?php echo '<div class="work-content">';?>
			  <?php the_title();?>
			<?php  echo '</div></div>';?>
				<ul class="work-mate">
					<li class="work_tabs"><?php $terms_as_text = get_the_term_list( $post->ID, 'genre', '', ', ', '' ) ; echo strip_tags($terms_as_text); ?></li>
					<li class="like_btn"><?php echo getPostLikeLink( get_the_ID() ); ?></li>	
				</ul>
			<?php  echo '</article>';?>

  <?php endwhile;?>
  			</div> 
		</div>
<div class="work-nav fadeInDown animated"><div class="post-nav">
	<div class="post-nav-inside">
  <?php previous_posts_link('上一页 ') ?>
  <?php
  $count_post = $count_posts->publish / $show_posts;

  if( $count_posts->publish % $show_posts == 2 ) {
  $count_post++;
  $count_post = intval($count_post);
  };

  for($i = 1; $i <= $count_post ; $i++) { ?>
  <a <?php if($req_uri[1] == $i) { echo 'class=active_page'; } ?> href="<?php echo $uri . $i; ?>" rel="external nofollow" ><?php echo $i; ?></a>
  <?php }
  ?>
  <?php next_posts_link(' 下一页') ?>
	</div>
</div>
</div>

  <?php 
  $wp_query = null; 
  $wp_query = $temp;  // Reset
  ?>

		
	<script>
	jQuery(document).ready(function($) {
		if($(".post-nav-inside a").length==0){
			$(".post-nav").removeClass("post-nav");
		} else if ($(".post-nav-inside a").length==1){
			
		}else{			
			$(".post-nav-inside a:eq(0)").wrap("<div class='post-nav-left'></div>");
			$(".post-nav-inside a:eq(1)").wrap("<div class='post-nav-right'></div>");	
		}			
	});	
	</script>	
	
<?php get_footer(); ?>