//import {DiffDOM}  from "https://imagenacion.com/wp-content/plugins/cibeles-ai/node_modules/diff-dom/dist/index.js";

class caip_Corrector extends caip_Multiaction{
	
	constructor() {
		super();
		if (caip_Corrector.instance) {
		  return caip_Corrector.instance;
		}
		this.replaceResponse = ' (NO CORRECTIONS NEEDED).';
		this.prompt = __('Corrige sintáticos, semánticos, orográficos o sintácticos %s sobre el siguiente texto y devuelvo original sin más comentarios adicionales y respetando el etiquetado HTML: \n\n','cibeles-ai').replace('%s',cibelesAiPlugin['idioma']);
		this.responseStartsWhith = __('TEXTO: <p>Un texto puede estar correctamente escrito.</p>\nCORRECIÓN: <p>Un texto puede estar correctamente escrito.</p>%r\n\nTEXTO: <p>Estoy aciendo una <strong>prueba</strong>.</p>\nCORRECIÓN: <p>Estoy haciendo una <strong>prueba</strong>.</p>\n\nTEXTO: <p>A veces puedes acer faltás.</p>\nCORRECIÓN: <p>A veces puedes hacer faltas.</p>\n\nTEXTO: <p>El texto puede estar perfectamente escrito.</p>\nCORRECIÓN: <p>El texto puede estar perfectamente escrito.</p> %r\n\nTEXTO: <p>Juan come porke tiene ambre.</p>\nCORRECIÓN: <p>Juan come porque tiene hambre.</p>\n\nTEXTO: ','cibeles-ai').replace('%r',this.replaceResponse);
		this.responseEndsWhith = __('\nCORRECIÓN: ','cibeles-ai');
		this.input = this.prompt + this.responseStartsWhith + this.contenido + this.responseEndsWhith  ;
		this.alertSinContenido = __('No hay ningún texto o contenido en la entrada con la que poder generar una corrección.','cibeles-ai');
		this.id = 'corrector';
		this.divresult = '.result.corrector';
		this.headingLeft = __('Original','cibeles-ai');
		this.headingRight = __('Corregido','cibeles-ai');
		
		this.responseText = [];
		this.input = [];
		this.finalResponse = '';
		
		this.htmlVariables();
		this.setButtons();
		this.viewHeadingsStyle();
		
		caip_Corrector.instance = this;
	}
	
	endResponses(){
		super.endResponses();
		this.finalResponse = jQuery(this.divResultRight).html();
		this.diffRightDiv();
	}
	
	diffRightDiv(){
		let elementA = jQuery('<div>' + jQuery(this.divResultLeft).html() + '</div>').get(0);
		let elementB = jQuery('<div>' + jQuery(this.divResultRight).html() + '</div>').get(0);

		//let correcionDiff = caip_diffString(jQuery(this.divResultLeft).html(),jQuery(this.divResultRight).html());

		let dd = new diffDOM.DiffDOM({
			debug: true,
		});
		//jQuery(this.divResultRight).html(correcionDiff);
		let diff = dd.diff(elementA, elementB);
		for(let i=0;i<diff.length;i++){
			//console.log(diff[i]);
			if(diff[i].oldValue !== diff[i].newValue){
				let difference = caip_diffString(diff[i].oldValue, diff[i].newValue);
				jQuery(this.divResultRight).html(jQuery(this.divResultRight).html().replace(diff[i].newValue,difference));			
			}
		}
		dd.apply(elementB, diff);
	}
	
	insertar(div){
		if(tinyMCE && tinyMCE.activeEditor != null){
			tinymce.get("content").setContent(this.finalResponse);
			this.boton.changeIconToChecked(div);
		}else{
			alert(__('Hay un problema con el edior tinyMCE, asegúrese que está en modo visual','cibeles-ai'));
		}
				
	}
	
}



