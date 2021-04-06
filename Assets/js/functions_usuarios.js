
//agregamos un evento al momento que se carga el archivo, el html Views/Roles/roles.php
document.addEventListener('DOMContentLoaded', function(){

    tableRoles = $('#tableUsuarios').dataTable( {
    	"aProcessing":true,
    	"aServerSide":true,
    	"language":{
    		"url":"//cdn.datatables.net/plug-ins/1.10.20/i18n/Spanish.json"//convierte el lenguaje en español
    	},
        "ajax":{
        	"url": " "+base_url+"/Usuarios/getUsuarios",
        	"dataSrc":""

        },
        "columns":[
            {"data":"idpersona"},
            {"data":"nombres"},
            {"data":"apellidos"},
            {"data":"email_user"},
            {"data":"telefono"},
            {"data":"nombrerol"},
            {"data":"status"},
            {"data":"options"}
        ],
        'dom' : 'lBfrtip',
        'buttons' : [
        	{
        		"extend" : "copyHtml5",
        		"text" : "<i class ='far fa-copy'></i> Copiar",
        		"titleAttr" : "Copiar",
        		"ClassName": "btn btn-sm btn-info"
        	},{
        		"extend" : "excelHtml5",
        		"text" : "<i class ='fas fa-file-excell'></i> Excel",
        		"titleAttr" : "Exportar a Excel",
        		"ClassName": "btn btn-success"
        	},{
        		"extend" : "pdfHtml5",
        		"text" : "<i class ='fas fa-file-pdf'></i> PDF",
        		"titleAttr" : "Exportar a PDF",
        		"ClassName": "btn btn-danger"
        	},{
        		"extend" : "csvHtml5",
        		"text" : "<i class ='far fa-file-csv'></i> CSV",
        		"titleAttr" : "Exportar a CSV",
        		"ClassName": "btn btn-info"
        	}
        	],
        "resonsieve":"true",
        "bDestroy": true,
        "iDisplayLength": 10,
        "order":[[0,"desc"]]
    });
    if (document.querySelector("#formUsuario")) {//si existe el elemento formUsuario, lo ejecuta
  
	    var formUsuario = document.querySelector("#formUsuario");
		formUsuario.onsubmit = function(e) {
			e.preventDefault();
			var strIdentificacion = document.querySelector('#txtIdentificacion').value;
			var strNombre = document.querySelector('#txtNombre').value;
			var strApellido = document.querySelector('#txtApellido').value;
			var strEmail = document.querySelector('#txtEmail').value;
			var intTelefono = document.querySelector('#txtTelefono').value;
			var strTipousuario = document.querySelector('#listRolid').value;
			var strPassword = document.querySelector('#txtPassword').value;

			if (strIdentificacion == '' || strApellido == '' || strNombre == '' || strEmail == '' || intTelefono == '') {
				swal("Atención", "Todos los campos son obligatorios.", "error");
				return false;
			}

			let elementsValid = document.getElementsByClassName("valid");
			for (let i = 0; i < elementsValid.length; i++){
				if (elementsValid[i].classList.contains('is-invalid')) {
					swal("Atención", "Por favor verifique los campos en rojo." , "error");
					return false;
				}

			}

			var request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
			var ajaxUrl = base_url+'/Usuarios/setUsuario';
			var formData = new FormData(formUsuario);
			request.open("POST", ajaxUrl, true);
			request.send(formData);
			request.onreadystatechange = function(){
				if (request.readyState = 4 && rerquest.status == 200) {
					var objData = JSON.parse(request.responseText);
					if (objData.status) 
					{
						$('#modalFormUsuario').modal("hide");
						formUsuario.reset();
						swal("Usuarios", objData.msg, "success");
						tableUsuarios.api().ajax.reload();
					}else{
						swal("Error", objData.msg, "error");
					}
				}
			}

	    }
    }//sino no
},false);



window.addEventListener('load', function() {
    setTimeout(() => { 
        fntRolesUsuario();
       // fntDelRol();
    }, 500);
  }, false);




function fntRolesUsuario(){
	if (document.querySelector('#listRolid')) {
	
		var ajaxUrl = base_url+'Roles/getSelectRoles';
		var request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
		request.open("GET", ajaxUrl,true);
		request.send();
		request.onreadystatechange = function(){
			if (request.readyState == 4 && request.status == 200) {
				document.querySelector('#listRolid').innerHTML = request.responseText;
				$('#listRolid').selectpicker('render')
			}
		}

	}
}

function fntViewUsuario(idpersona){
	var idpersona = idpersona;
	var request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
	var ajaxUrl = base_url+'/Usuarios/getUsuario'+idpersona; //nos dirijimos a la funcion getUsuario 
	request.send();//enviamos la informacion, todos los campos del formulario formData
        //retornamos una funcion
    request.onreadystatechange = function(){
    	if (request.readyState == 4 && request.status == 200) {
    		var objData = JSON.parse(request.responseText);

    		if (objData.status) {
    			var estadoUsuario = objData.data.status == 1 ?
    			'<span class="badge badge-success">Activo</span>' : 
    			'<span class="badge badge-danger">Inactivo</span>'

    			document.querySelector("celIdentificacion").innerHTML = objData.data.identificacion;
    			document.querySelector("celNombre").innerHTML = objData.data.nombres;
    			document.querySelector("celApellido").innerHTML = objData.data.apellidos;
    			document.querySelector("celTelefono").innerHTML = objData.data.telefono;
    			document.querySelector("celEmail").innerHTML = objData.data.email_user;
    			document.querySelector("celTipoUsuario").innerHTML = objData.data.nombrerol;
    			document.querySelector("celEstado").innerHTML = objData.data.estadoUsuario;
    			document.querySelector("celFechaRegistro").innerHTML = objData.data.fechaRegistro;
    			$('#modalViewUser').modal('show');
    		}else{
    			swal("Error", objData.msg, "error");
    		}
    	}
    }    
}

function fntEditUsuario(idpersona){
	document.querySelector('#titleModal').innerHTML = "Actualizar Usuario";
	document.querySelector('.modal-header').classList.replace("headerRegister", "headerUpdate");
	document.querySelector('#btnActionForm').classList.replace("btn-primary", "btn-info");
	document.querySelector('#btnText').innerHTML = "Actualizar";

	var idpersona = idpersona;
	var request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
	var ajaxUrl = base_url+'/Usuarios/getUsuario'+idpersona; //nos dirijimos a la funcion getUsuario 
	request.open('GET',ajaxUrl,true);
	request.send();//enviamos la informacion, todos los campos del formulario formData
	request.onreadystatechange = function(){
		if(request.readyState == 4 && request.status == 200){
			var objData = JSON.parse(request.responseText);

			if (objData.status) 
			{
				document.querySelector("#idUsuario").value = objData.data.idpersona;
				document.querySelector("#txtIdentificacion").value = objData.data.identificacion;
				document.querySelector("#txtNombre").value = objData.data.nombres;
				document.querySelector("#txtApellido").value = objData.data.apellidos;
				document.querySelector("#txtTelefono").value = objData.data.telefono;
				document.querySelector("#txtEmail").value = objData.data.email_user;
				document.querySelector("#listRolid").value = objData.data.idrol;
				$('#listRolid').selectpicker('render');

				if (objData.data.status == 1) {
					document.querySelector("#listStatus").value = 1;
				}else{
					document.querySelector("#listStatus").value = 2;
				}
				$('#listStatus').selectpicker('render');
			}	
		}
		$('#modalFormUsuario').modal('show');

	}

}


function fntDelUsuario(idpersona){

	var idUsuario = idpersona;
	swal({
		title: "Eliminar Usuario",
		text: "¿Realmente quiere elimnar el Usuario?",
		type: "warning",
		showCancelButton: true,
		confirmButtonText: "Si, eliminar!",
		cancelButtonText: "No, cancelar!",
		closeOnConfirm: false,
		closeOnCancel: true
	}, function(isConfirm){

		if (isConfirm) 
		{
			var request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
			var ajaxUrl = base_url+'/Usuarios/delUsuario'; //nos dirijimos a la funcion getUsuario 
			var strData = "idUsuario="+idUsuario;
			request.open("POST",ajaxUrl, true);
			request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
			request.send(strData);//enviamos la informacion, todos los campos del formulario formData
		        //retornamos una funcion
		    request.onreadystatechange = function(){
		    	if (request.readyState == 4 && request.status == 200) {
		    		var objData = JSON.parse(request.responseText);
		    		if (objData.status) 
		    		{
		    			swal("Eliminar!", objData.msg, "success");
		    			tableUsuarios.api().ajax.reload();
		    		}else{
		    			swal("Atencion", objData.msg, "error");
		    		}
		    	}
		    }
			
		}
	});
}



function openModal()
{

    document.querySelector('#idUsuario').value = ""; 
    document.querySelector('.modal-header').classList.replace("headerUpdate", "headerRegister"); //con classList nos dirigimos al elemento modal-header y lo reemplazamos
    document.querySelector('#btnActionForm').classList.replace("btn-info", "btn-primary");
    document.querySelector('#btnText').innerHTML = "Guardar";
    document.querySelector('#titleModal').innerHTML = "Nuevo Usuario";
    document.querySelector('#formUsuario').reset();//limpiamos todos los campos

	$('#modalFormUsuario').modal('show');//mostramos
}

function openModalPerfil(){
	$('#modalFormPerfil').modal('show');//mostramos el formulario
}





