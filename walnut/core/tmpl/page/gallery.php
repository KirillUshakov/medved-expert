<?php /** Template Name: Gallery */ ?>
<?php get_header(); ?>
	
	<div class="container">
		
		<div class="content">
			
			<div class="gallery">
				
				<?php wt_breadcrumbs(); ?>
				
				<?php if( have_posts() ) : while( have_posts() ) : the_post(); ?>
					
					<h1><?php the_title(); ?></h1>
					<?php the_content(); ?>
					
					<div>
						<?php $terms = get_terms( 'wt_gallery' ); ?>
						<?php foreach( $terms as $term ) { ?>
							
							<a href="<?php the_wt_term_link( $term->term_id, 'wt_gallery' ); ?>">
								<?php $photos = get_posts( array(
									'post_type' => 'wt_photo',
									'wt_gallery' => $term->slug,
									'numberposts' => -1
								) ); ?>
								<?php if( $photos && isset( $photos[0] ) ) { ?>
									<?php echo get_the_post_thumbnail( $photos[0]->ID, 'thumbnail' ); ?>
								<?php } ?>
								<span><?php echo $term->name; ?></span>
							</a>
						<?php } ?>
					</div>
				
				<?php endwhile;
				else : ?>
					<p><?php _e( 'Sorry, no posts matched your criteria.', 'walnut' ); ?></p>
				<?php endif; ?>
			
			</div>
		
		</div>
	
	</div>

<?php get_footer(); ?>