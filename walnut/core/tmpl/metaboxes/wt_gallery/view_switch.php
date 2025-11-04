<div class="wt_view-switch view-switch">
	<span class="wt_view-switch-label"><?php _ex( 'Gallery view:', 'Label for view switch', 'walnut' ); ?></span>
	<a href="/wp-admin/edit.php?post_type=<?php echo $this->post_type; ?>"
		class="view-list <?php echo ! isset( $_GET['page'] ) ? 'current' : ''; ?>"
		id="view-switch-list">
		<span class="screen-reader-text"><?php _ex( 'List view:', 'Label for view switch', 'walnut' ); ?></span>
	</a>
	<a href="/wp-admin/edit.php?post_type=<?php echo $this->post_type; ?>&page=gallery_grid"
		class="view-grid <?php echo isset( $_GET['page'] ) ? 'current' : ''; ?>"
		id="view-switch-grid">
		<span class="screen-reader-text"><?php _ex( 'Grid view:', 'Label for view switch', 'walnut' ); ?></span>
	</a>
</div>