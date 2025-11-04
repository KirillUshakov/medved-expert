<?php
	/** Меню навигации */
	$obj = get_queried_object();
	$menu = get_sub_field( 'menu', $obj );
	if( $menu ) {
		?>
		<aside class="wt-sidebar-block <?php wm_block_classes( 'wt-sidebar-menu' ); ?>">

			<?php if( get_sub_field( 'title', $obj ) ) { ?>
				<h2 class="wt-sidebar-title"><?= do_shortcode(get_sub_field( 'title', $obj )); ?></h2>
			<?php } ?>

			<?php if( get_sub_field( 'desc', $obj ) ) { ?>
				<div class="wt-sidebar-description"><?php the_sub_field( 'desc', $obj ); ?></div>
			<?php } ?>

			<nav class="wt-sidebar-menu-navigation"><?php echo $menu; ?></nav>

			<?php get_template_part( 'blocks/parts/link' ); ?>

		</aside>
		<?php
	}
