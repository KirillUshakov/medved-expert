<?php get_header(); ?>
<?php
	global $wp_query;
	$wp_query->query[ 'post_status' ] = 'approve';
	query_posts( $wp_query->query );
?>
	
	<div class="wt-page-head">
		<?php wm_container_open(); ?>
		
		<div class="wt-page-title">
			<h1><?php echo isset( get_queried_object()->labels->name ) ? get_queried_object()->labels->name
					: get_queried_object()->name; ?></h1>
		</div>
		<div class="wt-page-breadcrumbs hidden-xs">
			<?php wt_breadcrumbs(); ?>
		</div>
		
		<?php wm_container_close(); ?>
	</div>
	
	<div class="wt-testimonials">
		<?php wm_container_open(); ?>
		
		<div class="wt-page-row">
			<div class="wt-content wt-page-col col-md-8">
				
				<?php if( have_posts() ) { ?>
					<ul class="wt-testimonials-list">
						<?php while( have_posts() ) { ?>
							<?php the_post(); ?>
							
							<li class="wt-testimonials-item">
								<div class="wt-testimonials-brand">
									<?php wt_testimonial_field( 'logo', get_the_ID() ) ?>
								</div>
								<div class="wt-testimonials-content">
									<div class="wt-testimonials-name">
										<?php wt_testimonial_field( 'name', get_the_ID() ) ?>
									</div>
									<div class="wt-testimonials-review">
										<?php the_excerpt(); ?>
									</div>
								</div>
							</li>
						
						<?php } ?>
					</ul>
					
					<div class="wt-pagination">
						<?php the_posts_pagination( array(
							'prev_text' => '&laquo;', 'next_text' => '&raquo;',
						) ); ?>
					</div>
				<?php } else { ?>
					<p><?php _e( 'Sorry, no posts matched your criteria.', 'walnut' ); ?></p>
				<?php } ?>
				
			</div>
			<div class="wt-sidebar wt-page-col col-md-3"></div>
		</div>
		
		<?php wm_container_close(); ?>
	</div>

<?php get_footer(); ?>