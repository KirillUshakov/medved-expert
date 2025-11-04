<?php get_header(); ?>
<?php the_post(); ?>
	
	<div class="site-page-header">
		<div class="site-page-title">
			<div class="container">
				<h1><?php the_title(); ?></h1>
			</div>
		</div>
		<div class="breadcrumbs">
			<div class="container">
				<?php wt_breadcrumbs(); ?>
			</div>
		</div>
	</div>
	
	<div class="testimonial">
		<div class="container">
			
			<div class="site-page-list">
				
				<div class="site-page-col col-medium-8 site-content">
					
					<?php the_content(); ?>
					<?php wt_testimonial_fields(); ?>
				
				</div>
				
				<div class="site-page-col col-medium-4 site-sidebar">
					
					<a href="#" class="btn btn-main modal-testimonial-open"><?php _e( 'Write a review',
							'walnut' ); ?></a>
					
					<?php
						if( function_exists( 'dynamic_sidebar' ) ) {
							dynamic_sidebar( 'default-sidebar' );
						}
					?>
				
				</div>
			
			</div>
		
		</div>
	</div>

<?php get_template_part( 'parts/modal/testimonial-modal' ); ?>
<?php get_footer(); ?>