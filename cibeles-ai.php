<?php
if (!defined('ABSPATH')) exit;
/*
 * Plugin Name: Cibeles AI
 * Plugin URI:  https://ai.cibeles.net/
 * Description: Asistente de redacción de entradas de inteligencia artificial para Wordpress hecho por cibeles.net
 * Plugin Prefix: caip
 * Text Domain: cibeles-ai
 * Domain Path: /languages/
 * Author: Cibeles.net
 * Author URI:  https://www.cibeles.net/
 * Version: 1.10.1
 * License: GPLv2
 * Released under the GNU General Public License (GPL)
 * License URI: https://www.gnu.org/licenses/gpl-2.0.html
*/


if (!defined('ABSPATH')) exit;
if(!defined('CAIP_DS')) define('CAIP_DS',DIRECTORY_SEPARATOR);


$cibelesAiPlugin = [
  'namespace' => 'cibeles-ai',
  'version' => '1.10.1',
  'path' => dirname(__FILE__).CAIP_DS,
  'url' => plugin_dir_url( __FILE__ ),
  'filename' => __FILE__,
  'api_url' => 'https://openai.editmaker.com/wp/api/',
  'api_url_youtube' => 'https://openai.editmaker.com/wp/api/youtube.php',
  'api_url_whisper' => 'https://openai.editmaker.com/wp/api/whisper.php',
];




if ( is_admin() ) {	
	require_once $cibelesAiPlugin['path'] . 'init.php'; 
	require_once $cibelesAiPlugin['path'] . 'functions.php'; 
	require_once $cibelesAiPlugin['path'] . 'options.php'; 
}else{
	//Mejora la carga de la página en la vista de post haciendo una precarga de la imagen webp
	add_action('wp_head', 'caip_preload_post_thumbnail_in_webp_format_if_exists');

	if (!function_exists('caip_preload_post_thumbnail_in_webp_format_if_exists')) {
		function caip_preload_post_thumbnail_in_webp_format_if_exists(){
			if (has_post_thumbnail() && is_single()) {
				$attachment_id = get_post_thumbnail_id();
				$attachment_path = get_attached_file($attachment_id);
				$attachment_path_webp = $attachment_path . '.webp';
				$attachment_path_webp_custom_folder = str_replace('/wp-content/','/wp-content/webp-express/webp-images/',$attachment_path_webp);
				if (file_exists($attachment_path_webp)) {
					$upload_dir = wp_upload_dir();
					$attachment_url_webp = str_replace($upload_dir['basedir'], $upload_dir['baseurl'], $attachment_path_webp);
					echo '<link rel="preload" as="image" href="' . esc_url($attachment_url_webp) . '">';
				}
				if (file_exists($attachment_path_webp_custom_folder)) {
					$upload_dir = wp_upload_dir();
					$attachment_path_webp_custom_folder = str_replace($upload_dir['basedir'], $upload_dir['baseurl'], $attachment_path_webp);
					$attachment_url_webp_custom_folder = str_replace('/wp-content/','/wp-content/webp-express/webp-images/',$attachment_path_webp_custom_folder);
					echo '<link rel="preload" as="image" href="' . esc_url($attachment_url_webp_custom_folder) . '">';
				}
			} 
		}
	}
}

