<?php get_header(); ?>
<?php $term = get_queried_object(); ?>
	
	<div class="wt-page-head">
		<div class="container">
			
			<div class="wt-page-title">
				<h1><?php echo $term->name; ?></h1>
			</div>
			<div class="wt-page-breadcrumbs hidden-xs">
				<?php wt_breadcrumbs(); ?>
			</div>
		
		</div>
	</div>
	
	<div class="wt-gallery wt-gallery-list">
		<div class="container">
			
			<div class="wt-gallery-photos">
				
				<?php if( get_the_archive_description() ) { ?>
					<div class="wt-gallery-description"><?php the_archive_description(); ?></div>
				<?php } ?>
				
				<?php get_template_part( 'parts/wt_gallery/content', wt_gallery_options( 'display_type' ) ); ?>
				
			</div>
		
		</div>
	</div>

<?php get_footer(); ?>