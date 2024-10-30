class caip_Button{
			
	
	constructor(buttonId){
		this.animateButtonId = 'div_button_' + buttonId;
		this.checkedIcon = '<i class="fa fa-check" aria-hidden="true"></i>';
		this.powerIcon = '<i class="fa fa-superpowers" aria-hidden="true"></i>';
	}
	
	animateButton(){	
		jQuery('#'+this.animateButtonId + ' i').addClass('fa-spin');
		jQuery('#'+this.animateButtonId).css('background','#183954');
	}
	
	deanimateButton(){
		jQuery('#'+this.animateButtonId + ' i').removeClass('fa-spin');
		jQuery('#'+this.animateButtonId).css('background','#2271b1');
	}
	
	changeIconToChecked(div = false){
		if(div === false){
			div = '#' + this.animateButtonId;
		}
		jQuery(div).find('a i').remove();
		setTimeout(() => {
			jQuery(div).find('a').append(this.checkedIcon);
		}, 50);
	}
	changeIconToPower(div = false){
		if(div === false){
			div = '#' + this.animateButtonId;
		}
		jQuery(div).find('a i').remove();
		setTimeout(() => {
			jQuery(div).find('a').append(this.powerIcon);
			this.animateButton();
		}, 50);
	}
}
	