
class caip_Autotags extends caip_Tag{
		
	constructor() {
		super();
		if (caip_Autotags.instance) {
		  return caip_Autotags.instance;
		}
		this.id = 'autotags';
		this.divresult = '.result.autotags';
		this.setButtons(this.id);
		caip_Autotags.instance = this;
	}
	
	
	manageResponse(){
		super.manageResponse();
		this.insertAll();
		this.launched = false;
	}
	
}

