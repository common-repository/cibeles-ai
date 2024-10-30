class caip_Titulo extends caip_Action{
		
	constructor() {
		super();
		this.alertSinContenido = __('No hay ningún texto o contenido en la entrada con la que poder generar los titulares.','cibeles-ai');
		this.titulares = [];	
	}
	
	setButtons(){
		super.setButtons(this.id);
		this.buttons_id = 'div_button_'+this.id+'more';
		this.buttons_html = '<div id="'+this.buttons_id+'" class="more center"></div>';
		this.button_more = '<div id="'+this.buttons_id+'" class="more center"><div class="cibelesAi_button" onclick="caip_'+this.id+'.launch();"><a title="'+__('Generar más titulares','cibeles-ai')+'">'+__('Generar más','cibeles-ai')+this.boton.powerIcon+'</a></div></div>';
		this.button_insert = '<div class="insert"><div class="cibelesAi_button" onclick="caip_'+this.id+'.insertTitle(this);"><a title="'+__('Inserta el título del post','cibeles-ai')+'">'+__('Insertar','cibeles-ai')+'</a></div></div>';
	}
	resetRequest(){
		this.titulares = [];
		super.resetRequest();
	}
	titularesStringToArray(string){
		this.titulares = this.functions.convierteStringToArray(string);
		this.titulares = this.functions.eliminaSignosPuntuacion(this.titulares);
		return this.titulares;
	}
	
	manageResponse (){
		super.manageResponse();
		if (this.responseText.charAt(this.responseText.length - 1) === '.') {
			 this.responseText = this.responseText.slice(0, -1);
		}
		this.titulares = this.titularesStringToArray(this.responseText);
		this.titulares.forEach((str, index) => {
			this.htmlresult += '<div class="titular">' + this.button_insert + str + '</div>';
		});
		jQuery(this.divresult).append(this.htmlresult).append(this.buttons_html);
		jQuery('#' + this.buttons_id).append(this.button_more);
		//this.functions.spin_buttons();
		
	}
	insertTitle (insertButton){
		let titular = insertButton.closest('.titular');
		let titularClone = titular.cloneNode(true); // Clonar el elemento titular
		let insert = titularClone.querySelector('.insert');
		insert.innerHTML = ''; // Elimina el contenido del div con clase "insert" en el elemento clonado
		let titulo = titularClone.textContent.trim(); // Obtiene el texto restante sin etiquetas HTML y elimina los espacios en blanco al principio y al final
		jQuery('#TB_closeWindowButton').click();
		jQuery('#title').trigger('click');
		jQuery('#title').val(titulo);
		jQuery('#title-prompt-text').html('');
	}
	
    ajaxFunction() {
		super.ajaxFunction(this);
    }
}