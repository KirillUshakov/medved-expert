<div>
	<div class="link-list dashicons-container" <?php echo ! isset( $data ) || ! isset( $data['href'] ) ||
	! $data['href'] ? 'style="display: none;"' : ''; ?>>
		<input type="hidden" name="phone_add[title]" class="link-title"
			value="<?php echo isset( $data['title'] ) ? htmlspecialchars( $data['title'] ) : ''; ?>"/>
		<input type="hidden" name="phone_add[href]" class="link-href"
			value="<?php echo isset( $data['href'] ) ? $data['href'] : ''; ?>"/>
		<input type="hidden" name="phone_add[target]" class="link-target"
			value="<?php echo isset( $data['target'] ) && $data['target'] ? 1 : 0; ?>"/>
		<ul>
			<li>
				<strong><?php _ex( 'Title', 'Label of link', 'walnut' ); ?>:</strong>
				<span class="link-title"><?php echo isset( $data['title'] ) ? esc_html( $data['title'] ) : ''; ?></span>
			</li>
			<li>
				<strong><?php _ex( 'URL', 'Label of link', 'walnut' ); ?>:</strong>
				<span class="link-href"><?php echo isset( $data['href'] ) ? $data['href'] : ''; ?></span>
			</li>
			<li>
				<strong><?php _ex( 'Target', 'Label of link', 'walnut' ); ?>:</strong>
				<span class="link-target">
					<?php _ex( 'Link opens in', 'Label of link', 'walnut' ); ?>
					<?php echo isset( $data['target'] ) && $data['target'] ?
						_x( 'new tab', 'Label of link', 'walnut' ) :
						_x( 'same tab', 'Label of link', 'walnut' ); ?>
				</span>
			</li>
		</ul>
		<span class="dashicons dashicons-edit btn-link" data-id="link-phone-add"></span>
		<span class="dashicons dashicons-no"></span>
	</div>
	<div class="link-add" <?php echo isset( $data ) && isset( $data['href'] ) && $data['href'] ?
		'style="display: none;"' : ''; ?>>
		<p>
			<?php _ex( 'Additional phone is not specified', 'Label of link', 'walnut' ); ?>
			<a href="#" class="button btn-link" data-id="link-phone-add"><?php _ex( 'Insert link', 'Text for button',
					'walnut' ); ?></a>
		</p>
	</div>
</div>