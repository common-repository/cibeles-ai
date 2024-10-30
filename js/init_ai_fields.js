				
jQuery("#titlediv").prepend(jQuery('#div_group_button_titlediv'));
jQuery('#div_group_button_titlediv').show();

document.addEventListener("DOMContentLoaded", () => {	
	jQuery("#div_group_button_tagsdiv").insertBefore(jQuery('#tagsdiv-post_tag'));
	jQuery('#div_group_button_tagsdiv').show();
	jQuery("#titlediv").prepend(jQuery('#div_group_button_postdiv'));
	jQuery("#div_group_button_postdiv").insertAfter(jQuery('#wp-content-media-buttons'));
	jQuery('#div_group_button_postdiv').show();
	
});

let caip_functions;

let caip_titular;
let caip_titularcorto;
let caip_clickbait;
let caip_tags;
let caip_autotags;
let caip_resumen;
let caip_autoexcerpt;
let caip_refrito;
let caip_corrector;
let caip_introduccion;
let caip_conclusion;
let caip_youtube;
let caip_cifras;
let caip_cronologia;
let caip_faq;
let caip_audio;

document.addEventListener("DOMContentLoaded", () => {	
	
	caip_functions = new caip_Functions();
	
	jQuery('#div_button_titular').click(function() {
		caip_titular = new caip_Titular();
		if(!caip_titular.launched){
			caip_titular.launch();
		}
	});
	jQuery('#div_button_titularcorto').click(function() {
		caip_titularcorto = new caip_Titularcorto();
		if(!caip_titularcorto.launched){
			caip_titularcorto.launch();
		}
	});
	jQuery('#div_button_clickbait').click(function() {
		caip_clickbait = new caip_Clickbait();
		if(!caip_clickbait.launched){
			caip_clickbait.launch();
		}
	});
	
	jQuery('#div_button_tags').click(function() {
		caip_tags = new caip_Tags();
		if(!caip_tags.launched){
			caip_tags.launch();
		}
	});
	
	jQuery('#div_button_autotags').click(function() {
		caip_autotags = new caip_Autotags();
		if(!caip_autotags.launched){
			caip_autotags.launch();
		}
	});
	
	jQuery('#div_button_resumen').click(function() {
		caip_resumen = new caip_Resumen();
		if(!caip_resumen.launched){
			caip_resumen.launch();
		}
	});
	
	jQuery('#div_button_autoexcerpt').click(function() {
		caip_autoexcerpt = new caip_Autoexcerpt();
		if(!caip_autoexcerpt.launched){
			caip_autoexcerpt.launch();
		}
	});
	
	jQuery('#div_button_refrito').click(function() {
		caip_refrito = new caip_Refrito();
		if(!caip_refrito.launched){
			caip_refrito.launch();
		}
	});
	
	jQuery('#div_button_corrector').click(function() {
		caip_corrector = new caip_Corrector();
		if(!caip_corrector.launched){
			caip_corrector.launch();
		}
	});
	
	jQuery('#div_button_introduccion').click(function() {
		caip_introduccion = new caip_Introduccion();
		if(!caip_introduccion.launched){
			caip_introduccion.launch();
		}
	});
	
	jQuery('#div_button_conclusion').click(function() {
		caip_conclusion = new caip_Conclusion();
		if(!caip_conclusion.launched){
			caip_conclusion.launch();
		}
	});
	
	jQuery('#div_button_youtube').click(function() {
		caip_youtube = new caip_Youtube();
		if(!caip_youtube.launched){
			caip_youtube.launch();
		}
	});
	
	jQuery('#div_button_cifras').click(function() {
		caip_cifras = new caip_Cifras();
		if(!caip_cifras.launched){
			caip_cifras.launch();
		}
	});
	
	jQuery('#div_button_cronologia').click(function() {
		caip_cronologia = new caip_Cronologia();
		if(!caip_cronologia.launched){
			caip_cronologia.launch();
		}
	});
	
	jQuery('#div_button_faq').click(function() {
		caip_faq = new caip_Faq();
		if(!caip_faq.launched){
			caip_faq.launch();
		}
	});
	jQuery('#div_button_audio').click(function() {
		caip_audio = new caip_Audio();
		if(!caip_audio.launched){
			caip_audio.launch();
		}
	});
});

