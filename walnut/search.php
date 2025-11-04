<?php get_header(); ?>
	
	<div class="site-page-header">
		<div class="site-page-title">
			<div class="container">
				<h1><?php _e( 'Search result for', 'walnut' ); ?>:</h1>
				<?php wt_form_search(); ?>
			</div>
		</div>
		<div class="breadcrumbs">
			<div class="container">
				<?php wt_breadcrumbs(); ?>
			</div>
		</div>
	</div>
	
	<div class="search">
		<div class="container">
			
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
				<?php echo paginate_links( array(
					'prev_text' => '&laquo;',
					'next_text' => '&raquo;',
					'add_args' => $_GET
				) ); ?>
			</div>
		
		</div>
	</div>

<?php get_footer(); ?>