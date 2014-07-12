<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	
	<title><?php wp_title( '|', true, 'right' ); ?><?php echo bloginfo( 'name' ); ?></title>
	
	<link rel="profile" href="http://gmpg.org/xfn/11" />
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
	
	<!-- media queries -->
	<meta name="viewport" content="width=device-width, minimum-scale=1.0, initial-scale=1.0" />
	
	<!--[if lte IE 8]>
		<link rel="stylesheet" type="text/css" href="<?php echo get_template_directory_uri(); ?>/includes/styles/ie.css" media="screen"/>
		<script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/includes/js/IE/ie-html5.js"></script>
	<![endif]-->
	
	<!-- add js class -->
	<script type="text/javascript">document.documentElement.className = 'js';</script>
	
	<!-- load scripts -->
	<?php if ( is_singular() ) wp_enqueue_script( 'comment-reply' ); wp_head(); ?>
</head>

<body <?php body_class('teahouse-bg'); ?>>


	<?php if( is_mobile() ){ ?>
	<?php } else { ?>
	<canvas id="pixie"></canvas>
	<?php } ?>
	<section id="drawer" class="sb-slide">
		<div id="drawer-inside" class="clearfix">
			<?php if (function_exists('dynamic_sidebar') && dynamic_sidebar('Up-widget') ) : else : ?>		
			<?php endif; ?>		
		</div>
	</section><!--drawer-->
	
	<?php if ( is_active_sidebar(1) ) { ?>
		<a id="drawer-toggle" class="sb-slide" href="#"><i class="icon-cog"></i></a>
	<?php } ?>
	
	<header class="header navbar sb-slide">
	
	
	<?php if ( is_active_sidebar(3) ) { ?>
	<div class="move sb-toggle-left navbar-left">
	<ul>
	<li></li>
	<li></li>
	<li></li>
	<li></li>
	</ul>
	</div>
	<?php } ?>
	
	<div class="my-header">
		<!-- grab the logo and site title -->
		<?php if ( get_theme_mod('teahouse_theme_customizer_logo') ) { ?>
	    	<?php if ( get_option('teahouse_theme_customizer_retina') == 'enabled') {
				list($width, $height) = getimagesize(stripslashes(get_theme_mod('teahouse_theme_customizer_logo')));
				$width = ($width / 2);
				$height = ($height / 2);
				};
			?>
			
			<h1 class="logo-image animated fadeInDown">
				<a href="<?php echo home_url(); ?>" title="<?php bloginfo('name'); ?>">
					<img class="logo" src="<?php echo '' .get_theme_mod( 'teahouse_theme_customizer_logo', '' )."\n";?>" alt="<?php bloginfo('name'); ?>" <?php if ( get_option('teahouse_theme_customizer_retina') == 'enabled') { ?>width="<?php echo $width; ?>" height="<?php echo $height; ?>" <?php } ?>/>
				</a>
			</h1>
			<h2 class="logo-subtitle"><?php bloginfo('description') ?></h2>
	    <?php } else { ?>
	    
		    <hgroup>	
		    	<h1 class="logo-text"><a href="<?php echo home_url( '/' ); ?>" title="<?php bloginfo('name'); ?>"><?php bloginfo('name') ?></a></h1>
		    	<h2 class="logo-subtitle"><?php bloginfo('description') ?></h2>
		    </hgroup>
	    
	    <?php } ?>
	    
	    <nav role="navigation" class="header-nav">  	
	    	<!-- nav menu -->
	    	<?php wp_nav_menu(array('theme_location' => 'main', 'menu_class' => 'nav')); ?>
	    	
	    	<?php if ( is_active_sidebar(1) ) { ?>
	    		<a id="drawer-toggle2" href="#" title="drawer toggle"><i class="icon-asterisk"></i></a>
	    	<?php } ?>
	    </nav>	
	    
		</div>
		<nav role="navigation" class="my-nav">
	    	<?php wp_nav_menu(array('theme_location' => 'custom', 'menu_class' => 'mynav')); ?>
		</nav>
	</header>
	<div id="sb-site" class="sb-slide">
	<div class="wrapper <?php if ( is_active_sidebar(2) ) { ?>toggle-wrapper<?php } ?> ">
		<div id="main">