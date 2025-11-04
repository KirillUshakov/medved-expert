<?php get_header(); ?>
<style>#add_review>input, textarea{    width: 100% !important;}</style>
<?php $obj = get_queried_object(); ?>

	<div class="wt-page-head">
		<div class="container">
			<div class="wt-page-breadcrumbs hidden-xs">
				<?php wt_breadcrumbs(); ?>
			</div>
			<div class="wt-page-title">
				<h1><?php the_archive_title(); ?><?php echo Declension(get_blog_details( array( 'blog_id' => $blog_id ) )->blogname); ?></h1>
			</div>
		</div>
	</div>

	<div class="wt-category wt-category-reviews">
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

					<?php wm_content_blocks(); ?>

					<div class="wt-single"><div class="container"><div class="wt-page-row"><div class="wt-content wt-page-col col-md-12">
					<form id="add_review" class="modal">
					    <h2>Добавление отзыва:</h2>
					    <input type="text" name="name" placeholder="Ваше Имя" required><br>
					    <textarea name="message" placeholder="Ваше сообщение" required></textarea>
					    <div class="rating__group">
					        <input class="rating__star" type="radio" name="rating" value="1" aria-label="Ужасно">
					        <input class="rating__star" type="radio" name="rating" value="2" aria-label="Сносно">
					        <input class="rating__star" type="radio" name="rating" value="3" aria-label="Нормально">
					        <input class="rating__star" type="radio" name="rating" value="4" aria-label="Хорошо">
					        <input class="rating__star" type="radio" name="rating" value="5" aria-label="Отлично" checked>
					    </div>
						<div class="g-recaptcha" data-sitekey="6LdFM9weAAAAAKNftQP0S3_qTKZf0QIcf2cEdl46" style="margin-top: 10px"></div>
						<div id="review-error" style="margin-top: 10px"></div>
						<input type="submit" value="Отправить" class="wpcf7-form-control has-spinner wpcf7-submit btn btn-default" style="border-color: transparent; margin-top: 10px;">
                      </form>
                      <a href="#add_review" rel="modal:open" class="wpcf7-form-control has-spinner wpcf7-submit btn btn-default revBtn" style="border-color: transparent; margin:0 auto;display: table;">Оставить отзыв</a>
				</div></div></div></div><br>

					<div class="wt-category-description wt-styles"><?php the_archive_description(); ?></div>

					<?php if( get_field( 'show-posts', $obj ) ) { ?>
						<?php if( have_posts() ) { ?>
							<section class="wt-category-row <?php wm_posts_alignment(); ?>">
								<?php while( have_posts() ) { ?>
									<?php the_post(); ?>

									<article class="wt-category-col col-sm-6 col-md-4">
										<?php get_template_part( 'parts/category/article', get_post_format() ); ?>
									</article>

								<?php } ?>
							</section>

							<div class="wt-pagination <?php wm_pagination_alignment(); ?>">
								<?php the_posts_pagination( array(
									'prev_text' => '&laquo;',
									'next_text' => '&raquo;'
								) ); ?>
							</div>
						<?php } ?>
					<?php } ?>

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
	</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-modal/0.9.1/jquery.modal.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-modal/0.9.1/jquery.modal.min.css" />

<?php get_footer(); ?>
