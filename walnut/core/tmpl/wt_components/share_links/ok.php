<?php if( isset( $data ) && isset( $data['link'] ) ) { ?>
	<a class="share-link share-link-ok"
	   href="http://www.odnoklassniki.ru/dk?st.cmd=addShare&st.s=1&st._surl=<?php echo $data['link']; ?>"
	   target="_blank" rel="nofollow"
	   title="<?php _ex( 'Share on Odnoklassniki', 'Text of share button', 'walnut' ); ?>">
		<?php isset( $data['link_text'] ) && $data['link_text'] &&
		_ex( 'Share on Odnoklassniki', 'Text of share button', 'walnut' ) ?>
	</a>
<?php } ?>