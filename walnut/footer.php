</div>

<footer class="site-footer">
	
	<?php if( wt_is_desktop() ) { ?>
		<div class="site-footer-navigation">
			<div class="container">
				
				<nav role="navigation"><?php wt_nav_menu( 'footer_menu' ); ?></nav>
				<div class="scroll-up">
					<a href="#" class="btn-top"><?php _e( 'Back to top', 'walnut' ); ?></a>
				</div>
			
			</div>
		</div>
	<?php } ?>
	
	<div class="site-footer-main">
		<div class="container">
			<div class="site-row-table">
				
				<?php $description = get_bloginfo( 'description', 'display' ); ?>
				<div class="footer-brand <?php echo ! $description || ! get_bloginfo( 'name',
					'display' ) ? 'footer-brand-half' : 'footer-brand-full'; ?>">
					<a href="<?php echo esc_url( home_url() ); ?>" class="footer-logo" rel="home">
						<?php echo wt_logo( 'footer_logo' ); ?>
					</a>
					<?php if( get_bloginfo( 'name', 'display' ) && $description ) { ?>
						<div class="footer-name">
							<?php if( is_front_page() ) { ?>
								<h1 class="footer-name-title">
									<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">
										<?php bloginfo( 'name' ); ?>
									</a>
								</h1>
							<?php } else { ?>
								<p class="footer-name-title">
									<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">
										<?php bloginfo( 'name' ); ?>
									</a>
								</p>
							<?php } ?>
							<?php if( $description || is_customize_preview() ) { ?>
								<p class="footer-name-description"><?php echo $description; ?></p>
							<?php } ?>
						</div>
					<?php } ?>
				</div>
				
				<?php if( wt_is_desktop() ) { ?>
					<div class="footer-address hidden-touch">
						<p class="footer-address-destination"><?php echo wt_options( 'address' ); ?></p>
						<p class="footer-address-distance"><?php echo wt_options( 'distance' ); ?></p>
						<p class="footer-address-worktime"><?php echo wt_options( 'worktime' ); ?></p>
					</div>
				<?php } ?>
				
				<?php if( wt_is_not_phone() ) { ?>
					<div class="footer-contacts hidden-mobile">
						<?php $phone = wt_options( 'phone' ); ?>
						<p class="footer-contacts-phone">
							<a href="<?php echo $phone['href']; ?>" <?php echo $phone['target'] ? 'target="_blank"' : ''; ?>>
								<?php echo $phone['title']; ?>
							</a>
						</p>
						<?php $email = wt_options( 'email' ); ?>
						<p class="footer-contacts-email">
							<a href="<?php echo $email['href']; ?>" <?php echo $email['target'] ? 'target="_blank"' : ''; ?>>
								<?php echo $email['title']; ?>
							</a>
						</p>
						<div class="footer-callback">
							<a href="#" class="btn btn-main modal-widget-open">
								<?php _e( 'Get in touch', 'walnut' ); ?>
							</a>
						</div>
					</div>
				<?php } ?>
			
			</div>
		</div>
	</div>
	
	<div class="site-footer-bottom">
		<div class="container">
			
			<div class="footer-copyright"><?php echo wt_options( 'copyright' ); ?></div>
			<div class="footer-weblink"><?php echo wt_options( 'weblink' ); ?></div>
			
		</div>
	</div>

</footer>

<?php get_template_part( 'parts/modal/widget-modal' ); ?>
<?php get_template_part( 'parts/side-menu' ); ?>

<link href="https://fonts.googleapis.com/css?family=Roboto:300,400,400i,500,700&amp;subset=cyrillic,cyrillic-ext"
	  rel="stylesheet">
<?php wp_footer(); ?>

<script type="text/javascript" src="<?php echo get_stylesheet_directory_uri(); ?>/js/base.js"></script>

<?php echo wt_options( 'code_counter' ); ?>
</body>
</html>