<?php
/**
 * Ecommerce Clothing functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package ecommerce_clothing
 */

$ecommerce_clothing_theme_data = wp_get_theme();
if( ! defined( 'ECOMMERCE_CLOTHING_THEME_VERSION' ) ) define ( 'ECOMMERCE_CLOTHING_THEME_VERSION', $ecommerce_clothing_theme_data->get( 'Version' ) );
if( ! defined( 'ECOMMERCE_CLOTHING_THEME_NAME' ) ) define( 'ECOMMERCE_CLOTHING_THEME_NAME', $ecommerce_clothing_theme_data->get( 'Name' ) );
if( ! defined( 'ECOMMERCE_CLOTHING_THEME_TEXTDOMAIN' ) ) define( 'ECOMMERCE_CLOTHING_THEME_TEXTDOMAIN', $ecommerce_clothing_theme_data->get( 'TextDomain' ) );

if ( ! defined( 'ECOMMERCE_CLOTHING_VERSION' ) ) {
	define( 'ECOMMERCE_CLOTHING_VERSION', '1.0.0' );
}

if ( ! function_exists( 'ecommerce_clothing_setup' ) ) :
	
	function ecommerce_clothing_setup() {
		
		load_theme_textdomain( 'ecommerce-clothing', get_template_directory() . '/languages' );

		add_theme_support( 'woocommerce' );

		add_theme_support( 'automatic-feed-links' );
		
		add_theme_support( 'title-tag' );

		add_theme_support( 'post-thumbnails' );

		register_nav_menus(
			array(
				'primary' => esc_html__( 'Primary', 'ecommerce-clothing' ),
				'social'  => esc_html__( 'Social', 'ecommerce-clothing' ),
			)
		);

		add_theme_support(
			'html5',
			array(
				'search-form',
				'comment-form',
				'comment-list',
				'gallery',
				'caption',
				'style',
				'script',
				'woocommerce',
			)
		);

		add_theme_support( 'post-formats', array(
			'image',
			'video',
			'gallery',
			'audio', 
		) );

		add_theme_support(
			'custom-background',
			apply_filters(
				'ecommerce_clothing_custom_background_args',
				array(
					'default-color' => 'ffffff',
					'default-image' => '',
				)
			)
		);

		add_theme_support( 'customize-selective-refresh-widgets' );

		add_theme_support(
			'custom-logo',
			array(
				'height'      => 250,
				'width'       => 250,
				'flex-width'  => true,
				'flex-height' => true,
			)
		);

		add_theme_support( 'align-wide' );

		add_theme_support( 'responsive-embeds' );
	}
endif;
add_action( 'after_setup_theme', 'ecommerce_clothing_setup' );

function ecommerce_clothing_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'ecommerce_clothing_content_width', 640 );
}
add_action( 'after_setup_theme', 'ecommerce_clothing_content_width', 0 );

function ecommerce_clothing_widgets_init() {
	register_sidebar(
		array(
			'name'          => esc_html__( 'Sidebar', 'ecommerce-clothing' ),
			'id'            => 'sidebar-1',
			'description'   => esc_html__( 'Add widgets here.', 'ecommerce-clothing' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title"><span>',
			'after_title'   => '</span></h2>',
		)
	);

	// Regsiter 4 footer widgets.
	$ecommerce_clothing_footer_widget_column = get_theme_mod('ecommerce_clothing_footer_widget_column','4');
	for ($i=1; $i<=$ecommerce_clothing_footer_widget_column; $i++) {
		register_sidebar( array(
			'name' => __( 'Footer  ', 'ecommerce-clothing' )  . $i,
			'id' => 'ecommerce-clothing-footer-widget-' . $i,
			'description' => __( 'The Footer Widget Area', 'ecommerce-clothing' )  . $i,
			'before_widget' => '<aside id="%1$s" class="widget %2$s">',
			'after_widget' => '</aside>',
			'before_title' => '<div class="widget-header"><h4 class="widget-title">',
			'after_title' => '</h4></div>',
		) );
	}
}
add_action( 'widgets_init', 'ecommerce_clothing_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function ecommerce_clothing_scripts() {
	// Append .min if SCRIPT_DEBUG is false.
	$min = ( defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ) ? '' : '.min';

	// Slick style.
	wp_enqueue_style( 'ecommerce-clothing-slick-style', get_template_directory_uri() . '/resource/css/slick' . $min . '.css', array(), '1.8.1' );

	// Owl Carousel style.
	wp_enqueue_style( 'owl-carousel-css', get_template_directory_uri() . '/resource/css/owl.carousel' . '.css', array(), '2.3.4' );

	// Fontawesome style.
	wp_enqueue_style( 'ecommerce-clothing-fontawesome-style', get_template_directory_uri() . '/resource/css/fontawesome' . $min . '.css', array(), '5.15.4' );

	// Main style.
	wp_enqueue_style( 'ecommerce-clothing-style', get_template_directory_uri() . '/style.css', array(), ECOMMERCE_CLOTHING_VERSION );

	// Navigation script.
	wp_enqueue_script( 'ecommerce-clothing-navigation-script', get_template_directory_uri() . '/resource/js/navigation' . $min . '.js', array(), ECOMMERCE_CLOTHING_VERSION, true );

	// Owl Carousel.
	wp_enqueue_script( 'owl-carouselscript', get_template_directory_uri() . '/resource/js/owl.carousel' . '.js', array( 'jquery' ), '2.3.4', true );

	// Slick script.
	wp_enqueue_script( 'ecommerce-clothing-slick-script', get_template_directory_uri() . '/resource/js/slick' . $min . '.js', array( 'jquery' ), '1.8.1', true );

	// Custom script.
	wp_enqueue_script( 'ecommerce-clothing-custom-script', get_template_directory_uri() . '/resource/js/custom.js', array( 'jquery' ), ECOMMERCE_CLOTHING_VERSION, true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

	// Include the file.
	require_once get_theme_file_path( 'theme-library/function-files/wptt-webfont-loader.php' );

	
}
add_action( 'wp_enqueue_scripts', 'ecommerce_clothing_scripts' );

/**
 * Include wptt webfont loader.
 */
require_once get_theme_file_path( 'theme-library/function-files/wptt-webfont-loader.php' );

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/theme-library/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/theme-library/function-files/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/theme-library/function-files/template-functions.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/theme-library/customizer.php';

/**
 * Google Fonts
 */
require get_template_directory() . '/theme-library/function-files/google-fonts.php';

/**
 * Dynamic CSS
 */
require get_template_directory() . '/theme-library/dynamic-css.php';

/**
 * Breadcrumb
 */
require get_template_directory() . '/theme-library/function-files/class-breadcrumb-trail.php';


// Enqueue Customizer live preview script
function ecommerce_clothing_customizer_live_preview() {
    wp_enqueue_script(
        'ecommerce-clothing-customizer',
        get_template_directory_uri() . '/js/customizer.js',
        array('jquery', 'customize-preview'),
        '',
        true
    );
}
add_action('customize_preview_init', 'ecommerce_clothing_customizer_live_preview');


// Output inline CSS based on Customizer setting
function ecommerce_clothing_customizer_css() {
    $enable_breadcrumb = get_theme_mod('ecommerce_clothing_enable_breadcrumb', true);
    ?>
    <style type="text/css">
        <?php if (!$enable_breadcrumb) : ?>
            nav.woocommerce-breadcrumb {
                display: none;
            }
        <?php endif; ?>
    </style>
    <?php
}
add_action('wp_head', 'ecommerce_clothing_customizer_css');

function ecommerce_clothing_customize_css() {
    ?>
    <style type="text/css">
        :root {
            --primary-color: <?php echo esc_html( get_theme_mod( 'primary_color', '#E30045' ) ); ?>;
        }
    </style>
    <?php
}
add_action( 'wp_head', 'ecommerce_clothing_customize_css' );



function ecommerce_clothing_enqueue_selected_fonts() {
    $fonts_url = ecommerce_clothing_get_fonts_url();
    if (!empty($fonts_url)) {
        wp_enqueue_style('ecommerce-clothing-google-fonts', $fonts_url, array(), null);
    }
}
add_action('wp_enqueue_scripts', 'ecommerce_clothing_enqueue_selected_fonts');

function ecommerce_clothing_layout_customizer_css() {
    $margin = get_theme_mod('ecommerce_clothing_layout_width_margin', 0);
    ?>
    <style type="text/css">
        body.site-boxed--layout #page  {
            margin: 0 <?php echo esc_attr($margin); ?>px;
        }
    </style>
    <?php
}
add_action('wp_head', 'ecommerce_clothing_layout_customizer_css');

function ecommerce_clothing_blog_layout_customizer_css() {
    // Retrieve the blog layout option
    $ecommerce_clothing_blog_layouts = get_theme_mod('ecommerce_clothing_blog_layout_option_setting', 'Left');
    
    // Initialize custom CSS variable
    $ecommerce_clothing_custom_css = '';

    // Generate custom CSS based on the layout option
    if ($ecommerce_clothing_blog_layouts == 'Default') {
        $ecommerce_clothing_custom_css .= '.mag-post-detail {';
        $ecommerce_clothing_custom_css .= 'text-align: center;';
        $ecommerce_clothing_custom_css .= '}';
    } elseif ($ecommerce_clothing_blog_layouts == 'Left') {
        $ecommerce_clothing_custom_css .= '.mag-post-detail {';
        $ecommerce_clothing_custom_css .= 'text-align: left;';
        $ecommerce_clothing_custom_css .= '}';
    } elseif ($ecommerce_clothing_blog_layouts == 'Right') {
        $ecommerce_clothing_custom_css .= '.mag-post-detail {';
        $ecommerce_clothing_custom_css .= 'text-align: right;';
        $ecommerce_clothing_custom_css .= '}';
    }

    // Output the combined CSS
    ?>
    <style type="text/css">
        <?php echo $ecommerce_clothing_custom_css; ?>
    </style>
    <?php
}
add_action('wp_head', 'ecommerce_clothing_blog_layout_customizer_css');

function ecommerce_clothing_sidebar_width_customizer_css() {
    $width = get_theme_mod('ecommerce_clothing_sidebar_width', '30');
    ?>
    <style type="text/css">
        .right-sidebar .asterthemes-wrapper .asterthemes-page {
            grid-template-columns: auto <?php echo esc_attr($width); ?>%;
        }
        .left-sidebar .asterthemes-wrapper .asterthemes-page {
            grid-template-columns: <?php echo esc_attr($width); ?>% auto;
        }
    </style>
    <?php
}
add_action('wp_head', 'ecommerce_clothing_sidebar_width_customizer_css');