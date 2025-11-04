<?php $obj = get_queried_object(); ?>
<?php if( have_rows( 'elements', $obj ) ) { ?>
	<ul class="wt-sidebar-triggers-list">
		
		<?php while( have_rows( 'elements', $obj ) ) { ?>
			<?php the_row(); ?>
			<li class="wt-sidebar-triggers-item">
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
			</li>
		<?php } ?>
	
	</ul>
<?php } ?>