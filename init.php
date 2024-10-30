<?php
if (!defined('ABSPATH')) exit;
/* Inicializa*/
add_action('admin_init','caip_init');
/* Inicializa idioma de la aplicación*/
add_action('admin_init','caip_language');
add_action('plugins_loaded', 'caip_plugins_loaded', 0 );
/* Inicializa thickbox*/
add_action('admin_init','caip_init_thickbox');
/*	Agrega fontawesome y main*/
add_action('admin_init','caip_init_files_CSS');
/*Ajax tags*/
add_action( 'wp_ajax_caip_tags_exists', 'caip_tag_exists_check' );
/*	Agrega main */
add_action('admin_enqueue_scripts','caip_init_files_JS');
/*  Agrega views */
add_action('admin_head', 'caip_init_files_views');
/* Agrega notices */
add_action( 'admin_notices', 'caip_admin_notice_warn' );
/*Personaliza comportamiento TinyMCE*/
add_filter('tiny_mce_before_init','caip_paste_preprocess');




if ( ! function_exists( 'caip_plugins_loaded' ) ) {
	function caip_plugins_loaded() {
		load_plugin_textdomain('cibeles-ai', false, dirname(plugin_basename(__FILE__)) . '/languages/');
	}
}

if ( ! function_exists( 'caip_init' ) ) {
	function caip_init(){
		global $current_user;
		global $cibelesAiPlugin;

		@$cibelesAiPlugin['nick'] = $current_user->user_login;
		@$cibelesAiPlugin['settings'] = get_option('caip_settings');
		@$cibelesAiPlugin['settings']['caip_API_KEY'] = 			(isset($cibelesAiPlugin['settings']['caip_API_KEY']))? $cibelesAiPlugin['settings']['caip_API_KEY'] : '';
		@$cibelesAiPlugin['settings']['caip_numero_titulares'] = (isset($cibelesAiPlugin['settings']['caip_numero_titulares']))? $cibelesAiPlugin['settings']['caip_numero_titulares'] : '5';
		@$cibelesAiPlugin['settings']['caip_numero_tags'] = 		(isset($cibelesAiPlugin['settings']['caip_numero_tags']))? $cibelesAiPlugin['settings']['caip_numero_tags'] : '10';
		@$cibelesAiPlugin['settings']['caip_numero_resumenes'] = (isset($cibelesAiPlugin['settings']['caip_numero_resumenes']))? $cibelesAiPlugin['settings']['caip_numero_resumenes'] : '3';
		@$cibelesAiPlugin['settings']['caip_radio_idioma'] = (isset($cibelesAiPlugin['settings']['caip_radio_idioma']))? $cibelesAiPlugin['settings']['caip_radio_idioma'] : '1';
		
	}
}

if ( ! function_exists( 'caip_language' ) ) {
	function caip_language(){
		global $cibelesAiPlugin;
		switch($cibelesAiPlugin['settings']['caip_radio_idioma']){
			case '2':
				$language = strtoupper(substr(apply_filters( 'wpml_current_language', NULL ),0,2));
			break;
			case '1':
			default:
				$language = strtoupper(substr(get_user_locale(),0,2));
			break;
		}
		switch($language){ case 'ES': $idioma = 'Spanish'; break; case 'CA': $idioma = 'Catalan'; break; case 'GL': $idioma = 'Galician'; break; case 'EU': $idioma = 'Basque'; break; case 'FR': $idioma = 'French'; break; case 'IT': $idioma = 'Italian'; break; case 'DE': $idioma = 'German'; break; case 'PT': $idioma = 'Portuguese'; break; case 'ZH': $idioma = 'Mandarin'; break; case 'JA': $idioma = 'Japanese'; break; case 'KO': $idioma = 'Korean'; break; case 'RU': $idioma = 'Russian'; break; case 'AR': $idioma = 'Arabic'; break; case 'HI': $idioma = 'Hindi'; break; case 'BN': $idioma = 'Bengali'; break; case 'PL': $idioma = 'Polish'; break; case 'TH': $idioma = 'Thai'; break; case 'ID': $idioma = 'Indonesian'; break; case 'TR': $idioma = 'Turkish'; break; case 'VI': $idioma = 'Vietnamese'; break; case 'EL': $idioma = 'Greek'; break; case 'NL': $idioma = 'Dutch'; break; case 'SV': $idioma = 'Swedish'; break; case 'DA': $idioma = 'Danish'; break; case 'NO': $idioma = 'Norwegian'; break; case 'FI': $idioma = 'Finnish'; break; case 'IS': $idioma = 'Icelandic'; break; case 'FA': $idioma = 'Persian'; break; case 'UK': $idioma = 'Ukrainian'; break; case 'CS': $idioma = 'Czech'; break; case 'HU': $idioma = 'Hungarian'; break; case 'RO': $idioma = 'Romanian'; break; case 'SL': $idioma = 'Slovenian'; break; case 'HR': $idioma = 'Croatian'; break; case 'SR': $idioma = 'Serbian'; break; case 'BG': $idioma = 'Bulgarian'; break; case 'SK': $idioma = 'Slovak'; break; case 'EN': default: $idioma = 'English'; break; }
		$cibelesAiPlugin['settings']['idioma'] = '(in '. $idioma . ' language)';
	}
}


if ( ! function_exists( 'caip_init_thickbox' ) ) {
	function caip_init_thickbox(){
		global $pagenow;
		if ( ( 'post.php' == $pagenow || 'post-new.php' == $pagenow ) ) {
			add_thickbox();
		}
	}
}

if ( ! function_exists( 'caip_init_files_CSS' ) ) {
	function caip_init_files_CSS(){
		global $pagenow;
		
		if ( ( 'post.php' == $pagenow || 'post-new.php' == $pagenow ) || ( 'options-general.php' == $pagenow ) ) {
			wp_enqueue_style('fontawesome_css',  plugin_dir_url( __FILE__ ) . 'libs/fontawesome/css/main.css', '', '', 'all');
			wp_enqueue_style('post_css',  plugin_dir_url( __FILE__ ) . 'css/main.css', '', '1.10.1', 'all');
		}
	}
}


if ( ! function_exists( 'caip_init_files_JS' ) ) {
	function caip_init_files_JS(){

		global $cibelesAiPlugin;
		global $pagenow;
		global $post;

		if ( ( 'post.php' == $pagenow || 'post-new.php' == $pagenow ) && ($post->post_type == 'post' || 'wpbdp_listing' == $post->post_type)) {
			wp_enqueue_script( 'language_js', plugin_dir_url( __FILE__ ) . 'js/init_language.js', array( 'jquery' ), '1.10.1', true );
			wp_set_script_translations( 'language_js', 'cibeles-ai', plugin_basename( __DIR__ ) . '/languages/');
			
			if (caip_is_classic_editor()) {
				wp_enqueue_script( 'post_js', plugin_dir_url( __FILE__ ) . 'js/init_ai_fields.js', array( 'jquery' ), '1.10.1', true );
				wp_set_script_translations( 'post_js', 'cibeles-ai', plugin_basename( __DIR__ ) . '/languages/');
				wp_localize_script( 'post_js', 'caip_settings', $cibelesAiPlugin['settings']  );
				
				/*
				wp_enqueue_script( 	'caip_main',		plugin_dir_url( __FILE__ ) 		.'js/main.js', 		array( 'jquery' ), '1.0', true );
				wp_set_script_translations( 'caip_main', 	'cibeles-ai', plugin_basename( __DIR__ ) . '/languages/');
				*/
				wp_enqueue_script( 	'caip_diff',			plugin_dir_url( __FILE__ ) 		.'libs/diff/diffDOM.js',array( 'jquery' ), false, true );
				wp_enqueue_script( 	'caip_difftext',		plugin_dir_url( __FILE__ ) 		.'libs/diff/diff.js',	array( 'jquery' ), false, true ); 
				
				wp_enqueue_script( 	'caip_functions',		plugin_dir_url( __FILE__ ) 		.'js/classes/caip_Functions.js', 	array( 'jquery' ), '1.10.1', true );
				wp_enqueue_script( 	'caip_button',			plugin_dir_url( __FILE__ ) 		.'js/classes/caip_Button.js',		array( 'jquery' ), '1.10.1', true );
				wp_enqueue_script( 	'caip_action', 			plugin_dir_url( __FILE__ ) 		.'js/classes/caip_Action.js', 		array( 'jquery' ), '1.10.1', true );
				wp_enqueue_script( 	'caip_titulo', 			plugin_dir_url( __FILE__ ) 		.'js/classes/caip_Titulo.js', 		array( 'jquery' ), '1.10.1', true );
				wp_enqueue_script( 	'caip_tag', 			plugin_dir_url( __FILE__ ) 		.'js/classes/caip_Tag.js', 			array( 'jquery' ), '1.10.1', true );
				wp_enqueue_script( 	'caip_resumenp', 		plugin_dir_url( __FILE__ ) 		.'js/classes/caip_ResumenP.js', 	array( 'jquery' ), '1.10.1', true );
				wp_enqueue_script( 	'caip_multiaction',		plugin_dir_url( __FILE__ ) 		.'js/classes/caip_Multiaction.js', 	array( 'jquery' ), '1.10.1', true );
				
				wp_enqueue_script(	'caip_clickbait', 		plugin_dir_url( __FILE__ ) 		.'js/classes/clickbait.js',			array( 'jquery' ), '1.10.1', true );
				wp_enqueue_script(	'caip_titularcorto', 	plugin_dir_url( __FILE__ ) 		.'js/classes/titularcorto.js',		array( 'jquery' ), '1.10.1', true );
				wp_enqueue_script(	'caip_titular', 		plugin_dir_url( __FILE__ ) 		.'js/classes/titular.js',			array( 'jquery' ), '1.10.1', true );
				wp_enqueue_script(	'caip_tags', 			plugin_dir_url( __FILE__ ) 		.'js/classes/tags.js',				array( 'jquery' ), '1.10.1', true );
				wp_enqueue_script(	'caip_autotags', 		plugin_dir_url( __FILE__ ) 		.'js/classes/autotags.js',			array( 'jquery' ), '1.10.1', true );
				wp_enqueue_script(	'caip_resumen', 		plugin_dir_url( __FILE__ ) 		.'js/classes/resumen.js',			array( 'jquery' ), '1.10.1', true );
				wp_enqueue_script(	'caip_autoexcerpt',		plugin_dir_url( __FILE__ ) 		.'js/classes/autoexcerpt.js',		array( 'jquery' ), '1.10.1', true );
				wp_enqueue_script(	'caip_refrito',			plugin_dir_url( __FILE__ ) 		.'js/classes/refrito.js',			array( 'jquery' ), '1.10.1', true );
				wp_enqueue_script(	'caip_corrector',		plugin_dir_url( __FILE__ )	 	.'js/classes/corrector.js',			array( 'jquery' ), '1.10.1', true );
				wp_enqueue_script(	'caip_introduccion',	plugin_dir_url( __FILE__ )		.'js/classes/introduccion.js',		array( 'jquery' ), '1.10.1', true );
				wp_enqueue_script(	'caip_conclusion',		plugin_dir_url( __FILE__ )	 	.'js/classes/conclusion.js',		array( 'jquery' ), '1.10.1', true );
				wp_enqueue_script(	'caip_youtube',			plugin_dir_url( __FILE__ )	 	.'js/classes/youtube.js',			array( 'jquery' ), '1.10.1', true );
				wp_enqueue_script(	'caip_cifras',			plugin_dir_url( __FILE__ )	 	.'js/classes/cifras.js',			array( 'jquery' ), '1.10.1', true );
				wp_enqueue_script(	'caip_cronologia',		plugin_dir_url( __FILE__ )		.'js/classes/cronologia.js',		array( 'jquery' ), '1.10.1', true );
				wp_enqueue_script(	'caip_faq',				plugin_dir_url( __FILE__ )		.'js/classes/faq.js',				array( 'jquery' ), '1.10.1', true );
				wp_enqueue_script(	'caip_audio',			plugin_dir_url( __FILE__ )		.'js/classes/audio.js',				array( 'jquery' ), '1.10.1', true );

			
				wp_localize_script( 'caip_tags', 'ajax_var', array(
					'url'    => admin_url( 'admin-ajax.php' ),
					'check_nonce'  => wp_create_nonce( 'site_ajax_nonce' ),
				) );
			
				wp_set_script_translations( 'caip_functions',	'cibeles-ai', plugin_dir_path(__FILE__). '/languages/');
				wp_set_script_translations( 'caip_button',		'cibeles-ai', plugin_dir_path(__FILE__). '/languages/');
				wp_set_script_translations( 'caip_action', 		'cibeles-ai', plugin_dir_path(__FILE__). '/languages/');
				wp_set_script_translations( 'caip_titulo', 		'cibeles-ai', plugin_dir_path(__FILE__). '/languages/');
				wp_set_script_translations( 'caip_tag', 		'cibeles-ai', plugin_dir_path(__FILE__). '/languages/');
				wp_set_script_translations( 'caip_resumenp',	'cibeles-ai', plugin_dir_path(__FILE__). '/languages/');
				wp_set_script_translations( 'caip_multiaction',	'cibeles-ai', plugin_dir_path(__FILE__). '/languages/');
				
				wp_set_script_translations( 'caip_clickbait', 	'cibeles-ai', plugin_dir_path(__FILE__). '/languages/');
				wp_set_script_translations( 'caip_titularcorto','cibeles-ai', plugin_dir_path(__FILE__). '/languages/');
				wp_set_script_translations( 'caip_titular',		'cibeles-ai', plugin_dir_path(__FILE__). '/languages/');
				wp_set_script_translations( 'caip_tags',		'cibeles-ai', plugin_dir_path(__FILE__). '/languages/');
				wp_set_script_translations( 'caip_autotags',	'cibeles-ai', plugin_dir_path(__FILE__). '/languages/');
				wp_set_script_translations( 'caip_resumen',		'cibeles-ai', plugin_dir_path(__FILE__). '/languages/');
				wp_set_script_translations( 'caip_autoexcerpt',	'cibeles-ai', plugin_dir_path(__FILE__). '/languages/');
				wp_set_script_translations( 'caip_refrito',		'cibeles-ai', plugin_dir_path(__FILE__). '/languages/');
				wp_set_script_translations( 'caip_corrector',	'cibeles-ai', plugin_dir_path(__FILE__). '/languages/');
				wp_set_script_translations( 'caip_introduccion','cibeles-ai', plugin_dir_path(__FILE__). '/languages/');
				wp_set_script_translations( 'caip_conclusion',	'cibeles-ai', plugin_dir_path(__FILE__). '/languages/');
				wp_set_script_translations( 'caip_youtube',		'cibeles-ai', plugin_dir_path(__FILE__). '/languages/');
				
				wp_set_script_translations( 'caip_cifras',		'cibeles-ai', plugin_dir_path(__FILE__). '/languages/');
				wp_set_script_translations( 'caip_cronologia',	'cibeles-ai', plugin_dir_path(__FILE__). '/languages/');
				wp_set_script_translations( 'caip_faq',			'cibeles-ai', plugin_dir_path(__FILE__). '/languages/');
				
				wp_set_script_translations( 'caip_audio',		'cibeles-ai', plugin_dir_path(__FILE__). '/languages/');
				
				
			}else{
				wp_enqueue_script( 'gutenberg_js', plugin_dir_url( __FILE__ ) . 'js/gutenberg.js', array( 'jquery' ), '1.10.1', true );
				wp_set_script_translations( 'gutenberg_js', 'cibeles-ai', plugin_dir_path(__FILE__). '/languages/');
			}
			
			
		}
	}
}

if ( ! function_exists( 'caip_init_files_views' ) ) {
	function caip_init_files_views(){
		global $post;
		global $cibelesAiPlugin;
		global $pagenow;
		
		if ( ( 'post.php' == $pagenow || 'post-new.php' == $pagenow ) && ($post->post_type == 'post' || 'wpbdp_listing' == $post->post_type)) {
			//include $cibelesAiPlugin['path'] . 'views' . DS . 'scripts.phtml';
				
			if(caip_is_classic_editor()){
				require_once $cibelesAiPlugin['path'] . 'views' . CAIP_DS . 'buttons.php';
				require_once $cibelesAiPlugin['path'] . 'views' . CAIP_DS . 'thickbox' . CAIP_DS . 'titular.php';
				require_once $cibelesAiPlugin['path'] . 'views' . CAIP_DS . 'thickbox' . CAIP_DS . 'titularcorto.php';
				require_once $cibelesAiPlugin['path'] . 'views' . CAIP_DS . 'thickbox' . CAIP_DS . 'clickbait.php';
				require_once $cibelesAiPlugin['path'] . 'views' . CAIP_DS . 'thickbox' . CAIP_DS . 'tags.php';
				require_once $cibelesAiPlugin['path'] . 'views' . CAIP_DS . 'thickbox' . CAIP_DS . 'autotags.php';
				require_once $cibelesAiPlugin['path'] . 'views' . CAIP_DS . 'thickbox' . CAIP_DS . 'resumen.php';
				require_once $cibelesAiPlugin['path'] . 'views' . CAIP_DS . 'thickbox' . CAIP_DS . 'autoexcerpt.php';
				require_once $cibelesAiPlugin['path'] . 'views' . CAIP_DS . 'thickbox' . CAIP_DS . 'refrito.php';
				require_once $cibelesAiPlugin['path'] . 'views' . CAIP_DS . 'thickbox' . CAIP_DS . 'corrector.php';
				require_once $cibelesAiPlugin['path'] . 'views' . CAIP_DS . 'thickbox' . CAIP_DS . 'introduccion.php';	
				require_once $cibelesAiPlugin['path'] . 'views' . CAIP_DS . 'thickbox' . CAIP_DS . 'conclusion.php';
				require_once $cibelesAiPlugin['path'] . 'views' . CAIP_DS . 'thickbox' . CAIP_DS . 'youtube.php';
				require_once $cibelesAiPlugin['path'] . 'views' . CAIP_DS . 'thickbox' . CAIP_DS . 'cifras.php';
				require_once $cibelesAiPlugin['path'] . 'views' . CAIP_DS . 'thickbox' . CAIP_DS . 'cronologia.php';
				require_once $cibelesAiPlugin['path'] . 'views' . CAIP_DS . 'thickbox' . CAIP_DS . 'faq.php';
				require_once $cibelesAiPlugin['path'] . 'views' . CAIP_DS . 'thickbox' . CAIP_DS . 'audio.php';
			}		
		}
	}
}

if ( ! function_exists( 'caip_admin_notice_warn' ) ) {
	function caip_admin_notice_warn() {
		global $cibelesAiPlugin;
		$url = $cibelesAiPlugin['api_url'].'words.php?domain='.urlencode(get_site_url());
		$response = wp_remote_get($url);
		//echo  $response['body'];
		
		if( !is_wp_error($response) && isset($response['body']) && $response['body'] == 'NOWORDS'){
			echo '<div class="notice notice-error is-dismissible">
			  <p>'
			  .esc_html(__('Importante: Cibeles AI Plugin, están sin palabras y no funcionará correctamente, puede adquirir más en ','cibeles-ai')).
			  '<a href="https://ai.cibeles.net/" target="_blank">https://ai.cibeles.net/</a>
			  </p>
			  </div>'; 
		}
	}
}

if ( ! function_exists( 'caip_paste_preprocess' ) ) {
	function caip_paste_preprocess($in) {
		$in['paste_preprocess'] = "function(plugin, args){
		// Strip all HTML tags except those we have whitelisted
		var whitelist = 'a,p,span,b,strong,i,em,h2,h3,h4,h5,h6,ul,li,ol,table,th,tr,td,blockquote,embed,img,script,label,video,audio';
		var stripped = jQuery('<div>' + args.content + '</div>');
		var els = stripped.find('*').not(whitelist);
		for (var i = els.length - 1; i >= 0; i--) {
		  var e = els[i];
		  jQuery(e).replaceWith(e.innerHTML);
		}
		// Strip all class and id attributes
		stripped.find('*').removeAttr('id').removeAttr('class');
		// Return the clean HTML
		args.content = stripped.html();
		}";
	return $in;
	}
}



if ( ! function_exists( 'caip_tag_exists_check' ) ) {
	function caip_tag_exists_check() {
		
		$tags_que_ya_existen = array();
		
		if ( isset( $_POST['tags'] ) && isset( $_POST['check_nonce'] ) ) {
		// Sanitize nonce first
		$check_nonce = sanitize_text_field( wp_unslash( $_POST['check_nonce'] ) );

		// Verify the sanitized nonce
		if ( wp_verify_nonce( $check_nonce, 'site_ajax_nonce' ) ) {
			// Asegurarse de que 'tags' es un array
			if(is_array($_POST['tags'])){
				$tags_sanitized = array_map(function($tag) {
					// Sanitize individually
					return sanitize_text_field( wp_unslash( $tag ) );
				}, $_POST['tags']);
				
				foreach($tags_sanitized as $tag){
					$tag_trimmed = trim($tag);
					if (term_exists($tag_trimmed, 'post_tag')) {
						$tags_que_ya_existen[] = $tag_trimmed;
					}
				}
			}
		}
	}

		
		
		wp_send_json( $tags_que_ya_existen );
	}
}

