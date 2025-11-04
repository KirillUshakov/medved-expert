<div class="wt-dropdown" style="display: none;">
	<button class="wt-dropdown-close" type="button">
		<img src="<?php echo get_stylesheet_directory_uri(); ?>/img/svg/close-dark.svg" alt="Закрыть выпадающее окно">
	</button>
	<p class="wt-dropdown-title">Ваш город - <span><?php bloginfo( 'name' ); ?>?</span></p>
	<div class="wt-dropdown-action">
		<a class="wt-dropdown-success" href="<?php echo site_url(); ?>" data-name="<?php bloginfo( 'name' ); ?>">Да</a>
		<a class="wt-dropdown-another city-change-open" href="#">Выбрать другой</a>
	</div>
</div>