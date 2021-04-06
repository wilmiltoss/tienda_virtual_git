
var tableRoles;

//agregamos un evento al momento que se carga el archivo, el html Views/Roles/roles.php
document.addEventListener('DOMContentLoaded', function(){

    tableRoles = $('#tableRoles').dataTable( {
    	"aProcessing":true,
    	"aServerSide":true,
    	"language":{
    		"url":"//cdn.datatables.net/plug-ins/1.10.20/i18n/Spanish.json"//convierte el lenguaje en español
    	},
        "ajax":{
        	"url": " "+base_url+"/roles/getRoles",
        	"dataSrc":""

        },
        "columns":[
            {"data":"idrol"},
            {"data":"nombrerol"},
            {"data":"descripcion"},
            {"data":"status"},
            {"data":"options"}
        ],
        "resonsieve":"true",
        "bDestroy": true,
        "iDisplayLength": 10,
        "order":[[0,"desc"]]
    });

    //NUEVO ROL
    var formRol = document.querySelector("#formRol"); //#formRol es el id del formulario
    formRol.onsubmit = function(e){ //onsubmit en el momento q envia la informacion, ejecuta la funcion sgte
        e.preventDefault();//evita recargar la pagina

        var intIdRol = document.querySelector('#idRol').value;
        var strNombre = document.querySelector('#txtNombre').value;
        var strDescripcion = document.querySelector('#txtDescripcion').value;
        var intStatus = document.querySelector('#listStatus').value;

        if (strNombre == '' || strDescripcion == '' || intStatus == '') 
        {
            
            swal("Atención", "Todos los campos son obligatorios" , "error");
            return false;
        }
        //obtenemos c/u de los objetos dependiendo del navegador
        var request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
        var ajaxUrl = base_url+'/Roles/setRol'; //nos dirijimos a la funcion setRol en Roles.php

        var formData  = new FormData(formRol);//hacemos referencia al formulario.
        request.open("POST",ajaxUrl,true);// abrimos la ventana y enviamos el parametro, lo apuntamos hacia la variable de ajax por medio de POST
        request.send(formData);//enviamos la informacion, todos los campos del formulario formData
        //retornamos una funcion
        request.onreadystatechange = function(){

           if (request.readyState == 4 && request.status == 200) {
                 var objData = JSON.parse(request.responseText);//convertimos a un objeto el json
         
                 if (objData.status) //si el status es verdadero
                 {
                     $('#modalFormRol').modal("hide"); //cerramos el modal
                     formRol.reset();//limpiamos los campos con reset
                     swal("Roles de usuario", objData.msg, "success");//traemos los mensajes
                     tableRoles.api().ajax.reload(function(){ //funciona que asigna el evento a c/ uno de los botones

                        fntEditRol();
                        //fntDelRol();
                       // fntPermisos();
                    });
                 }
                 else{
                    swal("Error", objData.msg, "error");
                 }
            } 
        }
    }    
});


$('#tableRoles').DataTable(); //se utiliza en Views/Roles/roles.php 


//FUNCION DE LOS CONTROLES DEL formulario NUEVO ROL

function openModal()
{

    document.querySelector('#idRol').value = ""; 
    document.querySelector('.modal-header').classList.replace("headerUpdate", "headerRegister"); //con classList nos dirigimos al elemento modal-header y lo reemplazamos
    document.querySelector('#btnActionForm').classList.replace("btn-info", "btn-primary");
    document.querySelector('#btnText').innerHTML = "Guardar";
    document.querySelector('#titleModal').innerHTML = "Nuevo Rol";
    document.querySelector('#formRol').reset();

	$('#modalFormRol').modal('show');
}

//agregamos el evento load, cuando se carga todo el documento


/*window.addEventListener('load', function() {
    fntEditRol();
    fntDelRol();
}, false);*/


window.addEventListener('load', function() {
    setTimeout(() => { 
        fntEditRol();
        fntDelRol();
    }, 500);
  }, false);




//Funcion editor de botones del rol, evento para mostrar el modal
function fntEditRol(){
    var btnEditRol = document.querySelectorAll(".btnEditRol");
    btnEditRol.forEach(function(btnEditRol){
        btnEditRol.addEventListener('click', function(){

            //REEMPLAZOS
            document.querySelector('#titleModal').innerHTML = "Actualizar Rol"; //con innerHTL cambiamos el texto en el html
            document.querySelector('.modal-header').classList.replace("headerRegister", "headerUpdate"); //con classList nos dirigimos al elemento modal-header y lo reemplazamos
            document.querySelector('#btnActionForm').classList.replace("btn-primary", "btn-info");
            document.querySelector('#btnText').innerHTML = "Actualizar";

            //script p/ ejecutar el ajax
            var idrol = this.getAttribute("rl");//accedemos al atributo rl
            var request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
            var ajaxetUser = base_url+'/Roles/getRol/'+idrol;//nos dirijimos a la ruta url del rol capturado
            request.open("GET",ajaxetUser,true);//asignamos true
            request.send();//enviamos

            request.onreadystatechange = function(){
                if (request.readyState == 4 && request.status == 200) {
                    //console.log(request.responseText);//ver respuesta en consola
                    var objData = JSON.parse(request.responseText);//convertimos a un objeto el json
                        //  alert(objData.data.nombrerol);
                    //validamos
                    if (objData.status) {//si el estatus es verdadero
                        //seteamos lo campos con los valores que debe traer

                        document.querySelector("#idRol").value = objData.data.idrol;
                        document.querySelector("#txtNombre").value = objData.data.nombrerol;
                        document.querySelector("#txtDescripcion").value = objData.data.descripcion;
                       
                       //de la opcion lista desplegable
                        if (objData.data.status == 1) {
                            var optionSelect = '<option value="1" selected class="notBlock">Activo</option>';
                        }else{
                            var optionSelect = '<option value="2" selected class="notBlock">Inactivo</option>';//crea la variable a inactivo
                        }

                        var htmlSelect = `${optionSelect}
                                          <option value="1">Activo</option>
                                          <option value="2">Inactivo</option>
                                          `;
                        //coloca en el html la variable htmlSelect
                        document.querySelector("#listStatus").innerHTML = htmlSelect;
                        $('#modalFormRol').modal('show');    //muestra  

                    }else{
                        swal("Error", objData.msg , "error");
                    }
                }
             }

        });
    });
}
//ELIMINA ROL
function fntDelRol(){
    var btnDelRol = document.querySelectorAll(".btnDelRol");//nos dirigimos a todas las clases q contiene btnDelRol
    btnDelRol.forEach(function(btnDelRol){//recorremos con forEach
        btnDelRol.addEventListener('click', function(){//agregamos el evento click
            var idrol = this.getAttribute("rl");//se ejecuta el click al valor rl
           
            //scrip para mostrar la alerta
            swal({
                title: "Eliminar Rol",
                text: "¿Realmente quiere eliminar el Rol?",
                type: "warning",
                showCancelButton: true,
                confirmButtonText: "Si, eliminar!",
                cancelButtonText: "No, cancelar!",
                closeOnConfirm: false,
                closeOnCancel: true //cuando le da click en cancelar se cierra

            }, function(isConfirm) { //scrip para eliminar

                if (isConfirm) 
                {

                    var request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
                    var ajaxUrl = base_url+'/Roles/delRol/';//nos dirimos al metodo delRol
                    var strData = "idrol="+idrol;
                    request.open("POST",ajaxUrl,true);
                    request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");//forma de enviar los datos
                    request.send(strData);//hacemos el envio por la funcion

                    request.onreadystatechange = function(){
     //console.log(ajaxUrl);//ver respuesta en consola
                        if (request.readyState == 4 && request.status == 200) {//si la peticion es exitosa
                            var objData = JSON.parse(request.responseText);//parseamos

                            if (objData.status) //si es verdadero
                            {
                                swal("Eliminar!",objData.msg , "success");
                                tableRoles.api().ajax.reload(function(){
                                    fntEditRol();//ejecutamos las funciones
                                    fntDelRol();
                                });
                            }else{
                                swal("Atención!",objData.msg ,"error");
                            }
                        }
                    }
                }
            });
        });
    });
}