<?php if( isset( $data ) && isset( $data['link'] ) ) { ?>
	<a class="share-link share-link-fb" href="https://www.facebook.com/sharer.php?u=<?php echo $data['link']; ?>"
	   target="_blank" rel="nofollow" title="<?php _ex( 'Share on Facebook', 'Text of share button', 'walnut' ); ?>">
		<?php isset( $data['link_text'] ) && $data['link_text'] &&
		_ex( 'Share on Facebook', 'Text of share button', 'walnut' ) ?>
	</a>
<?php } ?>