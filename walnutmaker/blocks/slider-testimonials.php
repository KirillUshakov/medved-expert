<?php
	/** Слайдер отзывов */
	$obj = get_queried_object();
	$testimonials = new WP_Query( array(
		'post_type' => 'wt_testimonial',
		'order' => 'DESC',
		'posts_per_page' => 12,
		'post_status' => 'approve',
	) );
	if( $testimonials->have_posts() ) { ?>
		<section class="<?php wm_block_classes( 'wt-slider-testimonials' ); ?>" <?php wm_block_styles(); ?>>
			<?php wm_container_open(); ?>
			
			<?php if( get_sub_field( 'title', $obj ) ) { ?>
				<h2 class="wt-slider-testimonials-title"><?php the_sub_field( 'title', $obj ); ?></h2>
			<?php } ?>
			
			<?php if( get_sub_field( 'desc', $obj ) ) { ?>
				<div class="wt-slider-testimonials-description"><?php the_sub_field( 'desc', $obj ); ?></div>
			<?php } ?>
			
			<div class="wt-slider-testimonials-wrap owl-carousel" data-options="<?php echo htmlspecialchars( json_encode( get_sub_field( 'options', $obj ) ), ENT_QUOTES,
				     'UTF-8' ); ?>" data-speed="<?php the_sub_field( 'speed', $obj ); ?>" data-interval="<?php the_sub_field( 'interval', $obj ); ?>" data-cols="<?php the_sub_field( 'block-cols', $obj ); ?>">
				<?php while( $testimonials->have_posts() ) { ?>
					<?php $testimonials->the_post(); ?>
					
					<div class="wt-slider-testimonials-item">
						
						<div class="wt-slider-testimonials-avatar">
							<?php
								$avatar = wt_testimonial_field( 'avatar', get_the_ID(), false );
								if( $avatar && isset( $avatar['value'] ) && $avatar['value'] ) {
									echo wp_get_attachment_image( $avatar['value'], 'thumbnail' );
								}
							?>
						</div>
						<div class="wt-slider-testimonials-name">
							<?php wt_testimonial_field( 'name', get_the_ID() ); ?>
						</div>
						<div class="wt-slider-testimonials-message"><?php the_content(); ?></div>
					
					</div>
				<?php } ?>
			</div>
			
			<?php get_template_part( 'blocks/parts/link' ); ?>
			
			<?php wm_container_close(); ?>
		</section>
		<?php
	}
	wp_reset_postdata();
	wp_reset_query();