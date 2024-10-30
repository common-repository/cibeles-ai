class caip_Action{
	
	constructor(){
		this.cantidadPalabras = 0;
		this.functions = new caip_Functions();
		this.inputHTML = false;
		this.contenido = '';
		this.tokens = 500;
		this.input = '';
		this.responseText = '';
		this.htmlresult = '';
		this.launched = false;
		this.loadingDiv = document.createElement("div");
		this.loadingDiv.id = "loadingDiv";
		this.loadingDiv.innerHTML = "<div class='loading-indicator'></div>";
		this.responseStartsWhith = '';
		this.language = caip_settings.idioma;
	}
	
	initFunction (){
		this.contenido = this.functions.get_todo_contenido(this.inputHTML);
		this.input = this.prompt + this.contenido + '\n\n' + this.responseStartsWhith;
		if(this.contenido == ''){
			setTimeout(() => {
				jQuery('#TB_closeWindowButton').click();
				alert(this.alertSinContenido);
			}, 50);
			return false;
		}else{
			return true;
		}
	}
	
	
	
	manageResponse(){
		this.hideLoadingDiv();
		this.boton.changeIconToChecked();
		this.boton.deanimateButton();
	}
	
	setButtons(buttonId){
		this.boton = new caip_Button(buttonId);
	}
	
	launch(){
		if(this.initFunction()){
			this.showLoadingDiv();
			this.boton.changeIconToPower();
			jQuery('#'+this.buttons_id).remove();
			this.launched = true;
			this.resetRequest();
			this.ajaxFunction();
		}else{
			this.launched = false;
		}
	}
	
	resetRequest(){
		this.responseText = '';
		this.htmlresult = '';
	}
	
	ajaxFunction(child, elementoArray = false) {
		let inputAjax = '';
		if(elementoArray === false){
			inputAjax = child.input;
		}else{
			inputAjax = child.input[elementoArray];
		}
		jQuery.ajax({
			url : cibelesAiPlugin.api_url,
			data : { input : inputAjax , tokens : child.tokens, usuario : cibelesAiPlugin.nick, accion : child.id},
			type : 'POST',
			dataType : 'json',
			async : true,
			beforeSend: function() {
				//stopClick_resumen = true;
			},
			success : function(json) {
				if(json == null){
					//alert(__('Disculpe, existió un problema o el texto no puede ser vacío'));
					child.ajaxFunction();
				}else if(json.response == 'NOWORDS'){
					alert(__( 'Se ha quedado sin palabras disponibles, puede contratar más palabras en https://ai.cibeles.net/', 'cibeles-ai' ));
					child.responseText = '';
					child.manageResponse(elementoArray);
					
				}else if(json.error){
					alert(json.error.message + ' API OPENAI X');
					child.responseText = '';
					//child.ajaxFunction();
				}else{
					if(elementoArray === false){
						child.responseText += json.texto;
					}else{
						child.responseText[elementoArray] = json.texto;
						//child.responseText = json.texto;
					}
					
					//child.cantidadPalabras += json.cantidad_palabras;
					
					let fin = '';
					if(json.choices){
						fin = json.choices[0].finish_reason;
					}

					if(fin == 'length'){
						if(elementoArray === false){
							child.input = child.input + json.texto
							child.ajaxFunction();
						}else{
							child.input[elementoArray] = child.input[elementoArray] + json.texto
							child.ajaxFunction();
						}
						
					}else{
						console.log('fin ' + child.id + ': ' + fin);
						if(fin && fin == 'stop'){
							child.manageResponse(elementoArray);
						}else{// fin == null
							if(child.responseText.length > 3 || child.responseText[elementoArray] > 3){
								
								child.manageResponse(elementoArray);
							}else{
								child.responseText = '';
								child.ajaxFunction();
							}
							
						}
					}
				}
			},
			statusCode: {
                500: function(){
                        child.responseText = '';
						//child.ajaxFunction();
						alert('Disculpe, existió un problema ajax');
                     } 
            },
			error : function(xhr, status) {
				child.responseText = '';
				//child.ajaxFunction();
				alert('Disculpe, existió un error ajax');
			},
			complete : function(xhr, status) {
			}
		});
    }
	
	// Muestra el div de carga
	showLoadingDiv() {
		jQuery(this.divresult).append(this.loadingDiv);
		jQuery(this.divresult + ' #loadingDiv').css('display',"block");
	}

	// Oculta el div de carga
	hideLoadingDiv() {
		jQuery(this.divresult + ' #loadingDiv').css('display',"none");
	}
	
	copiar(div,selector=false){
		if(selector){
			this.functions.copiar(jQuery(selector).html());
			this.boton.changeIconToChecked(div);
		}else{
			this.functions.copiar(this.responseText);
			this.boton.changeIconToChecked(div);
		}
		
	}
}
