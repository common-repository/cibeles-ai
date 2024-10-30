<?php
if (!defined('ABSPATH')) exit;

add_action( 'admin_menu', 'caip_add_admin_menu' );
add_action( 'admin_init', 'caip_settings_init' );


function caip_add_admin_menu(  ) { 

	add_options_page( 'Cibeles AI', 'Cibeles AI', 'manage_options', 'cibeles_ai', 'caip_options_page' );

}


function caip_settings_init(  ) { 

	register_setting( 'caip_pluginPage', 'caip_settings' );

	add_settings_section(
		'caip_pluginPage_section', 
		__( 'Asistente de redacción de entradas con inteligencia artificial para Wordpress', 'cibeles-ai' ), 
		
		'caip_settings_section_callback', 
		'caip_pluginPage'
	);

	add_settings_field( 
		'caip_radio_idioma', 
		__( 'Seleccione una opción para el idioma', 'cibeles-ai' ), 
		'caip_radio_idioma_render', 
		'caip_pluginPage', 
		'caip_pluginPage_section' 
	);
	
	add_settings_field( 
		'caip_numero_titulares', 
		__( 'Cantidad de titulares generados', 'cibeles-ai' ), 
		'caip_numero_titulares_render', 
		'caip_pluginPage', 
		'caip_pluginPage_section' 
	);
	
	add_settings_field( 
		'caip_numero_tags', 
		__( 'Cantidad de tags generados', 'cibeles-ai' ), 
		'caip_numero_tags_render', 
		'caip_pluginPage', 
		'caip_pluginPage_section' 
	);
	
	add_settings_field( 
		'caip_enable_buttons', 
		__( 'Funciones habilitadas', 'cibeles-ai' ), 
		'caip_enable_buttons_render', 
		'caip_pluginPage', 
		'caip_pluginPage_section' 
	);

}

function caip_radio_idioma_render(  ) { 

	$options = get_option( 'caip_settings' );
	if(!isset($options['caip_radio_idioma']) || $options['caip_radio_idioma'] == ''  || $options['caip_radio_idioma'] < 1  || $options['caip_radio_idioma'] > 3){
		@$options['caip_radio_idioma'] = 1;
	}
	$WP_lang = strtoupper(substr(get_user_locale(),0,2));
	$WPML_lang = strtoupper(apply_filters( 'wpml_current_language', NULL ));
	
	?>
	<label>
		<input type="radio" name="caip_settings[caip_radio_idioma]" value="1" <?php if($options['caip_radio_idioma']=='1'){ echo 'checked'; }?>>
		<?php esc_html_e( 'Idioma del usuario en WP', 'cibeles-ai' ); ?>
		<?php echo wp_kses_post(' ('.__( 'idioma detectado', 'cibeles-ai' ).': <strong>'.$WP_lang.'</strong>)'); ?>
	</label>
	<br>
	<br>
	<label>
		<input type="radio" name="caip_settings[caip_radio_idioma]" value="2" <?php if($options['caip_radio_idioma']=='2'){ echo 'checked'; }?>>
		<?php esc_html_e( 'WPML automáticoa', 'cibeles-ai' ); ?>
		<?php echo wp_kses_post(' ('.__( 'idioma detectado', 'cibeles-ai' ).': <strong>'.$WPML_lang.'</strong>)'); ?>
	</label>
	<!--
	<br>
	<br>
	<label>
		<input type="radio" name="idioma" value="2" <?php if($options['caip_radio_idioma']=='3'){ echo 'checked'; }?>>
		<?php esc_html_e( 'Idioma fijo', 'cibeles-ai' ); ?>	
	</label>
	<br>
	-->
	<?php
}

function caip_numero_titulares_render(  ) { 

	$options = get_option( 'caip_settings' );
	if(!isset($options['caip_numero_titulares']) || $options['caip_numero_titulares'] == ''  || $options['caip_numero_titulares'] < 1  || $options['caip_numero_titulares'] > 15){
		@$options['caip_numero_titulares'] = 5;
	}
	?>
	<input type='number' name='caip_settings[caip_numero_titulares]' min="1" max="15" value='<?php echo esc_attr($options['caip_numero_titulares']); ?>' style="max-width:80px;">
	<?php
}

function caip_numero_tags_render(  ) { 

	$options = get_option( 'caip_settings' );
	if(!isset($options['caip_numero_tags']) || $options['caip_numero_tags'] == ''  || $options['caip_numero_tags'] < 1  || $options['caip_numero_tags'] > 25){
		@$options['caip_numero_tags'] = 10;
	}
	?>
	<input type='number' name='caip_settings[caip_numero_tags]' min="1" max="20" value='<?php echo esc_attr($options['caip_numero_tags']); ?>' style="max-width:80px;">
	<?php
}

function caip_enable_buttons_render(  ) { 

	$options = get_option( 'caip_settings' );
	Global $cibelesAiPlugin;
	include_once($cibelesAiPlugin['path'] . 'options_buttons_default.php');
	


	?>
	<table class="options-cibelesai">
		<tr>
			<td>
				<input type='hidden' name='caip_settings[caip_enable_buttons][titular]' value='off'>
				<input type='checkbox' name='caip_settings[caip_enable_buttons][titular]' style="max-width:80px;" <?php if($options['caip_enable_buttons']['titular'] == 'on'){ echo 'checked';} ?> />
			</td>
			<td>
				<div class="cibelesAi_button">
					<a href="#" title="<?php esc_html_e('Generación titular','cibeles-ai'); ?>">
						<?php  esc_html_e('Titular','cibeles-ai'); ?>
						<i class="fa fa-superpowers"></i>
					</a>
				</div>
				<div class="descriptionOptions"><?php esc_html_e('Generación titular','cibeles-ai'); ?></div>
			</td>
		</tr>
		<tr>
			<td>
				<input type='hidden' name='caip_settings[caip_enable_buttons][titularcorto]' value='off'>
				<input type='checkbox' name='caip_settings[caip_enable_buttons][titularcorto]' style="max-width:80px;" <?php if($options['caip_enable_buttons']['titularcorto'] == 'on'){ echo 'checked';} ?> />
			</td>
			<td>
				<div class="cibelesAi_button">
					<a href="#" title="<?php esc_html_e('Generación titular corto','cibeles-ai'); ?>">
						<?php  esc_html_e('Titular corto','cibeles-ai'); ?>
						<i class="fa fa-superpowers"></i>
					</a>
				</div>
				<div class="descriptionOptions"><?php esc_html_e('Generación titular corto','cibeles-ai'); ?></div>
			</td>
		</tr>
		<tr>
			<td>
				<input type='hidden' name='caip_settings[caip_enable_buttons][clickbait]' value='off'>
				<input type='checkbox' name='caip_settings[caip_enable_buttons][clickbait]' style="max-width:80px;" <?php if($options['caip_enable_buttons']['clickbait'] == 'on'){ echo 'checked';} ?> />
			</td>
			<td>
				<div class="cibelesAi_button">
					<a href="#" title="<?php esc_html_e('Generación clickbait','cibeles-ai'); ?>">
						<?php  esc_html_e('Clickbait','cibeles-ai'); ?>
						<i class="fa fa-superpowers"></i>
					</a>
				</div>
				<div class="descriptionOptions"><?php esc_html_e('Generación clickbait','cibeles-ai'); ?></div>
			</td>
		</tr>
		<tr><td><br /></td><td></td></tr>
		<tr>
			<td>
				<input type='hidden' name='caip_settings[caip_enable_buttons][tags]' value='off'>
				<input type='checkbox' name='caip_settings[caip_enable_buttons][tags]' style="max-width:80px;" <?php if($options['caip_enable_buttons']['tags'] == 'on'){ echo 'checked';} ?> />
			</td>
			<td>
				<div class="cibelesAi_button">
					<a href="#" title="<?php esc_html_e('Generación tags con asistente','cibeles-ai'); ?>">
						<?php  esc_html_e('Tags','cibeles-ai'); ?>
						<i class="fa fa-superpowers"></i>
					</a>
				</div>
				<div class="descriptionOptions"><?php esc_html_e('Generación tags con asistente','cibeles-ai'); ?></div>
			</td>
		</tr>
		<tr>
			<td>
				<input type='hidden' name='caip_settings[caip_enable_buttons][autotags]' value='off'>
				<input type='checkbox' name='caip_settings[caip_enable_buttons][autotags]' style="max-width:80px;" <?php if($options['caip_enable_buttons']['autotags'] == 'on'){ echo 'checked';} ?> />
			</td>
			<td>
				<div class="cibelesAi_button">
					<a href="#" title="<?php esc_html_e('Generación tags automática','cibeles-ai'); ?>">
						<?php  esc_html_e('Autotags','cibeles-ai'); ?>
						<i class="fa fa-superpowers"></i>
					</a>
				</div>
				<div class="descriptionOptions"><?php esc_html_e('Generación tags automática','cibeles-ai'); ?></div>
			</td>
		</tr>
		<tr><td><br /></td><td></td></tr>
		<tr>
			<td>
				<input type='hidden' name='caip_settings[caip_enable_buttons][resumen]' value='off'>
				<input type='checkbox' name='caip_settings[caip_enable_buttons][resumen]' style="max-width:80px;" <?php if($options['caip_enable_buttons']['resumen'] == 'on'){ echo 'checked';} ?> />
			</td>
			<td>
				<div class="cibelesAi_button">
					<a href="#" title="<?php esc_html_e('Generación resumen','cibeles-ai'); ?>">
						<?php  esc_html_e('Resumen','cibeles-ai'); ?>
						<i class="fa fa-superpowers"></i>
					</a>
				</div>
				<div class="descriptionOptions"><?php esc_html_e('Generación resumen','cibeles-ai'); ?></div>
			</td>
		</tr>
		<tr>
			<td>
				<input type='hidden' name='caip_settings[caip_enable_buttons][autoexcerpt]' value='off'>
				<input type='checkbox' name='caip_settings[caip_enable_buttons][autoexcerpt]' style="max-width:80px;" <?php if($options['caip_enable_buttons']['autoexcerpt'] == 'on'){ echo 'checked';} ?> />
			</td>
			<td>
				<div class="cibelesAi_button">
					<a href="#"  title="<?php esc_html_e('Generación extracto automático','cibeles-ai'); ?>">
						<?php  esc_html_e('Autoexcerpt','cibeles-ai'); ?>
						<i class="fa fa-superpowers"></i>
					</a>
				</div>
				<div class="descriptionOptions"><?php esc_html_e('Generación extracto automático','cibeles-ai'); ?></div>
			</td>
		</tr>
		<tr>
			<td>
				<input type='hidden' name='caip_settings[caip_enable_buttons][introduccion]' value='off'>
				<input type='checkbox' name='caip_settings[caip_enable_buttons][introduccion]' style="max-width:80px;" <?php if($options['caip_enable_buttons']['introduccion'] == 'on'){ echo 'checked';} ?> />
			</td>
			<td>
				<div class="cibelesAi_button">
					<a href="#" title="<?php esc_html_e('Generación introducción','cibeles-ai'); ?>">
						<?php  esc_html_e('Introducción','cibeles-ai'); ?>
						<i class="fa fa-superpowers"></i>
					</a>
				</div>
				<div class="descriptionOptions"><?php esc_html_e('Generación introducción','cibeles-ai'); ?></div>
			</td>
		</tr>
		<tr>
			<td>
				<input type='hidden' name='caip_settings[caip_enable_buttons][conclusion]' value='off'>
				<input type='checkbox' name='caip_settings[caip_enable_buttons][conclusion]' style="max-width:80px;" <?php if($options['caip_enable_buttons']['conclusion'] == 'on'){ echo 'checked';} ?> />
			</td>
			<td>
				<div class="cibelesAi_button">
					<a href="#" title="<?php esc_html_e('Generación conclusión','cibeles-ai'); ?>">
						<?php  esc_html_e('Conclusión','cibeles-ai'); ?>
						<i class="fa fa-superpowers"></i>
					</a>
				</div>
				<div class="descriptionOptions"><?php esc_html_e('Generación conclusión','cibeles-ai'); ?></div>
			</td>
		</tr>
		<tr>
			<td>
				<input type='hidden' name='caip_settings[caip_enable_buttons][refrito]' value='off'>
				<input type='checkbox' name='caip_settings[caip_enable_buttons][refrito]' style="max-width:80px;" <?php if($options['caip_enable_buttons']['refrito'] == 'on'){ echo 'checked';} ?> />
			</td>
			<td>
				<div class="cibelesAi_button">
					<a href="#" title="<?php esc_html_e('Generación refrito, reescribe el texto','cibeles-ai'); ?>">
						<?php esc_html_e('Refrito','cibeles-ai'); ?>
						<i class="fa fa-superpowers"></i>
					</a>
				</div>
				<div class="descriptionOptions"><?php esc_html_e('Generación refrito, reescribe el texto','cibeles-ai'); ?></div>
			</td>
		</tr>
		<tr>
			<td>
				<input type='hidden' name='caip_settings[caip_enable_buttons][corrector]' value='off'>
				<input type='checkbox' name='caip_settings[caip_enable_buttons][corrector]' style="max-width:80px;" <?php if($options['caip_enable_buttons']['corrector'] == 'on'){ echo 'checked';} ?> />
			</td>
			<td>
				<div class="cibelesAi_button">
					<a href="#" title="<?php esc_html_e('Corrección de ortografía, sintaxis y semántica','cibeles-ai'); ?>">
						<?php esc_html_e('Corrector','cibeles-ai'); ?>
						<i class="fa fa-superpowers"></i>
					</a>
				</div>
				<div class="descriptionOptions"><?php esc_html_e('Corrección de ortografía, sintaxis y semántica','cibeles-ai'); ?></div>
			</td>
		</tr>
		<tr>
			<td>
				<input type='hidden' name='caip_settings[caip_enable_buttons][youtube]' value='off'>
				<input type='checkbox' name='caip_settings[caip_enable_buttons][youtube]' style="max-width:80px;" <?php if($options['caip_enable_buttons']['youtube'] == 'on'){ echo 'checked';} ?> />
			</td>
			<td>
				<div class="cibelesAi_button">
					<a href="#" title="<?php esc_html_e('Creación de una noticia a partir de un video de Youtube','cibeles-ai'); ?>">
						<?php esc_html_e('Youtube','cibeles-ai'); ?>
						<i class="fa fa-superpowers"></i>
					</a>
				</div>
				<div class="descriptionOptions"><?php esc_html_e('Creación de una noticia a partir de un video de Youtube','cibeles-ai'); ?></div>
			</td>
		</tr>
		<tr>
			<td>
				<input type='hidden' name='caip_settings[caip_enable_buttons][audio]' value='off'>
				<input type='checkbox' name='caip_settings[caip_enable_buttons][audio]' style="max-width:80px;" <?php if($options['caip_enable_buttons']['audio'] == 'on'){ echo 'checked';} ?> />
			</td>
			<td>
				<div class="cibelesAi_button">
					<a href="#" title="<?php esc_html_e('Creación de un artículo basado en la transcripción de un audio','cibeles-ai'); ?>">
						<?php esc_html_e('Audio','cibeles-ai'); ?>
						<i class="fa fa-superpowers"></i> 
					</a> 
				</div> 
				<div class="descriptionOptions"><?php esc_html_e('Creación de un artículo basado en la transcripción de un audio','cibeles-ai'); ?></div>
			</td>
		</tr>
		<tr>
			<td>
				<input type='hidden' name='caip_settings[caip_enable_buttons][cifras]' value='off'>
				<input type='checkbox' name='caip_settings[caip_enable_buttons][cifras]' style="max-width:80px;" <?php if($options['caip_enable_buttons']['cifras'] == 'on'){ echo 'checked';} ?> />
			</td>
			<td>
				<div class="cibelesAi_button">
					<a href="#" title="<?php esc_html_e('Creación de una tabla con las cifras del contenido','cibeles-ai'); ?>">
						<?php esc_html_e('Cifras','cibeles-ai'); ?>
						<i class="fa fa-superpowers"></i>
					</a>
				</div>
				<div class="descriptionOptions"><?php esc_html_e('Creación de una tabla con las cifras del contenido','cibeles-ai'); ?></div>
			</td>
		</tr>
		<tr>
			<td>
				<input type='hidden' name='caip_settings[caip_enable_buttons][cronologia]' value='off'>
				<input type='checkbox' name='caip_settings[caip_enable_buttons][cronologia]' style="max-width:80px;" <?php if($options['caip_enable_buttons']['cronologia'] == 'on'){ echo 'checked';} ?> />
			</td>
			<td>
				<div class="cibelesAi_button">
					<a href="#" title="<?php esc_html_e('Creación de un texto con encabezados con la cronologia del contenido','cibeles-ai'); ?>">
						<?php esc_html_e('Cronología','cibeles-ai'); ?>
						<i class="fa fa-superpowers"></i>
					</a>
				</div>
				<div class="descriptionOptions"><?php esc_html_e('Creación de un texto con encabezados con la cronologia del contenido','cibeles-ai'); ?></div>
			</td>
		</tr>
		<tr>
			<td>
				<input type='hidden' name='caip_settings[caip_enable_buttons][faq]' value='off'>
				<input type='checkbox' name='caip_settings[caip_enable_buttons][faq]' style="max-width:80px;" <?php if($options['caip_enable_buttons']['faq'] == 'on'){ echo 'checked';} ?> />
			</td>
			<td>
				<div class="cibelesAi_button">
					<a href="#" title="<?php esc_html_e('Creación de una tabla con la FAQ del contenido','cibeles-ai'); ?>">
						<?php esc_html_e('FAQ','cibeles-ai'); ?>
						<i class="fa fa-superpowers"></i> 
					</a> 
				</div> 
				<div class="descriptionOptions"><?php esc_html_e('Creación de una tabla con la FAQ del contenido','cibeles-ai'); ?></div>
			</td>
		</tr>
	</table>

	<?php
}

function caip_settings_section_callback(  ) { 

	echo wp_kses_post(__('Configuración de Plugin de AI Cibeles - OpenAI y otros ajustes. (Uso del modelo gpt-4o). <br /><br />Tiene gratis 50.000 palabras. Si encuentra cualquier problema con el uso del plugin no dude en avisarnos en soporte@cibeles.net<br />
	<strong>Palabras usadas: <span id="palabrasusadas">0</span></strong> <br />
	<h2>Palabras disponibles: <span id="palabrasdisponibles">0</span></h2> <br />
	', 'cibeles-ai' ));
	echo '<script>';
	echo "
		document.addEventListener('DOMContentLoaded', () => {	
			jQuery.get( 'https://openai.editmaker.com/wp/api/get.php?palabrasUsadas=get', function( data ) {
			  jQuery('#palabrasusadas').html( data );
			});
			jQuery.get( 'https://openai.editmaker.com/wp/api/get.php?palabrasDisponibles=get', function( data ) {
			  jQuery('#palabrasdisponibles').html( data );
			});
		});";
	echo '</script>';
}


function caip_options_page(  ) { 

		?>
		<form action='options.php' method='post'>

			<h2>Cibeles AI</h2>
			<div class="logoAjustes">
				<a href="https://ai.cibeles.net/" target="_blank">
				<img src="<?php echo esc_url(plugin_dir_url( __FILE__ )) .'img/logo-ai.cibeles.net.png'; ?> " width="" />
				</a>
				<br />
				<?php esc_html_e('Puede adquirir más palabras en','cibeles-ai');?> <br /><a href="https://ai.cibeles.net/" target="_blank">https://ai.cibeles.net/</a>
				
			</div>
			<style>
				.logoAjustes {
					float: right;
					text-align: center;
					margin-right: 20px;
				}
				.logoAjustes img{
					max-width: 180px;
				}
			</style>
			<?php
			settings_fields( 'caip_pluginPage' );
			do_settings_sections( 'caip_pluginPage' );
			submit_button();
			?>

		</form>
		<?php

}


function caip_plugin_add_settings_link( $links ) {
    $settings_link = '<a href="/wp-admin/options-general.php?page=cibeles_ai">' . esc_html('Settings') . '</a>';
    array_push( $links, $settings_link );
  	return $links;
}
add_filter( "plugin_action_links_cibeles-ai/cibeles-ai.php", 'caip_plugin_add_settings_link' );





?>