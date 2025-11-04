<div class="side-menu side-menu-left">
	<div class="side-menu-icon">
		<img src="<?php echo get_stylesheet_directory_uri(); ?>/img/svg/close.svg" class="side-menu-close">
	</div>
	<div class="side-menu-brand">
		<a href="<?php echo esc_url( home_url() ); ?>" class="side-menu-logo" rel="home">
			<?php echo wt_logo(); ?>
		</a>
		<p class="side-menu-title">
			<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">
				<?php the_city_name() ?>
			</a>
		</p>
	</div>
	<div class="side-menu-navigation"><?php wt_nav_menu( 'header_menu' ); ?></div>
	<div class="side-menu-contacts">
		<?php $phone = wt_options( 'phone' ); ?>
		<p class="side-menu-phone">
			<a href="<?php echo $phone['href']; ?>" <?php echo $phone['target'] ? 'target="_blank"' : ''; ?>>
				<?php echo $phone['title']; ?>
			</a>
		</p>
		<?php $email = wt_options( 'email' ); ?>
		<p class="side-menu-email">
			<a href="<?php echo $email['href']; ?>" <?php echo $email['target'] ? 'target="_blank"' : ''; ?>>
				<?php echo $email['title']; ?>
			</a>
		</p>
	</div>
	<div class="side-menu-callback">
		<a href="#" class="btn btn-main modal-open side-menu-close">
			<?php _e( 'Get in touch', 'walnut' ); ?>
		</a>
	</div>
</div>
<div class="side-menu-overlay"></div>
