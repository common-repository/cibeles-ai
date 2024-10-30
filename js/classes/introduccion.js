class caip_Introduccion extends caip_ResumenP{
		
	constructor() {
		super();
		if (caip_Introduccion.instance) {
		  return caip_Introduccion.instance;
		}
		this.id = 'introduccion';
		this.divresult = '.result.introduccion';
		this.prompt = __('Genera un texto de introducción %s de no más de 70 palabras o 600 caracteres sobre el siguiente texto: \n\n','cibeles-ai').replace('%s',cibelesAiPlugin['idioma']);
		this.input = this.prompt + this.contenido + '\n\n' + this.responseStartsWhith;
		this.alertSinContenido = __('No hay ningún texto o contenido en la entrada con la que poder generar la introducción.','cibeles-ai');
		this.setButtons();
		caip_Introduccion.instance = this;
	}
	
	setButtons(){
		super.setButtons(this.id);
		this.buttons_id = 	'div_buttons_' + this.id;
		this.buttons_html = '<div id="'+this.buttons_id+'" class="more center"></div>';
		
		this.button_regenerar = 	'<div class="cibelesAi_button" onclick="caip_'+this.id+'.launch();"><a title="'+__('Regenerar introducción','cibeles-ai')+'">'+__('Regenerar','cibeles-ai')+ this.boton.powerIcon +'</a></div>';
		this.button_text = 	'<div class="cibelesAi_button" onclick="caip_'+this.id+'.content(this);"><a title="'+__('Insertar al principio del contenido de la entrada','cibeles-ai')+'">'+__('Insertar al principio del contenido','cibeles-ai')+'</a></div>';
		this.button_copy = 	'<div class="cibelesAi_button" onclick="caip_'+this.id+'.copiar(this);"><a title="'+__('Copiar','cibeles-ai')+'">'+__('Copiar','cibeles-ai')+'</a></div>';
	}
	
	
	manageResponse(){
		super.manageResponse();
		jQuery(this.divresult).append('<div class="introduccionText"></div>');
		this.responseText = this.responseText.trim();
		jQuery(this.divresult + ' .introduccionText').append(this.responseText);
		jQuery(this.divresult).append(this.buttons_html);
		jQuery('#' + this.buttons_id).append(this.button_regenerar + this.button_text + this.button_copy);
	}
	
	content(div){
		if(tinyMCE && tinyMCE.activeEditor != null){
			let contenidoActual = tinymce.get("content").getContent();
			contenidoActual = contenidoActual.replace(/<p class="introduccionContent">.*?<\/p>/gi, '');
			tinymce.get("content").setContent('<p class="introduccionContent">' + this.responseText + '</p>' + contenidoActual);
			this.boton.changeIconToChecked(div);
		}else{
			alert(__('Hay un problema con el editor tinyMCE, asegúrese que está en modo visual','cibeles-ai'));
		}
				
	}
	
}