<?php

//Filter TinyMCE Buttons
 
function themeit_mce_buttons_2( $buttons )
{
  array_unshift( $buttons, 'styleselect' );
  return $buttons;
}
add_filter( 'mce_buttons_2', 'themeit_mce_buttons_2' );


//Add Style Options

function themeit_tiny_mce_before_init( $settings )
{
	$settings['theme_advanced_blockformats'] = 'p,a,div,span,h1,h2,h3,h4,h5,h6,tr,';

	$style_formats = array(
		array( 'title' => 'Page Title',        'block'    => 'div',  'classes' => 'intro' ),
		array( 'title' => 'Highlight',          'inline'   => 'span', 'classes' => 'highlight' )
	);

	$settings['style_formats'] = json_encode( $style_formats );
	return $settings;
}
add_filter( 'tiny_mce_before_init', 'themeit_tiny_mce_before_init' );


//Add Editor Style
 
function themeit_add_editor_style() {
  add_editor_style( 'style-editor.css' );
}
add_action( 'after_setup_theme', 'themeit_add_editor_style' );

?>