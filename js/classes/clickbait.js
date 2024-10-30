class caip_Clickbait extends caip_Titulo{
		
	constructor() {
		super();
		if (caip_Clickbait.instance) {
		  return caip_Clickbait.instance;
		}
		this.id = 'clickbait';
		this.divresult = '.result.clickbait';
		this.prompt = __('Un listado de %d titulares estilo clickbait %s sin aplicar formato de negrita ni otros estilos sobre el siguiente texto: \n\n','cibeles-ai').replace('%d', caip_settings.caip_numero_titulares).replace('%s',cibelesAiPlugin['idioma']);
		this.input = this.prompt + this.contenido + '\n\n';
		this.setButtons();
		caip_Clickbait.instance = this;
	}
}