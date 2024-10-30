class caip_Conclusion extends caip_ResumenP{
		
	constructor() {
		super();
		if (caip_Conclusion.instance) {
		  return caip_Conclusion.instance;
		}
		this.id = 'conclusion';
		this.divresult = '.result.conclusion';
		this.prompt = __('Genera un texto de conclusión %s de no más de 70 palabras o 600 caracteres sobre el siguiente texto: \n\n','cibeles-ai').replace('%s',cibelesAiPlugin['idioma']);
		this.input = this.prompt + this.contenido + '\n\n' + this.responseStartsWhith;
		this.alertSinContenido = __('No hay ningún texto o contenido en la entrada con la que poder generar la conclusión.','cibeles-ai');
		this.setButtons();
		caip_Conclusion.instance = this;
	}
	
	setButtons(){
		super.setButtons(this.id);
		this.buttons_id = 	'div_buttons_' + this.id;
		this.buttons_html = '<div id="'+this.buttons_id+'" class="more center"></div>';
		
		this.button_regenerar = 	'<div class="cibelesAi_button" onclick="caip_'+this.id+'.launch();"><a title="'+__('Regenerar conclusión','cibeles-ai')+'">'+__('Regenerar','cibeles-ai')+ this.boton.powerIcon +'</a></div>';
		this.button_text = 	'<div class="cibelesAi_button" onclick="caip_'+this.id+'.content(this);"><a title="'+__('Insertar al final del contenido de la entrada','cibeles-ai')+'">'+__('Insertar al final del contenido','cibeles-ai')+'</a></div>';
		this.button_copy = 	'<div class="cibelesAi_button" onclick="caip_'+this.id+'.copiar(this);"><a title="'+__('Copiar','cibeles-ai')+'">'+__('Copiar','cibeles-ai')+'</a></div>';
	}
	
	
	manageResponse(){
		super.manageResponse();
		jQuery(this.divresult).append('<div class="conclusionText"></div>');
		this.responseText = this.responseText.trim();
		jQuery(this.divresult + ' .conclusionText').append(this.responseText);
		jQuery(this.divresult).append(this.buttons_html);
		jQuery('#' + this.buttons_id).append(this.button_regenerar + this.button_text + this.button_copy);
	}
	
	content(div){
		if(tinyMCE && tinyMCE.activeEditor != null){
			let contenidoActual = tinymce.get("content").getContent();
			contenidoActual = contenidoActual.replace(/<p class="conclusionContent">.*?<\/p>/gi, '');
			tinymce.get("content").setContent(contenidoActual + '<p class="conclusionContent">' + this.responseText + '</p>');
			this.boton.changeIconToChecked(div);
		}else{
			alert(__('Hay un problema con el editor tinyMCE, asegúrese que está en modo visual','cibeles-ai'));
		}
				
	}
	
}