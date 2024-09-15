<?php

/**
 * Active Callbacks
 *
 * @package ecommerce_clothing
 */

// Theme Options.
function ecommerce_clothing_is_pagination_enabled( $control ) {
	return ( $control->manager->get_setting( 'ecommerce_clothing_enable_pagination' )->value() );
}
function ecommerce_clothing_is_breadcrumb_enabled( $control ) {
	return ( $control->manager->get_setting( 'ecommerce_clothing_enable_breadcrumb' )->value() );
}
function ecommerce_clothing_is_layout_enabled( $control ) {
	return ( $control->manager->get_setting( 'ecommerce_clothing_website_layout' )->value() );
}

// Header Options.
function ecommerce_clothing_is_topbar_enabled( $control ) {
	return ( $control->manager->get_Setting( 'ecommerce_clothing_enable_topbar' )->value() );
}

// Banner Slider Section.
function ecommerce_clothing_is_banner_slider_section_enabled( $control ) {
	return ( $control->manager->get_setting( 'ecommerce_clothing_enable_banner_section' )->value() );
}
function ecommerce_clothing_is_banner_slider_section_and_content_type_post_enabled( $control ) {
	$ecommerce_clothing_content_type = $control->manager->get_setting( 'ecommerce_clothing_banner_slider_content_type' )->value();
	return ( ecommerce_clothing_is_banner_slider_section_enabled( $control ) && ( 'post' === $ecommerce_clothing_content_type ) );
}
function ecommerce_clothing_is_banner_slider_section_and_content_type_page_enabled( $control ) {
	$ecommerce_clothing_content_type = $control->manager->get_setting( 'ecommerce_clothing_banner_slider_content_type' )->value();
	return ( ecommerce_clothing_is_banner_slider_section_enabled( $control ) && ( 'page' === $ecommerce_clothing_content_type ) );
}

// Service section.
function ecommerce_clothing_is_service_section_enabled( $control ) {
	return ( $control->manager->get_setting( 'ecommerce_clothing_enable_service_section' )->value() );
}
function ecommerce_clothing_is_service_section_and_content_type_post_enabled( $control ) {
	$ecommerce_clothing_content_type = $control->manager->get_setting( 'ecommerce_clothing_service_content_type' )->value();
	return ( ecommerce_clothing_is_service_section_enabled( $control ) && ( 'post' === $ecommerce_clothing_content_type ) );
}
function ecommerce_clothing_is_service_section_and_content_type_page_enabled( $control ) {
	$ecommerce_clothing_content_type = $control->manager->get_setting( 'ecommerce_clothing_service_content_type' )->value();
	return ( ecommerce_clothing_is_service_section_enabled( $control ) && ( 'page' === $ecommerce_clothing_content_type ) );
}