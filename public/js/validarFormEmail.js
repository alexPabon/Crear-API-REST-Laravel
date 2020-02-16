$(document).ready(function(){

	
	var formularioContacto = document.getElementById('formContacto');
	var entradas = formContacto.getElementsByClassName('entradas');	
	var errorEntradas = document.getElementById('msnError');
	var valorLabel = "";

	for(j=0; j<entradas.length; j++){
		valorLabel = entradas[j].previousElementSibling.innerHTML;
		entradas[j].previousElementSibling.style.visibility="hidden";
		entradas[j].setAttribute('placeholder',valorLabel);

		comprobarEntradas(entradas[j]);

		entradas[j].addEventListener('focus', function(){
			this.previousElementSibling.style.visibility="visible";
			this.removeAttribute('placeholder');
		});
		
		entradas[j].addEventListener('blur', function(){
			comprobarEntradas(this);
		});		
	}	

	formContacto.addEventListener('submit',function(e){
		e.preventDefault();		
		var todoCorrecto = true;
		var nombreEntrada = ""
		var privacidad = document.getElementById('privacidad');
		errorEntradas.innerHTML="";		
		
		for(var i=0; i<entradas.length; i++){
			if(entradas[i].value ==""){
				nombreEntrada = entradas[i].getAttribute('name')
				
				if(nombreEntrada=="empresa" || nombreEntrada=="tel"){			
				}else{
					entradas[i].previousElementSibling.style.visibility="hidden";
					entradas[i].classList.add('is-invalid');
					todoCorrecto = false;
					errorEntradas.innerHTML="<p class='alert alert-danger m-0'>los campos que estan en rojo son obligatorios</p>";
				}
			}
			else{
				entradas[i].classList.remove('is-invalid');
				entradas[i].previousElementSibling.style.visibility="visible";			
			}
		}

		if(!privacidad.checked){
			todoCorrecto = false;
			errorEntradas.innerHTML+="<p class='alert alert-danger m-0'>Debe aceptar la politica de privacidad</p>";
		}

		if(todoCorrecto)
			formContacto.submit();
	});

	formContacto.addEventListener('reset',function(){
		for(var i=0; i<entradas.length; i++){
			valorLabel = entradas[i].previousElementSibling.innerHTML;
			entradas[i].previousElementSibling.style.visibility="hidden";
			entradas[i].setAttribute('placeholder',valorLabel);
		}
	});	

});

function comprobarEntradas(valor){
	if(valor.value==""){
		valorLabel = valor.previousElementSibling.innerHTML;
		valor.previousElementSibling.style.visibility="hidden";
		valor.setAttribute('placeholder',valorLabel);
	}else{
		valor.removeAttribute('placeholder');
		valor.previousElementSibling.style.visibility="visible";
	}	

}