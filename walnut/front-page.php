<?php get_header(); ?>

	<div class="container">

		<div class="content">

			<?php the_post(); ?>

			<?php the_post_thumbnail(); ?>

			<?php the_content(); ?>

		</div>

	</div>

<?php get_footer(); ?>