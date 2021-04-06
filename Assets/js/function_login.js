
 $('.login-content [data-toggle="flip"]').click(function() {
 	$('.login-box').toggleClass('flipped');
 	return false;
 });

 //scrip para capturar los datos del formulario

document.addEventListener('DOMContentLoaded', function(){//con addEventListener cargamos todos los documentos
	//validar los datos del formulario
	if (document.querySelector("#formLogin")){// si exsite el formLogin

		let formLogin = document.querySelector("#formLogin");//variable que se utiliza dentro de la funcion indicada
		formLogin.onsubmit = function(e){//indica que se le va agregar el evento onsubmit
			e.preventDefault();//previene a que se recargue la pagina

			let strEmail = document.querySelector('#txtEmail').value;//nos referimos al elemento txtEmail del html
			let strPassword = document.querySelector('#txtPassword').value;

			if (strEmail == "" || strPassword == "") {//si esta vacio

				swal ("Por favor", "Escribe el usuario y la contraseña.","error");//mensaje
				return false;//si esta vacio false p/ que no continue
			}else{

				 //obtenemos c/u de los objetos dependiendo del navegador
        		var request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
        		var ajaxUrl = base_url+'/Login/loginUser'; //nos dirijimos al metodo loginUser en Login.php
        		var formData  = new FormData(formLogin);//hacemos referencia al formulario.
		        request.open("POST",ajaxUrl,true);// abrimos la ventana y enviamos el parametro, lo apuntamos hacia la variable de ajax por medio de POST
		        request.send(formData);//enviamos la informacion, todos los campos del formulario formData
		        //retornamos una funcion

		        //onreadystatechange ejecuta el evento
		        request.onreadystatechange = function() {
	 		        //obtenemos el responseText
			        if (request.readyState != 4) return; //llamamos a readyState
			        if (request.status == 200) {//si es 200 es exitoso
			        	var objData = JSON.parse(request.responseText);//parseamos p/ obenter el objeto
			        	if (objData.status) //si es 200
			        	{
			        		window.location = base_url+'/dashboard';//redireccionamos la url panel de control inicio
			        	}else{
			        		swal("Atención", objData.msg, "error");//mensaje
			        		document.querySelector('#txtPassword').value = "";//limpia el campo
			        	}
			        }else{
			        	swal("Atención","Error en el proceso, not 200","error");
			        }
			        return false;
			    }
			}
		}
	}
}, false);