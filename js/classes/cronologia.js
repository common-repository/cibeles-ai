class caip_Cronologia extends caip_ResumenP{
		
	constructor() {
		super();
		if (caip_Cronologia.instance) {
		  return caip_Cronologia.instance;
		}
		this.id = 'cronologia';
		this.tokens = 3000
		this.divresult = '.result.cronologia';
		this.prompt = __('Eres capaz de generar una breve cronología %s con información ordenada cronológica o logicamente en formato HTML sin Markdown con titulares <h3> y una escueta descripción dentro de un <p> de los eventos más importantes de una noticia sobre el siguiente texto: \n\n','cibeles-ai').replace('%s',cibelesAiPlugin['idioma']);
		this.input = this.prompt + this.contenido + '\n\n' + this.responseStartsWhith;
		this.alertSinContenido = __('No hay ningún texto o contenido en la entrada con la que poder generar la Cronología.','cibeles-ai');
		this.setButtons();
		caip_Cronologia.instance = this;
	}
	
	setButtons(){
		super.setButtons(this.id);
		this.buttons_id = 	'div_buttons_' + this.id;
		this.buttons_html = '<div id="'+this.buttons_id+'" class="more center"></div>';
		
		this.button_regenerar = 	'<div class="cibelesAi_button" onclick="caip_'+this.id+'.launch();"><a title="'+__('Regenerar Cronología','cibeles-ai')+'">'+__('Regenerar','cibeles-ai')+ this.boton.powerIcon +'</a></div>';
		this.button_text = 	'<div class="cibelesAi_button" onclick="caip_'+this.id+'.content(this);"><a title="'+__('Insertar al final del contenido de la entrada','cibeles-ai')+'">'+__('Insertar al final del contenido','cibeles-ai')+'</a></div>';
		this.button_copy = 	'<div class="cibelesAi_button" onclick="caip_'+this.id+'.copiar(this);"><a title="'+__('Copiar','cibeles-ai')+'">'+__('Copiar','cibeles-ai')+'</a></div>';
	}
	
	
	manageResponse(){
		super.manageResponse();
		jQuery(this.divresult).append('<div class="cronologiaText"></div>');
		this.responseText = this.responseText.trim();
		jQuery(this.divresult + ' .cronologiaText').append(this.responseText);
		jQuery(this.divresult).append(this.buttons_html);
		jQuery('#' + this.buttons_id).append(this.button_regenerar + this.button_text + this.button_copy);
	}
	
	content(div){
		if(tinyMCE && tinyMCE.activeEditor != null){
			let contenidoActual = tinymce.get("content").getContent();
			contenidoActual = contenidoActual.replace(/<div class="cronologiaText">.*?<\/div>/gi, '');
			tinymce.get("content").setContent(contenidoActual + '<div class="cronologiaText">' + this.responseText + '</div>');
			this.boton.changeIconToChecked(div);
		}else{
			alert(__('Hay un problema con el editor tinyMCE, asegúrese que está en modo visual','cibeles-ai'));
		}
				
	}
	
}