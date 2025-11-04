<?php get_header(); ?>
<?php $post_type = get_post_type_object( get_query_var( 'post_type' ) ); ?>
	
	<div class="site-page-header">
		<div class="site-page-title">
			<div class="container">
				<h1><?php echo $post_type && isset( $post_type->labels->menu_name ) ? $post_type->labels->menu_name :
						get_queried_object()->name; ?></h1>
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
			
			<div class="gallery-albums">
				
				<?php if( get_the_archive_description() ) { ?>
					<div class="gallery-description"><?php the_archive_description(); ?></div>
				<?php } ?>
				
				<?php $terms = get_terms( 'wt_gallery' ); ?>
				<?php if( $terms ) { ?>
					<ul class="gallery-list clearfix">
						<?php foreach( $terms as $term ) { ?>
							<li class="gallery-col col-small-6 col-medium-4">
								<a href="<?php the_wt_term_link( $term->term_id, 'wt_gallery' ); ?>">
									<?php $photos = get_posts( array(
										'post_type' => 'wt_photo',
										'wt_gallery' => $term->slug,
										'orderby' => 'ID',
										'order' => 'DESC',
										'numberposts' => 1
									) ); ?>
									<?php if( $photos && isset( $photos[0] ) ) { ?>
										<?php echo get_the_post_thumbnail( $photos[0]->ID, 'adaptive' ); ?>
									<?php } ?>
									<div class="gallery-albums-title"><?php echo $term->name; ?></div>
								</a>
							</li>
						<?php } ?>
					</ul>
				<?php } ?>
				
			</div>
			
		</div>
	</div>

<?php get_footer(); ?>