<?php
	/** Блок про COVID */
	$obj = get_queried_object();
?>
<section class="<?php wm_block_classes( 'wt-covid' ); ?>" <?php wm_block_styles(); ?>>
	<?php wm_container_open(); ?>

	<div class="wt-covid-wrap">

		<div class="wt-covid-content">
            <img class="wt-covid-content__img" src="https://medved-expert.ru/wp-content/themes/walnutmaker/img/svg/covid.svg" alt="против COVID" width="230" height="164">
            <div class="wt-covid-content__text">
                <?php if( get_sub_field( 'title', $obj ) ) { ?>
                    <div class="wt-form-title wt-covid-content__title"><?php the_sub_field( 'title', $obj ); ?></div>
                <?php } ?>

                <?php if( get_sub_field( 'desc', $obj ) ) { ?>
                    <div class="wt-covid-description "><?php the_sub_field( 'desc', $obj ); ?></div>
                <?php } ?>
            </div>
		</div>

	</div>
	
	<?php wm_container_close(); ?>
</section>