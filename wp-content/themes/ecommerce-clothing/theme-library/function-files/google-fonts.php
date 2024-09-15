<?php
function ecommerce_clothing_get_all_google_fonts() {
    $ecommerce_clothing_webfonts_json = get_template_directory() . '/theme-library/google-webfonts.json';
    if ( ! file_exists( $ecommerce_clothing_webfonts_json ) ) {
        return array();
    }

    $ecommerce_clothing_fonts_json_data = file_get_contents( $ecommerce_clothing_webfonts_json );
    if ( false === $ecommerce_clothing_fonts_json_data ) {
        return array();
    }

    $ecommerce_clothing_all_fonts = json_decode( $ecommerce_clothing_fonts_json_data, true );
    if ( json_last_error() !== JSON_ERROR_NONE ) {
        return array();
    }

    $ecommerce_clothing_google_fonts = array();
    foreach ( $ecommerce_clothing_all_fonts as $font ) {
        $ecommerce_clothing_google_fonts[ $font['family'] ] = array(
            'family'   => $font['family'],
            'variants' => $font['variants'],
        );
    }
    return $ecommerce_clothing_google_fonts;
}


function ecommerce_clothing_get_all_google_font_families() {
    $ecommerce_clothing_google_fonts  = ecommerce_clothing_get_all_google_fonts();
    $ecommerce_clothing_font_families = array();
    foreach ( $ecommerce_clothing_google_fonts as $font ) {
        $ecommerce_clothing_font_families[ $font['family'] ] = $font['family'];
    }
    return $ecommerce_clothing_font_families;
}

function ecommerce_clothing_get_fonts_url() {
    $ecommerce_clothing_fonts_url = '';
    $fonts     = array();

    $ecommerce_clothing_all_fonts = ecommerce_clothing_get_all_google_fonts();

    if ( ! empty( get_theme_mod( 'ecommerce_clothing_site_title_font', 'Lora' ) ) ) {
        $fonts[] = get_theme_mod( 'ecommerce_clothing_site_title_font', 'Lora' );
    }

    if ( ! empty( get_theme_mod( 'ecommerce_clothing_site_description_font', 'Raleway' ) ) ) {
        $fonts[] = get_theme_mod( 'ecommerce_clothing_site_description_font', 'Raleway' );
    }

    if ( ! empty( get_theme_mod( 'ecommerce_clothing_header_font', 'Raleway' ) ) ) {
        $fonts[] = get_theme_mod( 'ecommerce_clothing_header_font', 'Raleway' );
    }

    if ( ! empty( get_theme_mod( 'ecommerce_clothing_content_font', 'Raleway' ) ) ) {
        $fonts[] = get_theme_mod( 'ecommerce_clothing_content_font', 'Raleway' );
    }

    $fonts = array_unique( $fonts );

    foreach ( $fonts as $font ) {
        $ecommerce_clothing_variants      = $ecommerce_clothing_all_fonts[ $font ]['variants'];
        $ecommerce_clothing_font_family[] = $font . ':' . implode( ',', $ecommerce_clothing_variants );
    }

    $query_args = array(
        'family' => urlencode( implode( '|', $ecommerce_clothing_font_family ) ),
    );

    if ( ! empty( $ecommerce_clothing_font_family ) ) {
        $ecommerce_clothing_fonts_url = add_query_arg( $query_args, 'https://fonts.googleapis.com/css' );
    }

    return $ecommerce_clothing_fonts_url;
}

