class caip_Refrito extends caip_Multiaction{
		
	constructor() {
		super();
		if (caip_Refrito.instance) {
		  return caip_Refrito.instance;
		}
		this.prompt = __('Reescribe con otras frases u oraciones, reemplazando palabras o expresiones por sinónimos y cambiando el orden del sujeto y predicado, preservando las etiquetas HTML por otras semejantes, etc, %s sobre el siguiente texto: \n\n','cibeles-ai').replace('%s',cibelesAiPlugin['idioma']);
		this.responseStartsWhith = __('ORIGINAL: <p>Los refritos son <strong>baratos</strong> y dan visitas.</p> \nREESCRITO: <p>Refritar resulta <strong>económico</strong> y atrae tráfico.</p> \n\nORIGINAL:','cibeles-ai');
		this.responseEndsWhith = __('\nREESCRITO: ','cibeles-ai');
		this.input = this.prompt + this.responseStartsWhith + this.contenido + this.responseEndsWhith  ;
		this.alertSinContenido = __('No hay ningún texto o contenido en la entrada con la que poder generar el refrito.','cibeles-ai');
		this.id = 'refrito';
		this.divresult = '.result.refrito';
		this.headingLeft = __('Original','cibeles-ai');
		this.headingRight = __('Refrito','cibeles-ai');
		
		this.responseText = [];
		this.input = [];
		
		this.htmlVariables();
		this.setButtons();
		this.viewHeadingsStyle();
		
		caip_Refrito.instance = this;
	}	
	
}