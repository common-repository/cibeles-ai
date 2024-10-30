class caip_Youtube extends caip_ResumenP{
		
	constructor() {
		super();
		if (caip_Youtube.instance) {
		  return caip_Youtube.instance;
		}
		this.responseText = '';
		this.tituloYoutube = '';
		this.descriptionYoutube = '';
		this.tokens = 2500;
		this.id = 'youtube';
		this.divresult = '.result.youtube';
		this.inputRemain = __('Genera el texto de una noticia %s de 1000 palabras con los siguientes datos obtenidos de un video de Youtube:\n\n','cibeles-ai').replace('%s',cibelesAiPlugin['idioma']);
		this.setButtons();
		caip_Youtube.instance = this;
	}
	
	setButtons(){
		super.setButtons(this.id);
		this.buttons_id = 	'div_buttons_' + this.id;
		this.buttons_html = '<div id="'+this.buttons_id+'" class="more center"></div>';
		
		this.button_regenerar = 	'<div class="cibelesAi_button" onclick="caip_'+this.id+'.launchButton();"><a title="'+__('Regenerar resumen','cibeles-ai')+'">'+__('Regenerar','cibeles-ai')+ this.boton.powerIcon +'</a></div>';
		//this.button_excerpt = 	'<div class="cibelesAi_button" onclick="caip_'+this.id+'.excerpt(this);"><a title="'+__('Insertar en el excerpt de la entrada','cibeles-ai')+'">'+__('Insertar en el excerpt','cibeles-ai')+'</a></div>';
		this.button_titulo = 	'<div class="cibelesAi_button" onclick="caip_'+this.id+'.insertTitle(this);"><a title="'+__('Insertar titular al principio del contenido de la entrada','cibeles-ai')+'">'+__('Insertar titular','cibeles-ai')+'</a></div>';
		this.button_text = 	'<div class="cibelesAi_button" onclick="caip_'+this.id+'.content(this);"><a title="'+__('Insertar noticia al principio del contenido de la entrada','cibeles-ai')+'">'+__('Insertar noticia al principio del contenido','cibeles-ai')+'</a></div>';
		this.button_copy = 	'<div class="cibelesAi_button" onclick="caip_'+this.id+'.copiar(this);"><a title="'+__('Copiar','cibeles-ai')+'">'+__('Copiar','cibeles-ai')+'</a></div>';
	}

	copiar(div,selector=false){
		let articulo;
		if(selector){
			articulo = jQuery(selector).html();
		}else{
			articulo = this.responseText;
		}

		if (articulo.length < 2) {
			alert(__('El artículo está vacío', 'cibeles-ai'));
		} else {
			function listener(e) {
				e.clipboardData.setData("text/html", articulo);
				e.clipboardData.setData("text/plain", articulo);
				e.preventDefault();
			}
			document.addEventListener("copy", listener);
			document.execCommand("copy");
			document.removeEventListener("copy", listener);
			this.boton.changeIconToChecked(div);
		}

		
	}
	
	launch(){}
	
	launchButton(){
		jQuery(this.divresult).html('');
		let inputAjax = jQuery('input[name="youtubeUrl"]').val();
		if(inputAjax == ''){
			alert(__('Introduzca una URL de un video de Youtube','cibeles-ai'));
		}else{
			this.showLoadingDiv();
			this.boton.changeIconToPower();
			jQuery('#'+this.buttons_id).remove();
			jQuery('#youtubeme').hide();
			this.launched = true;
			this.resetRequest();
			this.ajaxFunction();
		}
		
	}
	
	manageResponse(){
		super.manageResponse();
		jQuery(this.divresult).append('<div class="youtubeData"></div>');
		jQuery(this.divresult).append('<div class="youtubeText"></div>');
		this.responseText = this.responseText.trim();
		let temp = '';
		if(this.tituloYoutube != ''){
			temp += '<h2>' + this.tituloYoutube + '</h2>';
		}
		if(this.descriptionYoutube != ''){
			temp += '<p>' + this.descriptionYoutube + '</p>';
		}
		temp += '<h4>' + __('Noticia generada: ','cibeles-ai') + '</h4>';
		this.responseText = this.responseText;
		jQuery(this.divresult + ' .youtubeData').append(temp);
		jQuery(this.divresult + ' .youtubeText').append(this.responseText);
		jQuery(this.divresult).append(this.buttons_html);
		jQuery('#' + this.buttons_id).append(this.button_regenerar + this.button_text + this.button_titulo + this.button_copy);
	}
	
	content(div){
		if(tinyMCE && tinyMCE.activeEditor != null){
			let contenidoActual = tinymce.get("content").getContent();
			contenidoActual = contenidoActual.replace(/<div class="youtubeContent">.*?<\/div>/gi, '');
			tinymce.get("content").setContent('<div class="youtubeContent">' + this.responseText + '</div>' + contenidoActual);
			this.boton.changeIconToChecked(div);
		}else{
			alert(__('Hay un problema con el editor tinyMCE, asegúrese que está en modo visual','cibeles-ai'));
		}
				
	}
	insertTitle(div){
		let titular = jQuery('.result.youtube .youtubeData h2').text();
		//jQuery('#TB_closeWindowButton').click();
		jQuery('#title').trigger('click');
		jQuery('#title').val(titular);
		jQuery('#title-prompt-text').html('');
		this.boton.changeIconToChecked(div);
	}
	
	content(div){
		if(tinyMCE && tinyMCE.activeEditor != null){
			let contenidoActual = tinymce.get("content").getContent();
			contenidoActual = contenidoActual.replace(/<div class="youtubeContent">.*?<\/div>/gi, '');
			tinymce.get("content").setContent('<div class="youtubeContent">' + this.responseText + '</div>' + contenidoActual);
			this.boton.changeIconToChecked(div);
		}else{
			alert(__('Hay un problema con el editor tinyMCE, asegúrese que está en modo visual','cibeles-ai'));
		}
				
	}
	
	ajaxFunction() {
		let este = this;
		let youtubeUrl = jQuery('input[name="youtubeUrl"]').val();
		jQuery.ajax({
			url : cibelesAiPlugin.api_url_youtube,
			data : { input : este.inputRemain , youtubeurl : youtubeUrl , tokens : este.tokens, usuario : cibelesAiPlugin.nick, accion : este.id},
			type : 'POST',
			dataType : 'json',
			async : true,
			beforeSend: function() {
				//stopClick_resumen = true;
			},
			success : function(json) {
				if(json == null){
					//alert(__('Disculpe, existió un problema o el texto no puede ser vacío'));
					este.ajaxFunction();
				}else if(json.response == 'NOWORDS'){
					alert(__( 'Se ha quedado sin palabras disponibles, puede contratar más palabras en https://ai.cibeles.net/', 'cibeles-ai' ));
					este.responseText = '';
					este.manageResponse();
					
				}else if(json.error){
					alert(json.error.message + ' API OPENAI X');
					este.responseText = '';
					//this.ajaxFunction();
				}else{
					este.responseText += json.texto;
					este.tituloYoutube = json.tituloYoutube;
					este.descriptionYoutube = json.descriptionYoutube;
					este.manageResponse();
				}
			},
			statusCode: {
                500: function(){
                        este.responseText = '';
						//este.ajaxFunction();
						este.manageResponse();
						alert('Disculpe, existió un problema ajax.');
                     } 
            },
			error : function(xhr, status) {
				este.responseText = '';
				//este.ajaxFunction();
				este.manageResponse();
				alert('Disculpe, existió un error ajax.');
			}
		});
    }
	
}