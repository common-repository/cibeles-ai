
class caip_Resumen extends caip_ResumenP{
		
	constructor() {
		super();
		if (caip_Resumen.instance) {
		  return caip_Resumen.instance;
		}
		this.id = 'resumen';
		this.divresult = '.result.resumen';
		this.setButtons();
		caip_Resumen.instance = this;
	}
	
	setButtons(){
		super.setButtons(this.id);
		this.buttons_id = 	'div_buttons_' + this.id;
		this.buttons_html = '<div id="'+this.buttons_id+'" class="more center"></div>';
		
		this.button_regenerar = 	'<div class="cibelesAi_button" onclick="caip_'+this.id+'.launch();"><a title="'+__('Regenerar resumen','cibeles-ai')+'">'+__('Regenerar','cibeles-ai')+ this.boton.powerIcon +'</a></div>';
		this.button_excerpt = 	'<div class="cibelesAi_button" onclick="caip_'+this.id+'.excerpt(this);"><a title="'+__('Insertar en el excerpt de la entrada','cibeles-ai')+'">'+__('Insertar en el excerpt','cibeles-ai')+'</a></div>';
		this.button_text = 	'<div class="cibelesAi_button" onclick="caip_'+this.id+'.content(this);"><a title="'+__('Insertar al principio del contenido de la entrada','cibeles-ai')+'">'+__('Insertar al principio del contenido','cibeles-ai')+'</a></div>';
		this.button_copy = 	'<div class="cibelesAi_button" onclick="caip_'+this.id+'.copiar(this);"><a title="'+__('Copiar','cibeles-ai')+'">'+__('Copiar','cibeles-ai')+'</a></div>';
	}
	
	excerpt(div=false){
		super.excerpt();
		this.boton.changeIconToChecked(div);
	}
	
	
	manageResponse(){
		super.manageResponse();
		jQuery(this.divresult).append('<div class="resumenText"></div>');
		this.responseText = this.responseText.trim();
		jQuery(this.divresult + ' .resumenText').append(this.responseText);
		jQuery(this.divresult).append(this.buttons_html);
		jQuery('#' + this.buttons_id).append(this.button_regenerar + this.button_excerpt + this.button_text + this.button_copy);
	}
	
	content(div){
		if(tinyMCE && tinyMCE.activeEditor != null){
			let contenidoActual = tinymce.get("content").getContent();
			contenidoActual = contenidoActual.replace(/<p class="resumenContent">.*?<\/p>/gi, '');
			tinymce.get("content").setContent('<p class="resumenContent">' + this.responseText + '</p>' + contenidoActual);
			this.boton.changeIconToChecked(div);
		}else{
			alert(__('Hay un problema con el editor tinyMCE, asegúrese que está en modo visual','cibeles-ai'));
		}
				
	}
	
}