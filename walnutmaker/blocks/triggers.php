<?php
	/** Триггеры */
	$obj = get_queried_object();
	$type = get_sub_field( 'slider-enable', $obj ) ? 'slider' : 'standard';
	$gallery = get_sub_field( 'gallery-enable', $obj );
	$class = 'wt-triggers-' . $type;
	$class .= $gallery ? ' wt-triggers-gallery' : '';
?>
<section class="<?php wm_block_classes( 'wt-triggers' ); ?> <?php echo $class; ?>" <?php wm_block_styles(); ?>>
	<?php wm_container_open(); ?>

	<?php if( get_sub_field( 'title', $obj ) || is_super_admin() ) { ?>
		<h2 class="wt-triggers-title"><?php the_sub_field( 'title', $obj ); ?></h2>
	<?php } ?>

	<?php if( get_sub_field( 'desc', $obj ) ) { ?>
		<div class="wt-triggers-description"><?php the_sub_field( 'desc', $obj ); ?></div>
	<?php } ?>

	<?php
		$elements = get_sub_field( 'elements', $obj );
		if( $elements ) {
			include get_stylesheet_directory() . '/blocks/parts/triggers/' . $type . '.php';
		}
	?>

	<?php get_template_part( 'blocks/parts/action' ); ?>

	

	<?php wm_container_close(); ?>
</section>

<style>
/* Сбрасываем встроенный счётчик темы для нашего списка */
ol.manual-numbers {
  list-style: none !important;      /* убираем цифры темы */
  counter-reset: manual-counter;    /* заводим свой счётчик */
  margin-left: 2em;
  padding-left: 0;
}

/* Нумерация только для прямых li верхнего уровня */
ol.manual-numbers > li {
  counter-increment: manual-counter !important;
  position: relative;
  margin-bottom: 1em;
}

/* Прописываем цифры вручную через наш счётчик */
ol.manual-numbers > li::before {
  content: counter(manual-counter) ". " !important;
  font-weight: bold;
  color: #1c4e9c; /* можно оставить цвет темы */
  /* position: absolute;
  left: -2em; */
}

/* Вложенные ul остаются буллетами */
ol.manual-numbers li ul {
  list-style: disc !important;
  margin-left: 1.5em;
}


</style>

<section class="wt-custom-content wt-custom-content-color-blue wt-custom-text-content">
	<div class="container">
		<div class="wt-custom-content-wrap wt-styles">
			<?php if( get_sub_field( 'custom-text', $obj ) ) { ?>
				<?php the_sub_field( 'custom-text', $obj ); ?>
			<?php } ?>
		</div>
	</div>
</section>