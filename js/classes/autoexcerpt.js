
class caip_Autoexcerpt extends caip_ResumenP{
		
	constructor() {
		super();
		if (caip_Autoexcerpt.instance) {
		  return caip_Autoexcerpt.instance;
		}
		this.id = 'autoexcerpt';
		this.divresult = '.result.autoexcerpt';
		this.setButtons(this.id);
		caip_Autoexcerpt.instance = this;
	}

	
	manageResponse(){
		super.manageResponse();
		jQuery(this.divresult).append('<div class="resumenText"></div>');
		this.responseText = this.responseText.trim();
		jQuery(this.divresult + ' .resumenText').append(this.responseText);
		this.launched = false;
		this.excerpt();
	}

}