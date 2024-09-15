<?php

/**
 * Header Options
 *
 * @package ecommerce_clothing
 */


// ---------------------------------------- GENERAL OPTIONBS ----------------------------------------------------


// ---------------------------------------- PRELOADER ----------------------------------------------------

$wp_customize->add_section(
	'ecommerce_clothing_general_options',
	array(
		'panel' => 'ecommerce_clothing_theme_options',
		'title' => esc_html__( 'General Options', 'ecommerce-clothing' ),
	)
);


// Add Separator Custom Control
$wp_customize->add_setting( 'ecommerce_clothing_preloader_separator', array(
	'sanitize_callback' => 'sanitize_text_field',
) );

$wp_customize->add_control( new Ecommerce_Clothing_Separator_Custom_Control( $wp_customize, 'ecommerce_clothing_preloader_separator', array(
	'label' => __( 'Enable / Disable Site Preloader Section', 'ecommerce-clothing' ),
	'section' => 'ecommerce_clothing_general_options',
	'settings' => 'ecommerce_clothing_preloader_separator',
) ) );


// General Options - Enable Preloader.
$wp_customize->add_setting(
	'ecommerce_clothing_enable_preloader',
	array(
		'sanitize_callback' => 'ecommerce_clothing_sanitize_switch',
		'default'           => false,
	)
);

$wp_customize->add_control(
	new Ecommerce_Clothing_Toggle_Switch_Custom_Control(
		$wp_customize,
		'ecommerce_clothing_enable_preloader',
		array(
			'label'   => esc_html__( 'Enable Preloader', 'ecommerce-clothing' ),
			'section' => 'ecommerce_clothing_general_options',
		)
	)
);


// ---------------------------------------- PAGINATION ----------------------------------------------------

// Add Separator Custom Control
$wp_customize->add_setting( 'ecommerce_clothing_pagination_separator', array(
	'sanitize_callback' => 'sanitize_text_field',
) );

$wp_customize->add_control( new Ecommerce_Clothing_Separator_Custom_Control( $wp_customize, 'ecommerce_clothing_pagination_separator', array(
	'label' => __( 'Enable / Disable Pagination Section', 'ecommerce-clothing' ),
	'section' => 'ecommerce_clothing_general_options',
	'settings' => 'ecommerce_clothing_pagination_separator',
) ) );


// Pagination - Enable Pagination.
$wp_customize->add_setting(
	'ecommerce_clothing_enable_pagination',
	array(
		'default'           => true,
		'sanitize_callback' => 'ecommerce_clothing_sanitize_switch',
	)
);

$wp_customize->add_control(
	new Ecommerce_Clothing_Toggle_Switch_Custom_Control(
		$wp_customize,
		'ecommerce_clothing_enable_pagination',
		array(
			'label'    => esc_html__( 'Enable Pagination', 'ecommerce-clothing' ),
			'section'  => 'ecommerce_clothing_general_options',
			'settings' => 'ecommerce_clothing_enable_pagination',
			'type'     => 'checkbox',
		)
	)
);

// Pagination - Pagination Type.
$wp_customize->add_setting(
	'ecommerce_clothing_pagination_type',
	array(
		'default'           => 'default',
		'sanitize_callback' => 'ecommerce_clothing_sanitize_select',
	)
);

$wp_customize->add_control(
	'ecommerce_clothing_pagination_type',
	array(
		'label'           => esc_html__( 'Pagination Type', 'ecommerce-clothing' ),
		'section'         => 'ecommerce_clothing_general_options',
		'settings'        => 'ecommerce_clothing_pagination_type',
		'active_callback' => 'ecommerce_clothing_is_pagination_enabled',
		'type'            => 'select',
		'choices'         => array(
			'default' => __( 'Default (Older/Newer)', 'ecommerce-clothing' ),
			'numeric' => __( 'Numeric', 'ecommerce-clothing' ),
		),
	)
);


// ---------------------------------------- BREADCRUMB ----------------------------------------------------

// Add Separator Custom Control
$wp_customize->add_setting( 'ecommerce_clothing_breadcrumb_separators', array(
	'sanitize_callback' => 'sanitize_text_field',
) );

$wp_customize->add_control( new Ecommerce_Clothing_Separator_Custom_Control( $wp_customize, 'ecommerce_clothing_breadcrumb_separators', array(
	'label' => __( 'Enable / Disable Breadcrumb Section', 'ecommerce-clothing' ),
	'section' => 'ecommerce_clothing_general_options',
	'settings' => 'ecommerce_clothing_breadcrumb_separators',
)));

// Breadcrumb - Enable Breadcrumb.
$wp_customize->add_setting(
	'ecommerce_clothing_enable_breadcrumb',
	array(
		'sanitize_callback' => 'ecommerce_clothing_sanitize_switch',
		'default'           => true,
	)
);

$wp_customize->add_control(
	new Ecommerce_Clothing_Toggle_Switch_Custom_Control(
		$wp_customize,
		'ecommerce_clothing_enable_breadcrumb',
		array(
			'label'   => esc_html__( 'Enable Breadcrumb', 'ecommerce-clothing' ),
			'section' => 'ecommerce_clothing_general_options',
		)
	)
);

// Breadcrumb - Separator.
$wp_customize->add_setting(
	'ecommerce_clothing_breadcrumb_separator',
	array(
		'sanitize_callback' => 'sanitize_text_field',
		'default'           => '/',
	)
);

$wp_customize->add_control(
	'ecommerce_clothing_breadcrumb_separator',
	array(
		'label'           => esc_html__( 'Separator', 'ecommerce-clothing' ),
		'active_callback' => 'ecommerce_clothing_is_breadcrumb_enabled',
		'section'         => 'ecommerce_clothing_general_options',
	)
);



// ---------------------------------------- Website layout ----------------------------------------------------


// Add Separator Custom Control
$wp_customize->add_setting( 'ecommerce_clothing_layuout_separator', array(
	'sanitize_callback' => 'sanitize_text_field',
) );

$wp_customize->add_control( new Ecommerce_Clothing_Separator_Custom_Control( $wp_customize, 'ecommerce_clothing_layuout_separator', array(
	'label' => __( 'Website Layout Setting', 'ecommerce-clothing' ),
	'section' => 'ecommerce_clothing_general_options',
	'settings' => 'ecommerce_clothing_layuout_separator',
)));


$wp_customize->add_setting(
	'ecommerce_clothing_website_layout',
	array(
		'sanitize_callback' => 'ecommerce_clothing_sanitize_switch',
		'default'           => false,
	)
);

$wp_customize->add_control(
	new Ecommerce_Clothing_Toggle_Switch_Custom_Control(
		$wp_customize,
		'ecommerce_clothing_website_layout',
		array(
			'label'   => esc_html__('Boxed Layout', 'ecommerce-clothing'),
			'section' => 'ecommerce_clothing_general_options',
		)
	)
);

$wp_customize->add_setting('ecommerce_clothing_layout_width_margin', array(
	'default'           => 50,
	'sanitize_callback' => 'ecommerce_clothing_sanitize_range_value',
));

$wp_customize->add_control(new Ecommerce_Clothing_Customize_Range_Control($wp_customize, 'ecommerce_clothing_layout_width_margin', array(
		'label'       => __('Set Width', 'ecommerce-clothing'),
		'description' => __('Adjust the width around the website layout by moving the slider. Use this setting to customize the appearance of your site to fit your design preferences.', 'ecommerce-clothing'),
		'section'     => 'ecommerce_clothing_general_options',
		'settings'    => 'ecommerce_clothing_layout_width_margin',
		'active_callback' => 'ecommerce_clothing_is_layout_enabled',
		'input_attrs' => array(
			'min'  => 0,
			'max'  => 130,
			'step' => 1,
		),
)));




// ---------------------------------------- HEADER OPTIONS ----------------------------------------------------

$wp_customize->add_section(
	'ecommerce_clothing_header_options',
	array(
		'panel' => 'ecommerce_clothing_theme_options',
		'title' => esc_html__( 'Header Options', 'ecommerce-clothing' ),
	)
);


// Add setting for sticky header
$wp_customize->add_setting(
	'ecommerce_clothing_enable_sticky_header',
	array(
		'sanitize_callback' => 'ecommerce_clothing_sanitize_switch',
		'default'           => false,
	)
);

// Add control for sticky header setting
$wp_customize->add_control(
	new ecommerce_clothing_Toggle_Switch_Custom_Control(
		$wp_customize,
		'ecommerce_clothing_enable_sticky_header',
		array(
			'label'   => esc_html__( 'Enable Sticky Header', 'ecommerce-clothing' ),
			'section' => 'ecommerce_clothing_header_options',
		)
	)
);

// Header Options - Enable Topbar.
$wp_customize->add_setting(
	'ecommerce_clothing_enable_topbar',
	array(
		'sanitize_callback' => 'ecommerce_clothing_sanitize_switch',
		'default'           => false,
	)
);

$wp_customize->add_control(
	new Ecommerce_Clothing_Toggle_Switch_Custom_Control(
		$wp_customize,
		'ecommerce_clothing_enable_topbar',
		array(
			'label'   => esc_html__( 'Enable Topbar', 'ecommerce-clothing' ),
			'section' => 'ecommerce_clothing_header_options',
		)
	)
);

// Header Options - Contact Number.
$wp_customize->add_setting(
	'ecommerce_clothing_discount_topbar_text',
	array(
		'default'           => '',
		'sanitize_callback' => 'sanitize_text_field',
	)
);

$wp_customize->add_control(
	'ecommerce_clothing_discount_topbar_text',
	array(
		'label'           => esc_html__( 'Topbar Text', 'ecommerce-clothing' ),
		'section'         => 'ecommerce_clothing_header_options',
		'type'            => 'text',
		'active_callback' => 'ecommerce_clothing_is_topbar_enabled',
	)
);

$wp_customize->add_setting( 'menu_text_transform', array(
    'default'           => 'capitalize', // Default value for text transform
    'sanitize_callback' => 'sanitize_text_field',
) );

// Add control for menu text transform
$wp_customize->add_control( 'menu_text_transform', array(
    'type'     => 'select',
    'section'  => 'ecommerce_clothing_header_options', // Adjust the section as needed
    'label'    => __( 'Menu Text Transform', 'ecommerce-clothing' ),
    'choices'  => array(
        'none'       => __( 'None', 'ecommerce-clothing' ),
        'capitalize' => __( 'Capitalize', 'ecommerce-clothing' ),
        'uppercase'  => __( 'Uppercase', 'ecommerce-clothing' ),
        'lowercase'  => __( 'Lowercase', 'ecommerce-clothing' ),
    ),
) );


// ----------------------------------------SITE IDENTITY----------------------------------------------------




$wp_customize->add_setting( 'ecommerce_clothing_site_title_size', array(
    'default'           => 30, // Default font size in pixels
    'sanitize_callback' => 'absint', // Sanitize the input as a positive integer
) );

// Add control for site title size
$wp_customize->add_control( 'ecommerce_clothing_site_title_size', array(
    'type'        => 'number',
    'section'     => 'title_tagline', // You can change this section to your preferred section
    'label'       => __( 'Site Title Font Size ', 'ecommerce-clothing' ),
    'input_attrs' => array(
        'min'  => 10,
        'max'  => 100,
        'step' => 1,
    ),
) );

// Site Title - Enable Setting.
$wp_customize->add_setting(
	'ecommerce_clothing_enable_site_title_setting',
	array(
		'default'           => true,
		'sanitize_callback' => 'ecommerce_clothing_sanitize_switch',
	)
);

$wp_customize->add_control(
	new Ecommerce_Clothing_Toggle_Switch_Custom_Control(
		$wp_customize,
		'ecommerce_clothing_enable_site_title_setting',
		array(
			'label'    => esc_html__( 'Disable Site Title', 'ecommerce-clothing' ),
			'section'  => 'title_tagline',
			'settings' => 'ecommerce_clothing_enable_site_title_setting',
		)
	)
);

// Tagline - Enable Setting.
$wp_customize->add_setting(
	'ecommerce_clothing_enable_tagline_setting',
	array(
		'default'           => false,
		'sanitize_callback' => 'ecommerce_clothing_sanitize_switch',
	)
);

$wp_customize->add_control(
	new Ecommerce_Clothing_Toggle_Switch_Custom_Control(
		$wp_customize,
		'ecommerce_clothing_enable_tagline_setting',
		array(
			'label'    => esc_html__( 'Enable Tagline', 'ecommerce-clothing' ),
			'section'  => 'title_tagline',
			'settings' => 'ecommerce_clothing_enable_tagline_setting',
		)
	)
);

