<?php get_header(); ?>
	
	<div class="container">
		
		<div class="content">
			
			<?php wt_breadcrumbs(); ?>
			
			<div class="element">
				<?php the_post(); ?>
				
				<h1><?php the_title(); ?></h1>
				<?php wt_rating_block(); ?>
				<?php the_post_thumbnail(); ?>
				<?php the_content(); ?>
				
				<div>
					<?php
						if( function_exists( 'dynamic_sidebar' ) ) {
							dynamic_sidebar( 'default-sidebar' );
						}
					?>
				</div>
			</div>
		
		</div>
	
	</div>

<?php get_footer(); ?>