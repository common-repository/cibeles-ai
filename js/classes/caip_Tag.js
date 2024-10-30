class caip_Tag extends caip_Action{
		
	constructor() {
		super();
		this.tokens = 300;
		this.responseStartsWhith = '';
		this.cantidad = caip_settings.caip_numero_tags;
		this.prompt = __('Una lista ordenada de %d etiquetas o tags breves y sus variantes %s de caracter general a modo de categoría como por ejemplo empresas, marcas, personajes, lugares, objetos, alimentos, temáticas, instituciones, eventos, acciones, tecnologías, etc, que ayuden a clasificar el siguiente texto y que tu respuesta sea en un formato json así {"tags":["tag1","tag2",...]} sin MARKDOWN y asegurando que las palabras estén en el formato adecuado, no todo en minúsculas ni todo en mayúsculas:\n\n','cibeles-ai').replace('%d', caip_settings.caip_numero_tags).replace('%s',cibelesAiPlugin['idioma']);
		this.originalPrompt = this.prompt;
		this.input = this.prompt + this.contenido + '\n\n' + this.responseStartsWhith;
		this.tags = [];
		this.selectedTags = [];
		this.alertSinContenido = __('No hay ningún texto o contenido en la entrada con la que poder generar los tags.','cibeles-ai');
	}
	
	launch(){
		//this.responseStartsWhith = this.generateResponseStartsWhith(this.tags)
		this.prompt = this.originalPrompt.replace(caip_settings.caip_numero_tags,this.cantidad);
		this.cantidad = parseInt(caip_settings.caip_numero_tags)  +  parseInt(this.cantidad);
		super.launch();
	}
	generateResponseStartsWhith(tags){
		let str = '';
		for (let i = 0; i < tags.length; i++) {
			str += (i + 1) + '. ' + tags[i] + '\n';
			if((i+1) == tags.length){
				str += (i + 1 + 1) + '.';
			}
		}
		if(str == ''){
			return this.responseStartsWhith;
		}else{
			return str;
		}
	}
	
	tagsStringToArray(string){
		let tagsTemp = this.functions.convierteStringToArray(string);
		tagsTemp = this.functions.eliminaSignosPuntuacion(tagsTemp);
		return tagsTemp;
	}
	
	manageResponse (){
		super.manageResponse();

		this.responseText = this.responseStartsWhith + this.responseText;
		//this.responseText = this.responseText.replace(/,/g, '');
		//if (this.responseText.charAt(this.responseText.length - 1) === '.') {
			// this.responseText = this.responseText.slice(0, -1);
		//}
		//this.tagsResponse = this.tagsStringToArray(this.responseText);
		//this.mergeTags();
		

		const response = JSON.parse(this.responseText);
		this.tagsResponse = response.tags;
		this.mergeTags();
		this.tagsResponse.forEach((str) => { 
			this.htmlresult += '<div class="tag">' + str + '</div>';
		});
		jQuery(this.divresult).append(this.htmlresult);
	}
	
	insertSelected(){
		const selectedTagsText = document.querySelectorAll('.result.'+this.id+' .tag.selected');
		this.selectedTags = Array.from(selectedTagsText, tag => tag.textContent.trim());
		this.insert();
	}
	
	insertAll(){
		const tags = document.querySelectorAll('.result.'+this.id+' .tag');
		tags.forEach(tag => {
		  if (!tag.classList.contains("selected")) {
			tag.classList.add("selected");
		  }
		});
		this.selectedTags = Array.from(document.querySelectorAll('.result.'+this.id+' .tag.selected')).map(tag => tag.textContent);
		this.insert();
	}
	
	insert(){
		jQuery('#new-tag-post_tag').val(this.selectedTags.join(','));
		jQuery('.button.tagadd').trigger('click');
	}
	
	mergeTags(){
		let i = 0;
		while (i < this.tagsResponse.length) {
		  const tag = this.tagsResponse[i];
		  const lowerCaseTag = tag.toLowerCase();
		  if (this.tags.some(t => t.toLowerCase() === lowerCaseTag)) {
			this.tagsResponse.splice(i, 1);
		  } else {
			this.tags.push(tag);
			i++;
		  }
		}
	}

	makeTagSelectable (){
		jQuery('.'+this.id+' .tag').off('click').on('click', function() {
			jQuery(this).toggleClass('selected');
		});
	}
	
	ajaxFunction() {
		super.ajaxFunction(this);
    }

}