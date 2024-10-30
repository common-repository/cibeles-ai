class caip_Faq extends caip_ResumenP{
		
	constructor() {
		super();
		if (caip_Faq.instance) {
		  return caip_Faq.instance;
		}
		this.id = 'faq';
		this.tokens = 3000;
		this.divresult = '.result.faq';
		this.prompt = __('Eres capaz de generar un FAQ (frequently asked questions) %s con preguntas o titulares en formato HTML sin Markdown y que los encabezados sean en formato <h3> y una breve respuesta dentro en formato <p> sobre el siguiente texto: \n\n','cibeles-ai').replace('%s',cibelesAiPlugin['idioma']);
		this.input = this.prompt + this.contenido + '\n\n' + this.responseStartsWhith;
		this.alertSinContenido = __('No hay ningún texto o contenido en la entrada con la que poder generar las FAQ.','cibeles-ai');
		this.setButtons();
		caip_Faq.instance = this;
	}
	
	setButtons(){
		super.setButtons(this.id);
		this.buttons_id = 	'div_buttons_' + this.id;
		this.buttons_html = '<div id="'+this.buttons_id+'" class="more center"></div>';
		
		this.button_regenerar = 	'<div class="cibelesAi_button" onclick="caip_'+this.id+'.launch();"><a title="'+__('Regenerar FAQ','cibeles-ai')+'">'+__('Regenerar','cibeles-ai')+ this.boton.powerIcon +'</a></div>';
		this.button_text = 	'<div class="cibelesAi_button" onclick="caip_'+this.id+'.content(this);"><a title="'+__('Insertar al final del contenido de la entrada','cibeles-ai')+'">'+__('Insertar al final del contenido','cibeles-ai')+'</a></div>';
		this.button_copy = 	'<div class="cibelesAi_button" onclick="caip_'+this.id+'.copiar(this);"><a title="'+__('Copiar','cibeles-ai')+'">'+__('Copiar','cibeles-ai')+'</a></div>';
	}
	
	
	manageResponse(){
		super.manageResponse();
		jQuery(this.divresult).append('<div class="faqText"></div>');
		this.responseText = this.responseText.trim();
		jQuery(this.divresult + ' .faqText').append(this.responseText);
		jQuery(this.divresult).append(this.buttons_html);
		jQuery('#' + this.buttons_id).append(this.button_regenerar + this.button_text + this.button_copy);
	}
	
	content(div){
		if(tinyMCE && tinyMCE.activeEditor != null){
			let contenidoActual = tinymce.get("content").getContent();
			contenidoActual = contenidoActual.replace(/<div class="faqText">.*?<\/div>/gi, '');
			tinymce.get("content").setContent(contenidoActual + '<div class="faqText">' + this.responseText + '</div>');
			this.boton.changeIconToChecked(div);
		}else{
			alert(__('Hay un problema con el editor tinyMCE, asegúrese que está en modo visual','cibeles-ai'));
		}
				
	}
	
}