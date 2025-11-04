<?php $obj = get_queried_object(); ?>
<div class="wt-sidebar-triggers-wrap owl-carousel" data-options="<?php echo htmlspecialchars( json_encode( get_sub_field( 'options', $obj ) ), ENT_QUOTES,
			'UTF-8' ); ?>" data-speed="<?php the_sub_field( 'speed', $obj ); ?>" data-interval="<?php the_sub_field( 'interval', $obj ); ?>" data-cols="<?php the_sub_field( 'block-cols', $obj ); ?>">
	
	<?php if( have_rows( 'elements', $obj ) ) { ?>
		<?php while( have_rows( 'elements', $obj ) ) { ?>
			<?php the_row(); ?>
			<div class="wt-sidebar-triggers-item">
				<?php
					$link = get_sub_field( 'link', $obj );
					echo $link ? '<a href="' . $link . '">' : '';
				?>
				
				<?php $icon = get_sub_field( 'icon', $obj ); ?>
				<?php if( $icon ) { ?>
					<div class="wt-sidebar-triggers-icon">
						<?php echo wp_get_attachment_image( $icon, 'adaptive' ); ?>
					</div>
				<?php } ?>
				
				<?php $title = get_sub_field( 'title', $obj ); ?>
				<?php if( $title ) { ?>
					<div class="wt-sidebar-triggers-name"><?php echo $title; ?></div>
				<?php } ?>
				
				<?php $desc = get_sub_field( 'desc', $obj ); ?>
				<?php if( $desc ) { ?>
					<div class="wt-sidebar-triggers-description"><?php echo $desc; ?></div>
				<?php } ?>
				
				<?php echo $link ? '</a>' : ''; ?>
			</div>
		<?php } ?>
	<?php } ?>

</div>