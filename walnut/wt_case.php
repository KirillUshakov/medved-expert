<?php get_header(); ?>

	<div class="container">

		<div class="content">

			<h1><?php the_title(); ?></h1>
			
			<?php wt_breadcrumbs(); ?>

			<?php the_post(); ?>
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

<?php get_footer(); ?>