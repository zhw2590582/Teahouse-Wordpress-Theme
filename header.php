<?php
// 获取选项
$keywords = cs_get_option( 'i_seo_keywords' ); 
$description = cs_get_option( 'i_seo_description' );
$favicon = cs_get_option( 'i_favicon_icon' ); 
$page = cs_get_option('i_pagination'); 
$style = cs_get_option('i_ajax_style'); 
$symbol = cs_get_option( 'i_symbol' ); 
$logo = cs_get_option( 'i_logo_image' ); 
$search = cs_get_option( 'i_search' ); 
$fixed = cs_get_option( 'i_menu_fixed' ); 
$scroll = cs_get_option( 'i_menu_scroll' ); 
$login = cs_get_option( 'i_login' ); 
$sliders = cs_get_option( 'i_slider' ); 
$link = cs_get_option( 'i_slider_link' );
$newtab = cs_get_option( 'i_slider_newtab' ); 
$copyright = cs_get_option( 'i_foot_copyright' );  
$leftbar = cs_get_option( 'i_leftbar_show' );  
$rightbar = cs_get_option( 'i_rightbar_show' ); 
$rb = cs_get_option( 'i_rightbar_scroll' ); 
$post_img = cs_get_option( 'i_post_image' ); 
$img_setup = cs_get_option( 'i_post_setup' ); 
$leftmenu = cs_get_option( 'i_menu_skin' ); 
$leftcode = cs_get_option( 'i_menu_code' ); 
$sidebar = cs_get_option( 'i_sidebar_switch' );  
$logo_color = cs_get_option( 'i_logo_color' );  
$sticky = cs_get_option( 'i_post_sticky' ); 
$exclude = cs_get_option( 'i_exclude_sticky' ); 
$sticky_img = cs_get_option( 'i_sticky_image' ); 
$leftbar_view = cs_get_option( 'i_leftbar_view' ); 
$banner_test = cs_get_option( 'i_banner_text' ); 
$switcher = cs_get_option( 'i_switcher' ); 
$qrcodes = cs_get_option( 'i_code_qrcodes' ); 
$qrcodes_img = cs_get_option( 'i_qrcodes_img' ); 
$bulletin = cs_get_option( 'i_bulletin' ); 
?> 

<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<title><?php if(function_exists('show_wp_title')){show_wp_title();} ?></title>
	<meta charset="<?php bloginfo( 'charset' ); ?>" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0,minimal-ui">	<title><?php wp_title( '|', true, 'right' ); ?><?php echo bloginfo( 'name' ); ?></title>
	<meta name="keywords" content="<?php echo $keywords ?>" />
	<meta name="description" content="<?php echo $description ?>" />
	<link rel="profile" href="http://gmpg.org/xfn/11" />
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
	<link rel="shortcut icon" href="<?php echo $favicon; ?>" title="Favicon">	
	<!--[if lte IE 8]>
		<link rel="stylesheet" type="text/css" href="<?php echo get_template_directory_uri(); ?>/css/ie.css" media="screen"/>
		<script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/js/ie-html5.js"></script>
	<![endif]-->
	<script type="text/javascript">document.documentElement.className = 'js';</script>
	<?php wp_head(); ?>
</head>
<?php if ( $page == 'i_ajax' ) { 
 $bar = cs_get_option('i_ajax_style');
	$load_style = '';
	switch ($bar) {
		case "style1":
			$load_style = 'ajax_load loading_style1';
			break;

		case "style2":
			$load_style = 'ajax_load loading_style2';
			break;

		case "style3":
			$load_style = 'ajax_load loading_style3';
			break;
	} 
} ?>
	
<body <?php body_class($load_style); ?> <?php if ($leftbar_view == true ) {echo 'id="leftbar_open"';}else{echo 'id="leftbar_close"';} ?>>
	<header class="header">
		<div class="header-inter clearfix">
			<?php if ( $symbol == 'i_text' ) { ?>
				<hgroup>	
					<span class="logo-text <?php if ( $logo_color == true ) { echo 'in';}?>"><a href="<?php echo home_url( '/' ); ?>" title="<?php bloginfo('name'); ?>"><?php bloginfo('name'); ?></a></span>
				</hgroup>
			<?php }elseif( $symbol == 'i_logo' ){ ?>
				<span class="logo-image">
					<a href="<?php echo home_url(); ?>" title="<?php bloginfo('name'); ?>">
						<img class="logo" src="<?php echo $logo ;?>" alt="<?php bloginfo('name'); ?>" />
					</a>
				</span> 
			<?php }else{ ?>
				<hgroup>	
					<span class="logo-text <?php if ( $logo_color == true ) { echo 'in';}?>"><a href="<?php echo home_url( '/' ); ?>" title="<?php bloginfo('name'); ?>"><i class="icon-logo"></i></a></span>
				</hgroup>
			<?php } ?>
		<h2 class="logo-subtitle"><?php bloginfo('description') ?></h2>
	    <nav role="navigation" class="header-menu">  	
			<?php wp_nav_menu(array('theme_location' => 'main', 'container' => 'div', 'container_class' => 'header-menu-wrapper arrow-up-right', 'menu_class' => 'header-menu-list', 'walker' => new pinthis_submenu_wrap())); ?>
	    </nav>	
	
	<a id="menu-toggle" href="javascript:void(0)" class="menu-toggle"></a>
	<div class="clearfix"></div>
	</div>
	
	<?php if ($leftbar_view == true && !is_mobile()) { ?>
	<!-- 左侧边栏 -->	
		<div class="leftbar<?php if ($leftmenu == 'menu_skin_1') {echo ' leftopen';} ?>">
			<!-- 左菜单 -->
			<div class="left_menu">
				<?php 
					$my_menus = cs_get_option( 'i_menu' );
					echo '<ul class="menu_link">';
					if( ! empty( $my_menus ) ) {
					  foreach ( $my_menus as $menu ) {
						$iconstyle = $menu['i_menu_style']; 
						echo '<li>';
						if( ! empty( $menu['i_menu_link'] ) ){echo '<a href="'. $menu['i_menu_link'] .'" class="simptip-position-right simptip-smooth simptip-movable" data-tooltip="'. $menu['i_menu_title'] .'"';}else{echo '<a href="javascript:void(0)"  class="simptip-position-right simptip-smooth simptip-movable" data-tooltip="'. $menu['i_menu_title'] .'" ';}
						if ( $menu['i_menu_newtab'] == true) { echo 'target="_black"';}
						if ($iconstyle == 'i_icon') {echo '><i class="'. $menu['i_menu_icon'] .'"></i>';} else {echo '><img src="'. $menu['i_menu_image'] .'">';}			
						echo '<span>'. $menu['i_menu_title'] .'</span><div class="clearfix"></div></a>';
						echo '</li>';
					  }
					}		
					echo '</ul>';
				?>
			</div>
		</div>
	<?php } ?>		
	
	</header>
	
	<nav role="navigation" class="mobile-nav">  	
		<?php wp_nav_menu(array('theme_location' => 'main', 'menu_class' => 'mobile-menu')); ?>
	</nav>		
	
	<div id="wrapper" <?php if ($rightbar != true){echo 'class="toggle-wrapper"';}?>>
		<div id="main">
		
	<?php if(is_home() && !is_paged()) { ?> 
		<!-- 调用幻灯片 -->
		<?php if ( $sliders == true || $sticky == true ) { ?> <div id="header_slider" 	<?php if (!is_mobile()) { ?> class=" fadeInDown animated <?php }?>"> <?php } ?>	
		<?php if ($sliders == true) { ?>
		<div class="slider">
			<?php	
				$my_sliders = cs_get_option( 'i_slider_custom' );
				echo '<ul class="lightSlider">';
				if( ! empty( $my_sliders ) ) {
				  foreach ( $my_sliders as $slider ) {
					echo '<li>';
				    if( ! empty( $slider['i_slider_link'] ) ){ echo '<a href="'. $slider['i_slider_link'] .'"';}
					if ( ! empty( $slider['i_slider_link'] ) && $slider['i_slider_newtab'] == true) { echo 'target="_black">';}else{ if ( ! empty( $slider['i_slider_link'] )){ echo '>';}}
					echo '<img class=" " src="data:image/gif;base64,R0lGODlhAQABAAAAACH5BAEKAAEALAAAAAABAAEAAAICTAEAOw==" data-echo="'. $slider['i_slider_image'] .'"/><p>'. $slider['i_slider_text'] .'</p>';
				    if( ! empty( $slider['i_slider_link'] ) ){ echo '</a>';}				    
					echo '</li>';
				  }
				}		
				echo '</ul>';
			?>	
		</div>
		<?php } ?>
		
		<?php if ( $sliders == true || $sticky == true ) { ?> </div><?php } ?>
	<?php } ?>	
	
	<?php if(is_home() && !is_paged() && !is_mobile()) { ?> 
		<?php if ($bulletin == true) {?>
		<div id="bulletin_box">
			<i class="fa fa-bell-o"></i>
			<div id="bulletin">
				<?php	
					$my_bulletins = cs_get_option( 'i_bulletin_custom' );
					echo '<ul class="bulletin_list">';
					if( ! empty( $my_bulletins ) ) {
					  foreach ( $my_bulletins as $bulletin ) {
						echo '<li>';
						if( ! empty( $bulletin['i_bulletin_link'] ) ){ echo '<a href="'. $bulletin['i_bulletin_link'] .'"';}
						if ( ! empty( $bulletin['i_bulletin_link'] ) && $bulletin['i_bulletin_newtab'] == true) { echo 'target="_black">';}else{ if ( ! empty( $bulletin['i_bulletin_link'] )){ echo '>';}}
						echo ''. $bulletin['i_bulletin_text'] .'';
						if( ! empty( $bulletin['i_bulletin_link'] ) ){ echo '</a>';}				    
						echo '</li>';
					  }
					}		
					echo '</ul>';
				?>	
			</div>
			<a href="#" class="bulletin_remove"><i class="fa fa-close"></i></a>
		</div>
		<?php }	?>	
	<?php } ?>		