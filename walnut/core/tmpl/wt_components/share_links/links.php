<?php if( isset( $data ) ) { ?>
	<div class="share-links">
		<?php if( isset( $data['text'] ) && $data['text'] ) { ?>
			<div class="share-links-title"><?php echo $data['text']; ?></div>
		<?php } ?>
		<?php if( isset( $data['links'] ) ) { ?>
			<ul class="share-links-list">
				<?php foreach( $data['links'] as $link ) { ?>
					<li>
						<?php isset( $this ) && $this->get_template( 'share_links', $link, $data ); ?>
					</li>
				<?php } ?>
			</ul>
		<?php } ?>
	</div>
<?php } ?>