<?php get_header(); ?>
<?php
	global $wp_query;
	$wp_query->query['post_status'] = 'approve';
	query_posts( $wp_query->query );
?>
	
	<div class="site-page-header">
		<div class="site-page-title">
			<div class="container">
				<h1><?php echo isset( get_queried_object()->labels->name ) ? get_queried_object()->labels->name :
						get_queried_object()->name; ?></h1>
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
					
					<div class="testimonial-archive">
						
						<?php if( have_posts() ) { ?>
							
							<ul class="testimonial-list">
								<?php while( have_posts() ) { ?>
									<?php the_post(); ?>
									<li class="testimonial-col">
										<div class="testimonial-archive-item">
											<a href="<?php the_permalink( get_the_ID() ); ?>">
												<div class="testimonial-archive-brand">
													<?php wt_testimonial_field( 'avatar', get_the_ID() ); ?>
												</div>
												<div class="testimonial-archive-content">
													<div class="testimonial-archive-review">
														<?php the_excerpt(); ?>
													</div>
													<div class="testimonial-archive-name">
														<?php wt_testimonial_field( 'name', get_the_ID() ); ?>
													</div>
													<div class="testimonial-archive-subtitle">
														<?php wt_testimonial_field( 'company', get_the_ID() ); ?>
													</div>
													<div class="testimonial-archive-rating">
														<?php wt_testimonial_field( 'rating', get_the_ID() ); ?>
													</div>
												</div>
											</a>
										</div>
									</li>
								<?php } ?>
							</ul>
						
						<?php } else { ?>
							<p><?php _e( 'Sorry, no posts matched your criteria.', 'walnut' ); ?></p>
						<?php } ?>
						
						<div class="pagination">
							<?php the_posts_pagination( array(
								'prev_text' => '&laquo;',
								'next_text' => '&raquo;'
							) ); ?>
						</div>
					
					</div>
				
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