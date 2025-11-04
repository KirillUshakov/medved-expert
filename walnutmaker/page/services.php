<?php /** Template Name: Услуги */ ?>
<?php get_header(); ?>

	<div class="page-header">
		<div class="container">
			<?php wt_breadcrumbs(); ?>
		</div>
	</div>

	<div class="services-page">

		<div class="container clearfix">

			<div class="sidebar"><?php wm_sidebar_blocks(); ?></div>

			<div class="page-wrapper">
				<?php the_post(); ?>
				<h1>
					<?php the_title(); ?>
					<?php add_city_postfix() ?>
				</h1>

				<div class="attendance">

					<?php the_post_thumbnail( 'large' ); ?>

					<?php $posts = get_posts( array( 'post_type' => 'page', 'post_parent' => get_the_ID() ) ); ?>
					<?php if( $posts ) { ?>
						<?php global $post; ?>
						<ul class="attendance__list">
							<?php foreach( $posts as $post ) { ?>
								<?php setup_postdata( $post ); ?>
								<li class="attendance__item clearfix">
									<div class="attendance__thumb"><?php the_post_thumbnail( 'product' ); ?></div>
									<div class="attendance__content">
										<div class="attendance__title"><?php the_title(); ?></div>
										<?php the_advanced_excerpt(); ?>
										<a href="<?php the_permalink(); ?>">Посмотреть подробнее</a>
									</div>
								</li>
							<?php } ?>
							<?php wp_reset_postdata(); ?>
						</ul>
					<?php } ?>

					<div class="page-content">
						<?php the_content(); ?>
					</div>

				</div>

			</div>

		</div>

	</div>

<?php get_footer(); ?>
