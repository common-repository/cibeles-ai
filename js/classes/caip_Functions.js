class caip_Functions{
	
	/***************************************
	Espera array
	Devuelve array
	Elimina signos de puntuación como ¿?¡!, dobles espacios y puntos. 
	***************************************/
	eliminaSignosPuntuacion(values){
		values.forEach((str, index) => {
			values[index] = str.replace(/\?/g, '');
			values[index] = values[index].replace(/['"]+/g, '');
			values[index] = values[index].split(' ... ').join(', ');
			values[index] = values[index].split('¡').join('');
			values[index] = values[index].split('!').join('. ');
			values[index] = values[index].split('¿').join('');
			values[index] = values[index].split('?').join('. ');
			values[index] = values[index].trim();
			values[index] = values[index].replace(/\.jQuery/, '');
			values[index] = values[index].replace(/\s{2,}/g, ' ');
		});
		
		
		return values;
	}
	

	convierteStringToArray(str){
		str = str.trim();
		return str.replace(/^\d+\.\s*/gm, '').split("\n");
	}

	
	get_todo_contenido(texto = false){
		
		if(tinyMCE && tinyMCE.activeEditor != null){
			let contenido = tinymce.editors.content.getContent();
			if(texto){
				return contenido;
			}else{
				var divTemp = document.createElement('div');
				divTemp.innerHTML = contenido;
				contenido = divTemp.textContent;

				contenido = contenido.trim();
				
				return contenido;
			}
			
		}else{
			alert(__('Hay un problema con el edior tinyMCE, asegúrese que está en modo visual','cibeles-ai'));
			return false;
		}
	}
	
	
	copiar(str){
		var tempInput = document.createElement("input");
		tempInput.value = str;
		document.body.appendChild(tempInput);
		tempInput.select();
		document.execCommand("copy");
		document.body.removeChild(tempInput);
	}
	
	getArrayPartsFromHTMLString(textoHtml){
		
		var elements = jQuery(textoHtml).map(function() {
			return jQuery(this).prop('outerHTML'); 
			
		});
		
		let partes = [];
		elements.each(function() {
		  partes.push(this);
		});		
		
		return partes;
	}
	
	
}