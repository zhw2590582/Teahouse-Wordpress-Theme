<?php
/**
 * teahouse functions and definitions
 *
 * @package teahouse
 * @since teahouse 1.0
 */

/**
 * Set the content width based on the theme's design and stylesheet.
 *
 * @since teahouse 1.0
 */
if ( ! isset( $content_width ) )
	$content_width = 690; /* pixels */

if ( ! function_exists( 'teahouse_setup' ) ):
/**
 * Sets up theme defaults and registers support for various WordPress features.
 * @since teahouse 1.0
 */
function teahouse_setup() {

	/* Add Customizer settings */
	require( get_template_directory() . '/customizer.php' );

	/* Add post styles */
	require_once( dirname( __FILE__ ) . "/includes/editor/add-styles.php" );

	/* Add default posts and comments RSS feed links to head */
	add_theme_support( 'automatic-feed-links' );

	/* Add editor styles */
	add_editor_style();

	/* Enable support for Post Thumbnails */
	add_theme_support( 'post-thumbnails' );
	set_post_thumbnail_size( 150, 150, true ); // Default Thumb
	add_image_size( 'large-image', 9999, 9999, false );

	/* Add support for Post Formats */
	add_theme_support( 'post-formats', array(
	    'status',
	    'gallery'
		) );

	/* Custom Background Support 
	add_theme_support( 'custom-background' );
	*/
	
	/* This theme uses wp_nav_menu() in one location. */
	register_nav_menus( array(
		'main' => __( 'Main Menu', 'teahouse' ),
		'custom' => __( 'Custom Menu', 'teahouse' )
	) );

	/* Make theme available for translation */
	load_theme_textdomain( 'teahouse', get_template_directory() . '/languages' );

}
endif; // teahouse_setup
add_action( 'after_setup_theme', 'teahouse_setup' );


/* Load Scripts and Styles */
function teahouse_scripts_styles() {

	//Enqueue Styles

	//Stylesheet
	wp_enqueue_style( 'style', get_stylesheet_uri() );
    wp_enqueue_style('wp-mediaelement');	
	
	//Enqueue Scripts

	//Register jQuery
	wp_enqueue_script( 'jquery' );
    wp_enqueue_script('wp-mediaelement');

	//Custom JS
	wp_enqueue_script( 'custom-js', get_template_directory_uri() . '/includes/js/custom.js', false, false , true );

	//comments JS
	wp_enqueue_script( 'comments-js', get_template_directory_uri() . '/comments-ajax.js', false, false , true );
	
	//Plugins JS
	wp_enqueue_script( 'Plugins-js', get_template_directory_uri() . '/includes/js/Plugins.js', false, false , true );

}
add_action( 'wp_enqueue_scripts', 'teahouse_scripts_styles' );


/* Add Customizer CSS to Header */
function customizer_css() {
    ?>
	<style type="text/css">
		a {
			color: <?php echo get_theme_mod( 'teahouse_theme_customizer_accent', '#999' ); ?>;
		}

		<?php echo get_theme_mod( 'teahouse_theme_customizer_css', '' ); ?>
	</style>
    <?php
}
add_action( 'wp_head', 'customizer_css' );


/* Pagination Conditional */
function teahouse_page_has_nav() {
	global $wp_query;
	return ( $wp_query->max_num_pages > 1 );
}


/* Portfolio & Gallery Support */
function teahouse_theme_setup() {
	add_theme_support( 'teahouse_themes_gallery_support' );
}
add_action( 'after_setup_theme', 'teahouse_theme_setup' );

add_filter( 'teahouse_themes_portfolio_items_support', '__return_true' );


/* Register Widget Areas */
if ( function_exists( 'register_sidebars' ) )

register_sidebar(array(
	'name' 			=> __( 'Up-widget', 'teahouse' ),
	'description' 	=> __( 'Widgets in this area will be shown in the drawer.', 'teahouse' ),
	'before_widget' => '<div id="%1$s" class="widget %2$s">',
	'after_widget' 	=> '</div>'
));

register_sidebar(array(
	'name' 			=> __( 'Right-widget', 'teahouse' ),
	'description' 	=> __( 'Widgets in this area will be shown in the drawer.', 'teahouse' ),
	'before_widget' => '<div id="%1$s" class="widget %2$s">',
	'after_widget' 	=> '</div>'
));

register_sidebar(array(
	'name' 			=> __( 'Left-widget', 'teahouse' ),
	'description' 	=> __( 'Widgets in this area will be shown in the drawer.', 'teahouse' ),
	'before_widget' => '<div id="%1$s" class="widget %2$s">',
	'after_widget' 	=> '</div>'
));


/* -------------------------------------------------------------- 
 	Post Meta
-------------------------------------------------------------- */
require_once(get_template_directory() . '/includes/post-meta/post-meta-fields.php');

//自定义表情路径
function custom_smilies_src($src, $img){
    return get_option('home') . '/wp-content/themes/Motify/smilies/' . $img;
}

/* Custom Comment Output */
function mytheme_comment($comment, $args, $depth) {
   $GLOBALS['comment'] = $comment;
   global $commentcount;
   if(!$commentcount) {
	   $page = ( !empty($in_comment_loop) ) ? get_query_var('cpage')-1 : get_page_of_comment( $comment->comment_ID, $args )-1;
	   $cpp=get_option('comments_per_page');
	   $commentcount = $cpp * $page;
	}
?>
   <li <?php comment_class(); ?> id="li-comment-<?php comment_ID() ?>">
	<div id="comment-<?php comment_ID(); ?>" class="comment-body">
			<div class="comment-author"><?php echo get_avatar( $comment, $size = '32'); ?></div>
			<div class="comment-head">
				<span class="name"><?php printf(__('%s'), get_comment_author_link()) ?></span>
				<span class="num"> <?php if(!$parent_id = $comment->comment_parent) {printf('#%1$s', ++$commentcount);} ?></span>
				<p> <?php comment_text() ?> </p>
				<div class="post-reply"><?php comment_reply_link(array_merge( $args, array('depth' => $depth, 'max_depth' => $args['max_depth'], 'reply_text' => __('回复')))) ?></div>
				<div class="date"><?php  {printf(__('%1$s %2$s'), get_comment_date('Y/n/j'),  get_comment_time('H:i:G'));} ?></div>
			</div>

    </div>
<?php
}

/* Archives list by zwwooooo | http://zww.me */
 function zww_archives_list() {
     if( !$output = get_option('zww_archives_list') ){
         $output = '<div id="archives"><p style="display:none;">[<a id="al_expand_collapse" href="#">全部展开/收缩</a>] <em>(注: 点击月份可以展开)</em></p>';
         $the_query = new WP_Query( 'posts_per_page=-1&ignore_sticky_posts=1' ); //update: 加上忽略置顶文章
         $year=0; $mon=0; $i=0; $j=0;
         while ( $the_query->have_posts() ) : $the_query->the_post();
             $year_tmp = get_the_time('Y');
             $mon_tmp = get_the_time('m');
             $y=$year; $m=$mon;
             if ($mon != $mon_tmp && $mon > 0) $output .= '</ul></li>';
             if ($year != $year_tmp && $year > 0) $output .= '</ul>';
             if ($year != $year_tmp) {
                 $year = $year_tmp;
                 $output .= '<h3 class="al_year">'. $year .' 年</h3><ul class="al_mon_list">'; //输出年份
             }
             if ($mon != $mon_tmp) {
                 $mon = $mon_tmp;
                 $output .= '<li><span class="al_mon">'. $mon .' 月</span><ul class="al_post_list">'; //输出月份
             }
             $output .= '<li>'. get_the_time('d日: ') .'<a href="'. get_permalink() .'">'. get_the_title() .'</a> <em>('. get_comments_number('0', '1', '%') .')</em></li>'; //输出文章日期和标题
         endwhile;
         wp_reset_postdata();
         $output .= '</ul></li></ul></div>';
         update_option('zww_archives_list', $output);
     }
     echo $output;
 }
 function clear_zal_cache() {
     update_option('zww_archives_list', ''); // 清空 zww_archives_list
 }
 add_action('save_post', 'clear_zal_cache'); // 新发表文章/修改文章时
 
 
  //文章点击次数
function getPostViews($postID){
    $count_key = 'post_views_count';
    $count = get_post_meta($postID, $count_key, true);
    if($count==''){
        delete_post_meta($postID, $count_key);
        add_post_meta($postID, $count_key, '0');
        return "0";
    }
    return $count.' ';
}
function setPostViews($postID) {
    $count_key = 'post_views_count';
    $count = get_post_meta($postID, $count_key, true);
    if($count==''){
        $count = 0;
        delete_post_meta($postID, $count_key);
        add_post_meta($postID, $count_key, '0');
    }else{
        $count++;
        update_post_meta($postID, $count_key, $count);
    }
}
 
 //判断是否属手机
function is_mobile() {
	$user_agent = $_SERVER['HTTP_USER_AGENT'];
	$mobile_agents = Array("240x320","acer","acoon","acs-","abacho","ahong","airness","alcatel","amoi","android","anywhereyougo.com","applewebkit/525","applewebkit/532","asus","audio","au-mic","avantogo","becker","benq","bilbo","bird","blackberry","blazer","bleu","cdm-","compal","coolpad","danger","dbtel","dopod","elaine","eric","etouch","fly ","fly_","fly-","go.web","goodaccess","gradiente","grundig","haier","hedy","hitachi","htc","huawei","hutchison","inno","ipad","ipaq","ipod","jbrowser","kddi","kgt","kwc","lenovo","lg ","lg2","lg3","lg4","lg5","lg7","lg8","lg9","lg-","lge-","lge9","longcos","maemo","mercator","meridian","micromax","midp","mini","mitsu","mmm","mmp","mobi","mot-","moto","nec-","netfront","newgen","nexian","nf-browser","nintendo","nitro","nokia","nook","novarra","obigo","palm","panasonic","pantech","philips","phone","pg-","playstation","pocket","pt-","qc-","qtek","rover","sagem","sama","samu","sanyo","samsung","sch-","scooter","sec-","sendo","sgh-","sharp","siemens","sie-","softbank","sony","spice","sprint","spv","symbian","tablet","talkabout","tcl-","teleca","telit","tianyu","tim-","toshiba","tsm","up.browser","utec","utstar","verykool","virgin","vk-","voda","voxtel","vx","wap","wellco","wig browser","wii","windows ce","wireless","xda","xde","zte");
	$is_mobile = false;
	foreach ($mobile_agents as $device) {
		if (stristr($user_agent, $device)) {
			$is_mobile = true;
			break;
		}
	}
	return $is_mobile;
}

if( is_mobile() ){}else {

}
