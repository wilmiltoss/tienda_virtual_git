<?php 

		class Roles extends Controllers { //heredamos la clase Controllers
		
		public function __construct()
		{
			parent::__construct();//ejecuta el metodo que esta en el controllers  loadModel A1

			//validacion del usuario no logeado
			session_start();
			if (empty($_SESSION['login'])) //si esta vacio
			{
				header('Location: '.base_url().'/login'); //direcciona al frm login
			}


		}

		public function Roles()
		{
			//invocamos la vista principal 
			//data tiene toda la informacion de nuestra vista
			$data['page_id'] = 3;
			$data['page_tag'] = "Roles Usuario";
			$data['page_name']= "rol_usuario";
			$data['page_title']   = "Roles Usuario <small> Tienda Virtual</samall>";
			$data['page_functions_js']  = "functions_roles.js";
			$this->views->getView($this,"roles",$data);//con roles llamamos a la vista View/Roles/roles.php
		}

		//METODO QUE EXTRAE TODOS LOS ROLES
		public function getRoles()//se obtiene la info mediante el get
		{
			$arrData = $this->model->selectRoles();//llamamos al metodo selectRoles //con $this->model referenciamos al directorio Models/rolesModel.php

			for ($i=0; $i < count($arrData); $i++) { 
				if ($arrData[$i]['status'] == 1) 
				{
				 	$arrData[$i]['status'] = '<span class="badge badge-success">Activo</span>';
				}else{
					 $arrData[$i]['status'] = '<span class="badge badge-danger">Inactivo</span>';
				}
										  //armaos el div en donde obtenemos los botones
				$arrData[$i]['options'] = '<div class="text-center">
				
				<button class="btn btn-secondary btn-sm btnPermisosRol" rl="'.$arrData[$i]['idrol'].'" title="Permisos"><i class="fas fa-key"></i></button>
				<button class="btn btn-primary btn-sm btnEditRol" rl="'.$arrData[$i]['idrol'].'" title="Editar"><i class="fas fa-pencil-alt"></i></button>
				<button class="btn btn-danger btn-sm btnDelRol" rl="'.$arrData[$i]['idrol'].'" title="Eliminar"><i class="fas fa-trash-alt"></i></button>
				

											</div>';
			}


			echo json_encode($arrData, JSON_UNESCAPED_UNICODE);
			die();//finaliza el proceso 
     
		}

		//METODO QUE EXTRAE UN ROL
		public function getRol(int $idrol)
		{
			$intIdrol = intval(strClean($idrol));//variable formateada en entero(limpiamos)
			if($intIdrol > 0)//si es valido
			{
				$arrData = $this->model->selectRol($intIdrol);//enviamos a el id a selectRol ubicado en RoldesModel.php
				if(empty($arrData))
				{
					$arrResponse = array('status' => false, 'msg' => 'Datos no encontrados.');//asignamos false
				}else{
					$arrResponse = array('status' => true, 'data' => $arrData);//asgnamos a true con el dato
				}
				echo json_encode($arrResponse, JSON_UNESCAPED_UNICODE);//limpiamos los caracteres especiales
			}
			die();
		}




		//ALMACENA ROL
		public function setRol(){
			//dep($_POST);//mostramos en depuracion red, si llega la informacion

			$intIdrol = intval($_POST['idRol']);
			$strRol = strClean($_POST['txtNombre']);//con strClean limpiamos las inyecciones
			$strDescripcion = strClean($_POST['txtDescripcion']);
			$intStatus = intval($_POST['listStatus']);

			//validacion para recargar pagina con los metodos
			if ($intIdrol == 0) {
				//crear
				$request_rol = $this->model->insertRol($strRol, $strDescripcion, $intStatus);
				$option = 1;
			}else{
				//actualizar
				$request_rol = $this->model->updateRol($intIdrol,$strRol, $strDescripcion, $intStatus);//updateRol de RolesModel.php
				$option = 2;
			}
			
			//evaluamos la condicion
			if ($request_rol > 0)
			{
				if ($option == 1) 
				{
					$arrResponse = array('status' => true, 'msg' => 'Datos guardados correctamente.');
				}else {
					$arrResponse = array('status' => true, 'msg' => 'Datos Actualizados correctamente.');
				}
			}else if ($request_rol == 'exist') {
				$arrResponse = array('status' => false, 'msg' => 'Atención el rol ya exsite.');

			}else{
				$arrResponse = array('status' => false, 'msg' => 'No es posible almacenar los datos.');
			}
			echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);
			die();//detiene el proceso

		}

		public function delRol()
		{
			if ($_POST) { // si hay una peticion POST
				$intIdrol = intVal($_POST['idrol']);//convertimos a un entero
				$requestDelete = $this->model->deleteRol($intIdrol);
				if ($requestDelete == 'ok') 
				{
					$arrResponse = array('status' => true, 'msg' => 'Se ha eliminado el Rol');
				}else if($requestDelete == 'exist'){
					$arrResponse = array('status' => false, 'msg' => 'No es posible eliminar un Rol asociado a usuarios.');
				}else{
					$arrResponse = array('status' => false, 'msg' => 'Error al eliminar el Rol.');
				}
				echo json_encode($arrResponse, JSON_UNESCAPED_UNICODE);
			}
			die();
		}

	}


 ?>