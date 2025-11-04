<?php get_header(); ?>

	<div class="container">

		<div class="content">

			<h1><?php the_title(); ?></h1>

			<?php the_post(); ?>

			<?php the_post_thumbnail(); ?>
			
			<?php the_content(); ?>

		</div>

	</div>

<?php get_footer(); ?>