<?php get_header(); ?>
<?php $obj = wm_field_option(); ?>
	
	<div class="wt-page-head">
		<div class="container">
			
			<div class="wt-page-title">
				<h1>Поиск</h1>
			</div>
			<div class="wt-page-breadcrumbs hidden-xs">
				<?php wt_breadcrumbs(); ?>
			</div>
		
		</div>
	</div>
	
	<div class="wt-search">
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
				
				<div class="wt-content wt-page-col col-md-<?php echo get_field( 'layout', $obj ) == 'none' ? '12'
					: '9'; ?>">
					
					<div class="wt-search-form"><?php wt_form_search(); ?></div>
					
					<h3 class="wt-search-title">Поиск по запросу «<?php echo get_search_query(); ?>»</h3>
					
					<?php if( have_posts() ) { ?>
						
						<p class="wt-search-text">По вашему запросу найдено <?php
								$search = new WP_Query( array(
									's' => get_search_query(), 'posts_per_page' => -1,
								) );
								$count = $search->post_count;
								echo $count;
							?> запис<?php echo wt_num_end( $count, array( 'ь', 'и', 'ей' ) ) ?>:</p>
						
						<section class="wt-search-list">
							<?php while( have_posts() ) { ?>
								<?php the_post(); ?>
								
								<article class="wt-search-item">
									<a href="<?php the_permalink(); ?>">
										<?php wm_usability( 'image', $obj ) && the_post_thumbnail( 'adaptive' ); ?>
										<?php if( wm_usability( 'name', $obj ) ) { ?>
											<h3 class="wt-category-item-name"><?php wm_post_name(); ?></h3>
										<?php } ?>
										<?php if( wm_usability( 'desc', $obj ) ) { ?>
											<p class="wt-category-item-excerpt"><?php the_excerpt(); ?></p>
										<?php } ?>
									</a>
								</article>
							
							<?php } ?>
						</section>
						
						<div class="wt-pagination <?php wm_pagination_alignment( $obj ); ?>">
							<?php the_posts_pagination( array(
								'prev_text' => '&laquo;', 'next_text' => '&raquo;',
							) ); ?>
						</div>
					<?php } ?>
				
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