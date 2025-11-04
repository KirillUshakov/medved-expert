<?php get_header(); ?>
<?php the_post(); ?>
	
	<div class="wt-page-head">
		<div class="container">
			
			<div class="wt-page-title">
				<h1><?php the_title(); ?></h1>
			</div>
			<div class="wt-page-breadcrumbs hidden-xs">
				<?php wt_breadcrumbs(); ?>
			</div>
		
		</div>
	</div>
	
	<div class="wt-gallery wt-gallery-single">
		<div class="container">
			
			<div class="wt-gallery-item">
				
				<?php if( get_the_archive_description() ) { ?>
					<div class="wt-gallery-description"><?php the_content(); ?></div>
				<?php } ?>
				
				<?php the_post_thumbnail(); ?>
			
			</div>
		
		</div>
	</div>

<?php get_footer(); ?>