<?php if( isset( $data ) && isset( $data['link'] ) ) { ?>
	<a class="share-link share-link-vk" href="http://vkontakte.ru/share.php?url=<?php echo $data['link']; ?>"
	   target="_blank" rel="nofollow" title="<?php _ex( 'Share on VKontakte', 'Text of share button', 'walnut' ); ?>">
		<?php isset( $data['link_text'] ) && $data['link_text'] &&
		_ex( 'Share on VKontakte', 'Text of share button', 'walnut' ) ?>
	</a>
<?php } ?>