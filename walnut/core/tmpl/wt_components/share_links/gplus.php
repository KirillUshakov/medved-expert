<?php if( isset( $data ) && isset( $data['link'] ) ) { ?>
	<a class="share-link share-link-gplus" href="http://plus.google.com/share?url=<?php echo $data['link']; ?>"
	   target="_blank" rel="nofollow" title="<?php _ex( 'Share on Google+', 'Text of share button', 'walnut' ); ?>">
		<?php isset( $data['link_text'] ) && $data['link_text'] &&
		_ex( 'Share on Google+', 'Text of share button', 'walnut' ) ?>
	</a>
<?php } ?>