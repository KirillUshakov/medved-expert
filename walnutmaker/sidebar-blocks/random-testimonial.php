<?php /** Случайный отзыв */ ?>
<?php
	$random_posts = new WP_Query( array(
		'post_type' => 'wt_testimonial',
		'post_status' => 'approve',
		'orderby' => 'rand',
		'posts_per_page' => 1
	) );
	if( $random_posts->have_posts() ) {
		?>
		<aside class="wt-sidebar-block <?php wm_block_classes( 'wt-sidebar-testimonial' ); ?>">
			
			<?php if( get_sub_field( 'title', $obj ) ) { ?>
				<h2 class="wt-sidebar-title"><?php the_sub_field( 'title', $obj ); ?></h2>
			<?php } ?>
			
			<?php if( get_sub_field( 'desc', $obj ) ) { ?>
				<div class="wt-sidebar-description"><?php the_sub_field( 'desc', $obj ); ?></div>
			<?php } ?>
			
			<?php
				while( $random_posts->have_posts() ) {
					$random_posts->the_post();
					?>
					<div class="wt-sidebar-testimonial-item">
						<?php wt_testimonial_field( 'logo', get_the_ID() ); ?>
						<div class="wt-sidebar-testimonial-name"><?php wt_testimonial_field( 'name',
								get_the_ID() ); ?></div>
						<div class="wt-sidebar-testimonial-message"><?php the_advanced_excerpt(); ?></div>
					</div>
					<?php
				}
				wp_reset_postdata();
				$link = get_sub_field( 'link' );
				if( $link && isset( $link['url'] ) && isset( $link['title'] ) && $link['url'] ) {
					?>
					<a class="btn btn-default" href="<?php echo $link['url']; ?>"
						<?php echo isset( $link['target'] ) && $link['target'] ? 'target="' . $link['target'] . '"' :
							''; ?>><?php echo $link['title']; ?></a>
					<?php
				}
			?>
			
			<?php get_template_part( 'blocks/parts/link' ); ?>
		
		</aside>
		<?php
	}