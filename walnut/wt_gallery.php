<?php get_header(); ?>
<?php $term = get_queried_object(); ?>
	
	<div class="site-page-header">
		<div class="site-page-title">
			<div class="container">
				<h1><?php echo $term->name; ?></h1>
			</div>
		</div>
		<div class="breadcrumbs">
			<div class="container">
				<?php wt_breadcrumbs(); ?>
			</div>
		</div>
	</div>
	
	<div class="gallery">
		<div class="container">
			
			<div class="gallery-photos">
				
				<?php if( get_the_archive_description() ) { ?>
					<div class="gallery-description"><?php the_archive_description(); ?></div>
				<?php } ?>
				
				<?php get_template_part( 'parts/wt_gallery/content', wt_gallery_options( 'display_type' ) ); ?>
				
				<div class="site-page-pagination">
					<?php the_posts_pagination( array( 'prev_text' => '&laquo;', 'next_text' => '&raquo;' ) ); ?>
				</div>
			
			</div>
		</div>
	</div>

<?php get_footer(); ?>