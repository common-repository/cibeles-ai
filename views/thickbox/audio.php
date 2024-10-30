<?php
if (!defined('ABSPATH')) exit;
?>
<div class="cibelesAiView" id="audio" style="display: none;">
	<div class="CAIP_audioStep">
		<p><?php esc_html_e('Genera un artículo a partir de un fichero de audio.','cibeles-ai'); ?></p>
		
		<p><?php
		echo wp_kses_post(__('Se obtendrá la <strong>transcripción</strong> literal, y con ella se generará un <strong>artículo</strong>. Tenga paciencia, este proceso puede durar desde unos segundos a varios minutos, dependiendo principalmente de la longitud del audio.<br /><br/>','cibeles-ai'));?>
		</p>
		<p>
		<?php
		echo wp_kses_post(__('<div class="audioBoxDesc"><div>Se admiten los siguientes tipos de archivos de entrada:<br /><strong>mp3</strong>, <strong>mp4</strong>, <strong>mpeg</strong>, <strong>mpga</strong>, <strong>m4a</strong>, <strong>wav</strong> y <strong>webm</strong>. También puede subir videos y el sistema extraerá automáticamente el audio de los mismos.</div></div>','cibeles-ai'));?>
		
		</p>
		<p>
			<br /><?php echo wp_kses_post(__('Seleccione el <strong>fichero</strong> de audio para subirlo:','cibeles-ai')); ?><br />
			
			<div style="width:100%;text-align:center;margin:auto;">
						<form id="uploadFormAudioFile">
							<input type="file" name="audiofile" ></input>
							<select id="language-select" name="language">
								<option value="auto" selected><?php esc_html_e('Idioma automático', 'cibeles-ai'); ?></option>
								<option value="es" ><?php esc_html_e('Español', 'cibeles-ai'); ?></option>
								<option value="ca" ><?php esc_html_e('Catalán', 'cibeles-ai'); ?></option>
								<option value="en"><?php esc_html_e('Inglés', 'cibeles-ai'); ?></option>
								<option value="zh"><?php esc_html_e('Chino', 'cibeles-ai'); ?></option>
								<option value="hi"><?php esc_html_e('Hindi', 'cibeles-ai'); ?></option>
								<option value="ar"><?php esc_html_e('Árabe', 'cibeles-ai'); ?></option>
								<option value="pt"><?php esc_html_e('Portugués', 'cibeles-ai'); ?></option>
								<option value="bn"><?php esc_html_e('Bengalí', 'cibeles-ai'); ?></option>
								<option value="ru"><?php esc_html_e('Ruso', 'cibeles-ai'); ?></option>
								<option value="ja"><?php esc_html_e('Japonés', 'cibeles-ai'); ?></option>
								<option value="de"><?php esc_html_e('Alemán', 'cibeles-ai'); ?></option>
								<option value="fr"><?php esc_html_e('Francés', 'cibeles-ai'); ?></option>
								<option value="it"><?php esc_html_e('Italiano', 'cibeles-ai'); ?></option>
								<option value="ko"><?php esc_html_e('Coreano', 'cibeles-ai'); ?></option>
								<option value="tr"><?php esc_html_e('Turco', 'cibeles-ai'); ?></option>
								<option value="vi"><?php esc_html_e('Vietnamita', 'cibeles-ai'); ?></option>
								<option value="ta"><?php esc_html_e('Tamil', 'cibeles-ai'); ?></option>
								<option value="fa"><?php esc_html_e('Persa', 'cibeles-ai'); ?></option>
								<option value="ur"><?php esc_html_e('Urdu', 'cibeles-ai'); ?></option>
								<option value="pa"><?php esc_html_e('Punjabi', 'cibeles-ai'); ?></option>
								<option value="gu"><?php esc_html_e('Gujarati', 'cibeles-ai'); ?></option>
								<option value="pl"><?php esc_html_e('Polaco', 'cibeles-ai'); ?></option>
								<option value="uk"><?php esc_html_e('Ucraniano', 'cibeles-ai'); ?></option>
								<option value="ml"><?php esc_html_e('Malayalam', 'cibeles-ai'); ?></option>
								<option value="te"><?php esc_html_e('Telugu', 'cibeles-ai'); ?></option>
								<option value="mr"><?php esc_html_e('Marathi', 'cibeles-ai'); ?></option>
							</select>
							<a id="subiraudiofile" onclick="caip_audio.launchButtonGetTranscripcion();" title="Generar transcripción"><?php esc_html_e('Generar transcripción', 'cibeles-ai'); ?></a>
							<a id="copiarTranscripcion" onclick="caip_audio.copiarTranscripcion();" title="Copiar transcripción"><?php esc_html_e('Copiar transcripción', 'cibeles-ai'); ?></a>
						</form>
						<textarea id="transcripcion" placeholder="<?php esc_html_e('Aquí aparecerá la transcripción del audio en forma de texto. Si directamente tiene la transcripción del audio, no es necesario que suba el archivo de audio, pegue directamente la transcripción aquí y pulse el botón generar artículo.','cibeles-ai'); ?>"></textarea>
						<form id="uploadFormArticle">
							<a id="subirTranscripcion" onclick="caip_audio.launchButtonGetTranscripcionArticulo();" title="Generar artículo"><?php esc_html_e('Generar artículo', 'cibeles-ai'); ?></a>
							<a id="copiarArticulo" onclick="caip_audio.copiarTranscripcionArticulo();" title="Copiar artículo"><?php esc_html_e('Copiar artículo', 'cibeles-ai'); ?></a>
						</form>
						<div id="copiarArticuloTranscripcion"><div class="result article transcripcion"></div></div>
			</div>
			
		</p>
		<p></p>
		<div class="result audio"></div>
	</div>
</div>
