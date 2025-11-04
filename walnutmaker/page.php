<?php get_header(); ?>
<?php the_post(); ?>

	<div class="wt-page-head">
		<div class="container">

			<div class="wt-page-breadcrumbs hidden-xs">
				<?php wt_breadcrumbs(); ?>
			</div>
			<div class="wt-page-title test2">
				<h1> <?php the_title(); ?><?php add_city_postfix() ?></h1>
			</div>

		</div>
	</div>

<div style="display:none;" id="1111">
		<?php the_city_name() ?>
	</div>

<?php if( get_the_content() || wm_have_blocks() || wm_have_sidebar_blocks() ) { ?>
	<div class="wt-single">
		<div class="container">

			<div class="wt-page-row">

				<?php if( get_field( 'layout' ) == 'left' ) { ?>
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

					<div class="wt-styles">
						<?php the_post_thumbnail(); ?>
						<?php the_content(); ?>
					</div>

					<?php wm_content_blocks(); ?>
				</div>
				<?php if( get_field( 'layout' ) == 'right' ) { ?>
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
	</div>
<?php } ?>

<?php get_footer(); ?>
