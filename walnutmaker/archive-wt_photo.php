<?php get_header(); ?>
<?php $post_type = get_post_type_object( get_query_var( 'post_type' ) ); ?>
	
	<div class="wt-page-head">
		<div class="container">
			
			<div class="wt-page-title">
				<h1><?php echo $post_type && isset( $post_type->labels->menu_name ) ? $post_type->labels->menu_name :
						get_queried_object()->name; ?></h1>
			</div>
			<div class="wt-page-breadcrumbs hidden-xs">
				<?php wt_breadcrumbs(); ?>
			</div>
		
		</div>
	</div>
	
	<div class="wt-gallery wt-gallery-list">
		<div class="container">
			
			<div class="wt-gallery-albums">
				
				<?php if( get_the_archive_description() ) { ?>
					<div class="wt-gallery-description"><?php the_archive_description(); ?></div>
				<?php } ?>
				
				<?php $terms = get_terms( 'wt_gallery' ); ?>
				<?php if( $terms ) { ?>
					<ul class="wt-gallery-albums-row">
						<?php foreach( $terms as $term ) { ?>
							<li class="wt-gallery-albums-col col-sm-6 col-md-4">
								<a href="<?php the_wt_term_link( $term->term_id, 'wt_gallery' ); ?>">
									<?php $photos = get_posts( array(
										'post_type' => 'wt_photo',
										'wt_gallery' => $term->slug,
										'orderby' => 'ID',
										'order' => 'DESC',
										'numberposts' => 1
									) ); ?>
									<?php if( $photos && isset( $photos[0] ) ) { ?>
										<div class="wt-gallery-albums-thumb"><?php echo get_the_post_thumbnail( $photos[0]->ID,
												'adaptive' ); ?></div>
									<?php } ?>
									<div class="wt-gallery-albums-title"><?php echo $term->name; ?></div>
								</a>
							</li>
						<?php } ?>
					</ul>
				<?php } ?>
			
			</div>
		
		</div>
	</div>

<?php get_footer(); ?>