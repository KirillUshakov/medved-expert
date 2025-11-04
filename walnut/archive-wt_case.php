<?php get_header(); ?>
	
	<div class="container">
		
		<div class="content">
			
			<div class="archive-portfolio">
				
				<?php wt_breadcrumbs(); ?>
				<h1>
					<?php if( is_day() ) { ?>
						<?php _e( 'Archive records for', 'walnut' ); ?><?php echo get_the_date( 'j F Y' ); ?>
					<?php } elseif( is_month() ) { ?>
						<?php _e( 'Archive records for', 'walnut' ); ?><?php echo get_the_date( 'F Y' ); ?>
					<?php } elseif( is_year() ) { ?>
						<?php _e( 'Archive records for', 'walnut' ); ?><?php echo get_the_date( 'Y' ); ?>
					<?php } else { ?>
						<?php echo isset( get_queried_object()->labels->name ) ? get_queried_object()->labels->name :
							get_queried_object()->name; ?>
					<?php } ?>
				</h1>
				
				<?php if( have_posts() ) { ?>
					
					<?php while( have_posts() ) { ?>
						<?php the_post(); ?>
						
						<div>
							<h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
							
							<a href="<?php the_permalink(); ?> "><?php the_post_thumbnail(); ?></a>
							<?php the_excerpt(); ?>
						</div>
					
					<?php } ?>
				
				<?php } else { ?>
					<p><?php _e( 'Sorry, no posts matched your criteria.', 'walnut' ); ?></p>
				<?php } ?>
				
				<div class="pagination">
					<?php the_posts_pagination( array( 'prev_text' => '&laquo;', 'next_text' => '&raquo;' ) ); ?>
				</div>
			
			</div>
		
		</div>
	
	</div>

<?php get_footer(); ?>