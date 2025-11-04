<div class="wrap wp_theme_settings">
	<h1>
		<?php _ex( 'Photos', 'Title on settings page', 'walnut' ); ?>
		<a href="/wp-admin/post-new.php?post_type=<?php echo $this->post_type; ?>" class="page-title-action">
			<?php _ex( 'Add New', 'Text for button on gallery grid page', 'walnut' ); ?>
		</a>
	</h1>
	<h2 class="screen-reader-text"><?php _ex( 'Filter pages list', 'Title for screen reader', 'walnut' ); ?></h2>
	<ul class="subsubsub">
		<li class="all">
			<a href="edit.php?post_type=wt_photo&page=gallery_grid"
				class="<?php echo ! isset( $_GET['post_status'] ) ? 'current' : ''; ?>">
				<?php _ex( 'All', 'Text for link on gallery grid page', 'walnut' ); ?>
				<span class="count">(<?php echo $this->count->publish + $this->count->pending; ?>)</span>
			</a>
			<?php echo $this->count->publish || $this->count->pending || $this->count->trash ? '|' : ''; ?>
		</li>
		<?php if( $this->count->publish ) { ?>
			<li class="publish">
				<a href="edit.php?post_status=publish&post_type=<?php echo $this->post_type; ?>&page=gallery_grid"
					class="<?php echo isset( $_GET['post_status'] ) && $_GET['post_status'] == 'publish' ? 'current' :
						''; ?>">
					<?php _ex( 'Published', 'Text for link on gallery grid page', 'walnut' ); ?>
					<span class="count">(<?php echo $this->count->publish; ?>)</span>
				</a>
				<?php echo $this->count->pending || $this->count->trash ? '|' : ''; ?>
			</li>
		<?php } ?>
		<?php if( $this->count->pending ) { ?>
			<li class="publish">
				<a href="edit.php?post_status=pending&post_type=<?php echo $this->post_type; ?>&page=gallery_grid"
					class="<?php echo isset( $_GET['post_status'] ) && $_GET['post_status'] == 'pending' ? 'current' :
						''; ?>">
					<?php _ex( 'Pending', 'Text for link on gallery grid page', 'walnut' ); ?>
					<span class="count">(<?php echo $this->count->pending; ?>)</span>
				</a>
				<?php echo $this->count->trash ? '|' : ''; ?>
			</li>
		<?php } ?>
		<?php if( $this->count->trash ) { ?>
			<li class="publish">
				<a href="edit.php?post_status=trash&post_type=<?php echo $this->post_type; ?>&page=gallery_grid"
					class="<?php echo isset( $_GET['post_status'] ) && $_GET['post_status'] == 'trash' ? 'current' :
						''; ?>">
					<?php _ex( 'Trash', 'Text for link on gallery grid page', 'walnut' ); ?>
					<span class="count">(<?php echo $this->count->trash; ?>)</span>
				</a>
			</li>
		<?php } ?>
	</ul>
	
	<form action="/wp-admin/edit.php" method="get">
		<input type="hidden" name="post_type" value="<?php echo $this->post_type; ?>"/>
		<input type="hidden" name="page" value="gallery_grid"/>
		<?php if( isset( $_GET['post_status'] ) ) { ?>
			<input type="hidden" name="post_status" value="<?php echo $_GET['post_status'] ?>"/>
		<?php } ?>
		
		<div class="tablenav top">
			<div class="alignleft actions">
				<?php $this->add_taxonomy_filter( $this->post_type ); ?>
				<input type="submit" id="post-query-submit" class="button" value="<?php _e( 'Filter' ); ?>"/>
			</div>
		</div>
	
	</form>
	
	<div class="media-frame wp-core-ui mode-grid mode-edit hide-menu">
		<div class="media-frame-content" data-columns="1" style="display: none;">
			<div class="attachments-browser hide-sidebar sidebar-for-errors">
				<?php if( $this->photos->have_posts() ) { ?>
					<ul tabindex="-1" class="attachments" id="__attachments-view-40">
						<?php while( $this->photos->have_posts() ) { ?>
							<?php $this->photos->the_post(); ?>
							<li tabindex="0" aria-label="<?php the_title(); ?>" data-id="<?php echo get_the_ID(); ?>"
								class="attachment save-ready">
								<?php if( get_post()->post_status != 'trash' ) { ?>
								<a href="/wp-admin/post.php?post=<?php echo get_the_ID(); ?>&action=edit">
									<?php } ?>
									<div class="attachment-preview js--select-attachment type-image landscape">
										<div class="thumbnail">
											<div class="centered">
												<img src="<?php echo get_the_post_thumbnail_url( get_the_ID(),
													'medium' ); ?>"/>
											</div>
											<div class="filename">
												<div>
													<?php the_title(); ?>
												
												</div>
											</div>
										</div>
									</div>
									<?php if( get_post()->post_status == 'trash' ) { ?>
										<div class="plugins">
											<a href="<?php echo wp_nonce_url( admin_url( 'post.php?post=' .
												get_the_ID() . '&action=untrash' ),
												'untrash-post_' . get_the_ID() ); ?>"><?php _e( 'Restore' ); ?></a>
											|
											<a href="<?php echo wp_nonce_url( admin_url( 'post.php?post=' .
												get_the_ID() . '&action=delete' ), 'delete-post_' . get_the_ID() ); ?>"
												class="delete"><?php _e( 'Delete Permanently' ); ?></a>
										</div>
									<?php } ?>
									<?php if( get_post()->post_status != 'trash' ) { ?>
								</a>
							<?php } ?>
							</li>
						<?php } ?>
					</ul>
				<?php } ?>
			</div>
		</div>
		<div class="media-frame-toolbar"></div>
	</div>

</div>
<script type="text/javascript">
	(function( $ ) {
		$( document ).ready( function() {
			
		} );
	}( jQuery ));
</script>