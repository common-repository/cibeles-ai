<?php
if (!defined('ABSPATH')) exit;
?>
<div class="cibelesAiView" id="tags" style="display: none;">
	<p><?php echo wp_kses_post(__('La generación de tags se hace con el contenido de la entrada. Los tags que ya existen en mi sistema, aparecerán marcados en un check <span style="color:green;"> verde <strong>✓</strong> </span>.','cibeles-ai')); ?></p>
	<p><?php esc_html_e('Elija entre los siguientes tags:','cibeles-ai'); ?></p>
	<div class="result tags"></div>
</div>
