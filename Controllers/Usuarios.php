<?php 
	
	
	class Usuarios extends Controllers { //heredamos la clase Controllers
		
		public function __construct()
		{
			parent::__construct();//ejecuta el metodo que esta en el controllers  loadModel A1
			//validacion del usuario no logeado
			session_start();
			if (empty($_SESSION['login'])) //si esta vacio
			{
				header('Location: '.base_url().'/login'); //direcciona al frm login
			}
			//getPermisos(2);

		}

		public function Usuarios ()
		{
			//invocamos la vista principal 
			//data tiene toda la informacion de nuestra vista
			$data['page_tag'] = "Usuarios";
			$data['page_title'] = "USUARIOS <small>Tienda Virtual</small>";
			$data['page_name']  = "usuarios";
			$data['page_functions_js']  = "functions_usuarios.js";
			$this->views->getView($this,"usuarios",$data);//contiene todos los parametros de nuestra vista  A3 en data osea llamamos a la vista View/home
		}


	/*	public function setUsuario(){
			if ($_POST) {
				if (empty($_POST['txtIdentificacion']) || empty($_POST['txtNombres']) || empty($_POST['txtApellidos']) ||
				empty($_POST['txtTelefono']) || empty($_POST['txtEmail']) || empty($_POST['listRolid']) || empty($_POST['listStatus'])) 
				{
					$arrResponse = array("status" => false, "msg" => 'Datos incorrectos. ');

				}else{
					$idUsuario = intval($_POST['idUsuario']);
					$strIdentificacion = strClean($_POST['txtIdentificacion']);
					$strNombre = ucwords(strClean($_POST['txtNombre']));
					$strApellido = ucwords(strClean($_POST['txtApellido']));
					$intTelefono = intval(strClean($_POST['txtTelefono']));
					$strEmail = strtolower(strClean($_POST['txtEmail']));
					$intTipoId = intval(strClean($_POST['listRolid']));
					$intStatus = intval(strClean($_POST['listStatus']));

					if ($idUsuario == 0) 
					{
						$option = 1;
						$strPassword = empty($_POST['txtPassword']) ? hash("SHA256", passGenerator()) : $_POST['txtPassword'];
						$request_user = $this->model->insertUsuario($idUsuario,
																	$strIdentificacion,
																	$strNombre,
																	$strApellido,
																	$intTelefono,
																	$strEmail,
																	$strPassword,
																	$intTipoId,
																	$intStatus);
					}else{
						$option = 2;
						$strPassword = empty($_POST['txtPassword']) ? hash("SHA256", passGenerator()) : $_POST['txtPassword'];
						$request_user = $this->model->insertUsuario($idUsuario,
																	$strIdentificacion,
																	$strNombre,
																	$strApellido,
																	$intTelefono,
																	$strEmail,
																	$strPassword,
																	$intTipoId,
																	$intStatus);



					}

					if ($request_user > 0) 
					{
						if ($option == 1) {
							$arrResponse = array("status" => true, "msg" => 'Datos guardados correctamente. ');
						}else{
							$arrResponse = array("status" => true, "msg" => 'Datos actualizados correctamente. ');
						}
					}else if ($request_user == 'exist') {
						$arrResponse = array("status" => false, "msg" => '¿Atención! el mail o la identidad no existen ');
					}else{
						$arrResponse = array("status" => false, "msg" => 'No es posible almacenar los datos. ');
					}

				}
				echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);
			}

			die();
		}*/

	/*	public function getUsuarios()
		{
			$arrData = $this->model->selectUsuarios();
			for ($i=0; $i < count($arrData); $i++){
				$btnView = '';
				$btnEdit = '';
				$btnDelete = '';

				if ($arrData[$i]['status'] == 1) {
					$arrData[$i]['status'] = '<span class = "badge badge-success">Activo</span>';
				}else{
					$arrData[$i]['status'] = '<span class = "badge badge-danger">Inactivo</span>';
				}

				if ($_SESSION['permisosMod']['r']) {
					$btnView = '<button class="btn btn-info btn-sm btnViewUsuario" onClick="fntViewUsuario
					idpersona'].')" title="Ver usuario"><i class="far fa-eye"></i></button>';
				}
				if ($_SESSION['permisosMod']['u']) {
					if (($_SESSION['idUser'] == 1 and $_SESSION['userData']['idrol'] == 1) ||
						($_SESSION['userData']['idrol'] == 1 and $arrData[$i]['idrol'] != 1) ) {
						$btnEdit = '<button class = "btn btn-primary btn-sm btnEditUsuario" onClick="fntViewUsuario">'
							[$i]['idpersona'].')" title="Editar usuario"><i class="fas fa-pencil-alt"></button>'
					}else{
						$btnEdit = '<button class="btn btn-secondary btn-sm" disabled ><i class="fas fa-pencil-alt"></i></button>';
					}

				}
			if ($_SESSION['permisosMod']['d']) {
				if (($_SESSION['idUser'] == 1 and $_SESSION['userData']['idrol'] == 1) || 
					($_SESSION['userData']['idrol'] == 1 and $arrData[$i]['idrol'] != 1) and
				 	($_SESSION['userData']['idpersona'] != $arrData[$i]['idpersona'])
				  ){
					$btnDelete = '<button class="btn btn-danger btn-sm btnDelUsuario" onClick="fntViewUsuario">'
					[i]['idpersona'].')" title="Eliminar usuario"><i class=far fa-trash-alt"></button>'
				}else{
					$btnDelete = '<button class="btn btn-secondary btn-sm" disabled ><i class="far fa-trash-alt"></i></button>';
				}
			}

			$arrData[$i]['options'] = '<div class="text-center">'.$btnView.' '.$btnEdit.' '.$btnDelete
			}
			echo json_encode($arrData,JSON_UNESCAPED_UNICODE);
			die();
		}*/




		public function getUsuario(int $idpersona){

			$idUsuario = intval($idpersona);
			if ($idUsuario > 0) {
				$arrData = $this->model->selectUsuarios($idUsuario);
				if (empty($arrData)) 
				{
					$arrResponse = array("status" => false, "msg" => 'Datos no encontrados. ');
				}else{
					//$arrResponse = array("status" => true, "msg" => 'data' => $arrData);
				}
				echo json_encode($arrData,JSON_UNESCAPED_UNICODE);
			}
			die();
		}


		public function delUsuario()
		{
			if ($_POST) {
				$intIdpersona = intval($_POST['idUsuario']);
				$requestDelete = $this->model->deleteUsuario($intIdpersona);
				if ($requestDelete) {
					$arrResponse = array("status" => true, "msg" => 'Se ha eliminado el usuario. ');
				}else{
					$arrResponse = array("status" => false, "msg" => 'Error al eliminar el usuario. ');
				}
				echo json_encode($arrData,JSON_UNESCAPED_UNICODE);
			}
			die();
		}

		public function perfil(){
			$data['page_tag'] = "Perfil";
			$data['page_title'] = "Perfil de usuario";
			$data['page_name']  = "perfil";
			$data['page_functions_js']  = "functions_usuarios.js";
			$this->views->getView($this,"perfil",$data);//contiene todos los parametros de nuestra vista  A3 en data osea llamamos a la vista View/home
		}
	}

 ?>