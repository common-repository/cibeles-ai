<?php
if (!defined('ABSPATH')) exit;
?>
<div class="cibelesAiView" id="youtube" style="display: none;">
	<p><?php esc_html_e('Genera una noticia a partir de un video de Youtube.','cibeles-ai'); ?></p>
	
	<p><?php
	echo wp_kses_post(__('Se obtendrá el <strong>título</strong>, la <strong>descripción</strong> y los <strong>subtítulos</strong> o transcripción del video si existe.','cibeles-ai'));?>
	</p>
	<p><?php
	echo wp_kses_post(__('Tenga paciencia, este proceso puede durar desde unos segundos a varios minutos, dependiendo principalmente de la longitud de los subtítulos, ya que si son muy extensos se produciran consultas adicionales de resumen.','cibeles-ai'));?>
	</p>
	<p>
		<br /><?php echo wp_kses_post(__('<strong>Introduzca la URL</strong> del video de Youtube','cibeles-ai')); ?><br />
		<input type="url" name="youtubeUrl" placeholder="https://www.youtube.com/watch?v=6Y5Sx_ZSzO4" style="width:100%;margin-top:5px;"></input>
		<div class="cibelesAi_button" id="youtubeme" onclick="caip_youtube.launchButton();">
			<a title="Youtube">Youtube me!</a>
		</div>
	</p>
	<p></p>
	<div class="result youtube"></div>
</div>
