<?php

function ecommerce_clothing_sanitize_select( $input, $setting ) {
	$input = sanitize_key( $input );
	$ecommerce_clothing_choices = $setting->manager->get_control( $setting->id )->choices;
	return ( array_key_exists( $input, $ecommerce_clothing_choices ) ? $input : $setting->default );
}

function ecommerce_clothing_sanitize_switch( $input ) {
	if ( true === $input ) {
		return true;
	} else {
		return false;
	}
}

function ecommerce_clothing_sanitize_google_fonts( $input, $setting ) {
	$ecommerce_clothing_choices = $setting->manager->get_control( $setting->id )->choices;
	return ( array_key_exists( $input, $ecommerce_clothing_choices ) ? $input : $setting->default );
}
/**
 * Sanitize HTML input.
 *
 * @param string $input HTML input to sanitize.
 * @return string Sanitized HTML.
 */
function ecommerce_clothing_sanitize_html( $input ) {
    return wp_kses_post( $input );
}

/**
 * Sanitize URL input.
 *
 * @param string $input URL input to sanitize.
 * @return string Sanitized URL.
 */
function ecommerce_clothing_sanitize_url( $input ) {
    return esc_url_raw( $input );
}

// Sanitize Scroll Top Position
function ecommerce_clothing_sanitize_scroll_top_position( $input ) {
    $valid_positions = array( 'bottom-right', 'bottom-left', 'bottom-center' );
    if ( in_array( $input, $valid_positions ) ) {
        return $input;
    } else {
        return 'bottom-right'; // Default to bottom-right if invalid value
    }
}

function ecommerce_clothing_sanitize_choices( $input, $setting ) {
	global $wp_customize; 
	$control = $wp_customize->get_control( $setting->id ); 
	if ( array_key_exists( $input, $control->choices ) ) {
		return $input;
	} else {
		return $setting->default;
	}
}

function ecommerce_clothing_sanitize_range_value( $number, $setting ) {

	// Ensure input is an absolute integer.
	$number = absint( $number );

	// Get the input attributes associated with the setting.
	$atts = $setting->manager->get_control( $setting->id )->input_attrs;

	// Get minimum number in the range.
	$min = ( isset( $atts['min'] ) ? $atts['min'] : $number );

	// Get maximum number in the range.
	$max = ( isset( $atts['max'] ) ? $atts['max'] : $number );

	// Get step.
	$step = ( isset( $atts['step'] ) ? $atts['step'] : 1 );

	// If the number is within the valid range, return it; otherwise, return the default.
	return ( $min <= $number && $number <= $max && is_int( $number / $step ) ? $number : $setting->default );
}