class caip_Titular extends caip_Titulo{
		
	constructor() {
		super();
		if (caip_Titular.instance) {
		  return caip_Titular.instance;
		}
		this.id = 'titular';
		this.divresult = '.result.titular';
		this.prompt = __('Un listado de %d titulares %s sin aplicar formato de negrita ni otros estilos sobre el siguiente texto: \n\n','cibeles-ai').replace('%d', caip_settings.caip_numero_titulares).replace('%s',cibelesAiPlugin['idioma']);
		this.input = this.prompt + this.contenido + '\n\n';
		this.setButtons();
		caip_Titular.instance = this;
	}
}