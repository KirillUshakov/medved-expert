<?php get_header(); ?>
<?php $obj = get_queried_object(); ?>

	<div class="wt-page-head">
		<div class="container">
			<div class="wt-page-breadcrumbs hidden-xs">
				<?php wt_breadcrumbs(); ?>
			</div>
			<div class="wt-page-title test3">
				<h1><?php the_archive_title(); ?><?php echo Declension(get_blog_details( array( 'blog_id' => $blog_id ) )->blogname); ?></h1>
			</div>
		</div>
	</div>
	
	<div style="display:none;" id="111">
			<?php echo $aiosp_title; ?>
	</div>

	<div class="wt-category wt-category-<?php echo $obj->slug; ?>" <?php echo ($obj->slug == 'blog') ? 'itemscope itemtype="http://schema.org/Blog"' : ''; ?>>
		<meta itemprop="headline" content="<?php the_archive_title(); ?>" />
		<meta itemprop="description" content="Блог аварийной замочной службы Медведь Эксперт в Москве" />
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
					
					<div class="wt-category-description wt-styles"><?php the_archive_description(); ?></div>
					
					<?php if( get_field( 'show-posts', $obj ) ) { ?>
						<?php if( have_posts() ) { ?>
							<section class="wt-category-row <?php wm_posts_alignment(); ?>">
								<?php while( have_posts() ) { ?>
									<?php the_post(); ?>
									
									<article class="wt-category-col col-sm-6 col-md-4" <?php echo ($obj->slug == 'blog') ? 'itemprop="blogPosts" itemscope itemtype="http://schema.org/BlogPosting"' : ''; ?>>
										<?php get_template_part( 'parts/category/article' ); ?>
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
					
					<?php wm_content_blocks(); ?>
				
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

<?php get_footer(); ?>