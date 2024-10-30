<?php
if (!defined('ABSPATH')) exit;

/*
Devuelve true si tenemos el editor clásico y false si tenemos el editor de bloques.
*/
if ( ! function_exists( 'caip_is_classic_editor' ) ) {
	function caip_is_classic_editor(){
		$current_screen = get_current_screen();
		
		return !($current_screen->is_block_editor);
		//return method_exists( $current_screen, 'is_block_editor' ) && $current_screen->is_block_editor();
	}
}

