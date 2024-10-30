<?php
if (!defined('ABSPATH')) exit;


if(!isset($options['caip_enable_buttons']['titular']) || $options['caip_enable_buttons']['titular'] == ''  ){
	$options['caip_enable_buttons']['titular'] = 'on';
}
if(!isset($options['caip_enable_buttons']['titularcorto']) || $options['caip_enable_buttons']['titularcorto'] == ''  ){
	$options['caip_enable_buttons']['titularcorto'] = 'on';
}
if(!isset($options['caip_enable_buttons']['clickbait']) || $options['caip_enable_buttons']['clickbait'] == ''  ){
	$options['caip_enable_buttons']['clickbait'] = 'on';
}
if(!isset($options['caip_enable_buttons']['tags']) || $options['caip_enable_buttons']['tags'] == ''  ){
	$options['caip_enable_buttons']['tags'] = 'on';
}
if(!isset($options['caip_enable_buttons']['autotags']) || $options['caip_enable_buttons']['autotags'] == ''  ){
	$options['caip_enable_buttons']['autotags'] = 'on';
}
if(!isset($options['caip_enable_buttons']['resumen']) || $options['caip_enable_buttons']['resumen'] == ''  ){
	$options['caip_enable_buttons']['resumen'] = 'on';
}
if(!isset($options['caip_enable_buttons']['autoexcerpt']) || $options['caip_enable_buttons']['autoexcerpt'] == ''  ){
	$options['caip_enable_buttons']['autoexcerpt'] = 'on';
}
if(!isset($options['caip_enable_buttons']['introduccion']) || $options['caip_enable_buttons']['introduccion'] == ''  ){
	$options['caip_enable_buttons']['introduccion'] = '';
}
if(!isset($options['caip_enable_buttons']['conclusion']) || $options['caip_enable_buttons']['conclusion'] == ''  ){
	$options['caip_enable_buttons']['conclusion'] = '';
}
if(!isset($options['caip_enable_buttons']['refrito']) || $options['caip_enable_buttons']['refrito'] == ''  ){
	$options['caip_enable_buttons']['refrito'] = 'on';
}
if(!isset($options['caip_enable_buttons']['corrector']) || $options['caip_enable_buttons']['corrector'] == ''  ){
	$options['caip_enable_buttons']['corrector'] = 'on';
}
if(!isset($options['caip_enable_buttons']['youtube']) || $options['caip_enable_buttons']['youtube'] == ''  ){
	$options['caip_enable_buttons']['youtube'] = 'on';
}
if(!isset($options['caip_enable_buttons']['cifras']) || $options['caip_enable_buttons']['cifras'] == ''  ){
	$options['caip_enable_buttons']['cifras'] = 'on';
}
if(!isset($options['caip_enable_buttons']['cronologia']) || $options['caip_enable_buttons']['cronologia'] == ''  ){
	$options['caip_enable_buttons']['cronologia'] = 'on';
}
if(!isset($options['caip_enable_buttons']['faq']) || $options['caip_enable_buttons']['faq'] == ''  ){
	$options['caip_enable_buttons']['faq'] = 'on';
}
if(!isset($options['caip_enable_buttons']['audio']) || $options['caip_enable_buttons']['audio'] == ''  ){
	$options['caip_enable_buttons']['audio'] = 'on';
}