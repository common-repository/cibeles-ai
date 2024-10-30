class caip_Multiaction extends caip_Action{
	
	constructor() {
		super();
		this.inputHTML = true;		
		this.tokens = 2000;
		this.responseText = [];
		this.input = [];
		this.partesRight = [];
		this.partesLeft = [];
		this.processedFalse = '...@@@xxxPROCESSEDFALSExxx@@@...';
		this.replaceResponse = '';
		this.delay = 100;
	}
	
	htmlVariables(){
		this.classLeft  = 'Left';
		this.classRight = 'Right';
		this.containerLeft  = 'container' + this.classLeft;
		this.containerRight = 'container' + this.classRight;
		this.divResultLeft    = this.divresult + ' .'+this.classLeft;
		this.divResultRight   = this.divresult + ' .'+this.classRight;
		this.divContainerLeft  = this.divresult + ' .'+this.containerLeft;
		this.divContainerRight = this.divresult + ' .'+this.containerRight;
	}
	
	insertar(div){
		if(tinyMCE && tinyMCE.activeEditor != null){
			tinymce.get("content").setContent(jQuery(this.divResultRight).html());
			this.boton.changeIconToChecked(div);
		}else{
			alert(__('Hay un problema con el edior tinyMCE, asegúrese que está en modo visual','cibeles-ai'));
		}
				
	}
	
	initFunction (){
		this.contenido = this.functions.get_todo_contenido(this.inputHTML);
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
	
	launch(){
		if(this.initFunction()){
			this.partesRight = [];
			this.partesLeft = [];
			let partesContenido = this.setDivsContent();
			this.boton.changeIconToPower();
			this.launched = true;
			this.showLoadingDiv();
			
			jQuery('#'+this.buttons_id).remove();
			let delay = 0;
			for(var i=0; i<partesContenido.length; i++){
				
				this.input[i] = this.prompt  + this.responseStartsWhith + partesContenido[i]  + this.responseEndsWhith  ;
				let textoLimpio = this.partesLeft[i].replace(/(<([^>]+)>)/gi, "").replace('&nbsp;',' ').trim();;
				if(this.partesLeft[i].length > 5000 || this.partesLeft[i].trim() == '' || textoLimpio == ''){
					this.partesRight[i] = this.partesLeft[i];
					this.manageResponse(i,this.partesLeft[i]);
				}else{
					this.partesRight[i] = this.processedFalse;
					//this.ajaxFunction(this,i);
					this.delayAjaxCall(i);
					
				}
				
			}
		}else{
			this.launched = false;
		}
		
	}
	
	delayAjaxCall(contador){
		this.delay = this.delay + 1000;
		let hijo = this;
		setTimeout(function () {
			hijo.ajaxFunction(hijo,contador);
		},hijo.delay);
		
	}
	
	manageResponse(i,responseOriginal=false){
		let eliminaTambien = this.replaceResponse.replace('.','');
		if(responseOriginal!=false ){
			this.partesRight[i] = responseOriginal;
		}else{
			this.partesRight[i] = this.responseText[i].trim().replace(this.replaceResponse,'').replace(eliminaTambien,'');
		}
		this.pintaAvanceResponse();				
	}
	
	endResponses(){
		super.manageResponse();
		jQuery(this.divresult).append(this.buttons_html);
		jQuery('#' + this.buttons_id).append(this.button_recargarLeft + this.button_regenerar + this.button_insertar  + this.button_copy);
	}
	
	pintaAvanceResponse(){
		let refritoResponse = '';

		for(var i=0; i<this.partesRight.length; i++){
			if(this.partesRight[i] != this.processedFalse){
				refritoResponse = refritoResponse + this.partesRight[i];
				jQuery(this.divResultRight).html(refritoResponse);	
				if((i+1) == this.partesRight.length){
					this.endResponses();
				}else{
					this.showLoadingDiv();		
				}
			}else{
				break;
			}
		}
	}
	
	showLoadingDiv(){
		super.showLoadingDiv();
		jQuery('#'+this.loadingDiv.id).appendTo(this.divResultRight);
		
	}
	
	setDivsContent(){
		let textoNoticiaHtml = this.functions.get_todo_contenido(this.inputHTML);
		let partes = this.functions.getArrayPartsFromHTMLString(textoNoticiaHtml);
		jQuery(this.divResultLeft).html(textoNoticiaHtml);
		jQuery(this.divResultRight).html('');
		this.partesLeft = partes;
		return partes;
	}
	
	recargarLeft(div){
		let textoNoticiaHtml = this.functions.get_todo_contenido(this.inputHTML);
		jQuery(this.divResultLeft).html(textoNoticiaHtml);
		this.boton.changeIconToChecked(div);
	}
	
	setButtons(){
		super.setButtons(this.id);
		this.buttons_id = 	'div_buttons_' + this.id;
		this.buttons_html = '<div id="'+this.buttons_id+'" class="more center"></div>';
		this.button_recargarLeft = 	'<div class="cibelesAi_button" onclick="caip_'+this.id+'.recargarLeft(this);"><a title="'+__('Refrescar original','cibeles-ai')+'">'+__('Refrescar original','cibeles-ai')+ this.boton.powerIcon +'</a></div>';
		this.button_regenerar = 	'<div class="cibelesAi_button" onclick="caip_'+this.id+'.launch();"><a title="'+__('Generar de nuevo','cibeles-ai')+'">'+__('Regenerar','cibeles-ai')+ this.boton.powerIcon +'</a></div>';
		this.button_copy = 	'<div class="cibelesAi_button" onclick="caip_'+this.id+'.copiar(this,\''+this.divResultRight+'\');"><a title="'+__('Copiar','cibeles-ai')+'">'+__('Copiar','cibeles-ai')+'</a></div>';
		this.button_insertar = 	'<div class="cibelesAi_button" onclick="caip_'+this.id+'.insertar(this);tb_remove();"><a title="'+__('Reemplazar contenido de la entrada con el generado','cibeles-ai')+'">'+__('Insertar contenido','cibeles-ai')+'</a></div>';
	}
	
	viewHeadingsStyle(){
		jQuery(this.divresult).append('<div class="'+this.containerLeft+'"></div>');
		jQuery(this.divresult).append('<div class="'+this.containerRight+'"></div>');
		jQuery(this.divContainerLeft).append('<div class="'+this.classLeft+'"></div>');
		jQuery(this.divContainerRight).append('<div class="'+this.classRight+'"></div>');
		
		var styleElement = jQuery('<style>');
		styleElement.append(this.divContainerLeft  + '::before { content: "' + this.headingLeft  + '"; }');
		styleElement.append(this.divContainerRight + '::before { content: "' + this.headingRight + '"; }');
		jQuery('head').append(styleElement);
		jQuery(window).resize(this.resizeHandler(this));
	}
	
	resize_thickbox_fullsize() {
		let anchoWorkspace = jQuery('#wpcontent').width();
		let anchoWPWindow = jQuery('#wpwrap').width();
		let anchoWPmenu_izq = anchoWPWindow - anchoWorkspace;
		jQuery(document).find('#TB_window').width(anchoWorkspace-20).css( 'margin-left', -  ((anchoWorkspace) / 2) + (anchoWPmenu_izq/2) );
	}
	
	resizeHandler(entidad) {
	  return function() {
		try {
		  if (jQuery(entidad.divresult).width() > 0) {
			entidad.resize_thickbox_fullsize();
		  }
		} catch (error) {
		  console.log(error);
		}
	  }
	}
	
}