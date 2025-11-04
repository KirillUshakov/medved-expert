<?php $albums = get_terms( 'wt_gallery', 'hide_empty=0' ); ?>
<?php if( is_array( $albums ) && ! empty( $albums ) ) { ?>
	<div class="albums">
		<label for="albums_id"><?php _ex( 'Select album', 'Label for selecting album', 'walnut' ); ?></label>
		<select name="albums_id" id="albums_id">
			<?php foreach( $albums as $album ) { ?>
				<option value="<?php echo $album->term_id ?>"><?php echo $album->name; ?></option>
			<?php } ?>
		</select>
		<button type="submit" class="button button-primary upload-photos"><?php _e( 'Upload' ); ?></button>
	</div>
	<div class="uploaded-mediafiles"></div>
<?php } else { ?>
	<p><?php echo sprintf( _x( 'At first %sadd album%s', 'Text for multiple upload if albums are not yet', 'walnut' ), '<a href="/wp-admin/edit-tags.php?taxonomy=wt_gallery&post_type=wt_photo">', '</a>' ); ?></p>
<?php } ?>