<?php get_header(); ?>
<?php the_post(); ?>
<?php if( get_the_content() || wm_have_blocks() || wm_have_sidebar_blocks() ) { ?>
	<div class="container">

		<div class="wt-page-row">

			<?php if( get_field( 'layout', $obj ) == 'left' ) { ?>
				<div class="wt-sidebar wt-page-col col-md-3">

					<?php
						if( function_exists( 'dynamic_sidebar' ) ) {
							dynamic_sidebar( 'default-sidebar' );
						}
					?>

					<?php wm_sidebar_blocks(); ?>

				</div>
			<?php } ?>

			<div class="wt-content wt-page-col col-md-<?php echo get_field( 'layout', $obj ) == 'none' ? '12' :
				'9'; ?>">

				<?php the_post_thumbnail(); ?>
				<div class="wt-single-content wt-styles"><?php the_content(); ?></div>

				<?php wm_content_blocks(); ?>

			</div>

			<?php if( get_field( 'layout', $obj ) == 'right' ) { ?>
				<div class="wt-sidebar wt-page-col col-md-3">

					<?php
						if( function_exists( 'dynamic_sidebar' ) ) {
							dynamic_sidebar( 'default-sidebar' );
						}
					?>

					<?php wm_sidebar_blocks(); ?>

				</div>
			<?php } ?>

		</div>

	</div>
<?php } ?>
<?php get_footer(); ?>
