<?php /** Template Name: Testimonials */ ?>
<?php get_header(); ?>
	
	<div class="container">
		
		<div class="content">
			
			<div class="testimonials">
				
				<?php wt_breadcrumbs(); ?>
				
				<h1><?php the_title(); ?></h1>
				<?php the_post(); ?>
				<?php the_content(); ?>
				
				<?php
					$testimonials = new WP_Query( array(
						'post_type' => 'wt_testimonial',
						'post_status' => 'approve'
					) );
				?>
				
				<?php if( $testimonials->have_posts() ) { ?>
					
					<ul class="testimonials">
						<?php while( $testimonials->have_posts() ) { ?>
							<?php $testimonials->the_post(); ?>
							<li class="testimonials__item">
								<?php the_content(); ?>
								<?php wt_testimonial_fields(); ?>
							</li>
						<?php } ?>
					</ul>
				
				<?php } else { ?>
					<p><?php _e( 'Sorry, no posts matched your criteria.', 'walnut' ); ?></p>
				<?php } ?>
				
				<?php wt_testimonials_form_fields(); ?>
			
			</div>
			
		</div>
	
	</div>


<?php get_footer(); ?>