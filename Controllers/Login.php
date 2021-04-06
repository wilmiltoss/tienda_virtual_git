<?php 
	
	
	class Login extends Controllers { //heredamos la clase Controllers
		
		public function __construct()
		{
			//validacion usuario logeado/ no mostrar el frm login
			session_start();
			if (isset($_SESSION['login'])) //si existe la session
			{
				header('Location: '.base_url().'/dashboard'); //direcciona al frm dashboard
			}

			parent::__construct();//ejecuta el metodo que esta en el controllers  loadModel A1

		}

		public function login ()
		{
			//invocamos la vista principal 
			//data tiene toda la informacion de nuestra vista
			$data['page_tag'] = "Login - Tienda Virtual";
			$data['page_title'] = "Login - Tienda Virtual";
			$data['page_name']  = "login";
			$data['page_functions_js']  = "function_login.js";
			$this->views->getView($this,"login",$data);//contiene todos los parametros de nuestra vista  A3 en data osea llamamos a la vista View/home
		}

		public function loginUser(){
			
			if ($_POST) { //si se realiza una peticion a este metodo
				if (empty($_POST['txtEmail']) || empty($_POST['txtPassword'])) {//si estan vacio los campos
					$arrResponse = array('status' => false, 'msg' => 'Error de datos');
				}else{


					$strUsuario = strtolower(strClean($_POST['txtEmail']));//pone en minuscula
					$strPassword = hash("SHA256",$_POST['txtPassword']);//encriptacion
					$requestUser = $this->model->loginUser($strUsuario, $strPassword);//metodo loginUser

					if (empty($requestUser)) {
						$arrResponse = array('status' => false, 'msg' => 'El usuario o la contraseña es incorrecta.');
					}else{
						$arrData = $requestUser;
						if ($arrData['status'] == 1) {

							$_SESSION['idUser'] = $arrData['idpersona'];//inicialisamo con session_start para crear las variables se session
							$_SESSION['login'] = true;
							//Obtenemos todos los datos del usuario//si actualizamos los datos p/ no cerrar session
							$arrData = $this->model->sessionLogin($_SESSION['idUser']);
							$_SESSION['userData'] = $arrData;

							$arrResponse = array('status' => true, 'msg' => 'ok');//si fue correcto el login
							
						}else{
							$arrResponse = array('status' => false, 'msg' => 'Usuario inactivo');
						}
					}
				}
				echo json_encode($arrResponse, JSON_UNESCAPED_UNICODE);//convertimos a json el array para retornarlo al archivo de funciones
			}
			die();
		}
	}

 ?>