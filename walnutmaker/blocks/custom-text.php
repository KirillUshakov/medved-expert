<?php
	/** Поделиться в социальных сетях */
	$obj = get_queried_object();
	$text = get_sub_field( 'text', $obj );
	if( $text ) {
		echo $text;
	}