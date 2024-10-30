<?php
if (!defined('ABSPATH')) exit;
$options = get_option( 'caip_settings' );
Global $cibelesAiPlugin;
include_once($cibelesAiPlugin['path'] . 'options_buttons_default.php');
?>
<!-- TITLEDIV -->
<div id="div_group_button_titlediv" style="display:none">
		<?php if($options['caip_enable_buttons']['titular'] == 'on'){ ?>
			<div id="div_button_titular" class="cibelesAi_button">
				<a href="#TB_inline?&height=300&width=400&inlineId=titular" class="thickbox" title="<?php esc_html_e('Generación titular','cibeles-ai'); ?>">
					<?php  esc_html_e('Titular','cibeles-ai'); ?>
					<i class="fa fa-superpowers"></i>
				</a>
			</div>
		<?php } ?>
		<?php if($options['caip_enable_buttons']['titularcorto'] == 'on'){ ?>
			<div id="div_button_titularcorto" class="cibelesAi_button">
				<a href="#TB_inline?&width=200&height=550&inlineId=titularcorto" class="thickbox" title="<?php esc_html_e('Generación titular corto','cibeles-ai'); ?>">
					<?php  esc_html_e('Titular corto','cibeles-ai'); ?>
					<i class="fa fa-superpowers"></i>
				</a>
			</div>
		<?php } ?>
		<?php if($options['caip_enable_buttons']['clickbait'] == 'on'){ ?>
			<div id="div_button_clickbait" class="cibelesAi_button">
				<a href="#TB_inline?&width=200&height=550&inlineId=clickbait" class="thickbox"  title="<?php esc_html_e('Generación clickbait','cibeles-ai'); ?>">
					<?php  esc_html_e('Clickbait','cibeles-ai'); ?>
					<i class="fa fa-superpowers"></i>
				</a>
			</div>
		<?php } ?>
	
</div>

<!-- TAGSDIV -->
<div id="div_group_button_tagsdiv" style="display:none">
		<?php if($options['caip_enable_buttons']['tags'] == 'on'){ ?>
			<div id="div_button_tags" class="cibelesAi_button">
				<a href="#TB_inline?&height=300&width=400&inlineId=tags" class="thickbox" title="<?php esc_html_e('Generación tags','cibeles-ai'); ?>">
					<?php  esc_html_e('Tags','cibeles-ai'); ?>
					<i class="fa fa-superpowers"></i>
				</a>
			</div>
		<?php } ?>
		<?php if($options['caip_enable_buttons']['autotags'] == 'on'){ ?>
			<div id="div_button_autotags" class="cibelesAi_button">
				<a href="#TB_inline?&height=300&width=400&inlineId=autotags" title="<?php esc_html_e('Generación tags automática','cibeles-ai'); ?>">
					<?php  esc_html_e('Autotags','cibeles-ai'); ?>
					<i class="fa fa-superpowers"></i>
				</a>
			</div>
		<?php } ?>
</div>

<!-- POSTDIVRICH  -->
<div id="div_group_button_postdiv" style="display:none">
		<?php if($options['caip_enable_buttons']['resumen'] == 'on'){ ?>
			<div id="div_button_resumen" class="cibelesAi_button">
				<a href="#TB_inline?&height=300&width=400&inlineId=resumen" class="thickbox" title="<?php esc_html_e('Generación resumen','cibeles-ai'); ?>">
					<?php  esc_html_e('Resumen','cibeles-ai'); ?>
					<i class="fa fa-superpowers"></i>
				</a>
			</div>
		<?php } ?>
		<?php if($options['caip_enable_buttons']['autoexcerpt'] == 'on'){ ?>
			<div id="div_button_autoexcerpt" class="cibelesAi_button">
				<a href="#TB_inline?&height=300&width=400&inlineId=autoexcerpt"  title="<?php esc_html_e('Generación excerpt automática','cibeles-ai'); ?>">
					<?php  esc_html_e('Autoexcerpt','cibeles-ai'); ?>
					<i class="fa fa-superpowers"></i>
				</a>
			</div>
		<?php } ?>
		<?php if($options['caip_enable_buttons']['introduccion'] == 'on'){ ?>
			<div id="div_button_introduccion" class="cibelesAi_button">
				<a href="#TB_inline?&height=300&width=400&inlineId=introduccion" class="thickbox" title="<?php esc_html_e('Generación introducción','cibeles-ai'); ?>">
					<?php  esc_html_e('Introducción','cibeles-ai'); ?>
					<i class="fa fa-superpowers"></i>
				</a>
			</div>
		<?php } ?>
		<?php if($options['caip_enable_buttons']['conclusion'] == 'on'){ ?>
			<div id="div_button_conclusion" class="cibelesAi_button">
				<a href="#TB_inline?&height=300&width=400&inlineId=conclusion" class="thickbox" title="<?php esc_html_e('Generación conclusión','cibeles-ai'); ?>">
					<?php  esc_html_e('Conclusión','cibeles-ai'); ?>
					<i class="fa fa-superpowers"></i>
				</a>
			</div>
		<?php } ?>
		<?php if($options['caip_enable_buttons']['refrito'] == 'on'){ ?>
			<div id="div_button_refrito" class="cibelesAi_button">
				<a href="#" onclick="tb_show('<?php esc_html_e('Generación refrito','cibeles-ai'); ?>', '#TB_inline?&inlineId=refrito&width=full&height=full&max-width=1520');  setTimeout(() => { caip_refrito.resize_thickbox_fullsize(); }, '50');">
					<?php esc_html_e('Refrito','cibeles-ai'); ?>
					<i class="fa fa-superpowers"></i>
				</a>
			</div>
		<?php } ?>
		<?php if($options['caip_enable_buttons']['corrector'] == 'on'){ ?>
			<div id="div_button_corrector" class="cibelesAi_button">
				<a href="#" onclick="tb_show('<?php esc_html_e('Corrección de ortografía, sintaxis y semántica','cibeles-ai'); ?>', '#TB_inline?&inlineId=corrector&width=full&height=full&max-width=1520');  setTimeout(() => { caip_corrector.resize_thickbox_fullsize(); }, '50');">
					<?php esc_html_e('Corrector','cibeles-ai'); ?>
					<i class="fa fa-superpowers"></i>
				</a>
			</div>
		<?php } ?>
		<?php if($options['caip_enable_buttons']['youtube'] == 'on'){ ?>
			<div id="div_button_youtube" class="cibelesAi_button">
				<a href="#TB_inline?&height=300&width=400&inlineId=youtube" class="thickbox" title="<?php esc_html_e('Youtube','cibeles-ai'); ?>">
					<?php  esc_html_e('Youtube','cibeles-ai'); ?>
					<i class="fa fa-superpowers"></i>
				</a>
			</div>
		<?php } ?>
		<?php if($options['caip_enable_buttons']['audio'] == 'on'){ ?>
			<div id="div_button_audio" class="cibelesAi_button">
				<a href="#TB_inline?&height=300&width=400&inlineId=audio" class="thickbox" title="<?php esc_html_e('Audio','cibeles-ai'); ?>">
					<?php  esc_html_e('Audio','cibeles-ai'); ?>
					<i class="fa fa-superpowers"></i>
				</a>
			</div>
		<?php } ?>
		<?php if($options['caip_enable_buttons']['cifras'] == 'on'){ ?>
			<div id="div_button_cifras" class="cibelesAi_button">
				<a href="#TB_inline?&height=300&width=400&inlineId=cifras" class="thickbox" title="<?php esc_html_e('Cifras','cibeles-ai'); ?>">
					<?php  esc_html_e('Cifras','cibeles-ai'); ?>
					<i class="fa fa-superpowers"></i>
				</a>
			</div>
		<?php } ?>
		<?php if($options['caip_enable_buttons']['cronologia'] == 'on'){ ?>
			<div id="div_button_cronologia" class="cibelesAi_button">
				<a href="#TB_inline?&height=300&width=400&inlineId=cronologia" class="thickbox" title="<?php esc_html_e('Cronología','cibeles-ai'); ?>">
					<?php  esc_html_e('Cronología','cibeles-ai'); ?>
					<i class="fa fa-superpowers"></i>
				</a>
			</div>
		<?php } ?>
		<?php if($options['caip_enable_buttons']['faq'] == 'on'){ ?>
			<div id="div_button_faq" class="cibelesAi_button">
				<a href="#TB_inline?&height=300&width=400&inlineId=faq" class="thickbox" title="<?php esc_html_e('FAQ','cibeles-ai'); ?>">
					<?php  esc_html_e('FAQ','cibeles-ai'); ?>
					<i class="fa fa-superpowers"></i>
				</a>
			</div>
		<?php } ?>
</div>

<script>
let cibelesAiPlugin = {
		api_url : 			'<?php echo esc_js($cibelesAiPlugin['api_url']); ?>',
		api_url_youtube : 	'<?php echo esc_js($cibelesAiPlugin['api_url_youtube']); ?>',
		api_url_whisper : 	'<?php echo esc_js($cibelesAiPlugin['api_url_whisper']); ?>',
		url : 				'<?php echo esc_js($cibelesAiPlugin['url']); ?>',
		namespace : 		'<?php echo esc_js($cibelesAiPlugin['namespace']); ?>',
		nick : 				'<?php echo esc_js($cibelesAiPlugin['nick']); ?>',
		idioma :			'<?php echo esc_js($cibelesAiPlugin['settings']['idioma']); ?>',

};

</script>
