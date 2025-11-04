<?php
	$obj = get_queried_object();
	$cols = get_sub_field( 'block-cols', $obj );
?>
<?php if( have_rows( 'elements', $obj ) ) { ?>
	<ul class="wt-triggers-row <?php wm_block_alignment(); ?>">
		
		<?php while( have_rows( 'elements', $obj ) ) { ?>
			<?php the_row(); ?>
			<li class="wt-triggers-col col-sm-6 col-md-<?php wm_calc_cols( $cols ); ?>">
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
							<?php echo wp_get_attachment_image( $icon, 'adaptive' ); ?>
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
			</li>
		<?php } ?>
	
	</ul>
<?php } ?>