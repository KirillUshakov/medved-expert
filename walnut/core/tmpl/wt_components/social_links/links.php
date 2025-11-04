<?php if( isset( $data ) && isset( $data['class'] ) ) { ?>
	<div class="<?php echo $data['class']; ?>">
		<?php if( isset( $data['text'] ) && $data['text'] ) { ?>
			<div class="social-links-title"><?php echo $data['text']; ?></div>
		<?php } ?>
		<?php if( isset( $data['links'] ) ) { ?>
			<ul class="social-links-list">
				<?php foreach( $data['links'] as $link ) { ?>
					<li>
						<?php isset( $this ) && $this->get_template( 'social_links', 'link', $link ); ?>
					</li>
				<?php } ?>
			</ul>
		<?php } ?>
	</div>
<?php } ?>