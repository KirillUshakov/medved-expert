<?php $obj = wm_field_option(); ?>
<div id="wt-modal-thanks" class="wt-modal wt-modal-thanks" data-selectable="true" style="display: none;">
	<div class="wt-modal-title"><?php the_field( 'thanks-title', $obj ); ?></div>
	<div class="wt-modal-description"><?php the_field( 'thanks-desc', $obj ); ?></div>
	<div class="wt-modal-icon"><img src="<?php echo get_stylesheet_directory_uri(); ?>/img/svg/success.svg" alt="Успешная отправка"></div>
</div>