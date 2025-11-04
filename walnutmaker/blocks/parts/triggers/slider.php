<?php $obj = get_queried_object(); ?>
<div class="wt-triggers-wrap owl-carousel" data-options="<?php echo htmlspecialchars( json_encode( get_sub_field( 'options', $obj ) ), ENT_QUOTES,
			'UTF-8' ); ?>" data-speed="<?php the_sub_field( 'speed', $obj ); ?>" data-interval="<?php the_sub_field( 'interval', $obj ); ?>" data-cols="<?php the_sub_field( 'block-cols', $obj ); ?>">

	<?php
		$triggers_id = sanitize_title( get_sub_field( 'title', $obj ) ) . '-' . get_row_index();
		$gallery = get_sub_field( 'gallery-enable', $obj );
	?>
	<?php if( have_rows( 'elements' ) ) { ?>
		<?php while( have_rows( 'elements' ) ) { ?>
			<?php the_row(); ?>
			<div class="wt-triggers-item">
				<?php
					$link = get_sub_field( 'link', $obj );
					$title = get_sub_field( 'title', $obj );
					$desc = get_sub_field( 'desc', $obj );
					$icon = get_sub_field( 'icon', $obj );
					if( $link ) {
						echo '<a href="' . $link . '">';
					} elseif( $gallery && $icon ) {
						$caption = '';
						if( $title ) {
							$caption = 'data-caption="' . $title . '"';
						}
						echo '<a href="' . wp_get_attachment_image_url( $icon, 'full' ) . '" data-fancybox="' .
							$triggers_id . '" ' . $caption . '>';
					}
				?>

				<?php if( $icon ) { ?>
					<div class="wt-triggers-icon">
						<?php echo str_replace('alt=""','alt="12"', wp_get_attachment_image( $icon, 'adaptive' )); ?>
					</div>
				<?php } ?>

				<?php if( $title || $desc ) { ?>
					<div class="wt-triggers-content">
						<?php if( $title ) { ?>
							<div class="wt-triggers-content-name"><?php echo $title; ?></div>
						<?php } ?>

						<?php if( $desc ) { ?>
							<div class="wt-triggers-content-description"><?php echo $desc; ?></div>
						<?php } ?>
					</div>
				<?php } ?>

				<?php
					if( $link || ( $gallery && $icon ) ) {
						echo '</a>';
					}
				?>
			</div>
		<?php } ?>
	<?php } ?>

</div>
