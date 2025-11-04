<?php get_header(); ?>
<?php the_post(); ?>
	
	<div class="site-page-header">
		<div class="site-page-title">
			<div class="container">
				<h1><?php the_title(); ?></h1>
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
			
			<div class="gallery-single">
				<?php the_post_thumbnail(); ?>
				<?php wt_rating_block(); ?>
				<div class="gallery-description"><?php the_content(); ?></div>
			</div>
		
		</div>
	</div>

<?php get_footer(); ?>