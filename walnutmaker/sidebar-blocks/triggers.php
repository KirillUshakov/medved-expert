<?php
	/** Триггеры */
	$obj = get_queried_object();
	$type = get_sub_field( 'slider-enable', $obj ) ? 'slider' : 'standard';
?>
<aside class="wt-sidebar-block <?php wm_block_classes( 'wt-sidebar-triggers' ); ?> wt-triggers-<?php echo $type; ?>">
	
	<?php if( get_sub_field( 'title', $obj ) ) { ?>
		<h2 class="wt-sidebar-title"><?php the_sub_field( 'title', $obj ); ?></h2>
	<?php } ?>
	
	<?php if( get_sub_field( 'desc', $obj ) ) { ?>
		<div class="wt-sidebar-description"><?php the_sub_field( 'desc', $obj ); ?></div>
	<?php } ?>
	
	<?php
		$elements = get_sub_field( 'elements', $obj );
		if( $elements ) {
			include get_stylesheet_directory() . '/sidebar-blocks/parts/triggers/' . $type . '.php';
		}
	?>
	
	<?php get_template_part( 'blocks/parts/action' ); ?>

</aside>