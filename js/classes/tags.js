class caip_Tags extends caip_Tag{
		
	constructor() {
		super();
		if (caip_Tags.instance) {
		  return caip_Tags.instance;
		}
		this.id = 'tags';
		this.divresult = '.result.tags';
		this.setButtons();
		caip_Tags.instance = this;
	}

	setButtons(){
		super.setButtons(this.id);
		this.buttons_id = 	'div_buttons_' + this.id;
		this.buttons_html = '<div id="'+this.buttons_id+'" class="more center"></div>';
		this.button_more = 	'<div class="cibelesAi_button" onclick="caip_'+this.id+'.launch();"><a title="'+__('Generar más tags','cibeles-ai')+'">'+__('Generar más','cibeles-ai')+this.boton.powerIcon+'</a></div>';
		this.button_all = 	'<div class="cibelesAi_button" onclick="caip_'+this.id+'.insertAll();"><a title="'+__('Insertar todos los tags','cibeles-ai')+'">'+__('Insertar todos','cibeles-ai')+'</a></div>';
		this.button_custom ='<div class="cibelesAi_button" onclick="caip_'+this.id+'.insertSelected();"><a title="'+__('Insertar los tags seleccionados','cibeles-ai')+'">'+__('Insertar selección','cibeles-ai')+'</a></div>';
	}
	
	manageResponse(){
		super.manageResponse();
		jQuery(this.divresult).append(this.buttons_html);
		jQuery('#' + this.buttons_id).append(this.button_more + this.button_all + this.button_custom);
		//this.functions.spin_buttons();
		this.ajax();
		this.makeTagSelectable();
	}
	
	insert(){
		super.insert();
		jQuery('#TB_closeWindowButton').click();
	}
	
	ajax(){
		let tags = this.tags;
		let instance = this;
		jQuery.ajax({
			url : ajax_var.url,
			type: 'post',
			data: {
				tags : tags,
				action : 'caip_tags_exists',
				check_nonce: ajax_var.check_nonce
			},
			beforeSend: function(){
			},
			success: function(resultado){
				tags = resultado;
				tags.forEach(function(tag){
					jQuery(instance.divresult + ' div.tag').each(function(){
						if(jQuery(this).text() == tag){
							jQuery(this).addClass('existe');
						}
					});
				});
			}

		});
	}
	
		


}