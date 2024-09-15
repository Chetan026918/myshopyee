<?php

/**
 * Functions which enhance the theme by hooking into WordPress
 *
 * @package ecommerce_clothing
 */

function ecommerce_clothing_body_classes( $classes ) {
	// Adds a class of hfeed to non-singular pages.
	if ( ! is_singular() ) {
		$classes[] = 'hfeed';
	}

	// Adds a class of no-sidebar when there is no sidebar present.
	if ( ! is_active_sidebar( 'sidebar-1' ) ) {
		$classes[] = 'no-sidebar';
	}

	$classes[] = ecommerce_clothing_sidebar_layout();

	return $classes;
}
add_filter( 'body_class', 'ecommerce_clothing_body_classes' );

/**
 * Add a pingback url auto-discovery header for single posts, pages, or attachments.
 */
function ecommerce_clothing_pingback_header() {
	if ( is_singular() && pings_open() ) {
		printf( '<link rel="pingback" href="%s">', esc_url( get_bloginfo( 'pingback_url' ) ) );
	}
}
add_action( 'wp_head', 'ecommerce_clothing_pingback_header' );


/**
 * Get all posts for customizer Post content type.
 */
function ecommerce_clothing_get_post_choices() {
	$ecommerce_clothing_choices = array( '' => esc_html__( '--Select--', 'ecommerce-clothing' ) );
	$args    = array( 'numberposts' => -1 );
	$ecommerce_clothing_posts   = get_posts( $args );

	foreach ( $ecommerce_clothing_posts as $post ) {
		$id             = $post->ID;
		$title          = $post->post_title;
		$ecommerce_clothing_choices[ $id ] = $title;
	}

	return $ecommerce_clothing_choices;
}

/**
 * Get all pages for customizer Page content type.
 */
function ecommerce_clothing_get_page_choices() {
	$ecommerce_clothing_choices = array( '' => esc_html__( '--Select--', 'ecommerce-clothing' ) );
	$ecommerce_clothing_pages   = get_pages();

	foreach ( $ecommerce_clothing_pages as $page ) {
		$ecommerce_clothing_choices[ $page->ID ] = $page->post_title;
	}

	return $ecommerce_clothing_choices;
}

/**
 * Get all categories for customizer Category content type.
 */
function ecommerce_clothing_get_post_cat_choices() {
	$ecommerce_clothing_choices = array( '' => esc_html__( '--Select--', 'ecommerce-clothing' ) );
	$cats    = get_categories();

	foreach ( $cats as $cat ) {
		$ecommerce_clothing_choices[ $cat->term_id ] = $cat->name;
	}

	return $ecommerce_clothing_choices;
}

/**
 * Get all donation forms for customizer form content type.
 */
function ecommerce_clothing_get_post_donation_form_choices() {
	$ecommerce_clothing_choices = array( '' => esc_html__( '--Select--', 'ecommerce-clothing' ) );
	$ecommerce_clothing_posts   = get_posts(
		array(
			'post_type'   => 'give_forms',
			'numberposts' => -1,
		)
	);
	foreach ( $ecommerce_clothing_posts as $post ) {
		$ecommerce_clothing_choices[ $post->ID ] = $post->post_title;
	}
	return $ecommerce_clothing_choices;
}

if ( ! function_exists( 'ecommerce_clothing_excerpt_length' ) ) :
	/**
	 * Excerpt length.
	 */
	function ecommerce_clothing_excerpt_length( $length ) {
		if ( is_admin() ) {
			return $length;
		}

		return get_theme_mod( 'ecommerce_clothing_excerpt_length', 20 );
	}
endif;
add_filter( 'excerpt_length', 'ecommerce_clothing_excerpt_length', 999 );

if ( ! function_exists( 'ecommerce_clothing_excerpt_more' ) ) :
	/**
	 * Excerpt more.
	 */
	function ecommerce_clothing_excerpt_more( $more ) {
		if ( is_admin() ) {
			return $more;
		}

		return '&hellip;';
	}
endif;
add_filter( 'excerpt_more', 'ecommerce_clothing_excerpt_more' );

if ( ! function_exists( 'ecommerce_clothing_sidebar_layout' ) ) {
	/**
	 * Get sidebar layout.
	 */
	function ecommerce_clothing_sidebar_layout() {
		$ecommerce_clothing_sidebar_position      = get_theme_mod( 'ecommerce_clothing_sidebar_position', 'right-sidebar' );
		$ecommerce_clothing_sidebar_position_post = get_theme_mod( 'ecommerce_clothing_post_sidebar_position', 'right-sidebar' );
		$ecommerce_clothing_sidebar_position_page = get_theme_mod( 'ecommerce_clothing_page_sidebar_position', 'right-sidebar' );

		if ( is_single() ) {
			$ecommerce_clothing_sidebar_position = $ecommerce_clothing_sidebar_position_post;
		} elseif ( is_page() ) {
			$ecommerce_clothing_sidebar_position = $ecommerce_clothing_sidebar_position_page;
		}

		return $ecommerce_clothing_sidebar_position;
	}
}

if ( ! function_exists( 'ecommerce_clothing_is_sidebar_enabled' ) ) {
	/**
	 * Check if sidebar is enabled.
	 */
	function ecommerce_clothing_is_sidebar_enabled() {
		$ecommerce_clothing_sidebar_position      = get_theme_mod( 'ecommerce_clothing_sidebar_position', 'right-sidebar' );
		$ecommerce_clothing_sidebar_position_post = get_theme_mod( 'ecommerce_clothing_post_sidebar_position', 'right-sidebar' );
		$ecommerce_clothing_sidebar_position_page = get_theme_mod( 'ecommerce_clothing_page_sidebar_position', 'right-sidebar' );

		$ecommerce_clothing_sidebar_enabled = true;
		if ( is_home() || is_archive() || is_search() ) {
			if ( 'no-sidebar' === $ecommerce_clothing_sidebar_position ) {
				$ecommerce_clothing_sidebar_enabled = false;
			}
		} elseif ( is_single() ) {
			if ( 'no-sidebar' === $ecommerce_clothing_sidebar_position || 'no-sidebar' === $ecommerce_clothing_sidebar_position_post ) {
				$ecommerce_clothing_sidebar_enabled = false;
			}
		} elseif ( is_page() ) {
			if ( 'no-sidebar' === $ecommerce_clothing_sidebar_position || 'no-sidebar' === $ecommerce_clothing_sidebar_position_page ) {
				$ecommerce_clothing_sidebar_enabled = false;
			}
		}
		return $ecommerce_clothing_sidebar_enabled;
	}
}

if ( ! function_exists( 'ecommerce_clothing_get_homepage_sections ' ) ) {
	/**
	 * Returns homepage sections.
	 */
	function ecommerce_clothing_get_homepage_sections() {
		$sections = array(
			'banner'  => esc_html__( 'Banner Section', 'ecommerce-clothing' ),
			'trending-product' => esc_html__( 'Product Section', 'ecommerce-clothing' ),
		);
		return $sections;
	}
}

/**
 * Renders customizer section link
 */
function ecommerce_clothing_section_link( $section_id ) {
	$ecommerce_clothing_section_name      = str_replace( 'ecommerce_clothing_', ' ', $section_id );
	$ecommerce_clothing_section_name      = str_replace( '_', ' ', $ecommerce_clothing_section_name );
	$ecommerce_clothing_starting_notation = '#';
	?>
	<span class="section-link">
		<span class="section-link-title"><?php echo esc_html( $ecommerce_clothing_section_name ); ?></span>
	</span>
	<style type="text/css">
		<?php echo $ecommerce_clothing_starting_notation . $section_id; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>:hover .section-link {
			visibility: visible;
		}
	</style>
	<?php
}

/**
 * Adds customizer section link css
 */
function ecommerce_clothing_section_link_css() {
	if ( is_customize_preview() ) {
		?>
		<style type="text/css">
			.section-link {
				visibility: hidden;
				background-color: black;
				position: relative;
				top: 80px;
				z-index: 99;
				left: 40px;
				color: #fff;
				text-align: center;
				font-size: 20px;
				border-radius: 10px;
				padding: 20px 10px;
				text-transform: capitalize;
			}

			.section-link-title {
				padding: 0 10px;
			}

			.banner-section {
				position: relative;
			}

			.banner-section .section-link {
				position: absolute;
				top: 100px;
			}
		</style>
		<?php
	}
}
add_action( 'wp_head', 'ecommerce_clothing_section_link_css' );

/**
 * Breadcrumb.
 */
function ecommerce_clothing_breadcrumb( $args = array() ) {
	if ( ! get_theme_mod( 'ecommerce_clothing_enable_breadcrumb', true ) ) {
		return;
	}

	$args = array(
		'show_on_front' => false,
		'show_title'    => true,
		'show_browse'   => false,
	);
	breadcrumb_trail( $args );
}
add_action( 'ecommerce_clothing_breadcrumb', 'ecommerce_clothing_breadcrumb', 10 );

/**
 * Add separator for breadcrumb trail.
 */
function ecommerce_clothing_breadcrumb_trail_print_styles() {
	$ecommerce_clothing_breadcrumb_separator = get_theme_mod( 'ecommerce_clothing_breadcrumb_separator', '/' );

	$style = '
		.trail-items li::after {
			content: "' . $ecommerce_clothing_breadcrumb_separator . '";
		}'; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped

	$style = apply_filters( 'ecommerce_clothing_breadcrumb_trail_inline_style', trim( str_replace( array( "\r", "\n", "\t", '  ' ), '', $style ) ) );

	if ( $style ) {
		echo "\n" . '<style type="text/css" id="breadcrumb-trail-css">' . $style . '</style>' . "\n"; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
	}
}
add_action( 'wp_head', 'ecommerce_clothing_breadcrumb_trail_print_styles' );

/**
 * Pagination for archive.
 */
function ecommerce_clothing_render_posts_pagination() {
	$ecommerce_clothing_is_pagination_enabled = get_theme_mod( 'ecommerce_clothing_enable_pagination', true );
	if ( $ecommerce_clothing_is_pagination_enabled ) {
		$ecommerce_clothing_pagination_type = get_theme_mod( 'ecommerce_clothing_pagination_type', 'default' );
		if ( 'default' === $ecommerce_clothing_pagination_type ) :
			the_posts_navigation();
		else :
			the_posts_pagination();
		endif;
	}
}
add_action( 'ecommerce_clothing_posts_pagination', 'ecommerce_clothing_render_posts_pagination', 10 );

/**
 * Pagination for single post.
 */
function ecommerce_clothing_render_post_navigation() {
	the_post_navigation(
		array(
			'prev_text' => '<span>&#10229;</span> <span class="nav-title">%title</span>',
			'next_text' => '<span class="nav-title">%title</span> <span>&#10230;</span>',
		)
	);
}
add_action( 'ecommerce_clothing_post_navigation', 'ecommerce_clothing_render_post_navigation' );

/**
 * Adds footer copyright text.
 */
function ecommerce_clothing_output_footer_copyright_content() {
    $ecommerce_clothing_theme_data = wp_get_theme();
    $ecommerce_clothing_copyright_text = get_theme_mod('ecommerce_clothing_footer_copyright_text');

    if (!empty($ecommerce_clothing_copyright_text)) {
        $ecommerce_clothing_text = esc_html($ecommerce_clothing_copyright_text);
    } else {
    	$ecommerce_clothing_default_text = esc_html($ecommerce_clothing_theme_data->get('Name')) . '&nbsp;' . esc_html__('by', 'ecommerce-clothing') . '&nbsp;<a target="_blank" href="' . esc_url($ecommerce_clothing_theme_data->get('AuthorURI')) . '">' . esc_html(ucwords($ecommerce_clothing_theme_data->get('Author'))) . '</a>';
        $ecommerce_clothing_default_text .= sprintf(esc_html__(' | Powered by %s', 'ecommerce-clothing'), '<a href="' . esc_url(__('https://wordpress.org/', 'ecommerce-clothing')) . '" target="_blank">WordPress</a>. ');
        $ecommerce_clothing_text = $ecommerce_clothing_default_text;
    }
    ?>
    <span><?php echo wp_kses_post($ecommerce_clothing_text); ?></span>
    <?php
}
add_action('ecommerce_clothing_footer_copyright', 'ecommerce_clothing_output_footer_copyright_content');

if ( ! function_exists( 'ecommerce_clothing_footer_widget' ) ) :
function ecommerce_clothing_footer_widget() {
	$ecommerce_clothing_footer_widget_column	= get_theme_mod('ecommerce_clothing_footer_widget_column','4'); 
		if ($ecommerce_clothing_footer_widget_column == '4') {
			$ecommerce_clothing_column = '3';
		} elseif ($ecommerce_clothing_footer_widget_column == '3') {
			$ecommerce_clothing_column = '4';
		} elseif ($ecommerce_clothing_footer_widget_column == '2') {
			$ecommerce_clothing_column = '6';
		} else{
			$ecommerce_clothing_column = '12';
		}
	if($ecommerce_clothing_footer_widget_column !==''): 
	?>
	<div class="dt_footer-widgets">
		
    <div class="footer-widgets-column">
    	<?php
		$ecommerce_clothing_footer_widget_column = get_theme_mod('ecommerce_clothing_footer_widget_column','4');
	for ($i=1; $i<=$ecommerce_clothing_footer_widget_column; $i++) { ?>
        <?php if ( is_active_sidebar( 'ecommerce-clothing-footer-widget-' .$i ) ) : ?>
            <div class="footer-one-column" >
                <?php dynamic_sidebar( 'ecommerce-clothing-footer-widget-'.$i); ?>
            </div>
        <?php endif; ?>
        <?php  } ?>
    </div>

</div>
	<?php 
	endif; } 
endif;
add_action( 'ecommerce_clothing_footer_widget', 'ecommerce_clothing_footer_widget' );


function ecommerce_clothing_footer_text_transform_css() {
    $ecommerce_clothing_footer_text_transform = get_theme_mod('footer_text_transform', 'none');
    ?>
    <style type="text/css">
        .site-footer h4 {
            text-transform: <?php echo esc_html($ecommerce_clothing_footer_text_transform); ?>;
        }
    </style>
    <?php
}
add_action('wp_head', 'ecommerce_clothing_footer_text_transform_css');
