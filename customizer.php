<?php

// ------------- Theme Customizer  ------------- //
 
add_action( 'customize_register', 'teahouse_theme_customizer_register' );

function teahouse_theme_customizer_register( $wp_customize ) {
	
	class teahouse_Customize_Textarea_Control extends WP_Customize_Control {
	    public $type = 'textarea';
	 
	    public function render_content() {
	        ?>
	        <label>
	        	<span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
	        	<textarea rows="5" style="width:100%;" <?php $this->link(); ?>><?php echo esc_textarea( $this->value() ); ?></textarea>
	        </label>
	        <?php
	    }
	}
	
	//teahouse Style Options
	$wp_customize->add_section( 'teahouse_theme_customizer_basic', array(
		'title' 	=> __( 'teahouse Options', 'teahouse' ),
		'priority' 	=> 100
	) );
	
	//Logo Image
	$wp_customize->add_setting( 'teahouse_theme_customizer_logo', array(
	) );
	
	$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'teahouse_theme_customizer_logo', array(
		'label' 	=> __( 'Logo Upload', 'teahouse' ),
		'section' 	=> 'teahouse_theme_customizer_basic',
		'settings' 	=> 'teahouse_theme_customizer_logo'
	) ) );
	
	//Retina
	$wp_customize->add_setting('teahouse_theme_customizer_retina', array(
        'default'	=> 'disabled',
        'capability'=> 'edit_theme_options',
        'type'		=> 'option',
    ));
    
    $wp_customize->add_control( 'retina_select_box', array(
        'settings' 	=> 'teahouse_theme_customizer_retina',
        'label'   	=> __( 'Retina Logo', 'teahouse' ),
        'section' 	=> 'teahouse_theme_customizer_basic',
        'type'    	=> 'select',
        'choices'   => array(
            'enabled' 	=> __( 'Enabled', 'teahouse' ),
            'disabled' 	=> __( 'Disabled', 'teahouse' ),
        ),
    ));
	
	//Accent Color
	$wp_customize->add_setting( 'teahouse_theme_customizer_accent', array(
		'default' 	=> '#999'
	) );
	
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'teahouse_theme_customizer_accent', array(
		'label'   	=> __( 'Link Color', 'teahouse' ),
		'section' 	=> 'teahouse_theme_customizer_basic',
		'settings'  => 'teahouse_theme_customizer_accent'
	) ) );
	 
	//Style
	$wp_customize->add_setting('teahouse_theme_customizer_style', array(
        'default'	=> 'enabled',
        'capability'=> 'edit_theme_options',
        'type'		=> 'option',
    ));
    
    $wp_customize->add_control( 'style_select_box', array(
        'settings' 	=> 'teahouse_theme_customizer_style',
        'label'   	=> __( 'style', 'teahouse' ),
        'section' 	=> 'teahouse_theme_customizer_basic',
        'type'    	=> 'select',
        'choices'   => array(
            'enabled' 	=> __( 'Black', 'teahouse' ),
            'disabled' 	=> __( 'White', 'teahouse' ),
        ),
    ));	
		
	
    //Custom CSS
	$wp_customize->add_setting( 'teahouse_theme_customizer_css', array(
        'default'	=> '',
    ) );
    
    $wp_customize->add_control( new teahouse_Customize_Textarea_Control( $wp_customize, 'teahouse_theme_customizer_css', array(
	    'label'		=> __( 'Custom CSS', 'teahouse' ),
	    'section'	=> 'teahouse_theme_customizer_basic',
	    'settings'	=> 'teahouse_theme_customizer_css',
	) ) );
	
}