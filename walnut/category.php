<?php get_header(); ?>

	<div class="container">

		<div class="content">

			<?php $category = get_category( get_query_var( 'cat' ) ); ?>

			<h1><?php echo $category->name; ?></h1>
			<?php wt_breadcrumbs(); ?>

			<?php if( have_posts() ) { ?>

				<?php while( have_posts() ) { ?>
					<?php the_post(); ?>

					<h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>

					<a href="<?php the_permalink(); ?> "><?php the_post_thumbnail(); ?></a>
					<?php the_excerpt(); ?>

				<?php } ?>

			<?php } else { ?>
				<p><?php _e( 'Sorry, no posts matched your criteria.', 'walnut' ); ?></p>
			<?php } ?>
			
			<div class="pagination">
				<?php the_posts_pagination( array( 'prev_text' => '&laquo;', 'next_text' => '&raquo;' ) ); ?>
			</div>

		</div>

	</div>

<?php get_footer(); ?>