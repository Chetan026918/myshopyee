<?php

if ( ! get_theme_mod( 'ecommerce_clothing_enable_service_section', false ) ) {
	return;
}

$args = '';

ecommerce_clothing_render_service_section( $args );

/**
 * Render Service Section.
 */
function ecommerce_clothing_render_service_section( $args ) { ?>
		<section id="ecommerce_clothing_trending_section" class="asterthemes-frontpage-section trending-section trending-style-1">
		<?php
		if ( is_customize_preview() ) :
			ecommerce_clothing_section_link( 'ecommerce_clothing_service_section' );
		endif;

		$ecommerce_clothing_trending_product_heading = get_theme_mod( 'ecommerce_clothing_trending_product_heading', '' );
		?>
			<?php if ( ! empty( $ecommerce_clothing_trending_product_heading ) ) { ?>
				<div class="product-contact-inner">
					<h3><?php echo esc_html( $ecommerce_clothing_trending_product_heading ); ?></h3>
				</div>
			<?php } ?>
			<?php 
      if ( class_exists( 'WooCommerce' ) ) { ?>

      	<div class="tab">
	        <?php $ecommerce_clothing_featured_post = get_theme_mod('ecommerce_clothing_services_number', '');
	          	for ( $ecommerce_clothing_j = 1; $ecommerce_clothing_j <= $ecommerce_clothing_featured_post; $ecommerce_clothing_j++ ){ ?>
	      		<button class="tablinks" onclick="ecommerce_clothing_services_tab(event, '<?php $ecommerce_clothing_main_id = get_theme_mod('ecommerce_clothing_services_text'.$ecommerce_clothing_j); $ecommerce_clothing_tab_id = str_replace(' ', '-', $ecommerce_clothing_main_id); echo $ecommerce_clothing_tab_id; ?> ')">
	          	<?php echo esc_html(get_theme_mod('ecommerce_clothing_services_text'.$ecommerce_clothing_j)); ?></button>
	        <?php }?>
	  	</div>

	  	<?php for ( $ecommerce_clothing_j = 1; $ecommerce_clothing_j <= $ecommerce_clothing_featured_post; $ecommerce_clothing_j++ ){ 
	  		$ecommerce_clothing_catData = get_theme_mod('ecommerce_clothing_trending_product_category'.$ecommerce_clothing_j,''); 
	  		?>
			        <div id="<?php $ecommerce_clothing_main_id = get_theme_mod('ecommerce_clothing_services_text'.$ecommerce_clothing_j); $ecommerce_clothing_tab_id = str_replace(' ', '-', $ecommerce_clothing_main_id); echo $ecommerce_clothing_tab_id; ?>"  class="tabcontent">
			        	<div class="services_main_box">
			        		<div class="owl-carousel">
					        <?php  $args = array(
					          'post_type' => 'product',
					          'posts_per_page' => 100,
					          'product_cat' => $ecommerce_clothing_catData,
					          'order' => 'ASC'
					        );?>
						        <?php $loop = new WP_Query( $args );
						        while ( $loop->have_posts() ) : $loop->the_post(); global $product; ?>
						          <div class="tab-product">
					            	<figure>
					              	<?php if (has_post_thumbnail( $loop->post->ID )) echo get_the_post_thumbnail($loop->post->ID, 'shop_catalog'); else echo '<img src="'.esc_url(wc_placeholder_img_src()).'" />'; ?>
					              	<?php if ( has_post_thumbnail() ) { ?>
					                    <?php woocommerce_show_product_sale_flash( $product ); ?>
					                <?php }?>
					                <div class="box-content intro-button">
					              		<?php if( $product->is_type( 'simple' ) ) { woocommerce_template_loop_add_to_cart(  $loop->post, $product );} ?>
					          			</div>
					              </figure>
					          			<h5 class="product-text"><a href="<?php echo esc_url(get_permalink( $loop->post->ID )); ?>"><?php the_title(); ?></a></h5>
					        			<p class="<?php echo esc_attr( apply_filters( 'woocommerce_product_price_class', 'price' ) ); ?>"><?php echo $product->get_price_html(); ?></p>
						          </div>
						        <?php endwhile; wp_reset_postdata(); ?>
						    </div>
					   	</div>
					</div>
				<?php }?>
      <?php } ?>
	</section>
	<?php
}
