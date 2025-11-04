<?php if( isset( $data ) && isset( $data['link'] ) ) { ?>
	<a class="share-link share-link-twitter" href="http://twitter.com/share?url=<?php
		echo $data['link'];
		if( isset( $data['title'] ) && $data['title'] ) {
			echo '&text=' . $data['title'];
		}
	?>" target="_blank" rel="nofollow" title="<?php _ex( 'Share on Twitter', 'Text of share button', 'walnut' ); ?>">
		<?php isset( $data['link_text'] ) && $data['link_text'] &&
		_ex( 'Share on Twitter', 'Text of share button', 'walnut' ) ?>
	</a>
<?php } ?>