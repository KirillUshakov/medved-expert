<?php get_header(); ?>
<?php $taxonomy = get_taxonomy( get_query_var( 'taxonomy' ) ); ?>
<?php $post_type = get_post_type_object( get_query_var( 'post_type' ) ); ?>
	
	<div class="container">
		
		<div class="content">
			
			<div class="archive-catalog">
				
				<?php wt_breadcrumbs(); ?>
				<h1>
					<?php echo $post_type && isset( $post_type->labels->menu_name ) ? $post_type->labels->menu_name :
						get_queried_object()->name; ?>
				</h1>
				
				<div><?php the_archive_description(); ?></div>
				
				<?php get_template_part( 'parts/catalog/content', wt_catalog_options( 'display_type' ) ); ?>
				
				<div class="pagination">
					<?php the_posts_pagination( array( 'prev_text' => '&laquo;', 'next_text' => '&raquo;' ) ); ?>
				</div>
			
			</div>
		
		</div>
	
	</div>

<?php get_footer(); ?>