<?php get_header(); ?>
	
	<div class="container">
		
		<div class="content">
			
			<div class="taxonomy-catalog">
				
				<?php $term = get_queried_object(); ?>
				
				<h1><?php echo $term->name; ?></h1>
				<?php wt_breadcrumbs(); ?>
				
				<?php the_archive_description(); ?>
				
				<?php if( have_posts() ) { ?>
					
					<ul>
						<?php while( have_posts() ) { ?>
							<?php the_post(); ?>
							<li>
								<h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
								
								<a href="<?php the_permalink(); ?> "><?php the_post_thumbnail(); ?></a>
								<?php the_excerpt(); ?>
							</li>
						<?php } ?>
					</ul>
				
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